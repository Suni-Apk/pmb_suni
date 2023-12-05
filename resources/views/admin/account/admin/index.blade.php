@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Admin</h6>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.admin.exportAdmin') }}" method="GET">
                            <button class="btn btn-success ms-2 d-flex align-items-center show_confirm">
                                <i class='bx bxs-file-export me-1'></i> Export
                            </button>
                        </form>
                        <a href="{{ route('admin.admin.create') }}" class="btn bg-gradient-primary float-end">Tambah + </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pilih
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Nomor Telepon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gender / Role</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admin as $index => $item)
                                    <tr>
                                        <td>
                                            <div>
                                                <input type="checkbox" name="ids" id="" class="checksAll"
                                                    value="{{ $item->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->phone }}</span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->email }}</span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->gender }}</p>
                                            <p class="text-xs text-uppercase text-secondary mb-0">{{ $item->role }}</p>
                                        </td>
                                        <td>
                                            @if ($item->status == 'on')
                                                <span class="badge badge-sm bg-gradient-success">AKTIF</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">OFF</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a style="letter-spacing: .02rem" href=""
                                                class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs"
                                                data-toggle="tooltip" data-original-title="detail">
                                                Detail
                                            </a>

                                            <a style="letter-spacing: .02rem"
                                                href="{{ route('admin.admin.edit', $item->id) }}"
                                                class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs mx-1"
                                                data-toggle="tooltip" data-original-title="edit">
                                                Ubah
                                            </a>

                                            @if (Auth::user()->id !== $item->id)
                                                <form action="{{ route('admin.admin.status', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    @if ($item->status == 'on')
                                                        <input type="hidden" name="status" value="off">
                                                        <button
                                                            class="badge badge-sm bg-red font-weight-bolder text-xxs ms-1 border-0"
                                                            type="submit">
                                                            OFF
                                                        </button>
                                                    @elseif($item->status == 'off')
                                                        <input type="hidden" name="status" value="on">
                                                        <button
                                                            class="badge badge-sm bg-teal font-weight-bolder text-xxs ms-1 border-0"
                                                            type="submit">
                                                            ON
                                                        </button>
                                                    @endif
                                                </form>

                                                <form action="{{ route('admin.admin.delete', $item->id) }}"
                                                    class="d-inline" id="form1" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="badge badge-sm bg-red font-weight-bolder text-xxs ms-1 border-0"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">Delete</button>
                                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Warning!!!! <i
                                                                            class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <i
                                                                        class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                                                    Apakah Anda Yakin Ingin Melakukan Penghapusan Admin?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Lanjut</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex ms-4 mb-4 mt-3">
                        <input type="checkbox" id="select_all_ids" class="chek me-2">
                        <a href="#" id="ClikKabeh" class="text-secondary">Pilih Semua</a>
                        <div class=" ms-4">
                            <i class="fas fa-trash me-1 cursor-pointer" style="color: #ff0000;" id="deleteAll"></i>
                            <a href="#" class="text-secondary" id="All">Hapus</a>
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil!',
                "{{ session('success') }}", // Menggunakan session('success') untuk mengambil pesan
                'success'
            )
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire(
                'Gagal!',
                "{{ session('error') }}", // Menggunakan session('success') untuk mengambil pesan
                'error'
            )
        </script>
    @endif
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
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
                                url: "{{ route('admin.admin.delete.all') }}",
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

                                    location.reload();
                                }
                            });
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
