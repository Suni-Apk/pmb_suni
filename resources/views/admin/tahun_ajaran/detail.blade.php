@extends('layouts.master')

@section('title', 'Jurusan')

@push('styles')
    <style>
        .title-item::after {
            content: 'detail';
            transition: all .2s ease-in-out;
            margin-left: .3rem;
            opacity: 0;
            font-weight: light;
            font-style: italic;
            letter-spacing: .01rem;
            font-size: 10px;
            color: rgb(45, 219, 45);
            display: inline-block;
        }
        .title-item { transition: all .2s ease-in-out; padding: 0 10px 0 3px; border-radius: 4px; }
        .title-item:hover { background: #314067; color: #fff;
        }
        .title-item:hover.title-item::after { transition: all .2s ease-in-out; opacity: 1; }
    </style>
@endpush


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
        toastr.success("{{ Session::get('success') }}")
    @endif

    @if (Session::has('delete'))
        toastr.success("{{ Session::get('success') }}")
    @endif

    @if (Session::has('pesan'))
        toastr.error("{{ Session::get('pesan') }}")
    @endif
</script>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 container">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Detail Tahun Ajaran</h6>
                    <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary">Back</a>
                </div>
                <hr class="horizontal dark">
                <div class="card-body pt-0 table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Tahun Ajaran</td>
                                <td>:</td>
                                <td style="font-size: 1.3rem" class="font-weight-bolder">{{ $angkatan->year }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td class="font-weight-normal">
                                    <span class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs"
                                    >{{ $angkatan->status == 'Active' ? 'Aktif' : 'Non Aktif' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Mulai Pendaftaran</td>
                                <td>:</td>
                                <td class="font-weight-normal">{{ \Carbon\Carbon::parse($angkatan->start_at)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Selesai Pendaftaran</td>
                                <td>:</td>
                                <td class="font-weight-normal">{{ \Carbon\Carbon::parse($angkatan->end_at)->format('d F Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Jurusan</h6>
                    <div>
                        <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modalLink">Tambah +</button>

                        <div class="modal fade text-start" id="modalLink" tabindex="-1" role="dialog"
                            aria-labelledby="modalLinkLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLinkLabel">Tambah Jurusan</h5>
                                            <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <form action="{{ route('admin.jurusan.store') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="name">Nama Jurusan</label>
                                                    <select name="jurusan" id="jurusan" class="form-control">
                                                        <option value="" selected disabled>-- Pilih Jurusan --</option>
                                                        @foreach ($jurusan as $j)
                                                            <option value="{{ $j->id }}">{{ $j->name }}</option>
                                                        @endforeach
                                                    </select>
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
                    </div>
                </div>
                <hr class="horizontal dark">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($links->where('id_tahun_ajarans', $angkatan->id) as $index => $link)
                                <tr>
                                    <td class="text-xs">
                                        {{ $link->name }}
                                    </td>
                                    <td class="text-xs">
                                        <a href="{{ route('admin.link.detail', $link->id) }}" class="badge badge-sm text-xxs bg-gradient-info">detail</a>
                                        <form action="{{ route('admin.link.destroy', $link->id) }}" method="POST" class="d-inline">
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

            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Detail Link</h6>
                    <div>
                        <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modalLink">Tambah +</button>

                        <div class="modal fade text-start" id="modalLink" tabindex="-1" role="dialog"
                            aria-labelledby="modalLinkLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLinkLabel">Tambah Link</h5>
                                            <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <form action="{{ route('admin.link.create.process') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-body">
                                                <input type="hidden" name="id_tahun_ajarans" value="{{ $angkatan->id }}">
                                                <div class="form-group mb-3">
                                                    <label for="name">Nama</label>
                                                    <small class="text-danger" style="font-size: 12px">*</small>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama linknya Disini" value="{{ old('name') }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="url">URL Link</label>
                                                    <small class="text-danger" style="font-size: 12px">*</small>
                                                    <input type="url" name="url" id="url" class="form-control" placeholder="Masukkan URL linknya Disini" {{ old('url') }}>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Tipe Link</label>
                                                    <small class="text-danger" style="font-size: 12px">*</small>
                                                    <div class="form-check">
                                                        <input type="radio" name="type" id="Whatsapp" class="form-check-input" value="Whatsapp">
                                                        <label class="form-check-label" for="Whatsapp">Whatsapp</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="type" id="Zoom" class="form-check-input" value="Zoom">
                                                        <label class="form-check-label" for="Zoom">Zoom</label>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
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
                    </div>
                </div>
                <hr class="horizontal dark">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">URL</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Jurusan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($links->where('id_tahun_ajarans', $angkatan->id) as $index => $link)
                                <tr>
                                    <td class="text-xs">
                                        {{ $link->name }}
                                    </td>
                                    <td class="text-xs">
                                        {{ $link->url }}
                                    </td>
                                    <td class="text-xs">
                                        @if ($link->id_jurusans)
                                            {{ $link->jurusan->name }}
                                        @else
                                            Tidak ada jurusan tertentu
                                        @endif
                                    </td>
                                    <td class="text-xs">
                                        {{ $link->type }}
                                    </td>
                                    <td class="text-xs">
                                        {{ $link->gender }}
                                    </td>
                                    <td class="text-xs">
                                        <a href="{{ route('admin.link.detail', $link->id) }}" class="badge badge-sm text-xxs bg-gradient-info">detail</a>
                                        
                                        <form action="{{ route('admin.link.destroy', $link->id) }}" method="POST" class="d-inline">
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
