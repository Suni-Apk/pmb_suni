<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Biaya;
use App\Models\Banner;
use App\Models\Notify;
use App\Traits\Fonnte;
use App\Traits\Ipaymu;
use App\Models\Biodata;
use App\Models\Transaksi;
use App\Models\TahunAjaran;
use Illuminate\Support\Str;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use App\Models\TagihanDetail;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    use Ipaymu;
    use Fonnte;
    public function register($program = null)
    {
        $banner = Banner::get();
        return view('auth.register', compact('banner'));
    }

    public function register_process_new(Request $request)
    {
        $user = Auth::user();
        $phone = $request->phone;
        if (Str::startsWith($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        $existingUser = User::where('phone', $phone)->first();
        if ($existingUser) {
            return redirect()->back()->withErrors(['phone' => 'Nomor Sudah Di Pake Maybe']);
        }
        $messages = [
            'name.required' => 'Nama Lengkap Wajib Diisi',
            'name.min:3' => 'Nama Anda Minimal 3 Huruf!!',
            'name.max:255' => 'Nama Anda Kepanjangan',
            'name.unique' => 'Nama Sudah Di Pakai',
            'phone.required' => 'Nomor Whatsapp Wajib Diisi',
            'phone.min' => 'Nomor Whatsapp Minimal 12 Angka!!',
            'phone.max' => 'Nomor Whatsapp Maksimal 13 Angka!!',
            'phone.unique' => 'Nomor Whatsapp Sudah Di Pakai',
            'gender.required' => 'Gender Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Sudah Di Pakai',
            'email.email' => 'Email Harus Format Menggunakan @',
            'password.required' => 'Password Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'password.min:8' => 'Password Wajib 8 Angka / Huruf!!!'
        ];
        $data = $request->validate([
            'name' => 'required|min:3|max:255|string|unique:users,name',
            'phone' => 'required|min:11|max:13|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|string',
            'password' => 'required|confirmed|min:8',
            'program_belajar' => 'required|string'
        ], $messages);
        $data['phone'] = $request->phone;
        $data['role'] = 'Mahasiswa';
        $data['token'] = rand(111111, 999999);
        // dd($data);
        $user = User::create($data);
        $notif = Notify::where('id', 1)->first();
        $messages =  $notif->notif_otp . ' ' . $user->token;
        $program = $request->program_belajar;
        $this->send_message($user->phone, $messages);

        $token = User::where('token', $request->token)->first();

        if ($user) {
            return view('auth.verify', compact('user', 'program'));
        } else {
            return back();
        }
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
            $program = $request->program_belajar;
            return view('auth.verify',compact('user','program'))->with('gagal', 'Kamu Harus Mengisi Kode OTP Yang Dikirim');
        } elseif ($user->status == 'off') {
            return redirect()->route('login')->withErrors(['phone' => 'Nomor Kamu Di NonAktifkan']);
        }

        $authenticated = Auth::attempt($credentials, $request->has('remember'));

        if (!$authenticated) {
            return redirect()->route('login')->with('error', 'Nomor Hp atau password salah.');
        }

        $input = $request->all();
        $users = Auth::user();
        $administrasiS1 = Transaksi::where('user_id',$users->id)->where('jenis_tagihan','Administrasi')->where('program_belajar','S1')->first();
        $administrasiKURSUS = Transaksi::where('user_id',$users->id)->where('jenis_tagihan','Administrasi')->where('program_belajar','KURSUS')->first();

        auth()->attempt(array('phone' => $input['phone'], 'password' => $input['password']));
        
        if (auth()->user()->role == 'Mahasiswa') {
            if($administrasiS1 && !$administrasiKURSUS){
                if($administrasiS1->status == 'berhasil'){
                    return redirect()->route('mahasiswa.dashboard')->with('success',"Halo, Selamat Datang $user->name!");
                }elseif($administrasiS1->status == 'pending'){
                    return redirect($administrasiS1->payment_link);
                }
            }elseif($administrasiKURSUS && !$administrasiS1){
                if($administrasiKURSUS->status == 'berhasil'){
                    return redirect()->route('kursus.dashboard')->with('success',"Halo, Selamat Datang $user->name!");
                }elseif($administrasiKURSUS->status == 'pending'){
                    return redirect($administrasiKURSUS->payment_link);
                }
            }elseif($administrasiS1 && $administrasiKURSUS){
                return redirect()->route('mahasiswa.dashboard')->with('success',"Halo, Selamat Datang $user->name!");
            } else {
                return back()->withErrors(['phone' => 'Silahkan hubungi Admin']);
            }
        }else{
            return redirect()->back()->withErrors([
                'phone' => 'Kamu bukan Mahasiswa Disini'
            ]);
        }
    }

    public function verify()
    {
        return view('auth.verify');
    }

    public function verify_otp(Request $request)
    {
        $users = Auth::user();
        $user = User::where('token', $request->token)->first();
        // dd($request->program);

        if ($user) {
            $user->update([
                'active' => 1,
            ]);
            // Setelah mengupdate status aktif, kita akan mencoba masuk
            $program = $request->program;
            $course = Course::where('keyword', $program)->first();
            auth()->login($user);

            // dd($course);
            $biayaAdministrasiS1 = Administrasi::where('program_belajar', 'S1')->value('amount');
            $biodataS1 = Biodata::where('user_id', $user->id)->where('program_belajar', 'S1')->first();
            $transaksiS1 = Transaksi::where('user_id', $user->id)->where('program_belajar', 'S1')->where('jenis_tagihan', 'Administrasi')->first();
            
            $biodataKursus = Biodata::where('user_id', $user->id)->where('program_belajar', 'KURSUS')->first();
            $biayaAdministrasiKursus = Administrasi::where('program_belajar', 'KURSUS')->value('amount');
            $transaksiKursus = Transaksi::where('user_id', $user->id)->where('program_belajar', 'KURSUS')->where('jenis_tagihan', 'Administrasi')->first();
            $adminstrasiKursus = Administrasi::where('program_belajar', 'KURSUS')->where('course_id', $course->id)->first();
            $adminstrasiS1 = Administrasi::where('program_belajar', 'S1')->first();
            if ($request->program == 'S1') {
                if (!$transaksiS1) {
                    $id = $user->id;
                    $payment = json_decode(json_encode($this->redirect_payment($id,$program,$adminstrasiS1,$adminstrasiKursus)), true);
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
                    return view('mahasiswa.transaksi.administrasi', compact('transaksi'));
                } elseif ($transaksiS1->status == 'pending') {
                    $adminstrasiS1Pending = Transaksi::where('program_belajar', 'S1')->where('user_id', $user->id)->where('status', 'pending')->first();
                    return Redirect::to($adminstrasiS1Pending->payment_link);
                } elseif ($transaksiS1->status == 'berhasil') {
                    if (!$biodataS1 && !$users->document) {
                        return redirect()->route('mahasiswa.dashboard')->with('success', 'Silahkan Lengkapi Biodata Dan Document Anda');
                    } elseif ($biodataS1 && !$users->document) {
                        return redirect()->route('mahasiswa.dashboard')->with('success', 'Silahkan Lengakpi Document Anda');
                    } else {
                        return redirect()->route('mahasiswa.dashboard')->with("success','Selamat Datang Di Dashboard S1 . $user->name");
                    }
                }
            } else {
                if (!$transaksiKursus) {
                    $id = $user->id;
                    $payment = json_decode(json_encode($this->redirect_payment($id,$program,$adminstrasiS1,$adminstrasiKursus)), true);
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
                    return Redirect::to($transaksi->payment_link);
                } elseif ($transaksiKursus->status == 'pending') {
                    $adminstrasiKursusPending = Transaksi::where('program_belajar', 'KURSUS')->where('user_id', $user->id)->where('status', 'pending')->latest()->first();
                    return Redirect::to($adminstrasiKursusPending->payment_link);
                } elseif ($transaksiKursus->status == 'berhasil') {
                    if (!$biodataKursus) {
                        return redirect()->route('kursus.dashboard')->with('success', 'Silahkan Melengkapi Biodata Anda');
                    } else {
                        return redirect()->route('kursus.dashboard')->with("success','Selamat Datang Di Dashboard Kursus . $user->name");
                    }
                }
            }
        }

        return redirect()->back()->with('error', 'Token Tidak Sesuai');
    }

    public function administrasiS1(Request $request, $id)
    {
        $user = Auth::user();
        auth()->login($user);
        $biodataS1 = Biodata::where('user_id', $user->id)->where('program_belajar', 'S1')->first();
        $transaksiS1 = Transaksi::where('user_id', $user->id)->where('program_belajar', 'S1')->where('jenis_tagihan', 'Administrasi')->first();
        $id = $user->id;
        $program = "S1";
        $adminstrasiS1 = Administrasi::where('program_belajar', 'S1')->first();
        $adminstrasiKursus = Administrasi::where('program_belajar', 'KURSUS')->first();
        if (!$transaksiS1) {
            $payment = json_decode(json_encode($this->redirect_payment($id,$program,$adminstrasiS1,$adminstrasiKursus)), true);
            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'no_invoice' => $payment['Data']['SessionID'],
                'jenis_tagihan' => 'Administrasi',
                'jenis_pembayaran' => 'Ipaymu',
                'program_belajar' => 'S1',
                'status' => 'pending',
                'total' => $adminstrasiS1->amount,
                'payment_link' => $payment['Data']['Url'],
            ]);
            return view('mahasiswa.transaksi.administrasi', compact('transaksi'));
        } elseif ($transaksiS1->status == 'pending') {
            $adminstrasiS1Pending = Transaksi::where('program_belajar', 'S1')->where('user_id', $user->id)->where('status', 'pending')->first();
            return Redirect::to($adminstrasiS1Pending->payment_link);
        } elseif ($transaksiS1->status == 'berhasil') {
            if (!$biodataS1 && !$user->document) {
                return redirect()->route('mahasiswa.dashboard')->with('eror', 'Silahkan Lengkapi Biodata Dan Document Anda');
            } elseif ($biodataS1 && !$user->document) {
                return redirect()->route('mahasiswa.dashboard')->with('eror', 'Silahkan Lengakpi Document Anda');
            } else {
                return redirect()->route('mahasiswa.dashboard')->with("success','Selamat Datang Di Dashboard S1 . $user->name");
            }
        }
    }

    public function administrasiKursus(Request $request, $id)
    {
        $user = Auth::user();
        auth()->login($user);
        $biodataKursus = Biodata::where('user_id', $user->id)->where('program_belajar', 'KURSUS')->first();
        $transaksiKursus = Transaksi::where('user_id', $user->id)->where('program_belajar', 'KURSUS')->where('jenis_tagihan', 'Administrasi')->first();
        $id = $user->id;
        $program = "KURSUS";
        $adminstrasiS1 = Administrasi::where('program_belajar', 'S1')->first();
        $adminstrasiKursus = Administrasi::where('program_belajar', 'Kursus')->first();
        if (!$transaksiKursus) {
            $adminstrasiKursus = Administrasi::where('program_belajar', 'Kursus')->first();

            $payment = json_decode(json_encode($this->redirect_payment($id,$program,$adminstrasiS1,$adminstrasiKursus)), true);
            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'no_invoice' => $payment['Data']['SessionID'],
                'jenis_tagihan' => 'Administrasi',
                'jenis_pembayaran' => 'Ipaymu',
                'program_belajar' => 'KURSUS',
                'status' => 'pending',
                'total' => $adminstrasiKursus->amount,
                'payment_link' => $payment['Data']['Url'],
            ]);
            return view('kursus.transaksi.administrasi', compact('transaksi'));
            // return Redirect::to($transaksi->payment_link);
        } elseif ($transaksiKursus->status == 'pending') {
            $adminstrasiKursusPending = Transaksi::where('program_belajar', 'KURSUS')->where('user_id', $user->id)->where('status', 'pending')->latest()->first();
            return Redirect::to($adminstrasiKursusPending->payment_link);
        } elseif ($transaksiKursus->status == 'berhasil') {
            if (!$biodataKursus) {
                return redirect()->route('kursus.dashboard')->with('success', 'Silahkan Melengkapi Biodata Anda');
            } else {
                return redirect()->route('kursus.dashboard')->with("success','Selamat Datang Di Dashboard Kursus . $user->name");
            }
        }
    }

    // public function switch_program()
    // {
    //     $user = Auth::user();
    //     return view('mahasiswa.program.index', compact('user'));
    // }

    // public function switch(Request $request, $id)
    // {
    //     $user = Auth::user();
    //     $biodataS1 = Biodata::where('user_id', $user->id)->where('program_belajar', 'S1')->first();
    //     $biodataKursus = Biodata::where('user_id', $user->id)->where('program_belajar', 'KURSUS')->first();
    //     $transaksiS1 = Transaksi::where('user_id', $user->id)->where('program_belajar', 'S1')->where('jenis_tagihan', 'Administrasi')->first();
    //     $transaksiKursus = Transaksi::where('user_id', $user->id)->where('program_belajar', 'KURSUS')->where('jenis_tagihan', 'Administrasi')->first();
    //     if ($request->program == 'S1') {
    //         if (!$transaksiS1) {
    //             $adminstrasiS1 = Administrasi::where('program_belajar', 'S1')->first();
    //             // return redirect()->route('mahasiswa.administrasi');

    //             $payment = json_decode(json_encode($this->redirect_payment($id)), true);
    //             $transaksi = Transaksi::create([
    //                 'user_id' => $user->id,
    //                 'no_invoice' => $payment['Data']['SessionID'],
    //                 'jenis_tagihan' => 'Administrasi',
    //                 'jenis_pembayaran' => 'Ipaymu',
    //                 'program_belajar' => 'S1',
    //                 'status' => 'pending',
    //                 'total' => '10000',
    //                 'payment_link' => $payment['Data']['Url'],
    //             ]);
    //             return view('mahasiswa.transaksi.administrasi', compact('transaksi'));
    //             // return Redirect::to($transaksi->payment_link);
    //         } elseif ($transaksiS1->status == 'pending') {
    //             $adminstrasiS1Pending = Transaksi::where('program_belajar', 'S1')->where('user_id', $user->id)->where('status', 'pending')->first();
    //             return Redirect::to($adminstrasiS1Pending->payment_link);
    //         } elseif ($transaksiS1->status == 'berhasil') {
    //             if (!$biodataS1 && !$user->document) {
    //                 return redirect()->route('mahasiswa.dashboard')->with('success', 'Silahkan Lengkapi Biodata Dan Document Anda');
    //             } elseif ($biodataS1 && !$user->document) {
    //                 return redirect()->route('mahasiswa.dashboard')->with('success', 'Silahkan Lengakpi Document Anda');
    //             } else {
    //                 return redirect()->route('mahasiswa.dashboard')->with("success','Selamat Datang Di Dashboard S1 . $user->name");
    //             }
    //         }
    //     } else {
    //         if (!$transaksiKursus) {
    //             $adminstrasiKursus = Administrasi::where('program_belajar', 'KURSUS')->first();

    //             $payment = json_decode(json_encode($this->redirect_payment($id)), true);
    //             $transaksi = Transaksi::create([
    //                 'user_id' => $user->id,
    //                 'no_invoice' => $payment['Data']['SessionID'],
    //                 'jenis_tagihan' => 'Administrasi',
    //                 'jenis_pembayaran' => 'Ipaymu',
    //                 'program_belajar' => 'KURSUS',
    //                 'status' => 'pending',
    //                 'total' => '10000',
    //                 'payment_link' => $payment['Data']['Url'],
    //             ]);
    //             return view('kursus.transaksi.administrasi', compact('transaksi'));
    //             return Redirect::to($transaksi->payment_link);
    //         } elseif ($transaksiKursus->status == 'pending') {
    //             $adminstrasiKursusPending = Transaksi::where('program_belajar', 'KURSUS')->where('user_id', $user->id)->where('status', 'pending')->latest()->first();
    //             return Redirect::to($adminstrasiKursusPending->payment_link);
    //         } elseif ($transaksiKursus->status == 'berhasil') {
    //             if (!$biodataKursus) {
    //                 return redirect()->route('kursus.dashboard')->with('success', 'Silahkan Melengkapi Biodata Anda');
    //             } else {
    //                 return redirect()->route('kursus.dashboard')->with("success','Selamat Datang Di Dashboard S1 . $user->name");
    //             }
    //         }
    //     }
    // }

    // public function demo_success($sid)
    // {
    //     $userId = Auth::user()->id;

    //     $transaksi = Transaksi::where('user_id', $userId)->where('no_invoice', $sid)->first();

    //     if (!$transaksi) {
    //         return redirect()->back()->with('error', 'Transaction not found.');
    //     }

    //     $transaksi->update([
    //         'status' => 'berhasil'
    //     ]);


    //     $dashboardRoute = ($transaksi->program_belajar == 'S1') ? 'mahasiswa.dashboard' : 'kursus.dashboard';

    //     return redirect()->route($dashboardRoute)->with('success', 'Selamat Datang Anda Telah Melakukan Pembayaran');
    // }

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

        return redirect()->route('mahasiswa.tagihan.index')->with('success', 'Selamat Datang Anda Telah Melakukan Pembayaran');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}