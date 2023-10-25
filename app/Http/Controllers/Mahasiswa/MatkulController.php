<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index()
    {
        return view('mahasiswa.matkul.index');
    }
}
