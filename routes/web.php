<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\MatkulController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\Mahasiswa\TagihanController;
use App\Http\Controllers\TahunAjaranController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth Mahasiswa
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register-process', [AuthController::class, 'register_process'])->name('register.process');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login-process', [AuthController::class, 'login_process'])->name('login.process');

Route::get('/verify', [AuthController::class, 'verify'])->name('verify');

Route::post('/verify-process', [AuthController::class,'verify_otp'])->name('verify.process');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Auth Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');

    Route::post('/login-process', [AdminAuthController::class, 'login_process'])->name('login.process');

    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Controller / Dashboard Admin
Route::prefix('/admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile-edit', [ProfileController::class, 'editProfile'])->name('profile_edit');
    Route::resource('/tahun_ajaran', TahunAjaranController::class);
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/matkul', MatkulController::class);
    Route::put('/profile-process/{id}', [ProfileController::class, 'prosesProfile'])->name('profile_proses');
    Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change_password');
    Route::put('/change-password-proses/{id}', [ProfileController::class, 'change_password_proses'])->name('change_password_proses');
});

//Mahasiswa
Route::prefix('/mahasiswa')->middleware(['auth', 'mahasiswa'])->name('mahasiswa.')->group(function () {
    // Dashboard Mahasiswa
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //profile mahasiswa
    Route::get('/profile',[MahasiswaProfileController::class,'profile'])->name('profile.index');
    Route::get('/profile/edit/{name}', [MahasiswaProfileController::class, 'edit_profile'])->name('profile.edit-profile');
    Route::put('/profile/edit/{id}/process',[MahasiswaProfileController::class,'edit_profile_process'])->name('profile.edit-profile.process');
    Route::get('/profile/change_password/{name}',[MahasiswaProfileController::class,'change_password'])->name('profile.change_password');
    Route::put('/profile/change_password_process',[MahasiswaProfileController::class,'change_password_process'])->name('profile.change_password.process');

    //tagihan mahasiswa
    Route::get('/tagihan',[TagihanController::class,'index'])->name('tagihan.index');
    Route::get('/detail-tagihan/{name}',[TagihanController::class,'detail'])->name('tagihan.detail');


    //matkul mahasiswa
    Route::get('/matkul',[MatkulController::class,'index'])->name('matkul');
});

Route::prefix('template')->group(function () {
    Route::get('/table', function () {
        return view('layouts.template.table');
    })->name('table');

    Route::get('/dashboard', function () {
        return view('layouts.template.dashboard');
    })->name('dashboard');

    Route::get('/billing', function () {
        return view('layouts.template.billing');
    })->name('billing');

    Route::get('/form', function () {
        return view('layouts.template.form');
    })->name('form');

    Route::get('/forgot', function () {
        return view('layouts.template.forgot-password');
    })->name('forgot');

    Route::get('/profile', function () {
        return view('layouts.template.profile');
    })->name('profile');

    Route::get('/rtl', function () {
        return view('layouts.template.rtl');
    })->name('rtl');

    Route::get('/pendaftaran_s1', function () {
        return view('layouts.template.pendaftaran_s1');
    })->name('pendaftaran_s1');
    
    Route::get('/pendaftaran_s1_dokumen', function () {
        return view('layouts.template.pendaftaran_s1_dokumen');
    })->name('pendaftaran_s1_dokumen');

    Route::get('/virtual-reality', function () {
        return view('layouts.template.virtual-reality');
    })->name('virtual-reality');

    // Route::get('/profile', function () {
    //     return view('admin.user.profile');
    // })->name('profile');

    Route::get('/edit-profile', function () {
        return view('admin.user.edit-profile');
    })->name('edit-profile');

    Route::get('/change-password', function () {
        return view('admin.user.change-password');
    })->name('change-password');

    Route::get('/wizard', function () {
        return view('layouts.template.wizard');
    })->name('wizard');
});
