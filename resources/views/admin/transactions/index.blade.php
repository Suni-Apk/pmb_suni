@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Transaksi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs  font-weight-bolder opacity-7">
                                        Nama Tagihan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Pembayaran
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pembayar
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Pembayaran
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis Tagihan / Pembayaran
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
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
                                        Rp. 200.000,-
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        <span class="badge text-uppercase badge-sm bg-gradient-success">SUCCESS</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Tidak Rutin</p>
                                        <p class="text-xs text-uppercase text-secondary mb-0">CASH</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaksi.show', 'tingkatan') }}"
                                            class="btn btn-sm bg-gradient-info font-weight-bold text-xs mx-2 show_confirm mt-3"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>
                                        <a href=""
                                            class="btn btn-sm bg-gradient-danger font-weight-bold text-xs show_confirm mt-3"
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
                                        Rp. 200.000,-
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        <span class="badge text-uppercase badge-sm bg-gradient-warning">PENDING</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Rutin</p>
                                        <p class="text-xs text-uppercase text-secondary mb-0">CASH</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaksi.show', 'tingkatan') }}"
                                            class="btn btn-sm bg-gradient-info font-weight-bold text-xs mx-2 show_confirm mt-3"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>
                                        <a href=""
                                            class="btn btn-sm bg-gradient-danger font-weight-bold text-xs show_confirm mt-3"
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
                                        Rp. 200.000,-
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        <span class="badge text-uppercase badge-sm bg-gradient-danger">EXPIRED</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Daftar Ulang</p>
                                        <p class="text-xs text-uppercase text-secondary mb-0">CASH</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaksi.show', 'tingkatan') }}"
                                            class="btn btn-sm bg-gradient-info font-weight-bold text-xs mx-2 show_confirm mt-3"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>
                                        <a href=""
                                            class="btn btn-sm bg-gradient-danger font-weight-bold text-xs show_confirm mt-3"
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
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Tingkatan</p>
                                        <p class="text-xs text-uppercase text-secondary mb-0">CASH</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaksi.show', 'tingkatan') }}"
                                            class="btn btn-sm bg-gradient-info font-weight-bold text-xs mx-2 show_confirm mt-3"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>
                                        <a href=""
                                            class="btn btn-sm bg-gradient-danger font-weight-bold text-xs show_confirm mt-3"
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
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Yakin?',
                text: "Kamu Akan Menghapus Data Transaksi!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya,  Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Terhapus!',
                        'Kamu telah menghapus Data Transaksi!!.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
