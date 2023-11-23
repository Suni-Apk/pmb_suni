<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Jurusan;
use App\Models\Notify;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\TahunAjaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function pendaftaran_s1()
    {
        $tahunAjaran = TahunAjaran::where('status', 'Active')->first();
        $jurusan = Jurusan::where('id_tahun_ajarans', $tahunAjaran->id)->get();
        return view('mahasiswa.biodata.pendaftaran-s1', compact('jurusan'));
    }

    public function pendaftaran_s1_process(Request $request)
    {
        $user = Auth::user()->id;
        $notif = Notify::where('id', 1)->first();
        $angkatan = TahunAjaran::where('status', 'Active')->first();
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

        $biodata = Biodata::create($data);
        $user = Auth::user()->id;

        $biaya = Biaya::all();

        // $transaksi = Transaksi::where('user_id', $user)->where('status', 'berhasil')->where('program_belajar', 'S1')->where('jenis_tagihan', 'Administrasi')->first();

        $biodata = Biodata::where('user_id', $user)->where('program_belajar', 'S1')->first();

        foreach ($biaya as $key => $biayas) {
            if ($biayas->jenis_biaya == 'DaftarUlang' && $biayas->id_angkatans == $biodata->angkatan_id) {
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
            // if ($biayas->id_angkatans == $biodata->angkatan_id && $biayas->id_jurusans == $biodata->jurusan_id && $biayas->program_belajar == $biodata->program_belajar) {
            //     $tagihan = Tagihan::where('id_biayas', $biayas->id)->get();

            //     foreach ($tagihan as $key => $tagihans) {
            //         $tagihanDetail = TagihanDetail::create([
            //             'id_biayas' => $biayas->id,
            //             'id_tagihans' => $tagihans->id,
            //             'id_users' => $biodata->user->id,
            //             'end_date' => $tagihans->end_date,
            //             'amount' => $tagihans->amount,
            //             'status' => 'BELUM',
            //         ]);
            //     }
            // } else if ($biayas->id_angkatans == $biodata->angkatan_id && $biayas->program_belajar == $biodata->program_belajar) {
            //     $tagihan = Tagihan::where('id_biayas', $biayas->id)->get();
            //     foreach ($tagihan as $key => $tagihans) {
            //         $tagihanDetail = TagihanDetail::create([
            //             'id_biayas' => $biayas->id,
            //             'id_tagihans' => $tagihans->id,
            //             'id_users' => $biodata->user->id,
            //             'end_date' => $tagihans->end_date,
            //             'amount' => $tagihans->amount,
            //             'status' => 'BELUM',
            //         ]);
            //     }
            // }
        }
        // $pesan = $notif->notif_isi_biodata_formal . $user->name;

        // $this->send_message($user->phone, $pesan);

        return redirect()->route('mahasiswa.pendaftaran.document')->with('success', 'Kamu Telah melengkapi Biodata Silahkan Lengkapi Dokument');
    }
}
