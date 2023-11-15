<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\Biaya;
use App\Models\TagihanDetail;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function administrasi()
    {
        $user = Auth::user();
        $adminstrasiS1 = Administrasi::where('program_belajar','S1')->first();
        return view('mahasiswa.transaksi.administrasi',compact('adminstrasiS1'));
    }

    public function daftarUlang(Request $request)
    {
        $biaya = Biaya::where('program_belajar','S1')->where('jenis_biaya','DaftarUlang')->where('id_angkatans',Auth::user()->biodata->angkatan_id)->latest()->first();
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
                'no_invoice' => rand(111111,999999),
                'tagihan_detail_id' => $tagihan->id,
                'user_id' => $user->id
            ]);

            return view('mahasiswa.transaksi.daftar-ulang',compact('transaction'));
        }else{
            $transaction = Transaksi::create([
                'program_belajar' => 'S1',
                'status' => 'pending',
                'total' => $cicil,
                'payment_link' => 'dasdafassadas',
                'jenis_pembayaran' => 'cicil',
                'jenis_tagihan' => 'DaftarUlang',
                'no_invoice' => rand(111111,999999),
                'tagihan_detail_id' => $tagihan->id,
                'user_id' => $user->id
            ]);

            return view('mahasiswa.transaksi.daftar-ulang',compact('transaction'));
        }
    }
}
