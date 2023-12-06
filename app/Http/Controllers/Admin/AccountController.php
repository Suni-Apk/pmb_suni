<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminExport;
use App\Exports\MahasiswaExport;
use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Cicilan;
use App\Models\Course;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\TahunAjaran;
use App\Models\Transaksi;
use App\Models\User;
use App\Traits\Ipaymu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AccountController extends Controller
{
    use Ipaymu;
    public function admin()
    {
        // Dapatkan admin yang sedang login saat ini
        $currentAdmin = Auth::user();

        // Dapatkan semua admin kecuali admin yang sedang login
        $admin = User::where('role', 'Admin')->get();

        return view('admin.account.admin.index', compact('admin'));
    }

    public function admin_show(string $id)
    {
        $data = User::find($id);

        return view('admin.account.admin.detail', compact('data'));
    }

    public function admin_create()
    {
        return view('admin.account.admin.create');
    }

    public function admin_create_process(Request $request)
    {
        $messages = [
            'name.required' => 'Nama Lengkap Wajib Diisi',
            'name.min:3' => 'Nama Anda Minimal 3 Huruf',
            'name.max:255' => 'Nama Anda Kepanjangan',
            'phone.required' => 'Nomor Whatshapp Wajib Diisi',
            'phone.min' => 'Nomor Whatshapp Minimal 12 Angka',
            'phone.max' => 'Nomor Whatshapp Maksimal 13 Angka',
            'phone.unique' => 'Nomor Sudah DI pakai Orang Lain',
            'email.email' => 'Harus Format Email',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Sudah Di pakai Orang Lain',
            'gender.required' => 'Gender Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'password.min:8' => 'Password Wajib 8 Angka / Huruf!'
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

        // dd($request->status);
        $user->update($data);
        return redirect()->route('admin.admin.index')->with('success', 'Berhasil Memperbarui Status Akun');
    }

    public function admin_delete($id)
    {
        $admin = User::where('role', 'Admin')->find($id);

        $admin->delete();

        return redirect()->route('admin.admin.index')->with("success", "Berhasil Menghapus Akun Admin $admin->name");
    }


    public function deleteAllAdmin(Request $request)
    {
        $ids = $request->ids;
        $admin = User::where('role', 'Admin')->whereIn('id', $ids);
        $admins = User::where('role', 'Admin')->where('id', $ids)->first();

        if ($admins == Auth::user()) {
            return redirect()->route('admin.admin.index')->with("error", "Ada user yang sedang dipakai");
        }
        $admin->delete();
        return redirect()->route('admin.admin.index')->with("success", "Berhasil Menghapus Akun Admin");
    }
    public function export(Request $request)
    {
        return Excel::download(new AdminExport, 'dataAdmin.xlsx');
    }

    public function mahasiswa(Request $request)
    {
        $tahun_ajaran = TahunAjaran::all();
        $mahasiswaAll = User::where('role', 'Mahasiswa')->get();
        $tahunAjaran = $request->input('angkatan_id');

        if ($request->input('angkatan_id')) {
            $mahasiswa = User::when($tahunAjaran, function ($query) use ($tahunAjaran) {
                $query->whereHas('biodata', function ($query) use ($tahunAjaran) {
                    $query->where('angkatan_id', $tahunAjaran);
                });
            })->latest()->get();
        } else {
            $mahasiswa = User::where('role', 'Mahasiswa')->latest()->get();
        }

        return view('admin.account.mahasiswa.index', compact('mahasiswa', 'tahun_ajaran', 'tahunAjaran', 'mahasiswaAll'));
    }

    public function mahasiswa_create()
    {
        return view('admin.account.mahasiswa.create');
    }

    public function mahasiswa_create_process(Request $request)
    {
        $messages = [
            'name.required' => 'Nama Lengkap Wajib Diisi',
            'name.min:3' => 'Nama Anda Minimal 3 Huruf',
            'name.max:255' => 'Nama Anda Kepanjangan',
            'phone.required' => 'Nomor Whatshapp Wajib Diisi',
            'phone.min' => 'Nomor Whatshapp Minimal 12 Angka',
            'phone.max' => 'Nomor Whatshapp Maksimal 13 Angka',
            'phone.unique' => 'Nomor Sudah dipakai Orang Lain',
            'email.email' => 'Harus Format Email',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Sudah Di pakai Orang Lain',
            'gender.required' => 'Gender Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'password.min:8' => 'Password Wajib 8 Angka / Huruf'
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
        $data['angkatan_id'] = TahunAjaran::latest()->where('status', 'Active')->first();

        $user = User::create($data);
        $id = $user->id;
        
        $program = $request->program;
        $course = Course::where('keyword', $program)->first();

        $adminstrasiKursus = Administrasi::where('program_belajar', 'KURSUS')->where('course_id', $course->id)->first();
        $adminstrasiS1 = Administrasi::where('program_belajar', 'S1')->first();

        if($program == 'S1'){
            $payment = json_decode(json_encode($this->redirect_payment($id,$program,$adminstrasiS1,$adminstrasiKursus)), true);
            // dd($payment);
            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'no_invoice' => $payment['Data']['SessionID'],
                'jenis_tagihan' => 'Administrasi',
                'jenis_pembayaran' => 'cash',
                'program_belajar' => 'S1',
                'status' => 'pending',
                'total' => $adminstrasiS1->amount,
                'payment_link' => $payment['Data']['Url'],
            ]);
        }else{
            $payment = json_decode(json_encode($this->redirect_payment($id,$program,$adminstrasiS1,$adminstrasiKursus)), true);
            // dd($payment);
            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'no_invoice' => $payment['Data']['SessionID'],
                'jenis_tagihan' => 'Administrasi',
                'jenis_pembayaran' => 'cash',
                'program_belajar' => 'KURSUS',
                'status' => 'pending',
                'total' => $adminstrasiKursus->amount,
                'payment_link' => $payment['Data']['Url'],
            ]);
        }



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

    public function mahasiswa_delete($id)
    {
        $user = User::where('role', 'Mahasiswa')->find($id);
        if ($user->biodata) {
            $user->biodata->delete();
        } if ($user->document) {
            $user->document->delete();
        } if ($user->transaksi) {
            $user->transaksi->delete();
        } if ($user->tagihanDetail) {
            $user->tagihanDetail->delete();
        }

        $user->delete();

        return redirect()->route('admin.mahasiswa.index')->with("success", "Berhasil Melakukan Penghapusan Akun $user->name");
    }

    public function mahasiswa_detail($id)
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->find($id);
        $biodata = Biodata::where('user_id', $mahasiswa->id)->get();
        $biaya = Biaya::get();
        $biayaAll = Biaya::all();
        $cicilanAll = Cicilan::all();
        return view('admin.account.mahasiswa.detail', compact('biodata', 'mahasiswa', 'biaya', 'biayaAll', 'cicilanAll'));
    }
    public function mahasiswa_bayar(Request $request, $id)
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

        $tagihan = TagihanDetail::where('id', $ids)->firstOrFail();
        $total = array_sum($jumlahBiaya);
        $mahasiswa = User::findOrFail($id);
        // foreach ($ids as $idTagih) {
        //     $tagihanDetail = TagihanDetail::where('id', $idTagih)->get();
        //     foreach ($tagihanDetail as $value) {
        //         // dd($value);
        //         $transaction = Transaksi::all();
        //         foreach ($transaction as $transactions) {
        //             if ($value->id_transactions === $transactions->id && $value->status === 'LUNAS' && $value->id_users == $mahasiswa->id) {
        //                 return redirect()->route('admin.mahasiswa.show', $mahasiswa->id);
        //             } else {
        //                 return view('admin.account.mahasiswa.bayar', compact('jenis', 'id', 'total', 'mahasiswa', 'tagihan', 'ids'));
        //             }
        //         }
        //     }
        // }

        return view('admin.account.mahasiswa.bayar', compact('jenis', 'id', 'total', 'mahasiswa', 'tagihan', 'ids'));
    }

    public function exportMahasiswa(Request $request)
    {
        $tahunAjaran = $request->input('angkatan_id');
        $mahasiswa = User::when($tahunAjaran, function ($query) use ($tahunAjaran) {
            $query->whereHas('biodata', function ($query) use ($tahunAjaran) {
                $query->where('angkatan_id', $tahunAjaran);
            });
        })->where('role', 'Mahasiswa')->get();

        $export = new MahasiswaExport($mahasiswa);
        return Excel::download($export, 'dataMahasiswa.xlsx');
    }


    public function pendaftar()
    {
        $mahasiswa = User::where('role', 'Mahasiswa')->latest()->get();

        return view('admin.account.pendaftar.index', compact('mahasiswa'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $user = User::where('role', 'Mahasiswa')->whereIn('id', $ids);
        $biodata = Biodata::whereIn('user_id', $ids);
        $tagihanDetail =  TagihanDetail::whereIn('id_users', $ids);
        $tagihanDetailGet =  TagihanDetail::whereIn('id_users', $ids)->get();

        foreach ($tagihanDetailGet as $value) {
            $cicilan = Cicilan::whereIn('id_tagihan_details', $value->id);
            $cicilan->delete();
        }

        $tagihanDetail->delete();
        $biodata->delete();
        $user->delete();

        return redirect()->back();
    }
}