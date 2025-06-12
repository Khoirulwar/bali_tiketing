<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FacilitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $facilities = [
            [
                'name' => 'Mushola',
                'description' => 'Tempat ibadah yang nyaman',
                'image' => 'mushola.png',
            ],
            [
                'name' => 'Parkir Motor',
                'description' => 'Parkir Kendaraan yang luas',
                'image' => 'parkirMotor.jpg',
            ],
            [
                'name' => 'Toilet',
                'description' => 'Toilet dan kamar mandi bilas yang bersih',
                'image' => 'toilet.jpg',
            ],
        ];

        foreach ($facilities as $facility) {
            DB::table('facilities')->insert($facility);
        }
    }
}
