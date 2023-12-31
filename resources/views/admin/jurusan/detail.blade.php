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
    <script>
        const jurusanSelect = document.getElementById('id_jurusans');
        const semesterSelect = document.getElementById('id_semesters');

        const jurusanSemesterMap = @json($semesterGrouped);

        jurusanSelect.addEventListener('change', () => {
            const selectedJurusanId = jurusanSelect.value;
            const semesterOptions = jurusanSemesterMap[selectedJurusanId] || [];

            semesterSelect.innerHTML = '';

            semesterOptions.forEach(semester => {
                const option = document.createElement('option');
                option.value = semester.id;
                option.textContent = semester.name;
                semesterSelect.appendChild(option);
            });
        });
    </script>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-11 d-flex justify-content-between align-items-center">
            <h4>{{ $jurusan->name }}</h4>

            <div class="">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addMatkul">
                    + Mata Kuliah
                </a>
            </div>
        </div>
        <div class="col-12 container mt-4">
            <div class="row flex-column justify-content-center align-items-start w-100">
                <div class="col-12" id="informasi">
                    <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                        <a id="list-sarjana-list" data-bs-toggle="list" href="#list-sarjana" role="tab" aria-controls="list-sarjana"
                            class="list-group-item list-group-item-action border-0 shadow text-center active" 
                        >Detail Jurusan</a>
                        <a id="list-kursus-list" data-bs-toggle="list" href="#list-kursus" role="tab" aria-controls="list-kursus"
                        class="list-group-item list-group-item-action border-0 shadow text-center" 
                        >Link</a>
                    </div>
                </div>
                <div class="col-12 py-3 px-4">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-sarjana" role="tabpanel" aria-labelledby="list-sarjana-list">
                            <div class="row">
                                @foreach ($semester as $semesters)
                                <div class="col-6 p-2">
                                    <div class="card">
                                        <div class="card-header pb-0 d-flex justify-content-between">
                                            <div>
                                                <h6>{{ $semesters->name }}</h6>
                                            </div>
                                        </div>
                                        <div class="card-body px-0 pt-0 pb-2">
                                            <div class="table-responsive p-0">
                                                <table class="table align-items-center mb-0" id="templateTable">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Nama Mata Kuliah
                                                            </th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Nama Dosen
                                                            </th>
                                                            <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                                                Mulai
                                                            </th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                Selesai
                                                            </th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Hari
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($matkuls->where('id_semesters', $semesters->id) as $matkul)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex py-1">
                                                                        <div class="d-flex flex-column justify-content-center">
                                                                            <a href="{{ route('admin.matkul.show', $matkul->id) }}" class="title-item font-weight-bold mb-0 text-sm ms-2">{{ $matkul->nama_matkuls }}</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="ps-4">
                                                                    <span class="text-secondary text-xs font-weight-bold"
                                                                    >{{ $matkul->nama_dosen }}</span>
                                                                </td>
                                                                <td class="align-text-start">
                                                                    <span class="text-secondary text-xs font-weight-bold"
                                                                    >{{ $matkul->mulai }}</span>
                                                                </td>
                                                                <td>
                                                                    <p class="text-xs font-weight-bold mb-0">{{ $matkul->selesai }}</p>
                                                                </td>
                                                                <td class="align-text-center text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0 ms-3">{{ $matkul->hari}}</p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @if ($jurusan->links)
                                    <div class="col-12 p-2">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <h5>Daftar Link</h5>
                                            </div>
                                            <div class="card-body pt-0 px-0">
                                                <div class="table-responsive p-0">
                                                    <table class="table align-items-center mb-0" id="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Nama Link</th>
                                                                <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Url</th>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Tahun Ajaran / Jurusan</th>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Gender</th>
                                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($links->where('id_jurusans', $jurusan->id) as $index => $item)
                                                                <tr>
                                                                    <td class="text-sm">
                                                                        <span class="text-bold">{{ $item->name }}</span>
                                                                    </td>
                                                                    <td class="text-xs">
                                                                        <span class="text-bold">{{ $item->url }}</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="d-flex flex-column justify-content-center">
                                                                                @if ($item->jurusan)
                                                                                <h6 class="mb-0 text-xs text-uppercase"> {{ $item->jurusan->name }} </h6>
                                                                                @else
                                                                                <h6 class="mb-0 text-xs"> Semua jurusan </h6>
                                                                                @endif
                                                                                <h6 class="text-xxs text-uppercase text-secondary mb-0">{{ $item->tahunAjaran->year }}</h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="align text-center">
                                                                        <span class="text-secondary text-xs font-weight-bold">
                                                                            @if ($item->gender == 'all')
                                                                                Semua
                                                                            @else
                                                                                {{ $item->gender }}
                                                                            @endif
                                                                        </span>
                                                                    </td>
                                                                    <td class="align-center">
                                                                        <a href="{{ route('admin.link.detail', $item->id) }}" class="badge badge-sm bg-gradient-info font-weight-bold text-xxs">
                                                                            <strong>Detail</strong>
                                                                        </a>
                                                                        <a href="{{ route('admin.link.edit', ['type' => $item->type, 'id' => $item->id]) }}" class="badge badge-sm bg-gradient-secondary font-weight-bold text-xxs mx-1">
                                                                            <strong>Edit</strong>
                                                                        </a>
                            
                                                                        <form action="{{ route('admin.link.destroy', $item->id) }}" method="POST" class="d-inline">
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
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-kursus" role="tabpanel" aria-labelledby="list-kursus-list">
                            <div class="py-2">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h6>Tambah Link Baru</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.link.create.process') }}" method="post">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <label for="">Nama</label>
                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Url Link</label>
                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                <input type="url" class="form-control" name="url" id="url" value="{{ old('url') }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Tipe Link</label>
                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                <div class="form-check">
                                                    <input type="radio" name="type" id="whatsapp" class="form-check-input" value="whatsapp">
                                                    <label class="form-check-label" for="whatsapp">Whatsapp</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="type" id="zoom" class="form-check-input" value="zoom">
                                                    <label class="form-check-label" for="zoom">Zoom</label>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Gender</label>
                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" id="Laki-Laki"
                                                        value="Laki-Laki">
                                                    <label class="form-check-label" for="Laki-Laki">
                                                        Ikhwan
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" id="Perempuan"
                                                        value="Perempuan">
                                                    <label class="form-check-label" for="Perempuan">
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
                                            <div class="form-group mb-4">
                                                <label for="id_tahun_ajarans">Tahun Ajaran</label>
                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                <select name="id_tahun_ajarans" id="id_tahun_ajarans" class="form-select" required>
                                                    <option disabled selected>-----------</option>
                                                    @foreach ($tahun_ajaran as $item)
                                                        <option value="{{ $item->id }}">{{ $item->year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_jurusans">Jurusan</label>
                                                <select name="id_jurusans" id="id_jurusans" class="form-select">
                                                    <option selected disabled>-----------</option>
                                                    @foreach ($jurusanAll as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_courses">Kursus</label>
                                                <small class="text-info" style="font-size: 10px">Diisi ketika ingin menambahkan link untuk Kursus</small>
                                                <select name="id_courses" id="id_courses" class="form-select">
                                                    <option selected disabled value="">-----------</option>
                                                    @foreach ($kursus as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>                    
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="javascript:location.reload()" class="btn btn-warning">Reset</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="addMatkul">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mata Kuliah</h5>
                        <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.matkul.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama_matkuls">Nama</label>
                                <input type="text" name="nama_matkuls" id="nama_matkuls" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_jurusans">Jurusan</label>
                                <input type="hidden" value="{{ $jurusan->id }}" name="id_jurusans" id="id_jurusans">
                                <input type="text" value="{{ $jurusan->name }}" class="form-control" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_semesters">Semester</label>
                                <select name="id_semesters" id="id_semesters" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @foreach ($semester as $item)
                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_dosen">Dosen Pengajar</label>
                                <input type="text" name="nama_dosen" id="nama_dosen" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="mulai">Mulai</label>
                                <input type="time" name="mulai" id="mulai" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="selesai">Selesai</label>
                                <input type="time" name="selesai" id="selesai" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="hari">Hari</label>
                                <select name="hari" id="hari" class="form-control" required>
                                    <option hidden selected>-----------</option>
                                    <option value="Senin">Senin</option> 
                                    <option value="Selasa">Selasa</option> 
                                    <option value="Rabu">Rabu</option> 
                                    <option value="Kamis">Kamis</option> 
                                    <option value="Jumat">Jumat</option> 
                                    <option value="Sabtu">Sabtu</option> 
                                    <option value="Ahad">Ahad</option> 
                                </select>
                            </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endpush
@endsection
