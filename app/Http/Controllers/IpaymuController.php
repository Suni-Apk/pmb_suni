<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Cicilan;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IpaymuController extends Controller
{
    public function notify(Request $request)
    {
        // $userId = Auth::user()->id;

        // $id_tagihan = $request->id_tagihan;
        $sid = $request->sid;
        $status = $request->status;
        $trx = $request->trx_id;

        $transaction = Transaksi::with('user')->where('no_invoice', $sid)->first();
        if ($status == 'berhasil') {
            if ($transaction->jenis_tagihan != 'Daftar Ulang Cicilan' && $transaction->jenis_tagihan != 'DaftarUlang') {
                $transaction->update([
                    'status' => $status,
                    'user_id' => $transaction->user->id,
                    'update_at' => now()
                ]);
                $tagihanGet = TagihanDetail::where('id_transactions', $transaction->id)->get();

                foreach ($tagihanGet as $tagihan) {
                    $tagihanupdate = TagihanDetail::where('id', $tagihan->id);

                    $tagihanupdate->update([
                        'status' => 'LUNAS',
                    ]);
                }
            } else if ($transaction->jenis_tagihan == 'DaftarUlang') {
                $tagihanGet = TagihanDetail::where('id_transactions', $transaction->id)->get();


                foreach ($tagihanGet as $tagihan) {

                    $transaction->update([
                        'status' => $status,
                        'user_id' => $transaction->user->id,
                        'update_at' => now(),
                        'tagihan_detail_id' => $tagihan->id
                    ]);

                    $tagihanupdate = TagihanDetail::where('id', $tagihan->id);

                    $tagihanupdate->update([
                        'status' => 'LUNAS',
                    ]);
                }
                $biodata = Biodata::where('user_id', $transaction->user_id)->where('program_belajar', 'S1')->first();
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
            } else if ($transaction->jenis_tagihan == 'Daftar Ulang Cicilan') {
                $cicilan = Cicilan::where('id_transactions', $transaction->id)->first();
                $transaction->update([
                    'status' => $status,
                    'user_id' => $transaction->user->id,
                    'update_at' => now()
                ]);
                
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

                $biodata = Biodata::where('user_id', $transaction->user_id)->where('program_belajar', 'S1')->first();
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
            }

            // foreach($tagihanGet as $value){
            //     $
            // }
        }
    }
}
