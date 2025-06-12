<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run()
    {
        $contents = [
            [
                'title' => 'Promo Musim Panas',
                'content' => 'Nikmati promo spesial musim panas dengan diskon besar untuk tiket masuk!',
                'image' => 'public/images/contents_images/summer.jpg',
            ],
            [
                'title' => 'Event Musik',
                'content' => 'Jangan lewatkan event musik seru di pantai kami dengan artis terkenal!',
                'image' => 'public/images/contents_images/event_music.jpg',
            ],
            [
                'title' => 'Festival Kuliner',
                'content' => 'Rasakan berbagai hidangan lezat di festival kuliner pantai kami!',
                'image' => 'public/images/contents_images/kuliner.jpg',
            ],
        ];

        foreach ($contents as $content) {
            DB::table('contents')->insert([
                'title' => $content['title'],
                'content' => $content['content'],
                'image' => $content['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
