<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.pelajaran.index',compact('biodata'));
    }
}
