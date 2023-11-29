@extends('layouts.master')

@section('title', 'table template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Mata Pelajaran (Kursus)</h6>
                    <a href="{{ route('admin.mapel.create') }}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7 text-center">Nama Mata Pelajaran</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7 text-center">Nama Kursus</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Mulai - Selesai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Hari</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapel as $index => $mapels)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-bold">{{ $index + 1 }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-bold">{{ $mapels->name }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-bold">{{ $mapels->kursus->name  }}</span>
                                        </td>
                                        <td class="align text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><strong>{{ $mapels->mulai }} WIB</strong> - <strong>{{ $mapels->selesai }} WIB</strong> </span>
                                        </td>
                                        <td class="align text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><strong>{{ $mapels->hari }}</strong></span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.mapel.show', $mapels->id) }}" class="badge badge-sm bg-gradient-info font-weight-bold text-xxs">
                                                <strong>Detail</strong>
                                            </a>

                                            <a href="{{ route('admin.mapel.edit', $mapels->id) }}" class="badge badge-sm bg-gradient-secondary font-weight-bold text-xxs mx-1">
                                                <strong>Edit</strong>
                                            </a>

                                            <form action="{{ Route('admin.mapel.destroy' , $mapels->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-sm border-0 bg-gradient-danger font-weight-bold text-xxs show_confirm"
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
                text: "Kamu Akan Menghapus Mata Pelajaran!!",
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
                        'Kamu telah menghapus Mata Pelajaran!!.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
