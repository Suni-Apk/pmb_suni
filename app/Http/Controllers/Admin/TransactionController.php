<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
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
        $transaction = Transaksi::when($programBelajar, function ($query) use ($programBelajar) {
            return $query->where('program_belajar', $programBelajar);
        })->get();
        return view('admin.transactions.index', compact('transaction', 'programBelajar'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
