@extends('auth.layouts.master')

@section('title', 'Welcome to Our Page')

@php
    $banner = App\Models\Banner::where('type', 'WELCOME')->get();
@endphp

@section('content')
<section class="min-vh-25 mb-n4 overflow-x-hidden">

    <div id="carouselWelcome" class="carousel slide page-header align-items-start height-600 pb-7 m-3 border-radius-lg" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators" style="top: 5rem;">
            @foreach ($banner as $item)
            <button type="button" data-bs-target="#carouselWelcome" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true"></button>
            @endforeach
          </div>
        <div class="carousel-inner">
            @foreach ($banner as $item)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="row flex-column justify-content-center height-600"
                style="background-image: url('{{ $item->image }}'); background-size: cover; background-position: center;">
                    <span class="mask bg-gradient-dark opacity-3 z-index-1"></span>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselWelcome" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselWelcome" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="row mt-n11">
        <div class="card col-9 col-lg-6 text-center mx-auto mb-2 mt-1 pt-5 pb-3 z-index-3 position-relative" style="border-radius: 2rem; user-select: none;">
            <span class="position-absolute start-50 rounded-circle bg-white shadow p-3" style="top: -3rem; transform: translateX(-50%);">
                <img src="{{ App\Models\General::first()->image }}" class="width-64-px">
            </span>
            <h4 class="mt-1 mt-sm-4">Selamat Datang di</h4>
            <h3 class="text-white lh-1 py-1 mt-1 mb-2 bg-gradient-dark rounded-pill">Website Pendaftaran</h3>
            <h1 class=" lh-1 text-uppercase">{{ App\Models\General::first()->name }}</h1>
            <div class="mx-auto d-flex justify-content-center gap-3 mt-2 mt-sm-4">
                @if (!Auth::user())
                <a href="{{ route('register') }}" class="btn rounded-pill bg-gradient-secondary"
                data-bs-toggle="tooltip" data-bs-placement="left" title="Belum mendaftar?">Daftar</a>
                @endif
                <a href="#informasi" class="btn rounded-pill btn-outline-secondary" 
                data-bs-toggle="tooltip" data-bs-placement="right" title="Butuh informasi?">Selengkapnya</a>
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
            <div class="col-12 pt-3 px-3">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-sarjana" role="tabpanel" aria-labelledby="list-sarjana-list">
                        <div class="card border">
                            <div class="row flex-column-reverse flex-sm-row justify-content-between align-items-start card-body" 
                            style="padding-left: 1.7rem; padding-right: 1.7rem;">
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
                            <div class="row flex-column-reverse flex-sm-row justify-content-between align-items-start card-body" 
                            style="padding-left: 1.7rem; padding-right: 1.7rem;">
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
