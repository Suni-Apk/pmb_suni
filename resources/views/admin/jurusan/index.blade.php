@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Jurusan table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tahun Ajaran</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jurusan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Code</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurusan as $index => $jurusans)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-bold">{{ $index + 1 }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-bold">{{ $jurusans->tahunAjaran->year }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-bold">{{ $jurusans->name }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-bold">{{ $jurusans->code }}</span>
                                        </td>
                                        <td class="d-flex align-items-center justify-content-center">
                                            <a href="{{ route('admin.jurusan.show', $jurusans->id) }}"
                                                class="btn btn-sm bg-gradient-success font-weight-bold text-xs mx-2 mt-3">
                                                <i class="fas fa-eye fs-6"></i>
                                            </a>

                                            <a href="{{ route('admin.jurusan.edit', $jurusans->id) }}"
                                                class="btn btn-sm bg-gradient-secondary font-weight-bold text-xs mx-2 mt-3">
                                                <i class="fas fa-edit fs-6"></i>
                                            </a>

                                            <form action="{{ route('admin.jurusan.destroy', $jurusans->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm bg-gradient-danger font-weight-bold text-xs mx-2 show_confirm mt-3">
                                                    <i class="fa fa-trash fs-6"></i>
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
        const dataTableSearch = new simpleDatatables.DataTable("#templateTableNoSearch", {
            searchable: false,
            fixedHeight: true,
        });

        const dataTableBasic = new simpleDatatables.DataTable("#templateTable", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
<<<<<<< HEAD
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
                text: "Kamu Akan Menghapus Jurusan!!",
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
                        'Kamu telah menghapus Jurusan!!.',
                        'success'
                    )
                }
            });
        });
    </script>
@endpush
