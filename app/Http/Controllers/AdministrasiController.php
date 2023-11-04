<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    public function administrasi()
    {
        return view('admin.settings.administrasi');
    }
}
