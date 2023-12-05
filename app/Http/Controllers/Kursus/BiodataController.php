<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Course;
use App\Models\Jurusan;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function pendaftaran_kursus()
    {
        $kursus = Course::get();
        return view('kursus.biodata.pendaftaran-kursus', compact('kursus'));
    }

    public function showPendaftaranForm($kursus_id)
    {
        $kursus = Course::findOrFail($kursus_id);
        return view('kursus.biodata.pendaftaran-kursus', compact('kursus'));
    }

    public function pendaftaran_kursus_process(Request $request)
    {
        $user = Auth::user()->id;
        $angkatan = TahunAjaran::where('status', 'Active')->first();
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
        $data['course_id'] = $request->course_id;
        $data['angkatan_id'] = $angkatan->id;
        $data['program_belajar'] = "KURSUS";
        $data['user_id'] = $user;
        $image = $request->file('image')->store('assets', 'public');
        $data['image'] = $image;

        $biodata = Biodata::create($data);

        $biaya = Biaya::all();

        foreach ($biaya as $key => $biayas) {
            if ($biayas->id_angkatans == $biodata->angkatan_id  && $biayas->program_belajar == $biodata->program_belajar && $biayas->id_kursus == $biodata->course_id) {
                $tagihan = Tagihan::where('id_biayas', $biayas->id)->get();
                foreach ($tagihan as $key => $tagihans) {
                    $tagihanDetail = TagihanDetail::create([
                        'id_biayas' => $biayas->id,
                        'id_tagihans' => $tagihans->id,
                        'id_users' => $biodata->user->id,
                        'end_date' => $tagihans->end_date,
                        'amount' => $tagihans->amount,
                        'status' => 'BELUM',
                    ]);
                }
            }
        }

        return redirect()->route('kursus.dashboard')->with('success', 'Kamu Telah melengkapi Biodata Silahkan Lengkapi Dokument');
    }
}
