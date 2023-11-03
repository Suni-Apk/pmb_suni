@extends('auth.layouts.master')

@section('title', 'Welcome to Our Page')

@section('content')
<<<<<<< HEAD
<section class="min-vh-25 mb-n4">
    <div class="page-header align-items-start min-vh-95 pt-5 pb-10 m-3 border-radius-lg"
        style="background-image: url('/soft-ui-dashboard-main/assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row flex-column justify-content-center">
                <div class="col-9 col-lg-6 text-center mx-auto mb-2 mt-5">
                    <img src="/soft-ui-dashboard-main/assets/img/logo-ct.png" class="my-5" alt="" width="100">
                    <h4 class="text-white mt-4">Selamat Datang di,</h4>
                    <h1 class="text-white lh-1">Website Pendaftaran Suni Indonesia</h1>
                </div>
                <div class="col-9 col-lg-5 mx-auto d-flex justify-content-center gap-3 mt-4">
                    <a href="{{route('login')}}" class="btn bg-gradient-secondary" 
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Sudah punya akun?">Login</a>
                    <a href="{{route('register')}}" class="btn bg-gradient-primary"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Belum mendaftar?">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</section>
=======
    <section class="min-vh-25 mb-8">
        <div class="page-header align-items-start min-vh-45 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('../soft-ui-dashboard-main/assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
                        <p class="text-lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit,
                            ab!.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-8 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Lorem Ipsum Dolor</h5>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
>>>>>>> 46e3398b5282bba2241af524ee2f88c8839a5162
@endsection
