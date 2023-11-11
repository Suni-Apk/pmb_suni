<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function administrasi()
    {
        $user = Auth::user();
        $adminstrasiS1 = Administrasi::where('program_belajar','S1')->first();
        return view('mahasiswa.transaksi.administrasi',compact('adminstrasiS1'));
    }
}
