@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Jurusan table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No</th>
                                    <th
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jurusan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-bold">1</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-bold">Hukum Ekonomi Syariah</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.jurusan.edit', 1) }}"
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
