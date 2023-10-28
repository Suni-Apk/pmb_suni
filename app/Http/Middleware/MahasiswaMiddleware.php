<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // MahasiswaMiddleware.php
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'Mahasiswa') {
            return $next($request);
        }

        return redirect()->back()->withErrors([
            'phone' => 'Kamu bukan Mahasiswa'
        ]);
    }

}
