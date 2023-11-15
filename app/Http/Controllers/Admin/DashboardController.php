<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Matkuls;
use App\Models\Transaksi;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tanggal = now()->format('d-m-Y');
        $bulan = now()->format('m'); // Format bulan sebagai "01" untuk Januari, "02" untuk Februari, dll.
        $tahun = now()->format('Y'); // Format tahun sebagai "2023" (misalnya).

        $client = new Client();
        $response = $client->get("http://api.aladhan.com/v1/gToH/$tanggal");
        $data = json_decode($response->getBody(), true); // Menggunakan true untuk mendapatkan array asosiatif

        // Mengambil tanggal Hijriah untuk indeks pertama (bulan ini).
        $hijriDateday = $data['data']['hijri']['day'];
        $hijriDatedayArabic = $data['data']['hijri']['weekday']['ar'];
        $hijriDatemonth = $data['data']['hijri']['month']['ar'];
        $hijriDateyear = $data['data']['hijri']['year'];

        // chart resources
        $users = User::orderBy('id', 'desc')->get();
        $pemasukan = Transaksi::sum('total');
        $jurusan = Jurusan::get();
        $matkul = Matkuls::get();

        return view('admin.index',compact('hijriDateday','hijriDatedayArabic','hijriDatemonth','hijriDateyear', 'user', 'users', 'pemasukan', 'jurusan', 'matkul'));
    }

    public function profile()
    {
        return view('admin.profile.profile');
    }
}
