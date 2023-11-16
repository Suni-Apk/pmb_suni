@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Detail Mata Pelajaran</h6>
    </nav>

    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('/soft-ui-dashboard-main/assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="d-flex text-center justify-content-center fs-3 font-weight-bold">
                <strong>{{ $mapel->name }}</strong>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="card-body p-1">
                    <hr class="horizontal gray-light">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            Deskripsi Mata Pelajaran:  <strong class="text-dark ">

                                @if ($mapel->description)
                                    "{{ $mapel->description }}"
                                @else
                                    -
                                @endif
                            </strong>
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            Nama Guru: <strong class="text-dark ">{{ $mapel->guru }}</strong>
                        </li>
                    </ul>

                    <div class="mt-3">
                        <table class="table table-bordered">
                            <thead class="bg-gradient-success">
                                <tr>
                                    <th class="text-white">Nama Kursus</th>
                                    <th class="text-white">Mulai</th>
                                    <th class="text-white">Selesai</th>
                                    <th class="text-white">Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>@if ($mapel->kursus->name)
                                        <strong>{{ $mapel->kursus->name }}</strong>
                                    @else
                                        -
                                    @endif</td>
                                    <td>@if ($mapel->mulai)
                                        <strong>{{ $mapel->mulai }} WIB</strong>
                                    @else
                                        -
                                    @endif</td>
                                    <td>@if ($mapel->selesai)
                                        <strong>{{ $mapel->selesai }} WIB</strong>
                                    @else
                                        -
                                    @endif</td>
                                    <td>@if ($mapel->hari)
                                        <strong>{{ $mapel->hari }}</strong>
                                    @else
                                        -
                                    @endif</td
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
