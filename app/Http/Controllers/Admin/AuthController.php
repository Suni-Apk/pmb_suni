<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.login');
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

        // if($user->active == 0){
            
        //     return redirect()->route('user.activication')->with('gagal','Kamu Harus Mengisi Kode OTP Yang Dikirim');
        // }
        $authenticated = Auth::attempt($credentials, $request->has('remember'));

        if (!$authenticated){
            return redirect()->back()->with('error', 'email atau password salah.');
        }

        $input = $request->all();

        if(auth()->attempt(array('phone' => $input['phone'], 'password' => $input['password'])))
        {
            if (auth()->user()->role == 'Admin') {
                return redirect()->route('admin.dashboard')->with('success','Yey Berhasil Login');
            }else{
                return redirect()->back()->withErrors([
                    'phone' => 'Kamu bukan Admin Disini'
                ]);
            }
        }else{
            return redirect()->route('login')
                ->withErrors('phone','Nomor And Password Are Wrong.');
        }

        return redirect()->route('user.dashboard');
    }

    public function logout()
    {
        auth()->logout();

        return view('admin.login');
    }
}
