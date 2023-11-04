<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function pendaftaran_s1()
    {
        $jurusan = Jurusan::get();
        $biodata = Biodata::where('program_belajar','S1')->where('user_id',Auth::user()->id)->first();
        return view('mahasiswa.biodata.pendaftaran-s1',compact('jurusan','biodata'));
    }

    public function pendaftaran_s1_process(Request $request)
    {
        $user = Auth::user()->id;

        $data = $request->validate([
            'birthdate' => 'required|date',
            'birthplace' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'address' => 'required',
            'last_graduate' => 'required'
        ]);
        $data['program_belajar'] = "S1";
        $data['jurusan_id'] = $request->jurusan_id;
        $data['user_id'] = $user;
        $image = $request->file('image')->store('assets' , 'public');
        $data['image'] = $image;

        Biodata::create($data);

        return redirect()->route('mahasiswa.pendaftaran.document')->with('success','Kamu Telah melengkapi Biodata Silahkan Lengkapi Dokument');
    }
}
