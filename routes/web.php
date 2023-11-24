<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\TagihanController as AdminTagihanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\IpaymuController;
use App\Http\Controllers\Kursus\MataPelajaranController;
use App\Http\Controllers\Kursus\BiodataController as KursusBiodataController;
use App\Http\Controllers\Kursus\ProfileController as KursusProfileController;
use App\Http\Controllers\Kursus\TagihanController as KursusTagihanController;
use App\Http\Controllers\Kursus\DashboardController as KursusDashboardController;
use App\Http\Controllers\Mahasiswa\MatkulController;
use App\Http\Controllers\Mahasiswa\BiodataController;
use App\Http\Controllers\Mahasiswa\TagihanController;
use App\Http\Controllers\MatkulController as ControllersMatkulController;
use App\Http\Controllers\Mahasiswa\TransaksiController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\Mahasiswa\DashboardController as S1DashboardController;
use App\Http\Controllers\Mahasiswa\DocumentController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\DocumentController as AdminDocumentController;
use App\Http\Controllers\Kursus\TransactionController as KursusTransactionController;
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

Route::get('log', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

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
    Route::post('/program-belajar/switch/{id}', [AuthController::class, 'switch'])->name('program_belajar.switch');
});

// Auth Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/login-process', [AdminAuthController::class, 'login_process'])->name('login.process');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Controller / Dashboard Admin
Route::prefix('/admin')->middleware(['admin', 'auth'])->name('admin.')->group(function () {
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
        Route::get('/', [AccountController::class, 'admin'])->name('index');
        Route::get('/create', [AccountController::class, 'admin_create'])->name('create');
        Route::post('/create/process', [AccountController::class, 'admin_create_process'])->name('create.process');
        Route::get('/edit/{id}', [AccountController::class, 'admin_edit'])->name('edit');
        Route::put('/edit/process/{id}', [AccountController::class, 'admin_edit_process'])->name('edit.process');
        Route::put('/change-status/{id}', [AccountController::class, 'admin_status'])->name('status');
        Route::delete('/delete/{id}', [AccountController::class, 'admin_delete'])->name('delete');
    });

    // data mahasiswa
    Route::prefix('mahasiswa/account')->name('mahasiswa.')->group(function () {
        Route::get('/', [AccountController::class, 'mahasiswa'])->name('index');
        Route::get('/create', [AccountController::class, 'mahasiswa_create'])->name('create');
        Route::post('/create/process', [AccountController::class, 'mahasiswa_create_process'])->name('create.process');
        Route::get('/edit/{id}', [AccountController::class, 'mahasiswa_edit'])->name('edit');
        Route::put('/edit/process/{id}', [AccountController::class, 'mahasiswa_edit_process'])->name('edit.process');
        Route::put('/change-status/{id}', [AccountController::class, 'mahasiswa_status'])->name('status');
        Route::delete('/delete/{id}', [AccountController::class, 'mahasiswa_delete'])->name('delete');
        Route::get('/detail/{id}', [AccountController::class, 'mahasiswa_detail'])->name('show');
        Route::get('/bayar/{id}', [AccountController::class, 'mahasiswa_bayar'])->middleware(['Pembayaran'])->name('bayar');
        Route::get('/program/{id}', [AccountController::class, 'mahasiswa_program'])->name('program');
    });

    // data pendaftar
    Route::prefix('pendaftar/account')->name('pendaftar.')->group(function () {
        Route::get('/', [AccountController::class, 'pendaftar'])->name('index');
        Route::get('/edit/{id}', [AccountController::class, 'pendaftar_edit'])->name('edit');
        Route::put('/edit/process/{id}', [AccountController::class, 'pendaftar_edit_process'])->name('edit.process');
        Route::put('/change-status/{id}', [AccountController::class, 'pendaftar_status'])->name('status');
        Route::delete('/delete/{id}', [AccountController::class, 'pendaftar_delete'])->name('delete');
        Route::get('/detail/{id}', [AccountController::class, 'pendaftar_detail'])->name('show');
    });
    
    // data link
    Route::prefix('link')->name('link.')->group(function () {
        Route::get('/whatsapp', [LinkController::class, 'whatsapp'])->name('whatsapp');
        Route::get('/zoom', [LinkController::class, 'zoom'])->name('zoom');
        Route::get('/create', [LinkController::class, 'create'])->name('create');
        Route::post('/create/process', [LinkController::class, 'store'])->name('create.process');
        Route::get('/{type}/edit/{id}', [LinkController::class, 'edit'])->name('edit');
        Route::put('/{type}/edit/process', [LinkController::class, 'update'])->name('edit.process');
        Route::get('/detail/{id}', [LinkController::class, 'show'])->name('detail');
        Route::delete('/delete/{id}', [LinkController::class,'destroy'])->name('destroy');
    });
    
    Route::prefix('tahun_ajaran')->name('tahun_ajaran.')->group( function(){
        Route::get('/', [TahunAjaranController::class, 'index'])->name('index');
        Route::get('/create', [TahunAjaranController::class, 'create'])->name('create');
        Route::post('/create/process', [TahunAjaranController::class, 'store'])->name('create.process');
        Route::get('/detail/{id}', [TahunAjaranController::class, 'show'])->name('detail');
        Route::post('/active/{id}', [TahunAjaranController::class, 'active'])->name('active');
        Route::delete('/delete/{id}', [TahunAjaranController::class, 'destroy'])->name('destroy');
    });
    
    // proses transaksi
    Route::prefix('transaksi')->name('transactions.')->group(function () {
        Route::post('/proses_bayar/{id}', [TransactionController::class, 'proses_bayar'])->middleware(['Pembayaran'])->name('proses_bayar');
    });
    
    // resources management
    Route::resource('/matkul', ControllersMatkulController::class);
    Route::resource('/mapel', MapelsController::class);
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/transaksi', TransactionController::class);
    Route::resource('/tagihan', AdminTagihanController::class);
    Route::resource('/dokumen', AdminDocumentController::class);
    Route::resource('/course',CourseController::class);
    Route::resource('/tagihan', AdminTagihanController::class);
    Route::get('/next', [AdminTagihanController::class, 'next'])->name('tagihan.next');
    
    //data settings
    Route::prefix('settings')->group(function () {
        // data administrasi
        Route::get('/administrasi', [AdministrasiController::class, 'administrasi'])->name('administrasi');
        Route::put('/administrasi/{id}', [AdministrasiController::class, 'AdministrasiProses'])->name('administrasi.proses');

        Route::prefix('')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('general');
            Route::put('/edit/{id}', [SettingController::class, 'general_edit'])->name('general.edit');
            Route::put('/desc/edit/{id}', [SettingController::class, 'desc_edit'])->name('desc.edit');
            Route::post('/upload/desc', [SettingController::class, 'upload_file'])->name('upload.file');
            
            Route::get('/notifikasi', [SettingController::class, 'notify_index'])->name('notifications');
            Route::put('/notifikasi/process/{id}', [SettingController::class, 'notify_edit'])->name('notifications.process');

            Route::prefix('')->group(function () {
                Route::get('/komponen', [SettingController::class, 'komponen'])->name('component');

                Route::prefix('banner')->name('banner.')->group(function () {
                    Route::get('/create', [SettingController::class, 'create_banner'])->name('create');
                    Route::post('/create/process', [SettingController::class, 'store_banner'])->name('store');
                    Route::get('/edit/{id}', [SettingController::class, 'edit_banner'])->name('edit');
                    Route::put('/edit/process/{id}', [SettingController::class, 'update_banner'])->name('update');
                    Route::delete('/delete/{id}', [SettingController::class, 'delete_banner'])->name('delete');
                });
            });
        });
    });
});

