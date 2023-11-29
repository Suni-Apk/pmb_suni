@extends('layouts.master')

@section('title', 'Link Whatsapp')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Link Whatsapp</h6>
                    <a href="{{ route('admin.link.create') }}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Nama Link</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Url</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Tahun Ajaran /Jurusan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Gender</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($link as $index => $links)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-bold">{{ $index + 1 }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span class="text-bold">{{ $links->name }}</span>
                                        </td>
                                        <td class="text-xs">
                                            <span class="text-bold">{{ $links->url }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex flex-column justify-content-center">
                                                    @if ($links->jurusan)
                                                    <h6 class="mb-0 text-xs text-uppercase"> {{ $links->jurusan->name }} </h6>
                                                    @else
                                                    <h6 class="mb-0 text-xs"> Tidak untuk jurusan tertentu </h6>
                                                    @endif
                                                    <h6 class="text-xxs text-uppercase text-secondary mb-0">{{ $links->tahunAjaran->year }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                @if ($links->gender == 'all')
                                                    Semua
                                                @else
                                                    {{ $links->gender }}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="align-center">
                                            <a href="{{ route('admin.link.detail', $links->id) }}" class="badge badge-sm bg-gradient-info font-weight-bold text-xxs">
                                                <strong>Detail</strong>
                                            </a>
                                            <a href="{{ route('admin.link.edit', ['type' => $links->type, 'id' => $links->id]) }}" class="badge badge-sm bg-gradient-secondary font-weight-bold text-xxs mx-1">
                                                <strong>Edit</strong>
                                            </a>

                                            <form action="{{ route('admin.link.destroy', $links->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-sm bg-gradient-danger font-weight-bold text-xxs border-0 show_confirm">
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
                text: "Kamu Akan Menghapus Links!!",
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
                        'Kamu telah menghapus Links!!.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
