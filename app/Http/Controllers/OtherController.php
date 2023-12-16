<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Link;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherController extends Controller
{
    public function mhs_index()
    {
        $user = Auth::user();
        
        if ($user->biodata) {
            $transaksi = Transaksi::where('user_id', $user->id)->latest();
            $transaksi = $transaksi->where('program_belajar', $user->biodata->program_belajar)->get();

            $link = Link::where('id_tahun_ajarans', $user->biodata->angkatan_id)->where('program', 'S1');

            return view('mahasiswa.other.index', compact('transaksi', 'link', 'user'));
        } else {
            return redirect()->back();
        }
    }

    public function krs_index()
    {
        $user = Auth::user();
        
        if ($user->biodata) {
            $transaksi = Transaksi::where('user_id', $user->id)->latest();
            $transaksi = $transaksi->where('program_belajar', $user->biodata->program_belajar)->get();

            $link = Link::where('id_tahun_ajarans', $user->biodata->angkatan_id)->where('program', 'KURSUS');

            return view('kursus.other.index', compact('transaksi', 'link', 'user'));
        } else {
            return redirect()->back();
        }
    }

    public function documentation()
    {
        return view('mahasiswa.other.documentation');
    }
}
