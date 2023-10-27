<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
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
            'phone.min:12' => 'Nomor Whatshapp Minimal 12 Angka!!',
            'phone.max:13' => 'Nomor Whatshapp Maksimal 13 Angka!!',
            'gender.required' => 'Gender Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'password.min:8' => 'Password Wajib 8 Angka / Huruf!!!'
        ];
        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'phone' => 'required|min:12|max:13|unique:users,phone',
            'gender' => 'required|string',
            'password' => 'required|confirmed|min:8',
        ],$messages);
        $data['phone'] = $request->phone;
        $data['role'] = 'Mahasiswa';
        $data['token'] = rand(111111,999999);
        // dd($data);
        $user = User::create($data);

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
        ],$messages);
        $infologin = [
            'phone' => $phone,
            'password' => $request->password
        ];

        $credentials = $request->only('phone', 'password');
        $user = User::where('phone',$credentials)->first();

        if($user->active == 0){
            
            return redirect()->route('verify')->with('gagal','Kamu Harus Mengisi Kode OTP Yang Dikirim');
        }
        $authenticated = Auth::attempt($credentials, $request->has('remember'));

        if (!$authenticated){
            return redirect()->route('login')->with('error', 'email atau password salah.');
        }

        $input = $request->all();

        auth()->attempt(array('phone' => $input['phone'], 'password' => $input['password']));
            if (auth()->user()->role == 'Mahasiswa') {
                return redirect()->route('mahasiswa.dashboard')->with('success','Yey Berhasil Login');
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
                'active' => 1
            ]);

            // Setelah mengupdate status aktif, kita akan mencoba masuk
            auth()->login($user);
           
                // $messages = $notif->notifys->notif_login;

                // $this->send_message($user->nomor,$messages);
            
            return redirect()->route('mahasiswa.dashboard');
        }

        return redirect()->back()->with('error', 'Token Tidak Sesuai');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
