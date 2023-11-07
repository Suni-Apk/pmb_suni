<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\Biodata;
use App\Models\Notify;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\Fonnte;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    use Fonnte;
    public function register()
    {
        return view('auth.register');
    }

    public function register_process(Request $request)
    {
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
            'phone.required' => 'Nomor Whatshapp Wajib Diisi',
            'phone.min' => 'Nomor Whatshapp Minimal 12 Angka!!',
            'phone.max' => 'Nomor Whatshapp Maksimal 13 Angka!!',
            'gender.required' => 'Gender Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'password.min:8' => 'Password Wajib 8 Angka / Huruf!!!'
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
        // dd($data);
        $user = User::create($data);
        $notif = Notify::where('id',1)->first();
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

        if($user->active == 0){
            
            return redirect()->route('verify')->with('gagal','Kamu Harus Mengisi Kode OTP Yang Dikirim');
        }elseif($user->status == 'off'){
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
            }else{
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
        return view('mahasiswa.program.index',compact('user'));
    }

    public function switch(Request $request)
    {
        $user = Auth::user();
        $biodataS1 = Biodata::where('user_id',$user->id)->where('program_belajar','S1')->first();
        $biodataKursus = Biodata::where('user_id',$user->id)->where('program_belajar','KURSUS')->first();
        $transaksiS1 = Transaksi::where('user_id',$user->id)->where('program_belajar','S1')->where('jenis_tagihan','Administrasi')->first();
        $transaksiKursus = Transaksi::where('user_id',$user->id)->where('program_belajar','KURSUS')->where('jenis_tagihan','Administrasi')->first();
        if($request->program == 'S1'){
            if(!$transaksiS1){
            $adminstrasiS1 = Administrasi::where('program_belajar','S1')->first();
            return redirect()->route('mahasiswa.administrasi',compact('adminstrasiS1'));
            }elseif($transaksiS1){
                // $adminstrasiS1Pending = Transaksi::where('program_belajar','S1')->where('user_id',$user->id)->where('status','pending')->latest()->first();
                // return Redirect::to($adminstrasiS1Pending->link);
            }else{
                if(!$biodataS1 && !$user->document){
                    return redirect()->route('mahasiswa.dashboard')->with('success','Silahkan Lengkapi Biodata Dan Document Anda');
                }elseif($biodataS1 && !$user->document){
                    return redirect()->route('mahasiswa.dashboard')->with('success','Silahkan Lengakpi Document Anda');
                }else{
                    return redirect()->route('mahasiswa.dashboard')->with("success','Selamat Datang Di Dashboard S1 . $user->name");
                }
            }
        }else{
            if(!$transaksiKursus){
                $adminstrasiKursus = Administrasi::where('program_belajar','KURSUS')->first();
                return redirect()->route('kursus.transaksi.administrasi',compact('adminstrasiKursus'));
            }elseif($transaksiKursus){
                $adminstrasiKursusPending = Transaksi::where('program_belajar','KURSUS')->where('user_id',$user->id)->where('status','pending')->latest()->first();
                return Redirect::to($adminstrasiKursusPending->link);
            }else{
                if(!$biodataKursus){
                    return redirect()->route('kursus.dashboard')->with('success','Silahkan Melengkapi Biodata Anda');
                }else{
                    return redirect()->route('kursus.dashboard')->with("success','Selamat Datang Di Dashboard S1 . $user->name");
                }
            }
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
