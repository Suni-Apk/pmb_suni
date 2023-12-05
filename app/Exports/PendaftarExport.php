<?php

namespace App\Exports;

use App\Models\Biodata;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PendaftarExport implements FromCollection, WithHeadings,WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */

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

    public function collection()
    {
        $mahasiswa = Biodata::all();

        return $mahasiswa->map(function($mahasiswas){
            return [
                'NO' => $mahasiswas->id,
                'NAMA' => $mahasiswas->user->name,
                'JENIS KELAMIN' => $mahasiswas->user->gender,
                'STATUS BIODATA' => $mahasiswas->user->gender,
                'STATUS DOKUMEN' => $mahasiswas->user->gender,
                'STATUS ADMINISTRASI' => $mahasiswas->user->gender,
                'STATUS PRA KULIAH' => $mahasiswas->user->gender,
                'BERGABUNG PADA' => $mahasiswas->user->gender,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NO' ,
            'NAMA',
            'JENIS KELAMIN' ,
            'STATUS BIODATA' ,
            'STATUS DOKUMEN' ,
            'STATUS ADMINISTRASI' ,
            'STATUS PRA KULIAH' ,
            'BERGABUNG PADA' ,
        ];
    }
}
