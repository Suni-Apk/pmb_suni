<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Biodata;
use App\Models\Course;
use App\Models\Link;
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
        $banner = Banner::where('type', 'DASHBOARD')->get();
        $mahasiswa = Auth::user();
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',$mahasiswa->id)->first();
        // Retrieve the user's selected course
        $kursusBiodata = Biodata::where('user_id', $mahasiswa->id)
        ->where('program_belajar', 'KURSUS')
        ->with('course') // Eager load the associated course
        ->first();

        if(!$kursusBiodata){ 
            $linkKursus = Link::where('gender',$mahasiswa->gender)->get();
            $kursus = Course::all();
        }else{
            // Retrieve links related to the selected course
            $linkKursus = Link::where('id_courses', $kursusBiodata->course->id)
            ->where('gender', $mahasiswa->gender)
            ->get();
            $kursus = Course::where('id', '!=', $kursusBiodata->course->id)->get();
        }
        
        // dd($kursus);
        return view('kursus.index', compact('hijriDateday', 'hijriDatedayArabic', 'hijriDatemonth', 'hijriDateyear', 'biodata', 'banner', 'kursusBiodata',
            (!$kursusBiodata) ? ['linkKursus','kursus'] : ['linkKursus', 'kursus'],
            'mahasiswa'
        ));
    }
}
