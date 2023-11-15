@extends('layouts.master')

@section('title', 'Detail Link')

@section('content')
<div class="page-header min-height-300 border-radius-xl"
    style="background-image: url('/soft-ui-dashboard-main/assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
</div>
<div class="card blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="pt-4">
        <div class="d-flex px-5 text-center justify-content-between fs-3 font-weight-bold">
            {{ $link->name }}
            <div class="">    
                <a href="" class="btn btn-outline-secondary">Back</a>
                <a href="{{ route('admin.link.edit', ['type' => $link->type, 'id' => $link->id]) }}" class="btn bg-gradient-secondary">Edit</a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-4 mt-n3">
        <div class="row">
            <div class="card-body">
                <hr class="horizontal gray-light">
                <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <span class="text-dark text-md lh-1">Nama Jurusan : <span class="text-lg font-weight-bold">{{ $link->jurusan->name }}</span></span>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <span class="text-dark text-md lh-1">Tahun Ajaran : <span class="font-weight-bold">{{ $link->tahunAjaran->year }}</span></span>
                    </li>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3">
                            <thead class="bg-gradient-success">
                                <tr>
                                    <th class="text-white text-uppercase text-xs opacity-9">url</th>
                                    <th class="text-white text-uppercase text-xs opacity-9">tipe</th>
                                    <th class="text-white text-uppercase text-xs opacity-9">gender</th>
                                    <th class="text-white text-uppercase text-xs opacity-9">created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-dark text-sm">{{ $link->url }}</td>
                                    <td class="text-dark text-sm">{{ $link->type }}</td>
                                    <td class="text-dark text-sm text-capitalize">{{ ($link->gender == 'all') ? 'Semua' : $link->gender }}</td>
                                    <td class="text-dark text-sm">{{ $link->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection