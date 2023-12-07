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
use Barryvdh\DomPDF\Facade\Pdf;
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

        return redirect()->route('admin.mahasiswa.show', $user->id)->with('success', 'Selamat anda berhasil membayar');
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
        $transaksi = Transaksi::find($id);
        return view('admin.transactions.detail', compact('transaksi'));
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
        $transaksi = Transaksi::find($id);
        $data = $request->validate([
            'status' => 'required|string',
        ]);

        if ($transaksi->jenis_pembayaran == 'Ipaymu') {
            return redirect()->back()
            ->with('bayar', 'Chat dengan <a class="fw-bolder text-capitalize text-white" href="https://api.whatsapp.com/send?phone=' . $transaksi->user->phone . '">' . $transaksi->user->name . '</a> untuk segera melakukan pembayaran.');
        } elseif ($transaksi->jenis_pembayaran == 'cash') {
            $transaksi->update($data);
            return redirect()->route('admin.transaksi.index')
            ->with('update', 'Anda berhasil mengubah status transaksi dari ' . $transaksi->status . ' menjadi ' . $request->status . '.');
        } else {
            return redirect()->back()->with('notfound', 'Anda tidak bisa mengubah status transaksi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $sid = $request->sid;
        $transaksi = Transaksi::find($id);


        $tagihanDetail = TagihanDetail::where('id_transactions', $transaksi->id)->get();
        $tagihanDetailTransaksi = TagihanDetail::where('id_transactions', $transaksi->id);

        foreach ($tagihanDetail as $value) {
            print_r($value->status);
        }

        $tagihanDetailTransaksi->update([
            'status' => 'BELUM',
            'id_transactions' => null
        ]);

        $cicilan = Cicilan::where('id_transactions', $id)->first();
        if ($cicilan) {
            $cicilan->update(['status' => 'BELUM', 'id_transactions' => null]);

            $tagihanDetails = TagihanDetail::where('id', $cicilan->id_tagihan_details);
            $tagihanDetails->update(['status' => 'BELUM']);
            $cicilans = Cicilan::where('id_tagihan_details', $cicilan->id_tagihan_details)->where('status', 'LUNAS')->get();

            if ($cicilans->count() == 0) {
                $tagihan = TagihanDetail::where('id_users', $transaksi->user_id)->get();
                foreach ($tagihan as $tagihans) {
                    if ($tagihans->biayasDetail->jenis_biaya != 'DaftarUlang' && $tagihans->biayasDetail->program_belajar == 'S1') {
                        $tagihanDelete = TagihanDetail::where('id', $tagihans->id);
                        $tagihanDelete->delete();
                        // print_r($tagihans->id);
                        // print_r($tagihans);
                    }
                }
            }
        }
        $transaksi->delete();
        return redirect()->back();


        // $cicilan = Cicilan::whereIn('id_transactions', $value->id);
        // $cicilans = $cicilan->update(['status' => 'belum']);
        // if ($cicilans) {
        //     $cicilanGet = Cicilan::where('id', $cicilans->id)->get();
        //     foreach ($cicilanGet as $nilai) {
        //         $tagihanDetails = TagihanDetail::whereIn('id', $nilai->id_tagihan_details);
        //         // $tagihanDetails->update(['status' => 'BELUM']);
        //     }
        // }
    }

    public function deleteAll(Request $request)
    {
        //

        $sid = $request->ids;
        $transaksi = Transaksi::whereIn('id', $sid);

        $transaksiGet = Transaksi::whereIn('id', $sid)->get();

        foreach ($transaksiGet as $value) {
            $tagihanDetail = TagihanDetail::where('id_transactions', $value->id);
            $tagihanDetail->update([
                'status' => 'BELUM',
                'id_transactions' => null
            ]);

            $cicilan = Cicilan::whereIn('id_transactions', $sid)->get();
            foreach ($cicilan as $nilai) {
                if ($nilai) {
                    $nilai->update(['status' => 'BELUM', 'id_transactions' => null]);
                    $tagihanDetails = TagihanDetail::where('id', $nilai->id_tagihan_details);
                    $tagihanDetails->update(['status' => 'BELUM']);
                    $cicilans = Cicilan::where('id_tagihan_details', $nilai->id_tagihan_details)->where('status', 'LUNAS')->get();

                    if ($cicilans->count() == 0) {
                        $tagihan = TagihanDetail::where('id_users', $value->user_id)->get();
                        foreach ($tagihan as $tagihans) {
                            if ($tagihans->biayasDetail->jenis_biaya != 'DaftarUlang' && $tagihans->biayasDetail->program_belajar == 'S1') {
                                $tagihanDelete = TagihanDetail::where('id', $tagihans->id);
                                $tagihanDelete->delete();
                                // print_r($tagihans->id);
                                // print_r($tagihans);
                            }
                        }
                    }
                }
            }
        }
        $transaksi->delete();
        return redirect()->back();
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
            'jenis_tagihan' => 'Daftar Ulang Cicilan',
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

    public function invoice(Request $request,$id)
    {
        $transaction = Transaksi::find($id);
        $user = $transaction->user;
        $pdf = Pdf::loadView('admin.transactions.invoice', compact('transaction', 'user'));
        return $pdf->download("$request->jenis_tagihan - INVOICE - $user->name.pdf");
    }
}