Route::prefix('/kursus')->middleware(['auth', 'kursus'])->name('kursus.')->group(function () {
    Route::get('/dashboard', [KursusDashboardController::class, 'kursus'])->name('dashboard');

    //callback demo
    Route::put('/change/status/{sid}', [AuthController::class, 'demo_success'])->name('demo');
    //biodata
    Route::prefix('/biodata')->name('pendaftaran.')->group(function () {
        Route::get('/', [KursusBiodataController::class, 'pendaftaran_kursus'])->name('kursus');
        Route::post('/process', [KursusBiodataController::class, 'pendaftaran_kursus_process'])->name('kursus.process');
        Route::get('/edit/{id}', [KursusProfileController::class, 'edit_biodata'])->name('s1.edit');
        Route::put('/edit/process/{id}', [KursusProfileController::class, 'edit_biodata_process'])->name('s1.edit.process');
    });

    //mata pelajaran
    Route::get('/mata-pelajaran', [MataPelajaranController::class, 'index'])->name('mapel');

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
    Route::get('/bayar/{id}', [KursusTagihanController::class, 'bayar'])->name('tagihan.bayar');

    Route::prefix('/transactions/')->name('transactions.')->group(function () {
        Route::post('/proses_bayar', [KursusTransactionController::class, 'proses_bayar'])->middleware('KursusTransactions')->name('proses_bayar');
    });
});

