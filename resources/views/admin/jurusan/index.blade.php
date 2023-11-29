@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Jurusan</h6>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.exportJurusan') }}" method="GET">
                            <button class="btn btn-success ms-2 d-flex align-items-center">
                                <i class='bx bxs-file-export me-1'></i> Export
                            </button>
                        </form>     
                        <a href="{{ route('admin.jurusan.create') }}" class="btn bg-gradient-primary float-end">Tambah + </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width: 25px">No</th>
                                    <th
                                        class="text-uppercase text-start text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama</th>
                                    <th
                                        class="text-uppercase text-start text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kode</th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurusan as $index => $jurusans)
                                    <tr>
                                        <td class="text-center">
                                            <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                        </td>
                                        <td class="text-sm">
                                            <span class="text-bold">{{ $jurusans->name }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span class="font-weight-bold">{{ $jurusans->code }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.jurusan.show', $jurusans->id) }}"
                                                class="badge badge-sm bg-gradient-info font-weight-bold text-xxs"
                                                data-toggle="tooltip" data-original-title="detail">
                                                Detail
                                            </a>

                                            <a href="{{ route('admin.jurusan.edit', $jurusans->id) }}"
                                                class="badge badge-sm bg-gradient-secondary font-weight-bold text-xxs mx-1"
                                                data-toggle="tooltip" data-original-title="edit">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.jurusan.destroy', $jurusans->id) }}" class="d-inline"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-sm border-0 bg-gradient-danger font-weight-bold text-xxs">
                                                    <strong>Hapus</strong>
                                                </button>
                                            </form>
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
        const dataTableBasic = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
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
            toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            toastr.success("{{ Session::get('success') }}")
        @endif
        @if (Session::has('delete'))
            toastr.success("{{ Session::get('success') }}")
        @endif
        @if (Session::has('pesan'))
            toast.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.error('{{ Session::get('pesan') }}')
        @endif
    </script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Yakin?',
                text: "Kamu Akan Menghapus Tahun Ajaran!!",
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
                        'Kamu telah menghapus Tahun Ajaran!!.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
