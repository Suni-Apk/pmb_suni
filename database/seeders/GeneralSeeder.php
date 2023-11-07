<?php

namespace Database\Seeders;

use App\Models\General;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        General::create([
            'name'    => 'Suni Indonesia',
            'image'   => 'https://suniindonesia.com/wp-content/uploads/2022/07/LOGO-2@2x-100x100.png',
            'phone'   => '123456781234',
            'email'   => 'suniindonesia@gmail.com',
            'title'   => 'SUNI ID',
            'url'     => 'http://www.suniindonesia.com',
        ]);
    }
}
