<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dan tahun dari query string atau default ke bulan dan tahun saat ini
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Query untuk mendapatkan data laporan tiket dengan kategori weekday dan weekend
        $reports = Ticket::selectRaw('
            DATE(visit_date) as date,
            SUM(CASE WHEN DAYOFWEEK(visit_date) BETWEEN 2 AND 6 THEN adult_ticket_count ELSE 0 END) as total_adults_weekday,
            SUM(CASE WHEN DAYOFWEEK(visit_date) BETWEEN 2 AND 6 THEN child_ticket_count ELSE 0 END) as total_children_weekday,
            SUM(CASE WHEN DAYOFWEEK(visit_date) = 1 OR DAYOFWEEK(visit_date) = 7 THEN adult_ticket_count ELSE 0 END) as total_adults_weekend,
            SUM(CASE WHEN DAYOFWEEK(visit_date) = 1 OR DAYOFWEEK(visit_date) = 7 THEN child_ticket_count ELSE 0 END) as total_children_weekend,
            SUM(total_price) as total_revenue
        ')
        ->whereYear('visit_date', $year)
        ->whereMonth('visit_date', $month)
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->paginate(10); // Menampilkan 10 baris per halaman

        return view('ticketReports.index', compact('reports', 'month', 'year'));
    }
}
