<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromCollection, WithHeadings
{
    protected $programBelajar;

    public function __construct(Request $request)
    {
        $this->programBelajar = $request->input('program_belajar');
    }

    public function collection()
    {
        $transactions = Transaksi::when($this->programBelajar, function ($query) {
            return $query->where('program_belajar', $this->programBelajar);
        })->get();

        return $transactions->map(function($transaksi){
            return [
                'NO' => $transaksi->id,
                'PROGRAM BELAJAR' => $transaksi->program_belajar,
                'TANGGAL PEMBAYARAN' => $transaksi->created_at,
                'PEMBAYAR' => $transaksi->user->name,
                'TOTAL PEMBAYARAN' => $transaksi->total,
                'STATUS' => $transaksi->status,
                'JENIS TAGIHAN' => $transaksi->jenis_tagihan,
                'METODE PEMBAYARAN' => $transaksi->jenis_pembayaran
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NO',
            'PROGRAM BELAJAR',
            'TANGGAL PEMBAYARAN',
            'PEMBAYAR',
            'TOTAL PEMBAYARAN',
            'STATUS',
            'JENIS TAGIHAN',
            'METODE PEMBAYARAN'
        ];
    }
}

