<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Biodata;
use App\Models\Course;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function kursus()
    {
        $tanggal = now()->format('d-m-Y');
        $bulan = now()->format('m'); // Format bulan sebagai "01" untuk Januari, "02" untuk Februari, dll.
        $tahun = now()->format('Y'); // Format tahun sebagai "2023" (misalnya).

        $client = new Client();
        $response = $client->get("http://api.aladhan.com/v1/gToH/$tanggal");
        $data = json_decode($response->getBody(), true); // Menggunakan true untuk mendapatkan array asosiatif

        // Mengambil tanggal Hijriah untuk indeks pertama (bulan ini).
        // $hijriDateArabic = $data['data']['hijri']['day']['ar'];
        $hijriDateday = $data['data']['hijri']['day'];
        $hijriDatedayArabic = $data['data']['hijri']['weekday']['ar'];
        $hijriDatemonth = $data['data']['hijri']['month']['ar'];
        $hijriDateyear = $data['data']['hijri']['year'];
        $user = Auth::user();
        $kursus = Course::all();
        $banner = Banner::where('type', 'DASHBOARD')->get();
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',$user->id)->first();
        return view('kursus.index',compact('hijriDateday', 'hijriDatedayArabic','hijriDatemonth','hijriDateyear','user','biodata', 'kursus', 'banner'));
    }
}
