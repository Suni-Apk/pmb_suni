<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        return view('mahasiswa.tagihan.index');
    }

    public function detail_spp($name)
    {
        return view('mahasiswa.tagihan.detail-tagihan');
    }
    public function payment_spp($name)
    {
        return view('mahasiswa.tagihan.pilih-pembayaran');
    }

    public function detail_tidak_routine($name)
    {
        return view('mahasiswa.tagihan.detail-tagihan-tidak-routine');
    }
}
