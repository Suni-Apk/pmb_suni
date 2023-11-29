<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Jurusan;
use App\Models\Link;
use App\Models\Matkuls;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatkulController extends Controller
{
    public function index()
    {
        $biodata = Biodata::where('program_belajar', 'S1')->where('user_id', Auth::user()->id)->first();

        if ($biodata) {
            if ($biodata->jurusan_id) {
                $jurusan = Jurusan::find($biodata->jurusan_id);

                $links = Link::where('id_jurusans', $jurusan->id)->where('id_tahun_ajarans', $jurusan->tahunAjaran->id)->where('gender', 'all')->first();

                $semester = Semester::where('id_jurusans', $jurusan->id)->get();

                $matkuls = Matkuls::where('id_jurusans', $jurusan->id)->get();

                return view('mahasiswa.matkul.index', compact('jurusan', 'semester', 'matkuls', 'links'));
            } else {
                return redirect()->route('mahasiswa.index')->with('error', 'Anda belum memilih jurusan.');
            }
        } else {
            return redirect()->route('mahasiswa.index')->with('error', 'Anda belum mengisi biodata.');
        }
    }
}
