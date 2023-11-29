<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Cicilan;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function administrasi()
    {
        $user = Auth::user();
        $adminstrasiS1 = Administrasi::where('program_belajar', 'S1')->first();


        return view('mahasiswa.transaksi.administrasi', compact('adminstrasiS1'));
    }

    public function daftarUlang(Request $request)
    {
        $biaya = Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->where('id_angkatans', Auth::user()->biodata->angkatan_id)->latest()->first();
        $user = Auth::user();
        $tagihan = TagihanDetail::where('id_biayas',$biaya->id)->where('id_users',$user->id)->latest()->first();
        $cicil = intval($tagihan->amount / 3);
        if($request->jenis_pembayaran == 'cash'){
            $transaction = Transaksi::create([
                'program_belajar' => 'S1',
                'status' => 'pending',
                'total' => $tagihan->amount,
                'payment_link' => 'dasdafassadas',
                'jenis_pembayaran' => 'cash',
                'jenis_tagihan' => 'DaftarUlang',
                'no_invoice' => rand(111111, 999999),
                'tagihan_detail_id' => $tagihan->id,
                'user_id' => $user->id
            ]);

            return view('mahasiswa.transaksi.daftar-ulang', compact('transaction'));
        } else {
            $jenis = 'cicil';
            $array = ['1', '2', '3'];
            foreach ($array as $keys => $nilai) {
                $end_date = strtotime('+' . $nilai . 'month', strtotime($tagihan->end_date));
                $end_dates = date('Y-m-d', $end_date);
                // print_r($end_dates . ' ');
                $cicilan = Cicilan::create([
                    'id_tagihan_details' => $tagihan->id,
                    'status' => 'belum',
                    'nama_cicilan' => 'Cicilan ke ' . $nilai,
                    'harga' => $cicil,
                    'end_date' => $end_dates
                ]);
            }
            // $transaction = Transaksi::create([
            //     'program_belajar' => 'S1',
            //     'status' => 'pending',
            //     'total' => $cicil,
            //     'payment_link' => 'dasdafassadas',
            //     'jenis_pembayaran' => 'cicil',
            //     'jenis_tagihan' => 'DaftarUlang',
            //     'no_invoice' => rand(111111, 999999),
            //     'tagihan_detail_id' => $tagihan->id,
            //     'user_id' => $user->id
            // ]);

            // if (count($transactions) == 4) {
            //     $tagihan->update([
            //         'status' => 'LUNAS'
            //     ]);
            // }
            // foreach ($transactions as $value) {
            // }
            // dd($jenis);
            session(['jenis' => $jenis]);
            return redirect()->route('mahasiswa.tagihan.index');
        }
    }
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

        return redirect()->route('mahasiswa.tagihan.index')->with('success', 'Selamat anda berhasil menbayar');
    }


    public function demo_cicilan(Request $request, $id)
    {
        $jenis = 'cicil';
        $data = $request->validate([
            'id' => 'required',
        ]);
        $ids = $request->id;

        // dd($ids);
        foreach ($ids as $idTagihan) {
            $tagihans = Cicilan::where('id', $idTagihan)->get();
            foreach ($tagihans as $t) {
                $jumlahBiaya[] = $t->harga;
            }
        }


        $total = array_sum($jumlahBiaya);
        $tagihan = Cicilan::where('id', $ids)->first();
        $mahasiswa = Auth::user();
        $transaction = Transaksi::create([
            'program_belajar' => 'S1',
            'status' => 'pending',
            'total' => $tagihan->harga,
            'payment_link' => 'dasdafassadas',
            'jenis_pembayaran' => 'cicilan',
            'jenis_tagihan' => 'DaftarUlang',
            'no_invoice' => rand(111111, 999999),
            'user_id' => $mahasiswa->id,
            'id_cicilans' => $tagihan->id,
        ]);
        return view('mahasiswa.transaksi.daftar-ulang-cicilan', compact('jenis', 'id', 'total', 'mahasiswa', 'tagihan', 'ids', 'transaction'));
    }
    public function demo_bayar_cicilan(Request $request, $sid)
    {
        $userId = Auth::user()->id;
        $biaya = Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->where('id_angkatans', Auth::user()->biodata->angkatan_id)->latest()->first();

        $user = Auth::user();
        $tagihanDetail = TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $user->id)->latest()->first();

        $transaksi = Transaksi::where('user_id', $userId)->where('no_invoice', $sid)->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        $transaksi->update([
            'status' => 'berhasil'
        ]);
        $cicilans = Cicilan::where('id', $transaksi->id_cicilans)->firstOrFail();

        if ($transaksi->status == 'berhasil') {
            $cicilans->update([
                'status' => 'LUNAS',
                'id_transactions' => $transaksi->id,
            ]);
        }




        $cicilans = Cicilan::where('id_tagihan_details', $tagihanDetail->id)->where('status', 'LUNAS')->get();
        if ($cicilans->count() == 3) {
            $tagihanDetail->update([
                'status' => 'LUNAS'
            ]);
        }

        $biodata = Biodata::where('user_id', $userId)->where('program_belajar', 'S1')->first();
        if ($cicilans->count() < 2) {
            $biaya = Biaya::all();
            // $transaksi = Transaksi::where('user_id', $user)->where('status', 'berhasil')->where('program_belajar', 'S1')->where('jenis_tagihan', 'Administrasi')->first();
            foreach ($biaya as $key => $biayas) {
                if ($biayas->id_angkatans == $biodata->angkatan_id && $biayas->id_jurusans == $biodata->jurusan_id && $biayas->program_belajar == $biodata->program_belajar) {
                    $tagihan = Tagihan::where('id_biayas', $biayas->id)->get();

                    foreach ($tagihan as $key => $tagihans) {
                        if ($tagihans->biayas->jenis_biaya != 'DaftarUlang') {
                            // dd($tagihans->biayas->jenis_biaya);
                            $tagihanDetail = TagihanDetail::create([
                                'id_biayas' => $biayas->id,
                                'id_tagihans' => $tagihans->id,
                                'id_users' => $biodata->user->id,
                                'end_date' => $tagihans->end_date,
                                'amount' => $tagihans->amount,
                                'status' => 'BELUM',
                            ]);
                        }
                    }
                } else if ($biayas->id_angkatans == $biodata->angkatan_id && $biayas->program_belajar == $biodata->program_belajar) {
                    $tagihan = Tagihan::where('id_biayas', $biayas->id)->get();

                    foreach ($tagihan as $key => $tagihans) {
                        if ($tagihans->biayas->jenis_biaya != 'DaftarUlang') {
                            $tagihanDetail = TagihanDetail::create([
                                'id_biayas' => $biayas->id,
                                'id_tagihans' => $tagihans->id,
                                'id_users' => $biodata->user->id,
                                'end_date' => $tagihans->end_date,
                                'amount' => $tagihans->amount,
                                'status' => 'BELUM',
                            ]);
                        } else {
                        }
                    }
                }
            }
        } else {
        }
        return redirect()->route('mahasiswa.tagihan.index')->with('success', 'Selamat anda berhasil menbayar');
        // if()
    }

    public function invoice(Request $request,$id)
    {
        $transaction = Transaksi::where('user_id',$id)->where('jenis_tagihan',$request->DaftarUlang)->where('status','berhasil')->get();
        $user = Auth::user();
        $pdf = PDF::loadView('mahasiswa.invoice.index', compact('transaction', 'user'));
        return $pdf->download("$request->DaftarUlang - INVOICE - $user->name.pdf");
    }
}
