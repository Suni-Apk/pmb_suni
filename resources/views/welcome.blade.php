@extends('auth.layouts.master')

@section('title', 'Welcome to Our Page')

@section('content')
<section class="min-vh-25 mb-n4">
    <div class="page-header align-items-start min-vh-95 pt-5 pb-10 m-3 border-radius-lg"
        style="background-image: url('/soft-ui-dashboard-main/assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row flex-column justify-content-center">
                <div class="col-9 col-lg-6 text-center mx-auto mb-2 mt-5">
                    <img src="/soft-ui-dashboard-main/assets/img/logo-ct.png" class="my-5" alt="" width="100">
                    <h4 class="text-white mt-4">Selamat Datang!</h4>
                    <h1 class="text-white lh-1">Di website Pendaftaran Suni Indonesia</h1>
                </div>
                <div class="col-9 col-lg-5 mx-auto d-flex justify-content-center gap-3 mt-4">
                    <a href="" class="btn bg-gradient-secondary" 
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Sudah punya akun?">Login</a>
                    <a href="" class="btn bg-gradient-primary"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Belum mendaftar?">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection