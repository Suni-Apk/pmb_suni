<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class AdminExport implements FromCollection, WithHeadings,WithColumnWidths
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
