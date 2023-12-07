<?php

namespace App\Exports;

use App\Models\Biodata;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class MahasiswaLaporanExport implements FromCollection, WithHeadings
{

    protected $mahasiswa;

    public function __construct($mahasiswa)
    {
        $this->mahasiswa = $mahasiswa;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->mahasiswa->map(function ($mahasiswas) {
            return [
                'NO' => $mahasiswas->id,
                'NAMA' => $mahasiswas->name,
                'NOMOR TELEPON' => $mahasiswas->phone,
                'TAHUN AJARAN' => $mahasiswas->biodata->angkatan->year,
                'EMAIL' => $mahasiswas->email,
                'JENIS KELAMIN' => $mahasiswas->gender,
                'ROLE' => $mahasiswas->role,
                'STATUS' => $mahasiswas->status,
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
