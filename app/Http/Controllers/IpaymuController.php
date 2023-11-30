<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use App\Models\TagihanDetail;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class IpaymuController extends Controller
{
    public function notify(Request $request)
    {
        // $id_tagihan = $request->id_tagihan;
        $sid = $request->sid;
        $status = $request->status;
        $trx = $request->trx_id;

        $transaction = Transaksi::with('user')->where('no_invoice', $sid)->first();
        if ($status == 'berhasil') {
            $transaction->update([
                'status' => $status,
                'user_id' => $transaction->user->id,
                'update_at' => now()
            ]);
            if ($transaction->jenis_tagihan != 'Daftar Ulang Cicilan') {
                $tagihanGet = TagihanDetail::where('id_transactions', $transaction->id)->get();

                foreach ($tagihanGet as $tagihan) {
                    $tagihanupdate = TagihanDetail::where('id', $tagihan->id);

                    $tagihanupdate->update([
                        'status' => 'LUNAS',
                    ]);
                }
            } else if ($transaction->jenis_tagihan == 'Daftar Ulang Cicilan') {
                $cicilan = Cicilan::where('id_transactions', $transaction->id)->first();
                $cicilan->update([
                    'status' => 'LUNAS',
                ]);
                $tagihanDetail = TagihanDetail::where('id', $cicilan->id_tagihan_details);
                $cicilans = Cicilan::where('id_tagihan_details', $cicilan->id_tagihan_details)->where('status', 'LUNAS')->get();
                if ($cicilans->count() == 3) {
                    $tagihanDetail->update([
                        'status' => 'LUNAS'
                    ]);
                }
            }

            // foreach($tagihanGet as $value){
            //     $
            // }
        }
    }
}
