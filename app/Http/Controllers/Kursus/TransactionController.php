<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\TagihanDetail;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function proses_bayar(Request $request)
    {
        $ids = $request->id;
        $total = $request->total;
        $user = Auth::user();
        $tagihanJenis = TagihanDetail::where('id', $ids)->first();
        $transaction = Transaksi::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'berhasil',
            'payment_link' => '-',
            'program_belajar' => $user->biodata->program_belajar,
            'jenis_pembayaran' => 'cash',
            'jenis_tagihan' => $tagihanJenis->biayasDetail->jenis_biaya,
            'no_invoice' => rand(2, 30),
        ]);

        if ($transaction->status == 'berhasil') {
            foreach ($ids as $id) {
                $tagihans = TagihanDetail::where('id', $id);
                $sudah = 'LUNAS';
                $tagihans->update([
                    'id_transactions' => $transaction->id,
                    'status' => $sudah,
                ]);
            }
        }

        return redirect()->route('kursus.tagihan.index')->with('success', 'Selamat anda berhasil menbayar');
    }
}
