<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\TagihanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $biodatas = Biodata::where('program_belajar', 'KURSUS')->where('user_id', Auth::user()->id)->first();
        $mahasiswa = Auth::user();
        $biaya = Biaya::all();
        $biayaAll = Biaya::all();

        // return view('admin.account.mahasiswa.detail', compact('biodata');
        return view('kursus.tagihan.index', compact('biodatas', 'mahasiswa', 'biaya', 'biayaAll'));
    }
    public function bayar(Request $request, $id)
    {
        $jenis = $request->jenis_tagihan;
        $data = $request->validate([
            'id' => 'required',
        ]);
        $ids = $request->id;

        // dd($ids);
        foreach ($ids as $idTagihan) {
            $tagihans = TagihanDetail::where('id', $idTagihan)->get();
            foreach ($tagihans as $t) {
                $jumlahBiaya[] = $t->amount;
            }
        }

        $total = array_sum($jumlahBiaya);
        $tagihan = TagihanDetail::where('id', $ids)->firstOrFail();
        $mahasiswa = Auth::user();

        return view('kursus.transaksi.bayar', compact('jenis', 'id', 'total', 'mahasiswa', 'tagihan', 'ids'));
    }
    public function detail($name)
    {
        $biodata = Biodata::where('program_belajar', 'KURSUS')->where('user_id', Auth::user()->id)->first();
        return view('kursus.tagihan.detail-tagihan', compact('biodata'));
    }
    public function detail_spp($name)
    {
        $biodata = Biodata::where('program_belajar', 'KURSUS')->where('user_id', Auth::user()->id)->first();
        return view('kursus.tagihan.detail-tagihan', compact('biodata'));
    }

    public function payment_spp($name)
    {
        $biodata = Biodata::where('program_belajar', 'KURSUS')->where('user_id', Auth::user()->id)->first();
        return view('kursus.tagihan.pilih-pembayaran', compact('biodata'));
    }

    public function detail_tidak_routine($name)
    {
        $biodata = Biodata::where('program_belajar', 'KURSUS')->where('user_id', Auth::user()->id)->first();
        return view('kursus.tagihan.detail-tagihan-tidak-routine', compact('biodata'));
    }
}
