<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Content;
use App\Models\TicketPrice;
use App\Models\Visitor; // Tambahkan ini
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        // Simpan IP pengunjung ke database
        Visitor::create([
            'ip_address' => $request->ip(),
        ]);

        // Ambil data untuk landing page
        $facilities = Facility::all();
        $contents = Content::all();
        $ticketPrices = TicketPrice::all();

        // Kembalikan view dengan data yang diperlukan
        return view('landingPage', compact('facilities', 'contents', 'ticketPrices'));
    }
}

