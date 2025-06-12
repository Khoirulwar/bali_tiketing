<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use App\Models\TicketPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TicketController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($tickets, 200);
    }

    // public function checkTicket($ticket_number)
    // {
    //     $ticket = Ticket::where('ticket_number', $ticket_number)
    //                     ->whereIn('status', ['aktif', 'belum bayar'])
    //                     ->first();

    //     if (!$ticket) {
    //         return response()->json(['status' => 'nonaktif'], 404);
    //     }
    //     $status = $ticket->status === 'aktif' ? 'aktif' : 'belum bayar';

    //     return response()->json([
    //         'status' => $status,
    //         'ticket' => $ticket->toPublicArray()
    //     ]);
    // }

    public function checkTicket($ticket_number)
    {
        $ticket = Ticket::where('ticket_number', $ticket_number)->first();

        if (!$ticket) {
            return response()->json(['message' => 'Tiket tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => $ticket->status,
            'ticket' => $ticket->toPublicArray()
        ], 200);
    }


    public function show($id)
    {
        $ticket = Ticket::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($ticket);
    }

    public function create(Request $request){
        $request->validate([
            'visit_date' => 'required|date',
            'adult_ticket_count' => 'required|integer|min:1|max:10',
            'child_ticket_count' => 'required|integer|min:0|max:10',
            'promo_code' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Retrieve the ticket prices
        $ticketPrices = $this->getTicketPrices($request->visit_date);

        $totalPrice = ($request->adult_ticket_count * $ticketPrices['adult_price']) +
                      ($request->child_ticket_count * $ticketPrices['child_price']);

        if ($request->promo_code) {
            $discount = $this->calculateDiscount($request->promo_code);
            $totalPrice = $totalPrice * ((100 - $discount) / 100);
        }

        $ticketNumber = $this->generateUniqueTicketNumber();
        $status = 'Belum Bayar';

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'visit_date' => $request->visit_date,
            'adult_ticket_count' => $request->adult_ticket_count,
            'child_ticket_count' => $request->child_ticket_count,
            'promo_code' => $request->promo_code,
            'total_price' => $totalPrice,
            'status' => $status,
            'ticket_number' => $ticketNumber,
        ]);

        return response()->json([
            'message' => 'Ticket booked successfully',
            'id' => $ticket->id,
            'total_price' => $totalPrice,
            'ticket_number' => $ticketNumber,
            'status' => $status,
        ], 200);
    }

    private function generateUniqueTicketNumber()
    {
        do {
            $ticketNumber = mt_rand(100000, 999999);
        } while (Ticket::where('ticket_number', $ticketNumber)->exists());

        return $ticketNumber;
    }

    private function calculateDiscount($promoCode)
    {
        return 10;
    }

    public function getTicketPrices(Request $request)
    {
        $date = $request->query('date');
        if (!$date) {
            return response()->json(['error' => 'Tanggal tidak disediakan.'], 400);
        }

        $prices = $this->fetchTicketPrices($date);

        return response()->json($prices, 200);
    }

    private function fetchTicketPrices($visitDate)
    {
        $dayOfWeek = Carbon::parse($visitDate)->dayOfWeek;
        $ticketPrices = TicketPrice::first();

        if ($dayOfWeek == Carbon::SATURDAY || $dayOfWeek == Carbon::SUNDAY) {
            return [
                'adult_price' => $ticketPrices->adult_price_weekend,
                'child_price' => $ticketPrices->child_price_weekend,
            ];
        } else {
            return [
                'adult_price' => $ticketPrices->adult_price_weekday,
                'child_price' => $ticketPrices->child_price_weekday,
            ];
        }
    }
    
    public function getTicket($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            \Log::info('Ticket data:', $ticket->toArray());
            return response()->json($ticket);
        } else {
            return response()->json(['error' => 'Ticket not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:belum bayar,aktif,non-aktif',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return response()->json(['message' => 'Status updated successfully!'], 200);
    }

    public function destroy($id)
    {

        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        if ($ticket->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted successfully'], 200);

    }
}
