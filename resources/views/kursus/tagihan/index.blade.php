@extends('kursus.layouts.parent')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Pembayaran Tingakatan</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Jenis Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Angkatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm text-center">Easy</h6>
                                        </div>
                                    </td>
                                    <td class="align- text-start">
                                        <span class="text-secondary text-xs font-weight-bold">Tingakatan</span>
                                    </td>
                                    <td class="align- text-start">
                                        <span class="text-secondary text-xs font-weight-bold">2023</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Informatika</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('kursus.tagihan.detail.spp', Auth::user()->name) }}"
                                            class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Detail
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
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Pembayaran Tidak Routine</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Jenis Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Angkatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm text-center">KKN</h6>
                                        </div>
                                    </td>
                                    <td class="align- text-start">
                                        <span class="text-secondary text-xs font-weight-bold">Tidak Routine</span>
                                    </td>
                                    <td class="align- text-start">
                                        <span class="text-secondary text-xs font-weight-bold">2023</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Informatika</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('kursus.tagihan.detail.tidak.routine', Auth::user()->name) }}"
                                            class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
