<?php

namespace App\Exports;

use App\Models\Biodata;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class MahasiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $mahasiswa = Biodata::all();

        return $mahasiswa->map(function($mahasiswas){
            return [
                'NO' => $mahasiswas->id,
                'NAMA' => $mahasiswas->user->name,
                'NOMOR TELEPON' => $mahasiswas->user->phone,
                'TAHUN AJARAN' => $mahasiswas->angkatan->year,
                'EMAIL' => $mahasiswas->user->email,
                'JENIS KELAMIN' => $mahasiswas->user->gender,
                'ROLE' => $mahasiswas->user->role,
                'STATUS' => $mahasiswas->user->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA',
            'NOMOR TELEPON',
            'TAHUN AJARAN',
            'EMAIL',
            'JENIS KELAMIN',
            'ROLE',
            'STATUS',
        ];
    }
}
