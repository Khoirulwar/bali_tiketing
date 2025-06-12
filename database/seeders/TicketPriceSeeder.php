<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketPrice;

class TicketPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketPrice::create([
            'adult_price_weekday' => 12500,
            'child_price_weekday' => 10000,
            'adult_price_weekend' => 15000,
            'child_price_weekend' => 12500,
        ]);
    }
}
