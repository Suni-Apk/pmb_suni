<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
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
        $hijriDatemonth = $data['data']['hijri']['month']['ar'];
        $hijriDateyear = $data['data']['hijri']['year'];
        $user = Auth::user();
        return view('mahasiswa.index',compact('hijriDateday','hijriDatemonth','hijriDateyear', 'user'));
    }

    public function profile()
    {
        return view('mahasiswa.profile.index');
    }

    public function edit_profile($name)
    {
        $mahasiswa = Auth::user();
        return view('mahasiswa.profile.edit-profile',compact('mahasiswa'));
    }

    public function edit_profile_process(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'phone' => "required|unique:users,phone,{$user->phone},phone",
            'email' => "required|email|unique:users,email,{$user->email},email",
            'gender' => 'required',
            'birthdate' => 'required|date',
        ]);

        $user->update($data);

        return redirect()->route('mahasiswa.profile')->with('success','Berhasil Mengedit Profile Anda');
    }

    public function change_password()
    {
        return view('mahasiswa.profile.change-password');
    }

    public function change_password_process(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $messages = [
            'old_password.required' => 'Password Lama Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama Dengan Password Confirmasi'
        ];
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ],$messages);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Password Lama Kamu Salah'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('mahasiswa.profile')->with('success','Berhasil Mengedit Password');
    }

}
