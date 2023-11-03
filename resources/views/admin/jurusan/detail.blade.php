@extends('layouts.master')

@section('title', 'Matkul')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <h4 class="ms-2">{{ $jurusan->name }}</h4>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mata Kuliah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <select name="id_jurusans" id="id_jurusans" class="form-control" required>
                                    <option disabled selected>-----------</option>
                                    @foreach ($jurusanAll as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_semesters">Semester</label>
                                <select name="id_semesters" id="id_semesters" class="form-control" required>
                                    <option disabled selected>-----------</option>

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
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('admin.jurusan.show', $jurusan->id) }}">
                                <button type="button" class="btn btn-warning text-dark">Back</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($semester as $semesters)
            <div class="col-12 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <div>
                            <h6>{{ $semesters->name }}</h6>
                        </div>
                        <div class="flex-row d-flex">
                            <a href="#" class="btn btn-primary fs-6 p-2 px-3" data-bs-toggle="modal"
                                data-bs-target="#myModal">
                                +
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="templateTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                            Mata Kuliah</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                            Mulai</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Selesai</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matkuls->where('id_semesters', $semesters->id) as $matkul)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm ms-2">{{ $matkul->nama_matkuls }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-text-start">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $matkul->mulai }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $matkul->selesai }}</p>
                                            </td>
                                            <td class="align-text-center text-sm">
                                                {{-- <span class="text-bold">{{ \Carbon\Carbon::parse($tahunAjarans->end_at)->format('d F') }}</span> --}}
                                                <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($matkul->tanggal)->format('d F Y') }}</p>
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
    </div>


    </div>
@endsection
