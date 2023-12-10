<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Cicilan;
use App\Models\Link;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
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
        
        $biayas = Biaya::get();
        $cicilanAll = Cicilan::all();
        $user = Auth::user();
        $banner = Banner::where('type', 'DASHBOARD')->get();
        $biodata = Biodata::where('program_belajar','S1')->where('user_id',$user->id)->first();
        if ($user->biodata) {
            $userCourseIds = Biodata::where('user_id', Auth::id())->pluck('jurusan_id')->toArray();
            $links = Link::whereIn('id_jurusans', $userCourseIds)
                    ->where('gender', $user->gender)
                    ->get();
            return view('mahasiswa.index',compact('hijriDateday','hijriDatedayArabic','hijriDatemonth','hijriDateyear', 'user', 'biodata', 'banner', 'biayas', 'cicilanAll', 'links'));
        } else {
            return view('mahasiswa.index',compact('hijriDateday','hijriDatedayArabic','hijriDatemonth','hijriDateyear', 'user', 'biodata', 'banner', 'biayas', 'cicilanAll'));
        }

    }
}
