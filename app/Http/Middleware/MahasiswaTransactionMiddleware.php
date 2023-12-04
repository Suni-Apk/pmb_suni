<?php

namespace App\Http\Middleware;

use App\Models\TagihanDetail;
use App\Models\Transaksi;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaTransactionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $userId = $request->route()->parameter('id');
        $data = $request->validate([
            'id' => 'required'
        ]);
        $ids = $request->id;
        // $mahasiswa = User::findOrFail($userId);
        foreach ($ids as $idTagih) {
            // dd($idTagih);
            $tagihanDetail = TagihanDetail::where('id', $idTagih)->get();
            foreach ($tagihanDetail as $value) {
                $transaction = Transaksi::all();
                foreach ($transaction as $transactions) {
                    if ($transactions->status != 'berhasil') {
                        return $next($request);
                    } else if ($value->id_transactions == $transactions->id && $transactions->status == 'berhasil' && $value->status == 'LUNAS') {
                        return redirect()->route('mahasiswa.tagihan.index')->with('error', 'Maaf, anda sudah membayar !');
                    }
                }
            }
        }
    }
}