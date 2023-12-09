@extends('layouts.master')

@section('title', 'table template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Mata Kuliah</h6>
                    <a href="{{ route('admin.matkul.create') }}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pilih</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Nama Matkul</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Jurusan / Semester</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Jadwal</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Hari</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matkuls as $index => $item)
                                    <tr>
                                        <td class="align-middle text-sm">
                                            <input type="checkbox" name="ids" id="" class="checksAll"
                                                value="{{ $item->id }}">
                                        </td>
                                        <td class="text-sm">
                                            <span class="text-bold">{{ $item->nama_matkuls }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs">{{ $item->jurusan->name }}</h6>
                                                    <p class="text-xxs text-uppercase text-secondary mb-0">
                                                        {{ $item->semesters->name }}</p>
                                                </div>
                                        </td>
                                        <td class="align text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->mulai }}
                                                <strong>WIB</strong> - {{ $item->selesai }} <strong>WIB</strong> </span>
                                        </td>
                                        <td class="align text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $item->hari }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.matkul.show' , $item->id) }}" class="badge badge-sm bg-gradient-info font-weight-bold text-xxs">
                                                <strong>Detail</strong>
                                            </a>

                                            <a href="{{ route('admin.matkul.edit', $item->id) }}" class="badge badge-sm bg-gradient-secondary font-weight-bold text-xxs mx-1">
                                                <strong>Edit</strong>
                                            </a>

                                        <form action="{{ route('admin.matkul.destroy', $item->id) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-sm border-0 bg-gradient-danger font-weight-bold text-xxs show_confirm" data-toggle="tooltip" data-original-title="hapus">
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
    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if (Session::has('delete'))
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if (Session::has('pesan'))
            toastr.error('{{ Session::get('pesan') }}')
        @endif
    </script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Yakin?',
                text: "Kamu Akan Menghapus Mata Kuliah!!",
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
                        'Kamu telah menghapus Mata Kuliah!!.',
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
                        title: "Apakah Anda Yakin Ingin Menghapus data mahasiswa?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('admin.matkul.delete.all') }}",
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
