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
use App\Traits\Ipaymu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Redirect;

class TransaksiController extends Controller
{
    use Ipaymu;
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
        $tagihan = TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $user->id)->latest()->first();
        $cicil = intval($tagihan->amount / 3);
        if ($request->jenis_pembayaran == 'cash') {
            $jenis = $request->jenis_tagihan;
            $data = $request->validate([
                'id' => 'required',
            ]);
            $ids = $request->id;

            // dd($ids);
            // foreach ($ids as $idTagihan) {
            $tagihans = TagihanDetail::where('id', $ids)->get();
            foreach ($tagihans as $t) {
                $jumlahBiaya[] = $t->amount;
            }
            // }


            $total = array_sum($jumlahBiaya);
            $tagihan = TagihanDetail::where('id', $ids)->firstOrFail();
            $mahasiswa = Auth::user();

            return view('mahasiswa.transaksi.bayar', compact('jenis', 'total', 'mahasiswa', 'tagihan', 'ids'));
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
        $transaksis =  Transaksi::where('id', $id_transactions)->first();
        $DetailTagihan =  TagihanDetail::where('id_transactions', $id_transactions)->get();
        $data4 = [];
        foreach ($DetailTagihan as $nilai) {
            if (!isset($data4[$nilai['id']])) {
                $data4[$nilai['id']] = $nilai->id;
            }
        }
        $data4 = array_values($data4);

        function isSame($data4, $id_tagihan)
        {
            // Memastikan jumlah data sama
            if (count($data4) != count($id_tagihan)) {
                return false;
            }
            // Urutkan nilai agar bisa dibandingkan
            sort($data4);
            sort($id_tagihan);

            // Bandingkan nilai, jika ada beda return false
            for ($i = 0; $i < count($data4); $i++) {
                if ($data4[$i] != $id_tagihan[$i]) {
                    return false;
                }
            }

            // Jika lolos dari semua pengecekan, berarti sama
            return true;
        }
        // Untuk mengecek apakah datanya sama apa beda
        $isSame = isSame($data4, $id_tagihan);

        if (!$isSame) {
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
        } elseif ($transaksis->status == 'expired') {
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
            return Redirect::to($transaksis->payment_link);
        }
    }


    public function demo_cicilan(Request $request, $id)
    {
        $jenis = 'cicil';
        $data = $request->validate([
            'id' => 'required',
        ]);
        $ids = $request->id;

        // dd($ids);
        foreach ($ids as $idCicilan) {
            $tagihans = Cicilan::where('id', $idCicilan)->get();
            foreach ($tagihans as $t) {
                $jumlahBiaya[] = $t->harga;
            }
        }


        $total = array_sum($jumlahBiaya);
        $tagihan = Cicilan::where('id', $ids)->firstOrFail();
        $mahasiswa = Auth::user();

        return view('mahasiswa.transaksi.bayar-cicilan', compact('jenis', 'id', 'total', 'mahasiswa', 'tagihan', 'ids'));
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
    public function demo_bayar_cash(Request $request, $invoice)
    {
        $user = Auth::user();
        $biaya = Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->where('id_angkatans', $user->biodata->angkatan_id)->latest()->first();
        $tagihanDetail = TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $user->id)->latest()->first();

        $transaksi = Transaksi::where('user_id', $user->id)->where('no_invoice', $invoice)->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        $transaksi->update([
            'status' => 'berhasil'
        ]);

        if ($transaksi->status == 'berhasil' && $transaksi->jenis_pembayaran == 'cash') {
            $tagihanDetail->update([
                'status' => 'LUNAS',
                'id_transactions' => $transaksi->id
            ]);

            $biodata = Biodata::where('user_id', $user->id)->where('program_belajar', 'S1')->first();

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
        }
    }
    public function invoice(Request $request, $id)
    {
        $transaction = Transaksi::where('user_id', $id)->where('jenis_tagihan', $request->DaftarUlang)->where('status', 'berhasil')->get();
        $user = Auth::user();
        $pdf = PDF::loadView('mahasiswa.invoice.index', compact('transaction', 'user'));
        return $pdf->download("$request->DaftarUlang - INVOICE - $user->name.pdf");
    }
    public function proses_bayar_cicilan(Request $request)
    {
        $total = $request->total;
        $id_tagihan = $request->id;
        // $id_tagihan = array_map('strip_tags', $id_tagihan);
        // $id_tagihan = array_map('htmlspecialchars', $id_tagihan);
        // dd($id_tagihan);
        $data = [];
        $cicilan = Cicilan::where('id', $id_tagihan)->first();
        // dd($cicilan->nama_cicilan);
        // $data = array_values($data);
        $nama_product = $cicilan->nama_cicilan;
        $transactionGet = Transaksi::find($cicilan->id_transactions);
        if ($cicilan->id_transactions == null) {
            $payment = json_decode(json_encode($this->redirect_payment2($nama_product, $total, $id_tagihan)), true);       // return redirect()->route('mahasiswa.tagihan.index')->with('success', 'Selamat anda berhasil menbayar');
            $transaction = Transaksi::create([
                'program_belajar' => 'S1',
                'status' => 'pending',
                'total' => $total,
                'payment_link' => $payment['Data']['Url'],
                'jenis_pembayaran' => 'cicilan',
                'jenis_tagihan' => 'Daftar Ulang CicilanDaftar Ulang Cicilan',
                'no_invoice' => $payment['Data']['SessionID'],
                'user_id' => Auth::user()->id,
                'id_cicilans' => $cicilan->id,
            ]);
            // foreach ($id_tagihan as $tagihandetails) {
            $idTagihan = Cicilan::where('id', $id_tagihan);

            $idTagihan->update([
                'id_transactions' => $transaction->id,
            ]);
            return Redirect::to($transaction->payment_link);
        } elseif ($cicilan->id_transactions != null) {
            return Redirect::to($transactionGet->payment_link);
        }
    }
}
