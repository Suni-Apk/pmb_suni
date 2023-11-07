<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\DocumentController;
use App\Http\Controllers\Mahasiswa\MatkulController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\Mahasiswa\TagihanController;
use App\Http\Controllers\Mahasiswa\TransaksiController;
use App\Http\Controllers\MatkulController as ControllersMatkulController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagihanController as AdminTagihanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MatkulController as AdminMatkulController;
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
    Route::put('/profile-process/{id}', [ProfileController::class, 'prosesProfile'])->name('profile_proses');
    Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change_password');
    Route::put('/change-password-proses/{id}', [ProfileController::class, 'change_password_proses'])->name('change_password_proses');
});

// Dashboard Mahasiswa
Route::prefix('/mahasiswa')->middleware(['auth', 'mahasiswa','s1'])->name('mahasiswa.')->group(function () {

    //bayar administrasi
    Route::get('/administrasi',[TransaksiController::class,'administrasi'])->name('administrasi');

    //biodata
    Route::get('/biodata', [BiodataController::class, 'pendaftaran_s1'])->name('pendaftaran.s1');
    Route::post('/biodata/process', [BiodataController::class, 'pendaftaran_s1_process'])->name('pendaftaran.s1.process');

    //edit biodata
    Route::get('/edit-biodata/{id}', [MahasiswaProfileController::class, 'edit_biodata'])->name('pendaftaran.s1.edit');
    Route::put('/edit-biodata/process/{id}', [MahasiswaProfileController::class, 'edit_biodata_process'])->name('pendaftaran.s1.edit.process');

    //document
    Route::get('/document', [DocumentController::class, 'document'])->name('pendaftaran.document');
    Route::post('/document/process', [DocumentController::class, 'document_process'])->name('pendaftaran.document.process');
    Route::get('/document/private-ktp/{id}', [DocumentController::class, 'download_pdf_ktp'])->name('pendaftaran.document.ktp');
    Route::get('/document/private-kk/{id}', [DocumentController::class, 'download_pdf_kk'])->name('pendaftaran.document.kk');
    Route::get('/document/private-ijazah/{id}', [DocumentController::class, 'download_pdf_ijazah'])->name('pendaftaran.document.ijazah');
    Route::get('/document/private-transkrip/{id}', [DocumentController::class, 'download_pdf_transkrip_nilai'])->name('pendaftaran.document.transkrip_nilai');

    //edit document
    Route::get('/edit-document/{id}', [MahasiswaProfileController::class, 'edit_document'])->name('pendaftaran.document.edit');
    Route::put('/edit-document/process/{id}', [MahasiswaProfileController::class, 'edit_document_process'])->name('pendaftaran.document.edit.process');

    //profile
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

    Route::get('/profile', function () {
        return view('layouts.template.profile');
    })->name('profile');

    Route::get('/rtl', function () {
        return view('layouts.template.rtl');
    })->name('rtl');

    Route::get('/virtual-reality', function () {
        return view('layouts.template.virtual-reality');
    })->name('virtual-reality');

    Route::get('/profile', function () {
        return view('admin.user.profile');
    })->name('profile');

    Route::get('/edit-profile', function () {
        return view('admin.user.edit-profile');
    })->name('edit-profile');

    Route::get('/change-password', function () {
        return view('admin.user.change-password');
    })->name('change-password');
});
