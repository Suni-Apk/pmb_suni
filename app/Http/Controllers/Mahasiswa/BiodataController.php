<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function pendaftaran_s1()
    {
        $jurusan = Jurusan::get();
        return view('mahasiswa.biodata.pendaftaran-s1', compact('jurusan'));
    }

    public function pendaftaran_s1_process(Request $request)
    {
        $user = Auth::user()->id;
        $angkatan = TahunAjaran::where('status','Active')->first();
        $data = $request->validate([
            'birthdate' => 'required|date',
            'birthplace' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'address' => 'required',
            'last_graduate' => 'required'
        ]);
        $data['angkatan_id'] = $angkatan->id;
        $data['program_belajar'] = "S1";
        $data['jurusan_id'] = $request->jurusan_id;
        $data['user_id'] = $user;
        $image = $request->file('image')->store('assets', 'public');
        $data['image'] = $image;

        Biodata::create($data);

        return redirect()->route('mahasiswa.pendaftaran.document')->with('success', 'Kamu Telah melengkapi Biodata Silahkan Lengkapi Dokument');
    }
}
