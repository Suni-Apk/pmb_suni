<?php

namespace App\Http\Controllers;

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
        }
    }
}
