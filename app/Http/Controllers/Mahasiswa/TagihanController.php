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

    public function detail($name)
    {
        return view('mahasiswa.tagihan.detail-tagihan');
    }
}
