<?php

namespace App\Exports;

use App\Models\Biodata;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class MahasiswaExport implements FromCollection, WithHeadings,WithColumnWidths
{

    protected $mahasiswa;

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
        ];
    }

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
