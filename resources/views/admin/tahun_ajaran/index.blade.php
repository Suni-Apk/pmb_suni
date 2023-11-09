@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Tahun Ajaran</h6>
                    <a href="{{route('admin.tahun_ajaran.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">id</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">angkatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Mulai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Selesai</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7 text-center">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tahun_ajaran as $index => $angkatans)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-bold">{{ $index + 1 }}</span>
                                        </td>
                                        <td class="align-middle text-start text-sm">
                                            <span class="text-bold">{{ $angkatans->year }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span class="text-bold">{{ \Carbon\Carbon::parse($angkatans->start_at)->format('d F') }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span class="text-bold">{{ \Carbon\Carbon::parse($angkatans->end_at)->format('d F') }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($angkatans->status == 'nonActive')
                                                <span class="text-uppercase badge badge-sm bg-gradient-danger">{{ $angkatans->status }}</span>
                                            @else
                                                <span class="text-uppercase badge badge-sm bg-gradient-success">{{ $angkatans->status }}</span>
                                            @endif
                                        </td>
                                        <td class="d-flex align-items-center justify-content-center">                   
                                            <form action="{{ route('admin.tahun_ajaran.active',$angkatans->id) }}" method="POST">
                                                @csrf
                                                @if($angkatans->status == 'nonActive')
                                                    <button type="submit" class="btn btn-sm bg-gradient-success font-weight-bold text-xs mx-2 mt-3">
                                                        <strong>On</strong>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-sm bg-gradient-secondary font-weight-bold text-xs mx-2 mt-3">
                                                        <strong>Off</strong>
                                                    </button>
                                                @endif
                                            </form>

                                            <form action="{{ route('admin.tahun_ajaran.destroy',$angkatans->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm bg-gradient-danger font-weight-bold text-xs mx-2 show_confirm mt-3">
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
