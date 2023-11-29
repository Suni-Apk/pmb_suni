<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->get();
        return view('admin.laporan.index', compact('mahasiswa'));
    }
}
