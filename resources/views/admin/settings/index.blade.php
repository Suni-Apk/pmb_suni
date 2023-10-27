@extends('layouts.master')


@section('title', 'Settings Notification')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Settings</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Setting Notification</h6>
    </nav>
    <div class="card h-100 mt-4">
        <div class="card-header">
            <h5 class="text-bold">Notification Whatsaap</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="" class="">Pesan notification tepat tenggat tagihan</label>
                <input type="text" class="form-control mb-3"
                    placeholder="Assalamualaikum anda mempunyai tagihan berikut">
                <button class="btn btn-primary py-2 px-3" type="submit">Submit</button>
            </div>
            <div class="form-group">
                <label for="" class="">Pesan notification sebelum waktu tagihan</label>
                <input type="text" class="form-control mb-3"
                    placeholder="Assalamualaikum tagihan ikan goreng akan mendekati jatuh tempo">
                <button class="btn btn-primary py-2 px-3" type="submit">Submit</button>
            </div>
        </div>
    </div>
@endsection
