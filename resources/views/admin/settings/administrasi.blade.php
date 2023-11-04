@extends('layouts.master')


@section('title', 'Settings Biaya Admin')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Settings</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Setting Biaya Administrasi</h6>
    </nav>
    <div class="card h-100 mt-4">
        <div class="card-header">
            <h5 class="text-bold">Silahkan Sesuaikan Biaya administrasi </h5>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label for="" class="">Masukkan Harga Adminstrasi <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control mb-3" placeholder="Rp.200.000" value="200.000">
                    <button class="btn btn-primary py-2 px-3" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
