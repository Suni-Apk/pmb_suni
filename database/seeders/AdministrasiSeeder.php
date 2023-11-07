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
        $administrasi = [
            'amount' => '10000',
            'nama_biaya' => 'Administrasi',
            'id_tahunAjaran' => 1,
        ];
        Administrasi::create($administrasi);
    }
}
