@extends('layouts.master')

@section('title', 'table template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Mata Kuliah</h6>
                    <a href="{{route('admin.matkul.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Nama Matkul</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Jurusan / Semester</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Jadwal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Tanggal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matkuls as $index => $item)
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-bold">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="text-sm">
                                        <span class="text-bold">{{ $item->nama_matkuls }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">{{ $item->jurusan->name }}</h6>
                                                <p class="text-xxs text-uppercase text-secondary mb-0">{{ $item->semesters->name }}</p>
                                            </div>
                                        </td>
                                        <td class="align text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->mulai }} <strong>WIB</strong> - {{ $item->selesai }} <strong>WIB</strong> </span>
                                        </td>
                                        <td class="align text-center">
                                            <span class="text-secondary text-xs font-weight-bold"> {{ $item->hari }}</span>
                                        </td>
                                        <td class="d-flex align-items-center justify-content-center">
                                            <a href="{{ route('admin.matkul.show' , $item->id) }}" class="btn btn-sm bg-gradient-success font-weight-bold text-xs mx-2 mt-3">
                                                <strong>Detail</strong>
                                            </a>

                                            <a href="{{ route('admin.matkul.edit', $item->id) }}" class="btn btn-sm bg-gradient-secondary font-weight-bold text-xs mx-2 mt-3">
                                                <strong>Edit</strong>
                                            </a>

                                        <form action="{{ route('admin.matkul.destroy', $item->id) }}" style="margin-top: -4px;" class="d-inline" method="POST">
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
@endpush
