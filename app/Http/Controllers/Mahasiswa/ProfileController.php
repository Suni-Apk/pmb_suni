<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    
    public function profile()
    {   
        $userId = Auth::user()->id;
        $user = Auth::user();
        $biodata = Biodata::where('program_belajar','S1')->where('user_id',Auth::user()->id)->first();
        return view('mahasiswa.profile.index',compact('biodata','user'));
    }



    public function edit_profile($name)
    {
        $mahasiswa = Auth::user();
        $biodata = Biodata::where('program_belajar','S1')->where('user_id',Auth::user()->id)->first();
        return view('mahasiswa.profile.edit-profile',compact('mahasiswa','biodata'));
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

        return redirect()->route('mahasiswa.profile.index')->with('success','Berhasil Mengedit Profile Anda');
    }

    public function change_password()
    {
        $biodata = Biodata::where('program_belajar','S1')->where('user_id',Auth::user()->id)->first();
        return view('mahasiswa.profile.change-password',compact('biodata'));
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

        return redirect()->route('mahasiswa.profile.index')->with('success','Berhasil Mengedit Password');
    }

    public function edit_biodata($id)
    {
        $user = User::where('id',$id)->first();
        $biodata = Biodata::where('program_belajar','S1')->where('user_id',Auth::user()->id)->first();
        return view('mahasiswa.profile.edit-biodata',compact('user','biodata'));
    }

    public function edit_biodata_process(Request $request,$id)
    {
        $user = Biodata::where('user_id',$id);
        $userId = User::find($id);
        $data = $request->validate([
            'user_id' => $userId,
            'birthdate' => 'required|date',
            'birthplace' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'address' => 'required',
            'last_graduate' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('assets', 'public');
            $data['image'] = $image;
        } else {
            // Access the 'image' property from the user model instance.
            $userId->biodata->image;
        }

        $user->update($data);
        return redirect()->route('mahasiswa.profile.index')->with('success','Berhasil Mengubah Biodata Anda');
    }

    public function edit_document($id)
    {
        $user = User::where('id',$id)->first();
        $biodata = Biodata::where('program_belajar','S1')->where('user_id',Auth::user()->id)->first();
        return view('mahasiswa.profile.edit-document',compact('user','biodata'));
    }

    public function edit_document_process(Request $request,$id)
    {
        $user = User::find($id);
            // Memeriksa apakah ada file yang diunggah untuk setiap jenis dokumen dan hanya mengunggah jika ada
            if ($request->hasFile('ktp')) {
                // Upload dan ganti file Kartu Keluarga jika ada yang diunggah
                $ktpFile = $request->file('ktp');
                $ktpFileName = time() . '_ktp_' . $ktpFile->getClientOriginalName();
                $ktpFile->storeAs('public/pdf', $ktpFileName);
                $user->document->ktp = 'pdf/' . $ktpFileName;
            }

            if ($request->hasFile('kk')) {
                // Upload dan ganti file Ijazah jika ada yang diunggah
                $kkFile = $request->file('kk');
                $kkFileName = time() . 'kk' . $kkFile->getClientOriginalName();
                $kkFile->storeAs('public/pdf', $kkFileName);
                $user->document->kk = 'pdf/' . $kkFileName;
            }

            if ($request->hasFile('ijazah')) {
                // Upload dan ganti file Akta jika ada yang diunggah
                $ijazahFile = $request->file('ijazah');
                $ijazahFileName = time() . 'ijazah' . $ijazahFile->getClientOriginalName();
                $ijazahFile->storeAs('public/pdf', $ijazahFileName);
                $user->document->ijazah = 'pdf/' . $ijazahFileName;
            }

            if ($request->hasFile('transkrip_nilai')) {
                // Upload dan ganti file Rapor jika ada yang diunggah
                $transkrip_nilaiFile = $request->file('transkrip_nilai');
                $transkrip_nilaiFileName = time() . '_transkrip_nilai_' . $transkrip_nilaiFile->getClientOriginalName();
                $transkrip_nilaiFile->storeAs('public/pdf', $transkrip_nilaiFileName);
                $user->document->transkrip_nilai = 'pdf/' . $transkrip_nilaiFileName;
            }
            
            $user->document->save();

            return redirect()->route('mahasiswa.profile.index')->with('success','Berhasil Mengganti Dokument');
    }
}
