@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Tahun Ajaran</h6>
                    <a href="{{route('admin.tahun-ajaran.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">id</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">angkatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Mulai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Selesai</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7 text-center">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-bold">1</span>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <span class="text-bold">2022</span>
                                    </td>
                                    <td class="text-sm">
                                        <span class="text-bold">1/8/2022</span>
                                    </td>
                                    <td class="text-sm">
                                        <span class="text-bold">1/12/2023</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-success">AKTIF</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.tahun-ajaran.destroy',1) }}" style="letter-spacing: .02rem"
                                            class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs mx-2"
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
        const dataTableBasic = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
@endpush
