<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\TagihanDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function admin()
    {
        // Dapatkan admin yang sedang login saat ini
        $currentAdmin = Auth::user();

        // Dapatkan semua admin kecuali admin yang sedang login
        $admin = User::where('role', 'Admin')->where('id', '!=', $currentAdmin->id)->get();

        return view('admin.account.admin.index', compact('admin'));
    }

    public function admin_create()
    {
        return view('admin.account.admin.create');
    }

    public function admin_create_process(Request $request)
    {
        $messages = [
            'name.required' => 'Nama Lengkap Wajib Diisi',
            'name.min:3' => 'Nama Anda Minimal 3 Huruf!!',
            'name.max:255' => 'Nama Anda Kepanjangan',
            'phone.required' => 'Nomor Whatshapp Wajib Diisi',
            'phone.min' => 'Nomor Whatshapp Minimal 12 Angka!!',
            'phone.max' => 'Nomor Whatshapp Maksimal 13 Angka!!',
            'phone.unique' => 'Nomor Sudah DI pakai Orang Lain',
            'email.email' => 'Harus Format Email',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Sudah Di pakai Orang Lain',
            'gender.required' => 'Gender Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'password.min:8' => 'Password Wajib 8 Angka / Huruf!!!'
        ];
        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'phone' => 'required|min:12|max:13|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required',
            'password' => 'required|min:8|confirmed'
        ], $messages);
        $data['active'] = 1;
        $data['token'] = rand(1111111, 999999);
        $data['role'] = 'Admin';

        User::create($data);

        return redirect()->route('admin.admin.index')->with('success', 'Berhasil Menambahkan Akun Admin');
    }

    public function admin_edit($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        if (!$user) {
            // Pengguna tidak ditemukan, lakukan sesuatu seperti me-redirect atau menampilkan pesan kesalahan.
            return redirect()->route('admin.admin.index')->with('error', 'Pengguna tidak ditemukan');
        }

        return view('admin.account.admin.edit', compact('user'));
    }

    public function admin_edit_process(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'phone' => "required|unique:users,phone,{$user->phone},phone",
            'email' => "required|email|unique:users,email,{$user->email},email",
            'gender' => 'required',
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Password Lama Kamu Salah'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $user->update($data);

        return redirect()->route('admin.admin.index')->with('success', 'Berhasil Mengedit Account Admin');
    }

    public function admin_status(Request $request, $id)
    {
        $user = User::where('role', 'Admin')->find($id);
        $data = $request->validate([
            'status' => ''
        ]);
        
        // dd($request);
        $user->update($data);
        return redirect()->route('admin.admin.index')->with('success', 'Berhasil Memperbarui Status Akun');
    }


    public function mahasiswa()
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->get();
        return view('admin.account.mahasiswa.index', compact('mahasiswa'));
    }

    public function mahasiswa_create()
    {
        return view('admin.account.mahasiswa.create');
    }

    public function mahasiswa_create_process(Request $request)
    {
        $messages = [
            'name.required' => 'Nama Lengkap Wajib Diisi',
            'name.min:3' => 'Nama Anda Minimal 3 Huruf!!',
            'name.max:255' => 'Nama Anda Kepanjangan',
            'phone.required' => 'Nomor Whatshapp Wajib Diisi',
            'phone.min' => 'Nomor Whatshapp Minimal 12 Angka!!',
            'phone.max' => 'Nomor Whatshapp Maksimal 13 Angka!!',
            'phone.unique' => 'Nomor Sudah DI pakai Orang Lain',
            'email.email' => 'Harus Format Email',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Sudah Di pakai Orang Lain',
            'gender.required' => 'Gender Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'password.min:8' => 'Password Wajib 8 Angka / Huruf!!!'
        ];
        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'phone' => 'required|min:12|max:13|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required',
            'password' => 'required|min:8|confirmed'
        ], $messages);
        $data['active'] = 1;
        $data['token'] = rand(1111111, 999999);
        $data['role'] = 'Mahasiswa';

        User::create($data);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil Menambahkan Akun Mahasiswa');
    }

    public function mahasiswa_edit($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        if (!$user) {
            // Pengguna tidak ditemukan, lakukan sesuatu seperti me-redirect atau menampilkan pesan kesalahan.
            return redirect()->route('admin.mahasiswa.index')->with('error', 'Pengguna tidak ditemukan');
        }

        return view('admin.account.mahasiswa.edit', compact('user'));
    }

    public function mahasiswa_edit_process(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'phone' => "required|unique:users,phone,{$user->phone},phone",
            'email' => "required|email|unique:users,email,{$user->email},email",
            'gender' => 'required',
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Password Lama Kamu Salah'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $user->update($data);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil Mengedit Account Mahasiswa');
    }

    public function mahasiswa_status(Request $request, $id)
    {
        $user = User::where('role', 'Mahasiswa')->find($id);
        $data = $request->validate([
            'status' => ''
        ]);
        
        $user->update($data);
        if ($user->status == 'on') {
            return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil Mengaktifkan Akun');
        } else {
            return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil Menonaktifkan Akun');
        }
    }
    public function mahasiswa_detail($id)
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->find($id);
        $biodata = Biodata::where('user_id', $mahasiswa->id)->get();
        $biaya = Biaya::get();
        $biayaAll = Biaya::all();

        return view('admin.account.mahasiswa.detail', compact('biodata', 'mahasiswa', 'biaya', 'biayaAll'));
    }
    public function mahasiswa_bayar(Request $request)
    {
        $jenis = $request->jenis_tagihan;
        $id = $request->id;
        return view('admin.account.mahasiswa.bayar', compact('jenis', 'id'));
    }
}
