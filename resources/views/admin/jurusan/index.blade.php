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
                                    <th class="text-uppercase text-start text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-start text-secondary text-xxs font-weight-bolder opacity-7">Tahun Ajaran</th>
                                    <th class="text-uppercase text-start text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurusan as $index => $jurusans)
                                    <tr>
                                        <td class="text-sm">
                                            <span class="text-bold">{{ $jurusans->name }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span class="font-weight-bold">{{ $jurusans->code }}</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="badge badge-sm border-0 bg-gradient-info me-1" 
                                            data-bs-toggle="modal" data-bs-target="#modalLink{{ $jurusans->id }}">Link <i class="fas fa-link ms-1"></i></button>
                                            
                                            <a href="{{ route('admin.jurusan.show', $jurusans->id) }}"
                                                class="badge badge-sm bg-gradient-warning font-weight-bold text-xxs"
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

                                            {{-- modal --}}
                                            <div class="modal fade text-start" id="modalLink{{ $jurusans->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="modalLinkLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLinkLabel">Tambah Link</h5>
                                                            <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                                        </div>
                                                        <form action="{{ route('admin.link.create.process') }}" method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">Nama</label>
                                                                    <small class="text-danger" style="font-size: 12px">*</small>
                                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama linknya Disini" value="{{ old('name') }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="url">URL Link</label>
                                                                    <small class="text-danger" style="font-size: 12px">*</small>
                                                                    <input type="url" name="url" id="url" class="form-control" placeholder="Masukkan URL linknya Disini" {{ old('url') }}>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Tipe Link</label>
                                                                    <small class="text-danger" style="font-size: 12px">*</small>
                                                                    <div class="form-check">
                                                                        <input type="radio" name="type" id="Whatsapp" class="form-check-input" value="whatsapp">
                                                                        <label class="form-check-label" for="Whatsapp">Whatsapp</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="radio" name="type" id="Zoom" class="form-check-input" value="zoom">
                                                                        <label class="form-check-label" for="Zoom">Zoom</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Gender</label>
                                                                    <small class="text-danger" style="font-size: 12px">*</small>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gender" id="ikhwan"
                                                                            value="ikhwan">
                                                                        <label class="form-check-label" for="ikhwan">
                                                                            Ikhwan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gender" id="akhwat"
                                                                            value="akhwat">
                                                                        <label class="form-check-label" for="akhwat">
                                                                            Akhwat
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gender" id="all"
                                                                            value="all">
                                                                        <label class="form-check-label" for="all">
                                                                            Semua (ditujukan untuk seluruh mahasiswa)
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-6">
                                                                        <label for="id_tahun_ajarans">Tahun Ajaran</label>
                                                                        <small class="text-danger" style="font-size: 12px">*</small>
                                                                        <select name="id_tahun_ajarans" id="id_tahun_ajarans" class="form-select" required>
                                                                            <option disabled selected>-----------</option>
                                                                            @foreach ($tahun_ajaran as $item)
                                                                                <option value="{{ $item->id }}" {{ $jurusans->tahunAjaran->id == $item->id ? 
                                                                                'selected' : '' }}>{{ $item->year }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-6">
                                                                        <label for="id_jurusans">Jurusan</label>
                                                                        <small class="text-danger" style="font-size: 12px">*</small>
                                                                        <select name="id_jurusans" id="id_jurusans" class="form-select" required>
                                                                            <option disabled selected>-----------</option>
                                                                            @foreach ($jurusan as $item)
                                                                                <option value="{{ $item->id }}" {{ $jurusans->id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn bg-gradient-primary" type="submit">
                                                                    Submit <i class="fas fa-arrow-circle-right ms-1"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
