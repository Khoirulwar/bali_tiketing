<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter pencarian dari session atau input
        $search = $request->session()->get('search', $request->input('search', ''));
        $tickets = collect();

        if ($search) {
            // Cari tiket dengan nomor tiket yang sesuai dengan pencarian
            $tickets = Ticket::where('ticket_number', 'LIKE', '%' . $search . '%')->get();
        }

        // Hitung total pengunjung
        $totalVisitors = Visitor::count();

        // Kirim data pencarian tiket dan total pengunjung ke view
        return view('dashboardAdmin', compact('tickets', 'search', 'totalVisitors'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search', '');
        $request->session()->put('search', $search);

        $tickets = collect();
        if (!empty($search)) {
            // Cari tiket yang aktif dan nomor tiketnya sesuai dengan pencarian
            $tickets = Ticket::where('ticket_number', 'LIKE', '%' . $search . '%')
                ->whereIn('status', ['aktif', 'belum bayar'])
                ->get();
        }

        return view('dashboardAdmin', [
            'tickets' => $tickets,
            'search' => $search
        ]);
    }

    public function updateStatusFromDashboard(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:belum bayar,aktif,nonaktif',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->save();

        $search = $request->session()->get('search', $request->input('search', ''));

        return redirect()->route('dashboard.index', ['search' => $search])
            ->with('success', 'Status tiket berhasil diperbarui');
    }

    public function validateTicket(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        // Ubah status menjadi nonaktif
        $ticket->status = 'nonaktif';
        $ticket->save();

        $search = $request->session()->get('search', $request->input('search', ''));

        // Redirect kembali ke halaman dashboard
        return redirect()->route('dashboard.index', ['search' => $search])
            ->with('success', 'Tiket berhasil divalidasi dan dinonaktifkan.');
    }
}
