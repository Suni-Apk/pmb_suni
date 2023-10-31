@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Detail Mata Kuliah</h6>
    </nav>

<div class="page-header min-height-300 border-radius-xl mt-4"
    style="background-image: url('/soft-ui-dashboard-main/assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
</div>
<div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
        <div class="d-flex text-center justify-content-center fs-3 font-weight-bold">
            Fiqih Muamalah
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
                <div class="card-body p-3">
                    <hr class="horizontal gray-light">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark fs-5">Nama Dosen: Pak Madinah</strong>
                            &nbsp; </li>
                            <table class="table table-bordered mt-3">
                                <thead class="bg-gradient-success">
                                    <tr>
                                        <th class="text-white">Jurusan</th>
                                        <th class="text-white">Semester</th>
                                        <th class="text-white">Mulai</th>
                                        <th class="text-white">Selesai</th>
                                        <th class="text-white d-flex">Tanggal</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                                <tr>
                                                    <td>
                                                            Hukum Ekonomi Syariah
                                                    </td>                                                                                                                                               
                                                    <td>
                                                            5
                                                    </td>
                                                    <td>
                                                        06:00
                                                    </td>
                                                    <td>
                                                        17:30
                                                    </td>
                                                    <td>
                                                        15/05/2023	
                                                    </td>                                  
                                                </tr>
                                    </tbody>
                            </table>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
