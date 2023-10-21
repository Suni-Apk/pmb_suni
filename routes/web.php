<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Mahasiswa\DashboardController;
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

Route::get('/register',[AuthController::class,'register'])->name('register');

Route::post('/register-process',[AuthController::class,'register_process'])->name('register.process');

Route::get('/login',[AuthController::class,'login'])->name('login');

Route::post('/login-process',[AuthController::class,'login_process'])->name('login.process');


Route::prefix('/mahasiswa')->middleware('auth')->name('mahasiswa.')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
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

    Route::get('/profile', function () {
        return view('layouts.template.profile');
    })->name('profile');

    Route::get('/rtl', function () {
        return view('layouts.template.rtl');
    })->name('rtl');

    Route::get('/virtual-reality', function () {
        return view('layouts.template.virtual-reality');
    })->name('virtual-reality');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
