<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\MatkulController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\Mahasiswa\TagihanController;
use App\Http\Controllers\MatkulController as ControllersMatkulController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagihanController as AdminTagihanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\TransactionController;
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

Route::post('/verify-process', [AuthController::class, 'verify_otp'])->name('verify.process');

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
    Route::resource('/tagihan', AdminTagihanController::class);
    Route::post('/next', [AdminTagihanController::class, 'next'])->name('tagihan.next');
    Route::get('settings/notifications', [SettingController::class, 'index'])->name('settings.notifications');
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/tahun_ajaran', TahunAjaranController::class);
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/matkul', ControllersMatkulController::class);
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [ProfileController::class, 'editProfile'])->name('profile_edit');
    Route::put('/profile-process/{id}', [ProfileController::class, 'prosesProfile'])->name('profile_proses');
    Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change_password');
    Route::put('/change-password-proses/{id}', [ProfileController::class, 'change_password_proses'])->name('change_password_proses');

    //account menu
    Route::get('/account/admin', [AccountController::class, 'admin'])->name('admin.account');
    Route::get('/create/account/admin', [AccountController::class, 'admin_create'])->name('admin.create');
    Route::post('/create/account/admin/process', [AccountController::class, 'admin_create_process'])->name('admin.create.process');
    Route::get('/edit/account/admin/{id}', [AccountController::class, 'admin_edit'])->name('admin.edit');
    Route::put('/edit/account/admin/process/{id}', [AccountController::class, 'admin_edit_process'])->name('admin.edit.process');
    Route::put('/change_status/admin/{id}', [AccountController::class, 'admin_status'])->name('admin.status');

    Route::get('/account/mahasiswa', [AccountController::class, 'mahasiswa'])->name('mahasiswa.account');
    Route::get('/create/account/mahasiswa', [AccountController::class, 'mahasiswa_create'])->name('mahasiswa.create');
    Route::post('/create/account/mahasiswa/process', [AccountController::class, 'mahasiswa_create_process'])->name('mahasiswa.create.process');
    Route::get('/edit/account/mahasiswa/{id}', [AccountController::class, 'mahasiswa_edit'])->name('mahasiswa.edit');
    Route::put('/edit/account/mahasiswa/process/{id}', [AccountController::class, 'mahasiswa_edit_process'])->name('mahasiswa.edit.process');
    Route::put('/change_status/mahasiswa/{id}', [AccountController::class, 'mahasiswa_status'])->name('mahasiswa.status');
    Route::get('/detail/account/mahasiswa/{id}', [AccountController::class, 'mahasiswa_detail'])->name('mahasiswa.show');
    Route::post('/bayar/account/mahasiswa', [AccountController::class, 'mahasiswa_bayar'])->name('mahasiswa.bayar');

    //setting admin
    Route::get('/administrasi', [AdministrasiController::class, 'administrasi'])->name('administrasi');
});

// Dashboard Mahasiswa
Route::prefix('/mahasiswa')->middleware(['auth', 'mahasiswa'])->name('mahasiswa.')->group(function () {
    Route::get('/program-belajar', [DashboardController::class, 'program_belajar'])->name('program_belajar');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [MahasiswaProfileController::class, 'profile'])->name('profile.index');
    Route::get('/profile/edit/{name}', [MahasiswaProfileController::class, 'edit_profile'])->name('profile.edit-profile');
    Route::put('/profile/edit/{id}/process', [MahasiswaProfileController::class, 'edit_profile_process'])->name('profile.edit-profile.process');
    Route::get('/profile/change_password/{name}', [MahasiswaProfileController::class, 'change_password'])->name('profile.change_password');
    Route::put('/profile/change_password_process', [MahasiswaProfileController::class, 'change_password_process'])->name('profile.change_password.process');
    //matkul mahasiswa
    Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul');
    //tagihan mahasiswa
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
    Route::get('/detail-tagihan-spp/{name}', [TagihanController::class, 'detail_spp'])->name('tagihan.detail.spp');
    Route::get('/payment-spp/{name}', [TagihanController::class, 'payment_spp'])->name('tagihan.payment.spp');
    Route::get('/detail-tagihan/{name}', [TagihanController::class, 'detail_tidak_routine'])->name('tagihan.detail.tidak.routine');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
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

    Route::get('/form', function () {
        return view('layouts.template.form');
    })->name('form');

    Route::get('/forgot', function () {
        return view('layouts.template.forgot-password');
    })->name('forgot');

    Route::get('/form', function () {
        return view('layouts.template.form');
    })->name('form');

    Route::get('/forgot', function () {
        return view('layouts.template.forgot-password');
    })->name('forgot');

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


    Route::get('/profile', function () {
        return view('admin.user.profile');
    })->name('profile');


    // Route::get('/edit-profile', function () {
    //     return view('admin.profile.edit-profile');
    // })->name('edit-profile');


    // Route::get('/change-password', function () {
    //     return view('admin.profile.change-password');
    // })->name('change-password');
    Route::get('/change-password', function () {
        return view('admin.profile.change-password');
    })->name('change-password');

    Route::get('/wizard', function () {
        return view('layouts.template.wizard');
    })->name('wizard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
