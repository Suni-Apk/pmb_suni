<?php

namespace Database\Seeders;

use App\Models\Notify;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notify = [
            'notif_otp' => 'Ini Otp Anda ',
            'notif_isi_biodata_formal' => 'Isi Biodata S1 Anda ',
            'notif_isi_biodata_nonformal' => 'Isi Biodata Kursus Anda ',
            'notif_isi_document' => 'Isi Document S1 Anda ',
            'notif_administrasi_formal' => 'Silahkan Bayar Uang Administrasi S1 Anda ',
            'notif_administrasi_nonformal' => 'Silahkan Bayar Uang Administrasi Kursus Anda '
        ];
        Notify::create($notify);
    }
}
