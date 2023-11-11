<?php

namespace Database\Seeders;

use App\Models\Administrasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrasi::create([
            'program_belajar' => 'S1',
            'amount' => '250000',
            'id_tahunAjaran' => 1,
        ]);
        
        Administrasi::create([
            'program_belajar' => 'Kursus',
            'amount' => '850000',
            'id_tahunAjaran' => 1,
        ]);
    }
}
