<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Cicilan;
use App\Models\TagihanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $biodata = Biodata::where('program_belajar', 'S1')->where('user_id', Auth::user()->id)->first();
        $mahasiswa = Auth::user();
        $biayas = Biaya::all();
        $biayaAll = Biaya::all();
        $cicilanAll = Cicilan::all();

        // return view('admin.account.mahasiswa.detail', compact('biodata');
        return view('mahasiswa.tagihan.index', compact('biodata', 'mahasiswa', 'biayas', 'biayaAll', 'cicilanAll'));
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

        return view('mahasiswa.transaksi.bayar', compact('jenis', 'id', 'total', 'mahasiswa', 'tagihan', 'ids'));
    }
    public function detail($name)
    {
        $biodata = Biodata::where('program_belajar', 'S1')->where('user_id', Auth::user()->id)->first();
        return view('mahasiswa.tagihan.detail-tagihan', compact('biodata'));
    }
    public function detail_spp($name)
    {
        $biodata = Biodata::where('program_belajar', 'S1')->where('user_id', Auth::user()->id)->first();
        return view('mahasiswa.tagihan.detail-tagihan', compact('biodata'));
    }
    public function payment_spp($name)
    {
        $biodata = Biodata::where('program_belajar', 'S1')->where('user_id', Auth::user()->id)->first();
        return view('mahasiswa.tagihan.pilih-pembayaran', compact('biodata'));
    }

    public function detail_tidak_routine($name)
    {
        $biodata = Biodata::where('program_belajar', 'S1')->where('user_id', Auth::user()->id)->first();
        return view('mahasiswa.tagihan.detail-tagihan-tidak-routine', compact('biodata'));
    }
}
