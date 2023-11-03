<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.tagihan.index',compact('biodata'));
    }

    public function detail($name)
    {
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.tagihan.detail-tagihan',compact('biodata'));
    }
    public function detail_spp($name)
    {
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.tagihan.detail-tagihan',compact('biodata'));
    }

    public function payment_spp($name)
    {
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.tagihan.pilih-pembayaran',compact('biodata'));
    }

    public function detail_tidak_routine($name)
    {
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.tagihan.detail-tagihan-tidak-routine',compact('biodata'));
    }
}
