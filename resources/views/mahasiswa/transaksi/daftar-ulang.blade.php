@extends('auth.layouts.master')

@section('title', 'Pilih Program Belajar')

@section('content')
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row sm:w-90 xl:60">
            <div class="col-12 col-sm-12">
                <div class="card border border-lg shadow-lg">
                    <div class="card-header">
                        <h4 class="text-center">Pembayaran Daftar Ulang {{$transaction->user->name}}</h4>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Invoice : </label>
                                        <strong>{{$transaction->no_invoice}}</strong>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status Pembayaran : </label>
                                        <strong>{{$transaction->status}}</strong>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Total : </label>
                                        <strong>{{$transaction->total}}</strong>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Program Belajar : </label>
                                        <strong>{{$transaction->program_belajar}}</strong>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Pembayaran : </label>
                                        <strong>{{$transaction->jenis_pembayaran}}</strong>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Tagihan : </label>
                                        <strong>{{$transaction->jenis_tagihan}}</strong>
                                    </div>
                                </div>
                                <form action="{{route('mahasiswa.daftar.ulang.demo',$transaction->no_invoice)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <div class="col-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary w-100">Bayar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
