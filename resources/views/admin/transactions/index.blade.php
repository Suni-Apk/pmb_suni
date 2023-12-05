@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
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
                        <a href="{{ route('admin.transaksi.create') }}" class="btn bg-gradient-primary">Tambah +</a>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        PROGRAM BELAJAR
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
                                @foreach ($transaction as $index => $transactions)
                                    <tr>
                                        <td><input type="checkbox" name="ids" id="" class="checksAll"
                                                value="{{ $transactions->id }}"></td>
                                        <td class="align-middle text-xs font-weight-bold">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold">
                                            {{ $transactions->jenis_tagihan }}
                                        </td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold">
                                            {{ \Carbon\Carbon::parse($transactions->created_at)->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            {{ $transactions->user->name ?? 'User Sudah tidak ada' }}
                                        </td>
                                        <td class="align-middle text-secondary text-xs font-weight-bold">
                                            Rp. {{ number_format($transactions->total) }},-
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            {{ $transactions->program_belajar }}
                                        </td>
                                        <td class="align-middle  text-secondary font-weight-bold">
                                            @if (strtolower($transactions->status) === 'berhasil')
                                                <span class="badge text-uppercase badge-sm bg-gradient-success">
                                                    SUCCESS
                                                </span>
                                            @elseif ($transactions->status == 'pending')
                                                @php
                                                    $now = now();
                                                    $paymentTime = \Carbon\Carbon::parse($transactions->created_at); // Gantilah 'payment_time' dengan kolom waktu pembayaran yang sesuai
                                                    $expirationTime = $paymentTime->addHours(24);

                                                    if ($now->greaterThan($expirationTime)) {
                                                        $status = 'EXPIRED';
                                                        $badgeClass = 'bg-gradient-danger';
                                                    } else {
                                                        $status = 'PENDING';
                                                        $badgeClass = 'bg-gradient-warning';
                                                    }
                                                @endphp
                                                <span class="badge text-uppercase badge-sm {{ $badgeClass }}">
                                                    {{ $status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Tidak Rutin</p>
                                            <p class="text-xs text-uppercase text-secondary mb-0">
                                                {{ $transactions->jenis_pembayaran }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.transaksi.show', 'DaftarUlang', $transactions->id) }}"
                                                class="badge badge-sm bg-gradient-info font-weight-bold text-xxs mx-1"
                                                data-toggle="tooltip" data-original-title="detail">
                                                Detail
                                            </a>
                                            <form action="{{ route('admin.transaksi.destroy', $transactions->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="badge badge-sm bg-gradient-danger border-0 font-weight-bold text-xxs show_confirm">HAPUS</button>
                                            </form>
                                            {{-- <a href=""
                                                class="badge badge-sm bg-gradient-danger font-weight-bold text-xxs show_confirm"
                                                data-toggle="tooltip" data-original-title="hapus">
                                                Hapus
                                            </a> --}}
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
                        title: "Apakah Anda Yakin Ingin Menghapus Transaction?",
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
