<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Cicilan;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $programBelajar = $request->input('program_belajar');

        if ($programBelajar) {
            $transactions = Transaksi::when($programBelajar, function ($query) use ($programBelajar) {
                return $query->where('program_belajar', $programBelajar);
            })->latest()->get();
        } else {
            $transactions = Transaksi::latest()->get();
        }
        return view('admin.transactions.index', compact('transactions', 'programBelajar'));
    }

    //Cash Transaction
    public function proses_bayar(Request $request, $id)
    {
        $ids = $request->id;
        $total = $request->total;
        $user = User::find($id);
        $tagihanJenis = TagihanDetail::where('id', $ids)->first();
        $transaction = Transaksi::create([
            'user_id' => $id,
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

        return redirect()->route('admin.mahasiswa.show', $user->id)->with('success', 'Selamat anda berhasil menbayar');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.transactions.detail', compact('id'));
    }

    public function export(Request $request)
    {
        return Excel::download(new TransactionExport($request), 'dataTransaksi.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function DaftarUlang(string $id, Request $request)
    {
        $user = User::find($id);
        $biodata = Biodata::where('user_id', $user->id)->where('program_belajar', 'S1')->firstOrFail();
        $biaya = Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->where('id_angkatans', $biodata->angkatan_id)->latest()->first();

        $tagihan = TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $user->id)->latest()->first();
        $cicil = intval($tagihan->amount / 3);
        $mahasiswa = User::find($id);
        $jenis = 'cash';
        if ($request->jenis_pembayaran == 'cash') {
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

            return view('admin.account.mahasiswa.daftar-ulang-cash', compact('transaction', 'mahasiswa'));
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
            session(['jenis' => $jenis]);
            return redirect()->route('admin.mahasiswa.show', $id);
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
        $tagihan = Cicilan::where('id', $ids)->first();
        $mahasiswa = User::find($id);
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
        return view('admin.account.mahasiswa.daftar-ulang-cicilan', compact('jenis', 'id', 'total', 'mahasiswa', 'tagihan', 'ids', 'transaction'));
    }
    public function demo_bayar_cicilan_admin(Request $request, $sid)
    {
        $userId = User::find($sid);
        $invoice = $request->no_invoice;
        $biaya = Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->where('id_angkatans', $userId->biodata->angkatan_id)->latest()->first();

        $tagihanDetail = TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $userId->id)->latest()->first();

        $transaksi = Transaksi::where('user_id', $userId->id)->where('no_invoice', $invoice)->first();

        // dd($transaksi);
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

        $biodata = Biodata::where('user_id', $userId->id)->where('program_belajar', 'S1')->first();
        $tagihan = Transaksi::where('user_id', $userId)->where('program_belajar', 'S1')->where('jenis_pembayaran', 'cash')->where('jenis_tagihan', 'DaftarUlang')->where('status', 'berhasil')->first();

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
        return redirect()->route('admin.mahasiswa.show', $sid)->with('success', 'Selamat anda berhasil menbayar');
        // if()
    }
    public function demo_bayar_cash(Request $request, $id)
    {
        $user = User::find($id);
        $invoice = $request->no_invoice;
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
        return redirect()->route('admin.mahasiswa.show', $id)->with('success', 'Selamat anda berhasil menbayar');
    }
}
