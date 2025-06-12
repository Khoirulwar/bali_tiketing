<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua user untuk membuat tiket bagi setiap user
        $users = User::all();

        foreach ($users as $user) {
            Ticket::create([
                'user_id' => $user->id,
                'visit_date' => Carbon::today()->addDays(rand(0, 30)),
                'adult_ticket_count' => rand(1, 5),
                'child_ticket_count' => rand(1, 5),
                'promo_code' => null,
                'total_price' => rand(100000, 500000),
                'status' => 'belum bayar', // Atau bisa diubah sesuai kebutuhan
                'ticket_number' => mt_rand(100000, 999999), // Atau bisa diubah sesuai kebutuhan
            ]);
        }
    }
}
