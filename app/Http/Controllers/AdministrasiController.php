<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    public function administrasi()
    {
        $administrasi = Administrasi::first();
        return view('admin.settings.administrasi', compact('administrasi'));
    }
    public function AdministrasiProses(Request $request, string $id)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $administrasi = Administrasi::find($id);
        $replace_amount = str_replace('.', '', $request->amount);

        $tahunAjaran = TahunAjaran::where('status', 'Active')->first();
        $administrasi->update([
            'amount' => $replace_amount,
            'id_tahunAjaran' => $tahunAjaran->id,
        ]);

        return redirect()->route('admin.administrasi.administrasi');
    }
}
