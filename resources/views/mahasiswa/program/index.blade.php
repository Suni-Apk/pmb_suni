@extends('auth.layouts.master')

@section('title', 'Pilih Program Belajar')

@section('content')
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card text-center border border-lg shadow-lg">
                    <div class="card-header">
                        <h1 class="text-black mb-2 mt-5">Selamat Datang {{$user->name}} ! </h1>
                                <h5>Silahkan Pilih Program Belajar Anda!</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('program.program_belajar.switch')}}" method="GET">
                            @csrf
                            @method('GET')
                            <button value="S1" name="program" class="btn btn-secondary">Program Belajar S1</button>
                            <button value="Kursus" name="program" class="btn btn-secondary">Program Belajar Bahasa Arab</button>
                           </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
