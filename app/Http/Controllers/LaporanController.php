<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaLaporanExport;
use App\Exports\PendaftarExport;
use App\Models\Jurusan;
use App\Models\Matkuls;
use App\Models\TahunAjaran;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->get();
        $tahunAjaran = TahunAjaran::with('biodatas.user')->get();
        $users = User::orderBy('id', 'desc')->get();
        $pemasukan = Transaksi::sum('total');
        $jurusan = Jurusan::get();
        $matkul = Matkuls::get();
        $transaksi = Transaksi::latest()->get();
        return view('admin.laporan.index', compact('mahasiswa', 'tahunAjaran', 'users','pemasukan', 'jurusan', 'matkul', 'transaksi'));
    }

    public function exportMahasiswaLaporan($tahunAjaran)
    {
        $mahasiswa = User::where('role', 'Mahasiswa')
            ->whereHas('biodata', function ($query) use ($tahunAjaran) {
                $query->where('angkatan_id', $tahunAjaran);
            })
            ->with('biodata')
            ->get();

        return Excel::download(new MahasiswaLaporanExport($mahasiswa), 'dataMahasiswa.xlsx');
    }

    public function exportPendaftar(Request $request)
    {
        return Excel::download(new PendaftarExport, 'dataPendaftar.xlsx');
    }
}
