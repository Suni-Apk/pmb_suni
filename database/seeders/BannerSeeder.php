<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Banner::create([
            'image' => 'https://c0.wallpaperflare.com/path/196/594/379/quran-book-97f792a4ef76b251052800f9f56a4c0b.jpg',
            'title' => 'Ini Contoh Banner Welcome',
            'type' => 'WELCOME',
            'author' => 1,
            'desc'  => NULL,
            'target' => NULL,
        ]);

        \App\Models\Banner::create([
            'image' => 'https://c0.wallpaperflare.com/path/196/594/379/quran-book-97f792a4ef76b251052800f9f56a4c0b.jpg',
            'title' => 'Hai, ini contoh Banner Dashboard',
            'type' => 'DASHBOARD',
            'author' => 1,
            'desc'  => 'Untuk memberikan informasi baik kesemua orang, maupun target tertentu.',
            'target' => 'SEMUA',
        ]);
    }
}
