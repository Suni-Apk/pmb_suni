@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Admin table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">id</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Nama Matkul</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Jurusan & Semester</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Mulai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Selesai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Tanggal</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Created By</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-bold">1</span>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <span class="text-bold">Slebew</span>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Hukum Ekonomi Syariah</h6>
                                                <p class="text-xs text-secondary mb-0">Semester 5</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align text-center">
                                        <span class="text-secondary text-xs font-weight-bold">06:00</span>
                                    </td>

                                    <td class="align text-center">
                                        <span class="text-secondary text-xs font-weight-bold">17:30</span>
                                    </td>

                                    <td class="align text-center">
                                        <span class="text-secondary text-xs font-weight-bold">15/05/2023</span>
                                    </td>

                                    <td class="align text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Admin</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href=""
                                            class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Detail
                                        </a>

                                        <a href=""
                                            class="badge badge-sm bg-gradient-success font-weight-bold text-xs mx-2"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Ubah
                                        </a>

                                        <a href=""
                                            class="badge badge-sm bg-gradient-danger font-weight-bold text-xs mx-2"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#templateTableNoSearch", {
            searchable: false,
            fixedHeight: true,
        });

        const dataTableBasic = new simpleDatatables.DataTable("#templateTable", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
@endpush
