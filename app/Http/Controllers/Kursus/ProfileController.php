<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {   
        $userId = Auth::user()->id;
        $user = Auth::user();
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',$userId)->first();
        return view('kursus.profile.index',compact('biodata','user'));
    }

    public function edit_profile($name)
    {
        $mahasiswa = Auth::user();
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.profile.edit-profile',compact('mahasiswa','biodata'));
    }

    public function edit_profile_process(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'phone' => "required|unique:users,phone,{$user->phone},phone",
            'email' => "required|email|unique:users,email,{$user->email},email",
            'gender' => 'required',
        ]);

        $user->update($data);

        return redirect()->route('kursus.profile.index')->with('success','Berhasil Mengedit Profile Anda');
    }

    public function change_password()
    {
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.profile.change-password',compact('biodata'));
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

        return redirect()->route('kursus.profile.index')->with('success','Berhasil Mengedit Password');
    }

    public function edit_biodata($id)
    {
        $user = User::where('id',$id)->first();
        $biodata = Biodata::where('program_belajar','KURSUS')->where('user_id',Auth::user()->id)->first();
        return view('kursus.profile.edit-biodata',compact('user','biodata'));
    }

    public function edit_biodata_process(Request $request,$id)
    {
        $user = Biodata::where('user_id',$id)->first();
        $userId = User::find($id);
        $angkatan = TahunAjaran::where('status','Active')->first();
        $data = $request->validate([
            'user_id' => $id,
            'profesi' => 'required|string',
            'baca_quran' => 'required|string',
            'birthdate' => 'required|date',
            'birthplace' => 'required',
            'address' => 'required',
        ]);
        $data['program_belajar'] = "KURSUS";
        $data['user_id'] = $id;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('assets', 'public');
            $data['image'] = $image;
        } else {
            // Access the 'image' property from the user model instance.
            $userId->biodata->image;
        }

         // Cek jika pengguna mengisi provinsi, kota, dan kecamatan
         if ($request->has('provinsi') && $request->has('kota') && $request->has('kecamatan')) {
            // Jika pengguna mengisi, gunakan data yang mereka masukkan
            $data['provinsi'] = $request->input('provinsi');
            $data['kota'] = $request->input('kota');
            $data['kecamatan'] = $request->input('kecamatan');
        } else {
            // Jika pengguna tidak mengisi, gunakan data yang sudah ada di database
            $data['provinsi'] = $user->provinsi;
            $data['kota'] = $user->kota;
            $data['kecamatan'] = $user->kecamatan;
        }
        // dd($data);
        $user->update($data);
        return redirect()->route('kursus.profile.index')->with('success','Berhasil Mengubah Biodata Anda');
    }
}
