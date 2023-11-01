@extends('layouts.master')

@section('title', 'Matkul')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <h4 class="ms-2">Jurusan Informatika</h4>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mata Kuliah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Mata Kuliah</label>
                            <select class="form-control" required>
                                <option disabled selected>-----------</option>
                                    <option value="#">Fiqih Keluarga</option>
                                    <option value="#">Fiqih Muamalah</option>
                                    <option value="#">Falaq</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama">Mulai</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama">Selesai</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama">Tanggal</label>
                            <input type="date" name="nama" id="nama" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>                                       
        <div class="col-12 col-lg-6">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <div>
                        <h6>Semester 1</h6>
                    </div>
                    <div class="flex-row d-flex">
                        <a href="#" class="btn btn-primary fs-6 p-2 px-3" data-bs-toggle="modal" data-bs-target="#myModal">
                            +
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Mata Kuliah</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Mulai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Selesai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Programming</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-text-start">
                                        <span class="text-secondary text-xs font-weight-bold">19:20</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">20:25</p>
                                    </td>
                                    <td class="align-text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">17-10-2023</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <div>
                        <h6>Semester 1</h6>
                    </div>
                    <div class="flex-row d-flex">
                        <a href="#" class="btn btn-primary fs-6 p-2 px-3" data-bs-toggle="modal" data-bs-target="#myModal">
                            +
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Mata Kuliah</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Mulai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Selesai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Programming</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-text-start">
                                        <span class="text-secondary text-xs font-weight-bold">19:20</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">20:25</p>
                                    </td>
                                    <td class="align-text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">17-10-2023</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    </div>
@endsection
