<?php

namespace App\Exports;

use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class JurusanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Jurusan::all(['id', 'name', 'code']);
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA',
            'KODE'
        ];
    }
}
