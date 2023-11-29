<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\TagihanDetail;
use App\Models\Transaksi;
use App\Models\User;
use App\Traits\Ipaymu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    use Ipaymu;
    public function proses_bayar(Request $request)
    {
        $total = $request->total;
        $id_tagihan = $request->input('id');
        $id_tagihan = array_map('strip_tags', $id_tagihan);
        $id_tagihan = array_map('htmlspecialchars', $id_tagihan);
        // dd($id_tagihan);
        $data = [];
        $data2 = [];
        $data3 = [];
        foreach ($id_tagihan as $ids) {
            $tagihan = TagihanDetail::where('id', $ids)->get();
            foreach ($tagihan as $value) {
                $tagihan1 = Biaya::where('id', $value->id_biayas)->get();
                foreach ($tagihan1 as $value1) {
                    if (!isset($data[$value1['nama_biaya']])) {
                        $data[$value1['nama_biaya']] = $value1->nama_biaya;
                    }
                    if (!isset($data2[$value1['jenis_biaya']])) {
                        $data2[$value1['jenis_biaya']] = $value1->jenis_biaya;
                    }
                }
                if (!isset($data3[$value['id_transactions']])) {
                    $data3[$value['id_transactions']] = $value->id_transactions;
                }
            }
        }
        $data = array_values($data);
        $nama_product = implode(", ", $data);
        $data2 = array_values($data2);
        $jenis_tagihan = implode(", ", $data2);
        $data3 = array_values($data3);
        $id_transactions = implode($data3);
        // print_r($id_transactions);
        if (collect($data3)->contains('')) {
            $payment = json_decode(json_encode($this->redirect_payment1($nama_product, $total, $id_tagihan)), true);       // return redirect()->route('mahasiswa.tagihan.index')->with('success', 'Selamat anda berhasil menbayar');
            $transaction = Transaksi::create([
                'program_belajar' => 'S1',
                'status' => 'pending',
                'total' => $total,
                'payment_link' => $payment['Data']['Url'],
                'jenis_pembayaran' => 'cash',
                'jenis_tagihan' => $jenis_tagihan,
                'no_invoice' => $payment['Data']['SessionID'],
                'user_id' => Auth::user()->id,
            ]);
            foreach ($id_tagihan as $tagihandetails) {
                $idTagihan = TagihanDetail::where('id', $tagihandetails);

                $idTagihan->update([
                    'id_transactions' => $transaction->id,
                ]);
            }
            return Redirect::to($transaction->payment_link);
        } else {
            $transaksis =  Transaksi::where('id', $id_transactions)->first();
            return Redirect::to($transaksis->payment_link);
        }
    }
}
