<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $numberOfYears = 10; // Ubah sesuai dengan jumlah tahun ajaran yang ingin Anda hasilkan

        foreach (range(1, $numberOfYears) as $index) {
            $year = 2020 + $index; // Ganti tahun awal sesuai kebutuhan
            DB::table('tahun_ajarans')->insert([
                'year' => $year . '/' . ($year + 1),
                'status' => 'Active', // Status aktif/nonaktif, 0 = Nonaktif, 1 = Aktif
                'start_at' => now()->subDays(rand(1, 365)), // Tanggal mulai acak dalam satu tahun terakhir
                'end_at' => now()->addDays(rand(1, 365)), // Tanggal selesai acak dalam satu tahun mendatang
            ]);
        }
    }
}
