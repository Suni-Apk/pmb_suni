<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DocumentController;
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

// Auth Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/login-process', [AdminAuthController::class, 'login_process'])->name('login.process');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Controller / Dashboard Admin
Route::prefix('/admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'editProfile'])->name('profile_edit');
        Route::put('/edit/process/{id}', [ProfileController::class, 'prosesProfile'])->name('profile_proses');
        Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change_password');
        Route::put('/change-password/process/{id}', [ProfileController::class, 'change_password_proses'])->name('change_password_proses');
    });

    // data admin
    Route::prefix('users/account')->name('admin.')->group(function () {
        Route::get('/',[AccountController::class,'admin'])->name('index');
        Route::get('/create',[AccountController::class,'admin_create'])->name('create');
        Route::post('/create/process',[AccountController::class,'admin_create_process'])->name('create.process');
        Route::get('/edit/{id}',[AccountController::class,'admin_edit'])->name('edit');
        Route::put('/edit/process/{id}',[AccountController::class,'admin_edit_process'])->name('edit.process');
        Route::put('/change-status/{id}',[AccountController::class,'admin_status'])->name('status');
    });

    // data mahasiswa
    Route::prefix('mahasiswa/account')->name('mahasiswa.')->group(function () {
        Route::get('/',[AccountController::class,'mahasiswa'])->name('index');
        Route::get('/create',[AccountController::class,'mahasiswa_create'])->name('create');
        Route::post('/create/process',[AccountController::class,'mahasiswa_create_process'])->name('create.process');
        Route::get('/edit/{id}',[AccountController::class,'mahasiswa_edit'])->name('edit');
        Route::put('/edit/process/{id}',[AccountController::class,'mahasiswa_edit_process'])->name('edit.process');
        Route::put('/change-status/{id}',[AccountController::class,'mahasiswa_status'])->name('status');
        Route::get('/detail/{id}', [AccountController::class, 'mahasiswa_detail'])->name('show');
        Route::post('/bayar', [AccountController::class, 'mahasiswa_bayar'])->name('bayar');
    });

    // resources management
    Route::resource('/matkul', ControllersMatkulController::class);
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/tahun-ajaran', TahunAjaranController::class);
    Route::resource('/tagihan', AdminTagihanController::class);
    Route::resource('/dokumen', DocumentController::class);
    Route::post('/next', [AdminTagihanController::class, 'next'])->name('tagihan.next');
    
    //data settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('general');
        Route::get('/notifikasi', [SettingController::class, 'notify_index'])->name('notifications');
        Route::put('/notifikasi/process/{id}',[SettingController::class,'notify_edit'])->name('notifications.process');
    });
});

//Mahasiswa
Route::prefix('/mahasiswa')->middleware(['auth', 'mahasiswa'])->name('mahasiswa.')->group(function () {
    // main
    Route::get('/program-belajar', [DashboardController::class, 'program_belajar'])->name('program_belajar');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [MahasiswaProfileController::class, 'profile'])->name('index');
        Route::get('/edit/{name}', [MahasiswaProfileController::class, 'edit_profile'])->name('edit-profile');
        Route::put('/edit/{id}/process', [MahasiswaProfileController::class, 'edit_profile_process'])->name('edit-profile.process');
        Route::get('/change-password/{name}', [MahasiswaProfileController::class, 'change_password'])->name('change_password');
        Route::put('/change-password/process', [MahasiswaProfileController::class, 'change_password_process'])->name('change_password.process');
    });

    //matkul mahasiswa
    Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul');

    //tagihan mahasiswa
    Route::prefix('tagihan')->name('tagihan.')->group(function () {
        Route::get('/',[TagihanController::class,'index'])->name('index');
        Route::get('/detail/{name}',[TagihanController::class,'detail_tidak_routine'])->name('detail.tidak.routine');
        Route::get('/detail-spp/{name}',[TagihanController::class,'detail_spp'])->name('detail.spp');
        Route::get('/payment-spp/{name}', [TagihanController::class, 'payment_spp'])->name('payment.spp');
    });
    
    // logout
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

    Route::get('/rtl', function () {
        return view('layouts.template.rtl');
    })->name('rtl');

    Route::get('/pendaftaran-s1', function () {
        return view('layouts.template.pendaftaran_s1');
    })->name('pendaftaran_s1');
    
    Route::get('/pendaftaran-s1-dokumen', function () {
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