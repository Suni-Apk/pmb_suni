<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DocumentController as AdminDocumentController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\Kursus\BiodataController as KursusBiodataController;
use App\Http\Controllers\Kursus\DashboardController as KursusDashboardController;
use App\Http\Controllers\Kursus\MataPelajaranController;
use App\Http\Controllers\Kursus\ProfileController as KursusProfileController;
use App\Http\Controllers\Kursus\TagihanController as KursusTagihanController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\Mahasiswa\BiodataController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\DocumentController;
use App\Http\Controllers\Mahasiswa\MatkulController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\Mahasiswa\TagihanController;
use App\Http\Controllers\MatkulController as ControllersMatkulController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagihanController as AdminTagihanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\TransactionController;
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
    Route::get('/', function () {
        return view('admin.notfound');
    })->name('notfound');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/tagihan', AdminTagihanController::class);
    Route::get('/next', [AdminTagihanController::class, 'next'])->name('tagihan.next');
    // Route::post('/process', [AdminTagihanController::class, 'process'])->name('tagihan.process');
    Route::get('settings/notifications', [SettingController::class, 'index'])->name('settings.notifications');
    Route::put('/setting/notifications/process/{id}', [SettingController::class, 'notify_edit'])->name('settings.notification.process');

    Route::resource('/transaction', TransactionController::class);
    Route::resource('/tahun_ajaran', TahunAjaranController::class);
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/matkul', ControllersMatkulController::class);

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [ProfileController::class, 'editProfile'])->name('profile_edit');
    Route::resource('/tahun_ajaran', TahunAjaranController::class);
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/matkul', AdminMatkulController::class);
    Route::put('/profile-process/{id}', [ProfileController::class, 'prosesProfile'])->name('profile_proses');
    Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change_password');
    Route::put('/change-password-proses/{id}', [ProfileController::class, 'change_password_proses'])->name('change_password_proses');

    //account menu
    //admin
    Route::get('/account/admin', [AccountController::class, 'admin'])->name('admin.account');
    Route::get('/create/account/admin', [AccountController::class, 'admin_create'])->name('admin.create');
    Route::post('/create/account/admin/process', [AccountController::class, 'admin_create_process'])->name('admin.create.process');
    Route::get('/edit/account/admin/{id}', [AccountController::class, 'admin_edit'])->name('admin.edit');
    Route::put('/edit/account/admin/process/{id}', [AccountController::class, 'admin_edit_process'])->name('admin.edit.process');
    Route::put('/change_status/admin/{id}', [AccountController::class, 'admin_status'])->name('admin.status');
    //mahasiswa
    Route::get('/account/mahasiswa', [AccountController::class, 'mahasiswa'])->name('mahasiswa.account');
    Route::get('/create/account/mahasiswa', [AccountController::class, 'mahasiswa_create'])->name('mahasiswa.create');
    Route::post('/create/account/mahasiswa/process', [AccountController::class, 'mahasiswa_create_process'])->name('mahasiswa.create.process');
    Route::get('/edit/account/mahasiswa/{id}', [AccountController::class, 'mahasiswa_edit'])->name('mahasiswa.edit');
    Route::put('/edit/account/mahasiswa/process/{id}', [AccountController::class, 'mahasiswa_edit_process'])->name('mahasiswa.edit.process');
    Route::put('/change_status/mahasiswa/{id}', [AccountController::class, 'mahasiswa_status'])->name('mahasiswa.status');
    Route::get('/detail/account/mahasiswa/{id}', [AccountController::class, 'mahasiswa_detail'])->name('mahasiswa.show');
    Route::post('/bayar/account/mahasiswa', [AccountController::class, 'mahasiswa_bayar'])->name('mahasiswa.bayar');
    Route::get('/account/mahasiswa/program/{id}', [AccountController::class, 'mahasiswa_program'])->name('mahasiswa.program');
    //setting admin
    Route::get('/administrasi', [AdministrasiController::class, 'administrasi'])->name('administrasi.administrasi');
    Route::put('/administrasi/{id}', [AdministrasiController::class, 'AdministrasiProses'])->name('administrasi.proses');
});

Route::prefix('/kursus')->middleware(['auth'])->name('kursus.')->group(function () {
    Route::get('/dashboard', [KursusDashboardController::class, 'kursus'])->middleware(['kursus'])->name('dashboard');

    //biodata
    Route::get('/biodata', [KursusBiodataController::class, 'pendaftaran_kursus'])->name('pendaftaran.kursus');
    Route::post('/biodata/process', [KursusBiodataController::class, 'pendaftaran_kursus_process'])->name('pendaftaran.kursus.process');

    //edit biodata
    Route::get('/edit-biodata/{id}', [KursusProfileController::class, 'edit_biodata'])->name('pendaftaran.s1.edit');
    Route::put('/edit-biodata/process/{id}', [KursusProfileController::class, 'edit_biodata_process'])->name('pendaftaran.s1.edit.process');

    //mata pelajaran
    Route::get('/mata-pelajaran', [MataPelajaranController::class, 'index'])->name('matkul');

    //tagihan kursus
    Route::get('/tagihan', [KursusTagihanController::class, 'index'])->name('tagihan.index');
    Route::get('/detail-tagihan-spp/{name}', [KursusTagihanController::class, 'detail_spp'])->name('tagihan.detail.spp');
    Route::get('/payment-spp/{name}', [KursusTagihanController::class, 'payment_spp'])->name('tagihan.payment.spp');
    Route::get('/detail-tagihan/{name}', [KursusTagihanController::class, 'detail_tidak_routine'])->name('tagihan.detail.tidak.routine');

    //kursus profile
    Route::get('/profile', [KursusProfileController::class, 'profile'])->name('profile.index');
    Route::get('/profile/edit/{name}', [KursusProfileController::class, 'edit_profile'])->name('profile.edit-profile');
    Route::put('/profile/edit/{id}/process', [KursusProfileController::class, 'edit_profile_process'])->name('profile.edit-profile.process');
    Route::get('/profile/change_password/{name}', [KursusProfileController::class, 'change_password'])->name('profile.change_password');
    Route::put('/profile/change_password_process', [KursusProfileController::class, 'change_password_process'])->name('profile.change_password.process');
});

// Dashboard Mahasiswa
Route::prefix('/mahasiswa')->middleware(['auth', 'mahasiswa'])->name('mahasiswa.')->group(function () {

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

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['s1'])->name('dashboard');
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

    Route::get('/profile', function () {
        return view('admin.user.profile');
    })->name('profile');

    Route::get('/edit-profile', function () {
        return view('admin.user.edit-profile');
    })->name('edit-profile');

    Route::get('/edit-profile', function () {
        return view('admin.profile.edit-profile');
    })->name('edit-profile');


    Route::get('/edit-profile', function () {
        return view('admin.profile.edit-profile');
    })->name('edit-profile');


    Route::get('/change-password', function () {
        return view('admin.profile.change-password');
    })->name('change-password');
    Route::get('/change-password', function () {
        return view('admin.profile.change-password');
    })->name('change-password');
    Route::get('/change-password', function () {
        return view('admin.user.change-password');
    })->name('change-password');
});
