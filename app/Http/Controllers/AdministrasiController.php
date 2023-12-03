<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    public function administrasi()
    {
        $administrasi = Administrasi::get();
        return view('admin.settings.administrasi', compact('administrasi'));
    }
    public function AdministrasiProses(Request $request, string $id)
    {
        $request->validate([
            'program_belajar' => 'required',
            'amount' => 'required',
        ]);

        $administrasi = Administrasi::find($id);
        // dd($administrasi);
        $replace_amount = str_replace('.', '', $request->amount);
        $tahunAjaran = TahunAjaran::where('status', 'Active')->orderBy('id', 'desc')->first();
        $administrasi->update([
            'program_belajar' => $request->program_belajar,
            'amount' => $replace_amount,
            'id_tahunAjaran' => $tahunAjaran->id,
        ]);

        return redirect()->route('admin.administrasi');
    }
}
