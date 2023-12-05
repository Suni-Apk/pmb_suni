@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Kursus</h6>
                    <a href="{{route('admin.course.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama Kursus</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Catatan</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course as $keys => $value)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $keys + 1 }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $value->name }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-secondary text-xs font-weight-normal">
                                                <ul class="mb-0">
                                                    @if (empty($value->notes))
                                                        ~ Tidak ada catatan ~
                                                    @else
                                                        @foreach ($value->notes as $item)
                                                            @if (!is_null($item))
                                                                <li>{{ $item }}</li>
                                                            @else
                                                                <p class="mb-0 text-xs text-center">~ Tidak ada catatan ~</p>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button type="button" class="badge badge-sm border-0 bg-gradient-info me-1 font-weight-bolder" 
                                            data-bs-toggle="modal" data-bs-target="#modalLink{{ $value->id }}">Link <i class="fas fa-link ms-1"></i></button>

                                            <a href="{{ route('admin.course.show', $value->id) }}"
                                                class="badge badge-sm bg-gradient-warning font-weight-bolder text-xxs me-1"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Detail
                                            </a>
                                            <a href="{{ route('admin.course.edit', $value->id) }}"
                                                class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs me-1"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.course.destroy', $value->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn badge badge-sm bg-gradient-danger font-weight-bolder text-xxs"
                                                    data-toggle="tooltip" data-original-title="Delete">Delete</button>
                                            </form>

                                            <div class="modal fade text-start" id="modalLink{{ $value->id }}" tabindex="-1" role="dialog"
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
                                                                                <option value="{{ $item->id }}">{{ $item->year }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-6">
                                                                        <label for="id_courses">Kursus</label>
                                                                        <small class="text-danger" style="font-size: 12px">*</small>
                                                                        <select name="id_courses" id="id_courses" class="form-select" required>
                                                                            <option disabled selected>-----------</option>
                                                                            @foreach ($course as $item)
                                                                                <option value="{{ $item->id }}" {{ $value->id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
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
        const dataTableSearch = new simpleDatatables.DataTable("#templateTable", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
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

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}")
        @endif
    </script>
@endpush
