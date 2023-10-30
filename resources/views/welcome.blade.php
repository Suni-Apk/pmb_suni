@extends('auth.layouts.master')

@section('title', 'Welcome to Our Page')

@section('content')
<section class="min-vh-25 mb-n4 overflow-x-hidden">
    <div class="page-header align-items-start min-vh-35 py-5 pb-7 m-3 border-radius-lg"
        style="background-image: url('/soft-ui-dashboard-main/assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row flex-column justify-content-center">
                <div class="col-9 col-lg-6 text-center mx-auto mb-2 mt-1">
                    <img src="/soft-ui-dashboard-main/assets/img/logo-ct.png" class="my-5" alt="" width="100">
                    <h4 class="text-white">Selamat Datang di</h4>
                    <h1 class="text-white lh-1">Website Pendaftaran Suni Indonesia</h1>
                </div>
                <div class="col-9 col-lg-5 mx-auto d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('register') }}" class="btn bg-gradient-secondary"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Belum mendaftar?">Daftar</a>
                    <a href="#inform" class="btn btn-outline-secondary" 
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Butuh informasi?">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row flex-column justify-content-center align-items-start w-100">
            <div class="col-12">
                <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                    <a id="list-sarjana-list" data-bs-toggle="list" href="#list-sarjana" role="tab" aria-controls="list-sarjana"
                        class="list-group-item list-group-item-action active" 
                    >Program Belajar S1</a>
                    <a id="list-kursus-list" data-bs-toggle="list" href="#list-kursus" role="tab" aria-controls="list-kursus"
                    class="list-group-item list-group-item-action" 
                    >Program Kursus Bahasa Arab</a>
                </div>
            </div>
            <div class="col-12 py-3 px-4">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-sarjana" role="tabpanel" aria-labelledby="list-sarjana-list">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus suscipit delectus, totam asperiores ab saepe mollitia iste aliquam nesciunt minima quidem,asfda sdf rem amet voluptatum adipisci! Deserunt libero labore officia.
                    </div>
                    <div class="tab-pane fade" id="list-kursus" role="tabpanel" aria-labelledby="list-kursus-list">
                        Lorem ipsum dolor sit amet consectasd fasdf asdcetur, adipisicing elit. Repellendus suscipit delectus, totam asperiores ab saepe mollitia iste aliquam nesciunt minima quidem, rem amet voluptatum adipisci! Deserunt libero labore officia.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
