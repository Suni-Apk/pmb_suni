<?php

namespace App\Exports;

use App\Models\Biodata;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class PendaftarExport implements FromCollection, WithHeadings
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
