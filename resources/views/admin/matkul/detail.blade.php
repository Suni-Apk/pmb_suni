@extends('layouts.master')

@section('title', 'Detail Mata Kuliah')

@section('content')
<div class="page-header min-height-300 border-radius-xl"
    style="background-image: url('/soft-ui-dashboard-main/assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
</div>
<div class="card blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
        <div class="col-12 text-center fs-3 font-weight-bold lh-1 mt-5">
            {{ $matkuls->nama_matkuls }}
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
                <div class="card-body p-3">
                    <hr class="horizontal gray-light">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark fs-5">Nama Dosen: {{ $matkuls->nama_dosen }}</strong>
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
                                                            {{ $matkuls->jurusan->name }}
                                                    </td>                                                                                                                                               
                                                    <td>
                                                            @if ($matkuls->id_semesters)
                                                                {{ $matkuls->id_semesters }}
                                                            @else
                                                                -
                                                            @endif
                                                    </td>
                                                    <td>
                                                        @if ($matkuls->mulai)
                                                                {{ $matkuls->mulai }}
                                                            @else
                                                                -
                                                            @endif
                                                    </td>
                                                    <td>
                                                        @if ($matkuls->selesai)
                                                                {{ $matkuls->selesai }}
                                                            @else
                                                                -
                                                            @endif
                                                    </td>
                                                    <td>
                                                        @if ($matkuls->hari)
                                                                {{ $matkuls->hari }}
                                                            @else
                                                                -
                                                            @endif
                                                    </td>                                  
                                                </tr>
                                    </tbody>
                            </table>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
