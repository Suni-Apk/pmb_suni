@extends('layouts.master')

@section('title', 'Transaksi')

@push('styles')
@endpush

@section('content')
    @if (session('bayar'))
        <div class="alert alert-info text-white alert-dismissible fade show" role="alert">
            <strong>Pemberitahuan.</strong> {!! session('bayar') !!}
            <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @elseif (session('update'))
        <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> {!! session('update') !!}
            <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @elseif (session('notfound'))
        <div class="alert alert-warning text-white alert-dismissible fade show" role="alert">
            <strong>Sayangnya.</strong> {!! session('notfound') !!}
            <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Transaksi</h6>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.exportTransaction') }}" method="GET">
                            <input type="hidden" name="program_belajar" value="{{ $programBelajar }}">
                            <button class="btn btn-success ms-2 d-flex align-items-center">
                                <i class='bx bxs-file-export me-1'></i> Export
                            </button>
                        </form>                    
                    </div>
                </div>
                <form action="{{ route('admin.transaksi.index') }}" method="GET">
                    <div class="d-flex align-items-center justify-content-end">
                        <label for="program_belajar" class="ms-3">Program Belajar</label>
                        <select name="program_belajar" id="programbelajarSelect" class="form-control w-20 ms-4">
                            <option value="">--SEMUA--</option>
                            <option value="S1">S1</option>
                            <option value="KURSUS">KURSUS</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-xl-3 ms-3 me-3" id="searchButton">Cari</button>
                    </div>
                </form>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pilih
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs  font-weight-bolder opacity-7">
                                        Nama Tagihan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Pembayaran
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pembayar / Invoice
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Pembayaran
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        program
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis Tagihan / Pembayaran
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $item)
                                 
                                <tr>
                                    <td>
                                        <input type="checkbox" name="ids" id="" class="checksAll" value="{{ $item->id }}">
                                    </td>
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
                                        {{ $item->user?->name }}
                                        <span class="d-block fw-light text-truncate" style="max-width: 130px;">
                                            {{ $item->no_invoice }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp. {{ number_format($item->total,0,'','.') }},-
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        {{ $item->program_belajar }}
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        @if (strtolower($item->status) == 'berhasil')
                                        <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-success">{{ $item->status }}</span>
                                        @elseif (strtolower($item->status) == 'pending')
                                            @php
                                                $now = now();
                                                $created_at = \Carbon\Carbon::parse($item->created_at);
                                                $expired = $created_at->addHours(24);
                                            @endphp
                                            @if ($now->greaterThan($expired))
                                                <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-danger">expired</span>
                                            @else
                                                <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-warning">{{ $item->status }}</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->jenis_tagihan }}</p>
                                        <p class="text-xs text-uppercase text-secondary mb-0">{{ $item->jenis_pembayaran }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaksi.show', $item->id) }}"
                                            class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>

                                        <button class="border-0 badge badge-sm text-xxs font-weight-bolder bg-gradient-secondary mx-1" role="button" data-bs-toggle="modal" data-bs-target="#modalEditStatus{{ $item->id }}">Edit</button>

                                        {{-- modal edit status --}}
                                        <div class="modal fade" id="modalEditStatus{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="modalEditStatus{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title" id="modalEditStatus{{ $item->id }}Label">Edit Status Transaksi</h5>
                                                        <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <div class="modal-body pt-0">
                                                        <form action="{{ route('admin.transaksi.update', $item->id) }}" method="POST" class="form-group">
                                                            @csrf
                                                            @method('PUT')
                                                            <label for="status" class="w-100 text-start">Status Transaksi</label>
                                                            <select name="status" id="status" class="form-select">
                                                                <option disabled>Ubah status transaksi</option>
                                                                <option value="berhasil" @selected($item->status == 'berhasil')>BERHASIL</option>
                                                                <option value="pending" @selected($item->status == 'pending')>PENDING</option>
                                                                <option value="expired" @selected($item->status == 'expired')>EXPIRED</option>
                                                            </select>
                                                            <hr class="horizontal dark">
                                                            <button type="submit" class="btn bg-gradient-primary float-end">Update <i class="fas fa-check ms-1"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('admin.transaksi.destroy', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                class="badge badge-sm border-0 bg-gradient-danger font-weight-bolder text-xxs show_confirm"
                                                data-toggle="tooltip" data-original-title="hapus">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex ms-4 mb-4 mt-3">
                        <input type="checkbox" id="select_all_ids" class="chek me-2">
                        <a href="#ClikKabeh" id="ClikKabeh" class="text-secondary">Pilih Semua</a>
                        <div class=" ms-4">
                            <i class="fas fa-trash me-1 cursor-pointer" style="color: #ff0000;" id="deleteAll"></i>
                            <a href="#" class="text-secondary" id="All">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <script>
        $(function(e) {
            $("#ClikKabeh").click(function() {
                $('.checksAll, #select_all_ids').prop('checked', function() {
                    return !$(this).prop("checked");
                });
            });
            $("#select_all_ids").click(function() {
                $('.checksAll').prop('checked', $(this).prop('checked'));
            });
            $("#All").click(function() {
                $('#deleteAll').click();
            });

            $("#deleteAll").click(function(e) {
                e.preventDefault();
                var all_ids = [];

                $('input:checkbox[name="ids"]:checked').each(function() {
                    all_ids.push($(this).val());
                });
                if ($('.checksAll').is(':checked')) {
                    Swal.fire({
                        title: "Apakah Anda Yakin Ingin Menghapus Tagihan?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('admin.transaksi.delete.all') }}",
                                type: "DELETE",
                                data: {
                                    ids: all_ids
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(response) {
                                    // Handle response jika diperlukan
                                    // Misalnya, menampilkan pesan sukses
                                    // Lakukan reload halaman setelah permintaan AJAX selesai

                                },
                                error: function(xhr, status, error) {
                                    // Handle error jika diperlukan

                                }
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then((result) => {});
                        }
                    });
                }
                if (!$('.checksAll').is(':checked')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pilih Minimal 1!',
                    })
                }

            });
        });
    </script>
@endpush
