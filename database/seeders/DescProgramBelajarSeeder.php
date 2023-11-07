<?php

namespace Database\Seeders;

use App\Models\DescProgramBelajar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DescProgramBelajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DescProgramBelajar::create([
            's1' => 'lorem ipsum dolor sit amet, consectetur adipiscing',
            'kursus' => 'lorem ipsum dolor sit amet, consectetur adipiscing',
        ]);
    }
}
