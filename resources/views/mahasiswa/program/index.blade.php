@extends('auth.layouts.master')

@section('title', 'Pilih')

@section('content')
    <section class="min-vh-25 mb-8">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
                        <div class="card-header text-center pt-4">
                            <h1 class="text-black mb-2 mt-5">Selamat Datang Nama Mahasiswa ! </h1>
                            <h5>Silahkan Pilih Program Belajar Anda!</h5>
                        </div>
                        <div class="card-body d-flex justify-content-around">
                            <a href="" class="btn btn-secondary">Program Belajar S1</a>
                            <a href="" class="btn btn-secondary">Program Belajar Bahasa Arab</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
