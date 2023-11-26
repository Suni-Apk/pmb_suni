<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class AdminExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 'Admin')->get();
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA',
            'NOMOR TELEPON',
            'EMAIL',
            'JENIS KELAMIN',
            'ROLE',
            'STATUS',
            'ACTIVE',
            'TOKEN'
        ];
    }
}
