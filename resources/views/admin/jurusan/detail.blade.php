@extends('layouts.master')

@section('title', 'Jurusan')

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
    <div class="row">
        <h4 class="ms-2">{{ $jurusan->name }}</h4>
        @foreach ($semester as $semesters)
            <!-- ... bagian lainnya ... -->
            <div class="modal fade" id="tambahMatkulModal{{ $semesters->id }}" tabindex="-1"
                aria-labelledby="tambahMatkulModalLabel{{ $semesters->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahMatkulModalLabel{{ $semesters->id }}">Tambah Mata Kuliah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.matkul.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_jurusans" value="{{ $jurusan->id }}">
                                <input type="hidden" name="id_semesters" value="{{ $semesters->id }}">
                                <div class="form-group mb-3">
                                    <label for="nama_matkuls">Nama</label>
                                    <input type="text" name="nama_matkuls" id="nama_matkuls" class="form-control">
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
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <div>
                            <h6>{{ $semesters->name }}</h6>
                        </div>
                        <div class="flex-row d-flex">
                            <button type="button" class="btn btn-primary fs-6 p-2 px-3" data-bs-toggle="modal"
                                data-bs-target="#tambahMatkulModal{{ $semesters->id }}">
                                +
                            </button>
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
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ \Carbon\Carbon::parse($matkul->tanggal)->format('d F Y') }}</p>
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
