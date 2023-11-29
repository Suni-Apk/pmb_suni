@extends('layouts.master')

@section('title', 'Transaksi')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Transaksi</h6>
                    <a href="{{ route('admin.transaksi.create') }}" class="btn bg-gradient-primary">Tambah +</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table mb-0" id="templateTable">
                            <thead>
                                <tr>
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
                                @foreach ($transactions as $item)
                                 
                                <tr>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        @if ($item->tagihanDetails)
                                        {{$item->tagihanDetails->biayasDetail->nama_biaya}}
                                        @else
                                        {{ $item->jenis_tagihan }}
                                        @endif
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        <h6 class="mb-0 text-xs">{{ $item->created_at->format('d F Y') }}</h6>
                                        <p class="mb-0 text-xs">{{ $item->created_at->format('H:i:s') }}</p>
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        {{ $item->user->name }}
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp. {{ number_format($item->total,0,'','.') }},-
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        @if ($item->status == 'berhasil')
                                        <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-success">{{ $item->status }}</span>
                                        @elseif ($item->status == 'pending')
                                        <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-warning">{{ $item->status }}</span>
                                        @else
                                        <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-danger">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->jenis_tagihan }}</p>
                                        <p class="text-xs text-uppercase text-secondary mb-0">{{ $item->jenis_pembayaran }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaksi.show', 'tingkatan') }}"
                                            class="badge badge-sm bg-gradient-info font-weight-bold text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>
                                        <a href=""
                                            class="badge badge-sm bg-gradient-danger font-weight-bold text-xxs show_confirm"
                                            data-toggle="tooltip" data-original-title="hapus">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
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
