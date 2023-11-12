<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CourseController;
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
use App\Http\Controllers\Mahasiswa\BiodataController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\DocumentController;
use App\Http\Controllers\Mahasiswa\MatkulController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\Mahasiswa\TagihanController;
use App\Http\Controllers\MatkulController as ControllersMatkulController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\TagihanController as AdminTagihanController;
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

Route::prefix('/switch')->middleware(['auth'])->name('program.')->group(function () {
    Route::get('/program-belajar', [AuthController::class, 'switch_program'])->name('program_belajar');
    Route::get('/program-belajar/switch', [AuthController::class, 'switch'])->name('program_belajar.switch');
});

// Auth Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/login-process', [AdminAuthController::class, 'login_process'])->name('login.process');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Controller / Dashboard Admin
Route::prefix('/admin')->middleware(['admin','auth'])->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.notfound');
    })->name('notfound');
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
        Route::delete('/delete/{id}',[AccountController::class,'admin_delete'])->name('delete');
    });

    // data mahasiswa
    Route::prefix('mahasiswa/account')->name('mahasiswa.')->group(function () {
        Route::get('/',[AccountController::class,'mahasiswa'])->name('index');
        Route::get('/create',[AccountController::class,'mahasiswa_create'])->name('create');
        Route::post('/create/process',[AccountController::class,'mahasiswa_create_process'])->name('create.process');
        Route::get('/edit/{id}',[AccountController::class,'mahasiswa_edit'])->name('edit');
        Route::put('/edit/process/{id}',[AccountController::class,'mahasiswa_edit_process'])->name('edit.process');
        Route::put('/change-status/{id}',[AccountController::class,'mahasiswa_status'])->name('status');
        Route::delete('/delete/{id}',[AccountController::class,'mahasiswa_delete'])->name('delete');
        Route::get('/detail/{id}', [AccountController::class, 'mahasiswa_detail'])->name('show');
        Route::post('/bayar', [AccountController::class, 'mahasiswa_bayar'])->name('bayar');
        Route::get('/program/{id}', [AccountController::class, 'mahasiswa_program'])->name('program');
    });

    // resources management
    Route::resource('/matkul', ControllersMatkulController::class);
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/transaksi', TransactionController::class);
    Route::resource('/tahun-ajaran', TahunAjaranController::class);
    Route::resource('/tagihan', AdminTagihanController::class);
    Route::resource('/dokumen', AdminDocumentController::class);
    Route::resource('/course',CourseController::class);
    Route::get('/next', [AdminTagihanController::class, 'next'])->name('tagihan.next');

    
    //data settings
    Route::prefix('settings')->group(function () {
        Route::get('/administrasi', [AdministrasiController::class, 'administrasi'])->name('administrasi');
        Route::put('/administrasi/{id}', [AdministrasiController::class, 'AdministrasiProses'])->name('administrasi.proses');

        Route::prefix('')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('general');
            Route::put('/edit/{id}', [SettingController::class, 'general_edit'])->name('general.edit');
            Route::put('/desc/edit/{id}', [SettingController::class, 'desc_edit'])->name('desc.edit');
            
            Route::get('/notifikasi', [SettingController::class, 'notify_index'])->name('notifications');
            Route::put('/notifikasi/process/{id}',[SettingController::class,'notify_edit'])->name('notifications.process');
        });
    });
});

Route::prefix('/kursus')->middleware(['auth','kursus'])->name('kursus.')->group(function () {
    Route::get('/dashboard', [KursusDashboardController::class, 'kursus'])->name('dashboard');

    //callback demo
    Route::put('/change/status/{sid}',[AuthController::class,'demo_success'])->name('demo');
    //biodata
    Route::prefix('/biodata')->name('pendaftaran.')->group(function () {
        Route::get('/',[KursusBiodataController::class,'pendaftaran_kursus'])->name('kursus');
        Route::post('/process',[KursusBiodataController::class,'pendaftaran_kursus_process'])->name('kursus.process');
        Route::get('/edit/{id}',[KursusProfileController::class,'edit_biodata'])->name('s1.edit');
        Route::put('/edit/process/{id}',[KursusProfileController::class,'edit_biodata_process'])->name('s1.edit.process');
    });

    //mata pelajaran
    Route::get('/mata-pelajaran', [MataPelajaranController::class, 'index'])->name('matkul');

    //tagihan kursus
    Route::prefix('/tagihan')->name('tagihan.')->group(function () {
        Route::get('/', [KursusTagihanController::class, 'index'])->name('index');
        Route::get('/detail-spp/{name}', [KursusTagihanController::class, 'detail_spp'])->name('detail.spp');
        Route::get('/payment-spp/{name}', [KursusTagihanController::class, 'payment_spp'])->name('payment.spp');
        Route::get('/detail/{name}', [KursusTagihanController::class, 'detail_tidak_routine'])->name('detail.tidak.routine');
    });

    //kursus profile
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('', [KursusProfileController::class, 'profile'])->name('index');
        Route::get('/edit/{name}', [KursusProfileController::class, 'edit_profile'])->name('edit-profile');
        Route::put('/edit/{id}/process', [KursusProfileController::class, 'edit_profile_process'])->name('edit-profile.process');
        Route::get('/change-password/{name}', [KursusProfileController::class, 'change_password'])->name('change_password');
        Route::put('/change-password/process', [KursusProfileController::class, 'change_password_process'])->name('change_password.process');
    });
});

//Mahasiswa
Route::prefix('/mahasiswa')->middleware(['auth', 'mahasiswa','s1'])->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    //callback demo doang
    Route::put('/change/status/{sid}',[AuthController::class,'demo_success'])->name('demo');
    //biodata
    Route::prefix('/biodata')->name('pendaftaran.')->group(function () {
        Route::get('/',[BiodataController::class,'pendaftaran_s1'])->name('s1');
        Route::post('/process',[BiodataController::class,'pendaftaran_s1_process'])->name('s1.process');
        Route::get('/edit/{id}',[MahasiswaProfileController::class,'edit_biodata'])->name('s1.edit');
        Route::put('/edit/process/{id}',[MahasiswaProfileController::class,'edit_biodata_process'])->name('s1.edit.process');
    });

    //document
    Route::prefix('/dokumen')->name('pendaftaran.')->group(function () {
        Route::get('',[DocumentController::class,'document'])->name('document');
        Route::post('/process',[DocumentController::class,'document_process'])->name('document.process');

        Route::prefix('/private')->name('document.')->group(function () {
            Route::get('/ktp/{id}',[DocumentController::class,'download_pdf_ktp'])->name('ktp');
            Route::get('/kk/{id}',[DocumentController::class,'download_pdf_kk'])->name('kk');
            Route::get('/ijazah/{id}',[DocumentController::class,'download_pdf_ijazah'])->name('ijazah');
            Route::get('/transkrip/{id}',[DocumentController::class,'download_pdf_transkrip_nilai'])->name('transkrip_nilai');
        });

        Route::get('/edit/{id}',[MahasiswaProfileController::class,'edit_document'])->name('document.edit');
        Route::put('/edit/process/{id}',[MahasiswaProfileController::class,'edit_document_process'])->name('document.edit.process');
    });

    //profile
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('', [MahasiswaProfileController::class, 'profile'])->name('index');
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


    Route::get('/change-password', function () {
        return view('admin.user.change-password');
    })->name('change-password');
});