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
            'title' => 'Banner Welcome',
            'image' => 'https://r4.wallpaperflare.com/wallpaper/681/554/339/abstract-planet-space-purple-wallpaper-6970a84df14a9dbb16f7683f30a186ad.jpg',
            'type' => 'WELCOME',
            'author' => 1,
            'desc'  => NULL,
            'target' => NULL,
        ]);

        \App\Models\Banner::create([
            'title' => 'Banner Dashboard',
            'image' => 'https://r4.wallpaperflare.com/wallpaper/681/554/339/abstract-planet-space-purple-wallpaper-6970a84df14a9dbb16f7683f30a186ad.jpg',
            'type' => 'DASHBOARD',
            'author' => 1,
            'desc'  => 'lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'target' => 'SEMUA',
        ]);
    }
}
