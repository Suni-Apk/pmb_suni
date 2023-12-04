<?php

namespace App\Http\Middleware;

use App\Models\Biaya;
use App\Models\TahunAjaran;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DaftarUlangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $angkatan = TahunAjaran::where('status', 'Active')->first();
        $biaya = Biaya::where('id_angkatans', $angkatan->id)->where('jenis_biaya', 'DaftarUlang')->first();
        if ($biaya) {
            return $next($request);
        } else {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Maaf belum ada biaya daftar ulang');
        }
    }
}
