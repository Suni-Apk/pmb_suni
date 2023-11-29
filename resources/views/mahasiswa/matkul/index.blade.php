@extends('layouts.master')

@section('title', 'Matkul')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="d-flex justify-content-between">
            <h4>{{ $jurusan->name }}</h4>
            @if ($links)
                <a href="{{ $links->url }}" target="_blank" class="btn btn-primary fs-4 p-2 px-3">
                    <i class="fab fa-whatsapp"></i>
                </a>
            @endif
        </div>
            @foreach ($semester as $semesters)
                <div class="col-12 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between">
                            <div>
                                <h6>{{ $semesters->name }}</h6>
                            </div>
                            <div class="flex-row d-flex">
                                {{-- <a href="" class="btn btn-secondary fs-6 p-2 px-3 ms-2">
                                    <i class="fas fa-file-download"></i>
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="templateTable">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Mata Kuliah
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                                Mulai
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Selesai
                                            </th>
                                            <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                                Hari
                                            </th>
                                            <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                                Dosen
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matkuls->where('id_semesters', $semesters->id) as $matkul)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm ms-2">{{ $matkul->nama_matkuls }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-start">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $matkul->mulai }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $matkul->selesai }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $matkul->hari }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $matkul->nama_dosen }}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
@endsection
