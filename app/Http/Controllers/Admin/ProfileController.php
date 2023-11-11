<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
        $auth = Auth::user();

        return view('admin.profile.profile', compact('auth'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editProfile()
    {
        $auth = Auth::user();

        return view('admin.profile.edit-profile', compact('auth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function prosesProfile(Request $request, string $id)
    {
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email,' . $user->id,
            'gender' => 'required',
            'phone' => 'required',
            'birthdate' => 'required'
        ]);

        $user->update($data);
        return redirect()->route('admin.profile')->with('success','Berhasil Mengedit Profile');
    }

    public function change_password()
    {
        $auth = Auth::user();


        return view('admin.profile.change-password', compact('auth'));
    }

    public function change_password_proses(Request $request, $id)
    {
        $user = User::find($id);
        $messages = [
            'old_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password_confirmation.same:password' => 'Password confirmation tidak sama dengan new password.',
        ];
        $data = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'same:password',
        ], $messages);
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Password Lama Kamu Salah'])->withInput();
        }
        $data['password'] = Hash::make($request->password);
        $user->update($data);
        return redirect()->route('admin.change_password')->with('success', 'Berhasil mengubah password');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
