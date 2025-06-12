<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\PaymentConfirmation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Memuat tiket dengan pembayaran terkait
    $tickets = Ticket::with('paymentConfirmation')->orderBy('created_at', 'desc')->get();
    $users = User::all();

    foreach ($tickets as $ticket) {
        $ticket->total_tickets = $ticket->adult_ticket_count + $ticket->child_ticket_count;
    }

    return view('dataTiket.transaksi.index', compact('tickets', 'users'));
}

// public function checkTicket($ticket_number)
// {
//     $ticket = Ticket::where('ticket_number', $ticket_number)
//                     ->where('status', 'paid')
//                     ->first();

//     if ($ticket) {
//         return response()->json([
//             'success' => true,
//             'message' => 'Tiket valid dan sudah dibayar.',
//             'ticket' => $ticket
//         ], 200);
//     } else {
//         return response()->json([
//             'success' => false,
//             'message' => 'Tiket tidak valid atau belum dibayar.'
//         ], 404);
//     }
// }


public function showQr($id)
{
    $ticket = Ticket::findOrFail($id);
    return view('qrcode', [
        'ticket_number' => $ticket->ticket_number,
    ]);
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Jika ada tampilan form create, masukkan logika di sini
    }

    // Fungsi untuk menghasilkan nomor tiket yang unik
    private function generateUniqueTicketNumber()
    {
        do {
            $ticketNumber = mt_rand(100000, 999999);
        } while (Ticket::where('ticket_number', $ticketNumber)->exists());

        return $ticketNumber;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'visit_date' => 'required|date',
            'adult_ticket_count' => 'required|integer',
            'child_ticket_count' => 'required|integer',
            'promo_code' => 'nullable|string',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Generate nomor tiket unik
        $ticketNumber = $this->generateUniqueTicketNumber();

        // Tambahkan nomor tiket ke data yang akan disimpan
        $validatedData['ticket_number'] = $ticketNumber;

        // Simpan data ke dalam tabel tickets
        Ticket::create($validatedData);

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('tickets.index')->with('success', 'Transaksi tiket berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $paymentConfirmations = PaymentConfirmation::where('ticket_id', $ticket->id)->get();

        return view('dataTiket.transaksi.detail', compact('ticket', 'paymentConfirmations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Jika ada tampilan form edit, masukkan logika di sini
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
    
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->save();
    
        return redirect()->route('tickets.index')->with('success', 'Status tiket berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Data tiket berhasil dihapus.');
    }

    /**
     * Display the detail of the specified ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $ticket = Ticket::findOrFail($id);
        $paymentConfirmations = PaymentConfirmation::where('ticket_id', $ticket->id)->get();

        // Mengembalikan view partial yang akan dimuat ke dalam modal
        return view('dataTiket.transaksi.detail', compact('ticket', 'paymentConfirmations'));
    }
}
