<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatkulController extends Controller
{
    public function index()
    {
        $biodata = Biodata::where('program_belajar','S1')->where('user_id',Auth::user()->id)->first();
        return view('mahasiswa.matkul.index',compact('biodata'));
    }
}
