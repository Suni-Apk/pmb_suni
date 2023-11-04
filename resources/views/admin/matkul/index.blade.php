@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tabel Mata Kuliah</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        id</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Nama Matkul</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Jurusan & Semester</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Mulai</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Selesai</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Tanggal</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Created By</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-bold">1</span>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <span class="text-bold">Fiqih Muamalah</span>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Hukum Ekonomi Syariah</h6>
                                                <p class="text-xs text-secondary mb-0">Semester 5</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align text-center">
                                        <span class="text-secondary text-xs font-weight-bold">06:00</span>
                                    </td>

                                    <td class="align text-center">
                                        <span class="text-secondary text-xs font-weight-bold">17:30</span>
                                    </td>

                                    <td class="align text-center">
                                        <span class="text-secondary text-xs font-weight-bold">15/05/2023</span>
                                    </td>

                                    <td class="align text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Admin</span>
                                    </td>
                                    <td class="d-flex align-items-center justify-content-center">
                                        <a href="{{ route('admin.matkul.show', 1) }}"
                                            class="btn btn-sm bg-gradient-success font-weight-bold text-xs mx-2 mt-3">
                                            <i class="fas fa-eye fs-6"></i>
                                        </a>

                                        <a href="{{ route('admin.matkul.edit', 1) }}"
                                            class="btn btn-sm bg-gradient-secondary font-weight-bold text-xs mx-2 mt-3">
                                            <i class="fas fa-edit fs-6"></i>
                                        </a>

                                        <form action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm bg-gradient-danger font-weight-bold text-xs mx-2 show_confirm mt-3">
                                                <i class="fa fa-trash fs-6 show_confirm"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
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
