@extends('auth.layouts.master')

@section('title', 'Selamat Datang!')

@php
    $banner = App\Models\Banner::where('type', 'WELCOME')->get();
    $descProgram = App\Models\DescProgramBelajar::get();
@endphp

@section('content')
    <section class="min-vh-25 mb-n4 overflow-x-hidden">

        <div id="carouselWelcome" class="carousel slide page-header align-items-start height-600 pb-7 m-3 border-radius-lg"
            data-bs-ride="carousel" data-bs-interval="3000" style="background-color: #fff;">
            <div class="carousel-indicators" style="top: 5rem;">
                @foreach ($banner as $item)
                    <button type="button" data-bs-target="#carouselWelcome" data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}" aria-current="true"></button>
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
            <div class="card col-9 col-lg-6 text-center mx-auto mb-2 mt-1 pt-5 pb-3 z-index-3 position-relative"
                style="border-radius: 2rem; user-select: none;">
                <span class="position-absolute start-50 rounded-circle bg-white shadow p-3"
                    style="top: -3rem; transform: translateX(-50%);">
                    <img src="{{ App\Models\General::first()->image }}" class="width-64-px">
                </span>
                <h4 class="mt-1 mt-sm-4">Selamat Datang di</h4>
                <h3 class="text-white lh-1 py-1 mt-1 mb-2 bg-gradient-dark rounded-pill">Website Pendaftaran</h3>
                <h1 class=" lh-1 text-uppercase">{{ App\Models\General::first()->name }}</h1>
                <div class="mx-auto d-flex justify-content-center gap-2 mt-2 mt-sm-4">
                    @if (!Auth::user())
                        <div class="nav-item">
                            <a class="btn bg-gradient-dark mb-0 rounded-pill" href="{{ route('register') }}">
                                Daftar
                            </a>
                        </div>
                    @endif
                    <a href="#informasi" class="btn rounded-pill btn-outline-secondary" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Butuh informasi?">Selengkapnya <i
                            class="fas fa-arrow-down ms-1"></i></a>
                </div>
            </div>
        </div>

    <div class="p-5">
        <div class="row flex-column justify-content-center align-items-start w-100">
            <div class="col-12" id="informasi">
                <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                    @foreach ($descProgram as $item)
                    <a id="list-sarjana-list" data-bs-toggle="list" href="#{{ $item->keyword }}" role="tab" aria-controls="{{ $item->keyword }}"
                        class="list-group-item list-group-item-action border-0 shadow text-center {{ $loop->first ? 'active' : '' }}" 
                    >Program {{ $item->title }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-12 pt-3 px-3">
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($descProgram as $item)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $item->keyword }}" role="tabpanel" aria-labelledby="{{ $item->keyword }}-list">
                        <div class="card border">
                            <div class="row flex-column-reverse flex-sm-row justify-content-between align-items-start card-body" 
                            style="padding-left: 1.7rem; padding-right: 1.7rem;">
                                <style> .desc-program img { max-width: 100%!important; height: auto } </style>
                                <div class="col-12 col-sm-9 p-1 p-sm-2 desc-program">
                                    {!! $item->desc !!}
                                </div>
                                <div class="col-12 col-sm-3 py-2 px-1 d-flex flex-column justify-content-start align-items-center">
                                    <a href="{{ App\Models\General::first()->url }}" class="px-3 btn bg-gradient-info rounded-pill">
                                        Informasi Lebih Lengkap <i class="fa fa-arrow-right ms-1"></i>
                                    </a>
                                    <ul class="list-group">
                                        @if ($loop->first)
                                        <li class="list-group-item text-sm lh-sm">
                                            Biaya Administrasi : Rp. {{ number_format(App\Models\Administrasi::first()->amount,0,'','.') }},-
                                        </li>
                                        @else
                                            @if ($item->course)
                                                @foreach ($item->course->notes as $note)
                                                    @if ($note !== null)
                                                        <li class="list-group-item text-sm lh-sm">
                                                            {{ $note }}
                                                        </li>
                                                    @endif
                                                @endforeach
                                                <li class="list-group-item text-sm lh-sm">
                                                    Biaya Administrasi : Rp. {{ number_format($item->course->administrasi->amount,0,'','.') }},-
                                                </li>
                                            @endif
                                        @endif
                                        <li class="list-group-item text-sm lh-sm">
                                            Hubungi Kami : <a href="https://api.whatsapp.com/send?phone={{ App\Models\General::first()->phone }}">{{ App\Models\General::first()->phone }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
