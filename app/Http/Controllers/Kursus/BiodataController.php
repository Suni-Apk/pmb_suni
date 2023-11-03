<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function pendaftaran_kursus()
    {
        $jurusan = Jurusan::get();
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.biodata.pendaftaran-kursus',compact('jurusan','biodata'));
    }

    public function pendaftaran_kursus_process(Request $request)
    {
        $user = Auth::user()->id;

        $data = $request->validate([
            'profesi' => 'required|string',
            'baca_quran' => 'required|string',
            'birthdate' => 'required|date',
            'birthplace' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'address' => 'required',
        ]);
        $data['program_belajar'] = "KURSUS";
        $data['user_id'] = $user;
        $image = $request->file('image')->store('assets' , 'public');
        $data['image'] = $image;

        Biodata::create($data);

        return redirect()->route('kursus.dashboard')->with('success','Kamu Telah melengkapi Biodata Silahkan Lengkapi Dokument');
    }
}
