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
                    <h3 class="text-dark lh-1 blur py-2 rounded-pill">Website Pendaftaran</h3>
                    <h1 class="text-white lh-1 text-uppercase">{{ App\Models\General::first()->name }}</h1>
                </div>
                <div class="col-9 col-lg-5 mx-auto d-flex justify-content-center gap-3 mt-5">
                    @if (!Auth::user())
                    <a href="{{ route('register') }}" class="btn bg-gradient-secondary"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Belum mendaftar?">Daftar</a>
                    @endif
                    <a href="#informasi" class="btn btn-outline-secondary" 
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Butuh informasi?">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row flex-column justify-content-center align-items-start w-100">
            <div class="col-12" id="informasi">
                <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                    <a id="list-sarjana-list" data-bs-toggle="list" href="#list-sarjana" role="tab" aria-controls="list-sarjana"
                        class="list-group-item list-group-item-action border-0 shadow text-center active" 
                    >Program Kuliah S1</a>
                    <a id="list-kursus-list" data-bs-toggle="list" href="#list-kursus" role="tab" aria-controls="list-kursus"
                    class="list-group-item list-group-item-action border-0 shadow text-center" 
                    >Program Madrasah Bahasa Arab</a>
                </div>
            </div>
            <div class="col-12 pt-3 px-4">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-sarjana" role="tabpanel" aria-labelledby="list-sarjana-list">
                        <div class="card border">
                            <div class="row flex-column-reverse flex-sm-row justify-content-between align-items-start card-body px-5">
                                <div class="col-12 col-sm-9 p-1 p-sm-2">
                                    {!! App\Models\DescProgramBelajar::first()->s1 !!}
                                </div>
                                <div class="col-12 col-sm-3 py-2 px-1 d-flex flex-column justify-content-start align-items-center">
                                    <a href="" class="px-2 btn bg-gradient-info">
                                        Informasi Lebih Lanjut <i class="fa fa-arrow-right ms-1"></i>
                                    </a>
                                    <ul class="list-group">
                                        <li class="list-group-item text-sm lh-sm">Biaya Administrasi : Rp. 250.000,-</li>
                                        <li class="list-group-item text-sm lh-sm">Biaya Prakuliah : Rp. 12.000.000,-</li>
                                        <li class="list-group-item text-sm lh-sm">Hubungi Kami : 089609494411</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-kursus" role="tabpanel" aria-labelledby="list-kursus-list">
                        <div class="card border">
                            <div class="row flex-column-reverse flex-sm-row justify-content-between align-items-start card-body px-5">
                                <div class="col-12 col-sm-9 p-1 p-sm-2">
                                    {!! App\Models\DescProgramBelajar::first()->kursus !!}
                                </div>
                                <div class="col-12 col-sm-3 py-2 px-1 d-flex flex-column justify-content-start align-items-center">
                                    <a href="" class="px-2 btn bg-gradient-info">
                                        Informasi Lebih Lanjut <i class="fa fa-arrow-right ms-1"></i>
                                    </a>
                                    <ul class="list-group">
                                        <li class="list-group-item text-sm lh-sm">Biaya Administrasi : Rp. 850.000,-</li>
                                        <li class="list-group-item text-sm lh-sm">Memiliki 3 Tingkatan : Mubtadi', Mutawassith, Mutaqaddim</li>
                                        <li class="list-group-item text-sm lh-sm">Hubungi Kami : 089609494411</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
