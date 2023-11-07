<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function administrasi()
    {
        
        return view('mahasiswa.transaksi.administrasi');
    }
}
