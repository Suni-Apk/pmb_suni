<?php

namespace App\Http\Middleware;

use App\Models\Transaksi;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KursusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $transaksi = Transaksi::where('program_belajar','KURSUS')->where('jenis_tagihan','Administrasi')->where('status','berhasil')->where('user_id',Auth::user()->id)->first();
        if(Auth::check() && $transaksi){
            return $next($request);
        } else {
            return redirect()->route('login')->withErrors(['phone' => 'Kamu Belum Membayar']);
        }
    }
}
