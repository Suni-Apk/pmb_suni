<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = [
            [
                'name'   => 'Pendidikan Agama Islam',
                'code'   => 'PAI',
            ],
            [
                'name'   => 'Hukum Ekonomi Syariah',
                'code'   => 'HES',
            ],
            [
                'name'   => 'Hukum Keluarga',
                'code'   => 'HK',
            ],
        ];

        foreach ($seed as $key => $item) {
            Jurusan::firstOrCreate($item);
        }
    }
}
