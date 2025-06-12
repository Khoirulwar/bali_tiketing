<?php

namespace App\Http\Controllers;

use App\Models\ScannedTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketScanController extends Controller
{
    public function store(Request $request)
    {
        $ticketNumber = $request->ticket_number;

        // Cek validasi tiket, misalnya:
        $isValid = Ticket::table('ticket_number')->where('ticket_number', $ticketNumber)->exists();

        ScannedTicket::create([
            'ticket_number' => $ticketNumber,
            'valid' => $isValid,
        ]);

        return redirect('/scan-ticket');
    }

    public function latestTicket()
    {
        $ticket = ScannedTicket::where('is_processed', false)
                    ->latest()
                    ->first();

        if ($ticket) {
            $ticket->update(['is_processed' => true]);
            return response()->json([
                'ticket_number' => $ticket->ticket_number,
                'valid' => $ticket->valid,
            ]);
        }

        return response()->json([
            'ticket_number' => '',
            'valid' => false,
        ]);
    }

}