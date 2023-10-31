@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Tagihan</h6>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="fas fa-plus me-1"></i> Tambah tagihan
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Tagihan</h5>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.tagihan.next') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="jenis_tagihan" value="rutin">
                                            <label class="custom-control-label" for="customRadio1">Spp</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="customRadio1" value="tidak-rutin">
                                            <label class="custom-control-label" for="customRadio1">Biaya Lain</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="customRadio1" value="daftar-ulang">
                                            <label class="custom-control-label" for="customRadio1">Daftar Ulang</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="customRadio1" value="tingkatan">
                                            <label class="custom-control-label" for="customRadio1">Tingkatan</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn bg-gradient-primary" type="submit">
                                            Lanjut <i class="fas fa-arrow-circle-right ms-1"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">
                                        Id
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">
                                        Nama Tagihan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-8">
                                        Angkatan
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">
                                        Jurusan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">
                                        Total Harga
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">
                                        Created at
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">
                                        Jenis tagihan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-xs font-weight-bold">1</td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Tagihan jas
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        2022/2023
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Ilmu Fiqih

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp 200.000
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        23/04/18
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        <strong>Biaya lain</strong>

                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.tagihan.show', 'tidak-rutin') }}"
                                            class="badge text-uppercase badge-sm bg-gradient-info text-xxs"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>

                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-secondary text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="Edit">
                                            Ubah
                                        </a>

                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-danger text-xxs"
                                            data-toggle="tooltip" data-original-title="hapus">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle text-xs font-weight-bold">2</td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Spp 2022/2023
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        2022/2023
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Ilmu Fiqih

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp 200.000
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        23/04/18
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        <strong>Spp</strong>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.tagihan.show', 'rutin') }}"
                                            class="badge text-uppercase badge-sm bg-gradient-info text-xxs"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>

                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-secondary text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="Edit">
                                            Ubah
                                        </a>

                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-danger text-xxs"
                                            data-toggle="tooltip" data-original-title="hapus">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle text-xs font-weight-bold">3</td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Daftar Ulang 2022/2023
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        2022/2023
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Ilmu Fiqih

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp 200.000
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        23/04/18
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        <strong>Daftar Ulang</strong>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.tagihan.show', 'daftar-ulang') }}"
                                            class="badge text-uppercase badge-sm bg-gradient-info text-xxs"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>

                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-secondary text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="Edit">
                                            Ubah
                                        </a>

                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-danger text-xxs"
                                            data-toggle="tooltip" data-original-title="hapus">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle text-xs font-weight-bold">4</td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Tingkatan 2023
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        2022/2023
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        -

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp 2.550.000
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        23/04/18
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        <strong>Tingkatan</strong>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.tagihan.show', 'tingkatan') }}"
                                            class="badge text-uppercase badge-sm bg-gradient-info text-xxs"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>

                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-secondary text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="Edit">
                                            Ubah
                                        </a>

                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-danger text-xxs"
                                            data-toggle="tooltip" data-original-title="hapus">
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
        const dataTableBasic = new simpleDatatables.DataTable("#templateTable", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
@endpush
