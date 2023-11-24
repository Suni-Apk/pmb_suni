<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\Banner;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Notify;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\TahunAjaran;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\Fonnte;
use App\Traits\Ipaymu;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    use Ipaymu;
    use Fonnte;
    public function register()
    {
        $banner = Banner::get();
        return view('auth.register', compact('banner'));
    }

    public function register_process(Request $request)
    {
        $phone = $request->phone;
        if (Str::startsWith($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        $existingUser = User::where('phone', $phone)->first();
        if ($existingUser) {
            return redirect()->back()->withErrors(['phone' => 'Nomor Sudah Terpakai']);
        }
        $messages = [
            'name.required' => 'Nama Lengkap Wajib Diisi',
            'name.min:3' => 'Masukkan Minimal 3 Huruf',
            'name.max:255' => 'Batas hanya 255 karakter',
            'phone.required' => 'Nomor Whatsapp Wajib Diisi',
            'phone.min' => 'Nomor Whatsapp Minimal 12 Angka',
            'phone.max' => 'Nomor Whatsapp Maksimal 13 Angka',
            'gender.required' => 'Gender Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'password.min:8' => 'Password Wajib 8 Angka / Huruf'
        ];
        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'phone' => 'required|min:11|max:13|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|string',
            'password' => 'required|confirmed|min:8',
        ], $messages);
        $data['phone'] = $request->phone;
        $data['role'] = 'Mahasiswa';
        $data['token'] = rand(111111, 999999);
        $data['angkatan_id'] = TahunAjaran::latest()->where('status', 'Active')->first();
        // dd($data);
        $user = User::create($data);
        $notif = Notify::where('id', 1)->first();
        $messages =  $notif->notif_otp . ' ' . $user->token;

        $this->send_message($user->phone, $messages);

        return redirect()->route('verify');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        $phone = $request->phone;
        if (Str::startsWith($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $messages = [
            'phone.required' => 'Nomor Wajib Diisi!!',
            'password.required' => 'Password Wajib Diisi',
            'phone.exists' => 'Nomor atau Password salah.'
        ];
        $request->validate([
            'phone' => 'required|exists:users,phone',
            'password' => 'required'
        ], $messages);
        $infologin = [
            'phone' => $phone,
            'password' => $request->password
        ];

        $credentials = $request->only('phone', 'password');
        $user = User::where('phone', $credentials)->first();

        if ($user->active == 0) {

            return redirect()->route('verify')->with('gagal', 'Kamu Harus Mengisi Kode OTP Yang Dikirim');
        } elseif ($user->status == 'off') {
            return redirect()->route('login')->withErrors(['phone' => 'Nomor Kamu Di NonAktifkan']);
        }

        $authenticated = Auth::attempt($credentials, $request->has('remember'));

        if (!$authenticated) {
            return redirect()->route('login')->with('error', 'Nomor Hp atau password salah.');
        }

        $input = $request->all();
        $users = Auth::user();
        auth()->attempt(array('phone' => $input['phone'], 'password' => $input['password']));
        if (auth()->user()->role == 'Mahasiswa') {
            return redirect()->route('program.program_belajar');
            // if(!Auth::user()->biodata && !Auth::user()->document){
            //     return redirect()->route('mahasiswa.dashboard')->with('success','Silahkan Mengisi Biodata Dan Dokument Terlebih Dahulu');
            // }elseif(Auth::user()->biodata && !Auth::user()->document){
            //     return redirect()->route('mahasiswa.dashboard')->with('success','Silahkan Mengisi Dokument Terlebih Dahulu');
            // }elseif(!Auth::user()->biodata && Auth::user()->document){
            //     return redirect()->route('mahasiswa.dashboard')->with('success','Silahkan Mengisi Biodata Terlebih Dahulu');
            // }else{
            //     return redirect()->route('mahasiswa.dashboard')->with('success','Halo Selamat Datang');
            // }
        } else {
            return redirect()->back()->withErrors([
                'phone' => 'Kamu bukan Mahasiswa Disini'
            ]);
        }

        return redirect()->route('mahasiswa.dashboard');
    }

    public function verify()
    {
        return view('auth.verify');
    }

    public function verify_otp(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        // $payment = User::where('payment',$request->id)->first();
        // $notif = User::where('notify_id',1)->first();

        if ($user) {
            $user->update([
                'active' => 1,
            ]);

            // Setelah mengupdate status aktif, kita akan mencoba masuk
            auth()->login($user);

            // $messages = $notif->notifys->notif_login;

            // $this->send_message($user->nomor,$messages);

            return redirect()->route('program.program_belajar');
        }

        return redirect()->back()->with('error', 'Token Tidak Sesuai');
    }

    public function switch_program()
    {
        $user = Auth::user();
        return view('mahasiswa.program.index', compact('user'));
    }

    public function switch(Request $request, $id)
    {
        $user = Auth::user();
        $biodataS1 = Biodata::where('user_id', $user->id)->where('program_belajar', 'S1')->first();
        $biodataKursus = Biodata::where('user_id', $user->id)->where('program_belajar', 'KURSUS')->first();
        $transaksiS1 = Transaksi::where('user_id', $user->id)->where('program_belajar', 'S1')->where('jenis_tagihan', 'Administrasi')->first();
        $transaksiKursus = Transaksi::where('user_id', $user->id)->where('program_belajar', 'KURSUS')->where('jenis_tagihan', 'Administrasi')->first();
        if ($request->program == 'S1') {
            if (!$transaksiS1) {
                $adminstrasiS1 = Administrasi::where('program_belajar', 'S1')->first();
                // return redirect()->route('mahasiswa.administrasi');

                $payment = json_decode(json_encode($this->redirect_payment($id)), true);
                $transaksi = Transaksi::create([
                    'user_id' => $user->id,
                    'no_invoice' => $payment['Data']['SessionID'],
                    'jenis_tagihan' => 'Administrasi',
                    'jenis_pembayaran' => 'Ipaymu',
                    'program_belajar' => 'S1',
                    'status' => 'pending',
                    'total' => '10000',
                    'payment_link' => $payment['Data']['Url'],
                ]);
                return view('mahasiswa.transaksi.administrasi', compact('transaksi'));
                // return Redirect::to($transaksi->payment_link);
            } elseif ($transaksiS1->status == 'pending') {
                $adminstrasiS1Pending = Transaksi::where('program_belajar', 'S1')->where('user_id', $user->id)->where('status', 'pending')->first();
                return Redirect::to($adminstrasiS1Pending->payment_link);
            } elseif ($transaksiS1->status == 'berhasil') {
                if (!$biodataS1 && !$user->document) {
                    return redirect()->route('mahasiswa.dashboard')->with('success', 'Silahkan Lengkapi Biodata Dan Document Anda');
                } elseif ($biodataS1 && !$user->document) {
                    return redirect()->route('mahasiswa.dashboard')->with('success', 'Silahkan Lengakpi Document Anda');
                } else {
                    return redirect()->route('mahasiswa.dashboard')->with("success','Selamat Datang Di Dashboard S1 . $user->name");
                }
            }
        } else {
            if (!$transaksiKursus) {
                $adminstrasiKursus = Administrasi::where('program_belajar', 'KURSUS')->first();

                $payment = json_decode(json_encode($this->redirect_payment($id)), true);
                $transaksi = Transaksi::create([
                    'user_id' => $user->id,
                    'no_invoice' => $payment['Data']['SessionID'],
                    'jenis_tagihan' => 'Administrasi',
                    'jenis_pembayaran' => 'Ipaymu',
                    'program_belajar' => 'KURSUS',
                    'status' => 'pending',
                    'total' => '10000',
                    'payment_link' => $payment['Data']['Url'],
                ]);
                return view('kursus.transaksi.administrasi', compact('transaksi'));
                return Redirect::to($transaksi->payment_link);
            } elseif ($transaksiKursus->status == 'pending') {
                $adminstrasiKursusPending = Transaksi::where('program_belajar', 'KURSUS')->where('user_id', $user->id)->where('status', 'pending')->latest()->first();
                return Redirect::to($adminstrasiKursusPending->payment_link);
            } elseif ($transaksiKursus->status == 'berhasil') {
                if (!$biodataKursus) {
                    return redirect()->route('kursus.dashboard')->with('success', 'Silahkan Melengkapi Biodata Anda');
                } else {
                    return redirect()->route('kursus.dashboard')->with("success','Selamat Datang Di Dashboard S1 . $user->name");
                }
            }
        }
    }

    public function demo_success($sid)
    {
        $userId = Auth::user()->id;

        $transaksi = Transaksi::where('user_id', $userId)->where('no_invoice', $sid)->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        $transaksi->update([
            'status' => 'berhasil'
        ]);


        $dashboardRoute = ($transaksi->program_belajar == 'S1') ? 'mahasiswa.dashboard' : 'kursus.dashboard';

        return redirect()->route($dashboardRoute)->with('success', 'Selamat Datang Anda Telah Melakukan Pembayaran');
    }

    // public function demo_success(Request $request, $sid)
    // {
    //     $userId = Auth::user()->id;
    //     $transaksi = Transaksi::where('user_id', $userId)->where('no_invoice', $sid)->first();

    //     $id_tagihan = $request->id_tagihan;
    //     $sid = $request->id;
    //     $status = $request->status;
    //     $trx = $request->trx_id;
    //     $transaction = Transaksi::with('user')->where('no_invoice', $sid)->first();

    //     if ($status == 'berhasil') {
    //         $transaction->update([
    //             'status' => $status,
    //             'id_user' => $transaction->user->name,
    //             'update_at' => now()
    //         ]);

    //         $pembayaranGet = TagihanDetail::where('id_transactions', $transaction->id)->get();

    //         // Redirect to payment link after successful transaction
    //         return Redirect::to($transaksi->payment_link);
    //     } else {
    //         return redirect()->back()->with('error', 'Transaction not found.');
    //     }

    //     $dashboardRoute = ($transaction->program_belajar == 'S1') ? 'mahasiswa.dashboard' : 'kursus.dashboard';

    //     return redirect()->route($dashboardRoute)->with('success', 'Selamat Datang Anda Telah Melakukan Pembayaran');
    // }

    public function daftar_ulang_demo_success($sid)
    {
        $userId = Auth::user()->id;

        $transaksi = Transaksi::where('user_id', $userId)->where('no_invoice', $sid)->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        $transaksi->update([
            'status' => 'berhasil'
        ]);
        $biodata = Biodata::where('user_id', $userId)->where('program_belajar', 'S1')->first();
        $biayat = Biaya::where('program_belajar', $biodata->program_belajar)->where('jenis_biaya', 'DaftarUlang')->firstOrFail();
        $transaction = Transaksi::where('user_id', $userId)->where('jenis_tagihan', 'DaftarUlang')->where('status', 'berhasil')->get();

        $biaya = Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->where('id_angkatans', Auth::user()->biodata->angkatan_id)->latest()->first();

        $user = Auth::user();
        $tagihan = TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $user->id)->latest()->first();
        $tagihan = TagihanDetail::where('id_biayas', $biaya->id)->where('id_users', $user->id)->latest()->first();
        // $bagi3 = $tagihan->amount / 3;
        // dd($bagi3);
        $transactions = Transaksi::where('user_id', $user->id)->where('tagihan_detail_id', $tagihan->id)->where('jenis_tagihan', $biaya->jenis_biaya)->where('status', 'berhasil')->sum('total');
        if ($transactions == $tagihan->amount) {
            $tagihan->update([
                'status' => 'LUNAS'
            ]);
        }
        // dd($tagihanTails->status == 'LUNAS');
        if ($transaction->count() < 2  && $tagihan->status == 'LUNAS') {
            $biaya = Biaya::all();
            // $transaksi = Transaksi::where('user_id', $user)->where('status', 'berhasil')->where('program_belajar', 'S1')->where('jenis_tagihan', 'Administrasi')->first();
            foreach ($biaya as $key => $biayas) {
                if ($biayas->id_angkatans == $biodata->angkatan_id && $biayas->id_jurusans == $biodata->jurusan_id && $biayas->program_belajar == $biodata->program_belajar) {
                    $tagihan = Tagihan::where('id_biayas', $biayas->id)->get();

                    foreach ($tagihan as $key => $tagihans) {
                        if ($tagihans->biayas->jenis_biaya != 'DaftarUlang') {
                            // dd($tagihans->biayas->jenis_biaya);
                            $tagihanDetail = TagihanDetail::create([
                                'id_biayas' => $biayas->id,
                                'id_tagihans' => $tagihans->id,
                                'id_users' => $biodata->user->id,
                                'end_date' => $tagihans->end_date,
                                'amount' => $tagihans->amount,
                                'status' => 'BELUM',
                            ]);
                        }
                    }
                } else if ($biayas->id_angkatans == $biodata->angkatan_id && $biayas->program_belajar == $biodata->program_belajar) {
                    $tagihan = Tagihan::where('id_biayas', $biayas->id)->get();

                    foreach ($tagihan as $key => $tagihans) {
                        if ($tagihans->biayas->jenis_biaya != 'DaftarUlang') {
                            $tagihanDetail = TagihanDetail::create([
                                'id_biayas' => $biayas->id,
                                'id_tagihans' => $tagihans->id,
                                'id_users' => $biodata->user->id,
                                'end_date' => $tagihans->end_date,
                                'amount' => $tagihans->amount,
                                'status' => 'BELUM',
                            ]);
                        } else {
                        }
                    }
                }
            }
        } else {
        }
        $jenis = 'cash';
        session(['jenis' => $jenis]);
        return redirect()->route('mahasiswa.tagihan.index')->with('success', 'Selamat Datang Anda Telah Melakukan Pembayaran');
    }



    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
