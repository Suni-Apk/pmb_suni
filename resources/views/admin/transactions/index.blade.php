@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Transaksi table</h6>
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
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
                                                id="jenis_tagihan" value="Routine">
                                            <label class="custom-control-label" for="customRadio1">Routine</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="customRadio1" value="Tidakroutine">
                                            <label class="custom-control-label" for="customRadio1">Tidak Routine</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="customRadio1" value="DaftarUlang">
                                            <label class="custom-control-label" for="customRadio1">Daftar Ulang</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button> --}}
                                        <button class="btn bg-gradient-primary" type="submit">Lanjut <i
                                                class="fas fa-arrow-circle-right ms-1"></i></button>
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
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        No
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xs  font-weight-bolder opacity-10">
                                        Nama
                                        Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Tanggal Pembayaran</th>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Pembayar</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Total Pembayaran</th>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Status</th>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Jenis tagihan</th>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Jenis Pembayaran</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-xs font-weight-bold">
                                        1
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Tagihan jas
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        20 January 2030
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Asep Kastelo

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp 200.000
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        <span class="badge text-uppercase badge-sm bg-gradient-success">SUCCESS</span>

                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Tidak routine

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Cash
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaction.show', 'Tidakroutine') }}"
                                            class="badge text-uppercase badge-sm bg-gradient-info text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>



                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-danger text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="hapus">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle text-xs font-weight-bold">
                                        2
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Spp 2022/2023
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        20 January 2030
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Bopak Mine

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp 200.000
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        <span class="badge text-uppercase badge-sm bg-gradient-warning">PENDING</span>

                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Routine

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Cash
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaction.show', 'Routine') }}"
                                            class="badge text-uppercase badge-sm bg-gradient-info text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>



                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-danger text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="hapus">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle text-xs font-weight-bold">
                                        3
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Daftar Ulang 2022/2023
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        20 January 2030
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Joko susilo

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp 200.000
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        <span class="badge text-uppercase badge-sm bg-gradient-danger">EXPIRED</span>
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Daftar ulang

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Cicil
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaction.show', 'DaftarUlang') }}"
                                            class="badge text-uppercase badge-sm bg-gradient-info text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>
                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-danger text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="hapus">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle text-xs font-weight-bold">
                                        4
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Tagihan Tingkatan
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        30 January 2050
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Bambang Jenoko

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp 850.000
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        <span class="badge text-uppercase badge-sm bg-gradient-danger">EXPIRED</span>
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        Tingkatan

                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Cash
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaction.show', 'Tingkatan') }}"
                                            class="badge text-uppercase badge-sm bg-gradient-info text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>
                                        <a href=""
                                            class="badge text-uppercase badge-sm bg-gradient-danger text-xxs mx-1"
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