Route::prefix('/callback')->name('callback.')->group(function () {
    Route::get('/return', function () {
        return view('callback.return');
    })->name('return');

    Route::get('/cancel', function () {
        return view('callback.cancel');
    })->name('cancel');

    Route::post('/notify', [IpaymuController::class, 'notify'])->name('notify');
});

//Mahasiswa
Route::prefix('/mahasiswa')->middleware(['auth', 'mahasiswa', 's1'])->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [S1DashboardController::class, 'index'])->name('dashboard');

    //callback demo doang
    // Route::post('/change/status/{sid}',[AuthController::class,'demo_success'])->name('demo');
    Route::put('/change-daftar-ulang/status/{sid}',[AuthController::class,'daftar_ulang_demo_success'])->name('daftar.ulang.demo');

    //biodata
    Route::prefix('/biodata')->name('pendaftaran.')->group(function () {
        Route::get('/', [BiodataController::class, 'pendaftaran_s1'])->name('s1');
        Route::post('/process', [BiodataController::class, 'pendaftaran_s1_process'])->name('s1.process');
        Route::get('/edit/{id}', [MahasiswaProfileController::class, 'edit_biodata'])->name('s1.edit');
        Route::put('/edit/process/{id}', [MahasiswaProfileController::class, 'edit_biodata_process'])->name('s1.edit.process');
    });

    //document
    Route::prefix('/dokumen')->name('pendaftaran.')->group(function () {
        Route::get('', [DocumentController::class, 'document'])->name('document');
        Route::post('/process', [DocumentController::class, 'document_process'])->name('document.process');

        Route::prefix('/private')->name('document.')->group(function () {
            Route::get('/ktp/{id}', [DocumentController::class, 'download_pdf_ktp'])->name('ktp');
            Route::get('/kk/{id}', [DocumentController::class, 'download_pdf_kk'])->name('kk');
            Route::get('/ijazah/{id}', [DocumentController::class, 'download_pdf_ijazah'])->name('ijazah');
            Route::get('/transkrip/{id}', [DocumentController::class, 'download_pdf_transkrip_nilai'])->name('transkrip_nilai');
        });

        Route::get('/edit/{id}', [MahasiswaProfileController::class, 'edit_document'])->name('document.edit');
        Route::put('/edit/process/{id}', [MahasiswaProfileController::class, 'edit_document_process'])->name('document.edit.process');
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
        Route::get('/daftar-ulang',[TransaksiController::class,'daftarUlang'])->name('daftar.ulang');
        Route::get('/detail/{name}',[TagihanController::class,'detail_tidak_routine'])->name('detail.tidak.routine');
        Route::get('/detail-spp/{name}',[TagihanController::class,'detail_spp'])->name('detail.spp');
        Route::get('/payment-spp/{name}', [TagihanController::class, 'payment_spp'])->name('payment.spp');
        Route::get('pay-ipaymu/{id}/{iduser}', [PembayaranUserController::class, 'payIpaymu'])->name('payment.ipaymu');
    });
    

    Route::get('/demo-cicilan/{id}', [TransaksiController::class, 'demo_cicilan'])->name('transactions.cicilan');
    Route::put('/demoBayar/{id}', [TransaksiController::class, 'demo_bayar_cicilan'])->name('transactions.cicilan.bayar');

    //callback demo bayar tagihan
    Route::prefix('/transactions/')->name('transactions.')->group(function () {
        Route::post('/proses_bayar', [TransaksiController::class, 'proses_bayar'])->middleware('MahasiswaTransactions')->name('proses_bayar');
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
