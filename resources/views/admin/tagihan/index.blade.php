@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                            href="{{ route('dashboard') }}">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transactions</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Semua Data Tagihan</h6>
            </nav>
            <div class="card mb-4 mt-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Tagihan table</h6>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm bg-gradient-primary py-2 px-3 text-xs" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="fas fa-plus me-1"></i> Tambah tagihan
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Tagihan</h5>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.tagihan.next') }}" method="GET">
                                    <div class="modal-body">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="jenis_tagihan" value="Routine">
                                            <label class="custom-control-label" for="customRadio1">Spp</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="customRadio1" value="Tidakroutine">
                                            <label class="custom-control-label" for="customRadio1">Biaya Lain</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="customRadio1" value="DaftarUlang">
                                            <label class="custom-control-label" for="customRadio1">Daftar Ulang</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="customRadio1" value="Tingkatan">
                                            <label class="custom-control-label" for="customRadio1">Tingkatan</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button> --}}
                                        <button class="btn bg-gradient-primary" type="submit">Lanjut <i
                                                class="fas fa-arrow-circle-right ms-1"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-8">
                                        Nama
                                        Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xs px-2 font-weight-bolder opacity-8">
                                        Tahun / Angkatan</th>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-8">
                                        Jurusan / Prodi</th>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-8">
                                        Program Belajar</th>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-8">
                                        Created</th>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-8">
                                        Jenis tagihan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($biaya as $key => $biayas)
                                    <tr>
                                        <td class="align-middle text-xs font-weight-bold">{{ $key + 1 }}</td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            <strong>{{ $biayas->nama_biaya }}</strong>
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            {{ $biayas->tahunAjaran->year }}
                                        </td>

                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            {{ $biayas->jurusans->name ?? 'Tidak Ada Jurusan' }}

                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            <strong>{{ $biayas->program_belajar }}</strong>
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            {{ \Carbon\Carbon::parse($biayas->created_at)->format('d/m/y H:i:s') }}
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            <strong>{{ $biayas->jenis_biaya }}</strong>

                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.tagihan.show', $biayas->id) }}"
                                                class="badge text-uppercase badge-sm bg-gradient-info text-xxs mx-1"
                                                data-toggle="tooltip" data-original-title="detail">
                                                Detail
                                            </a>

                                            <a href="{{ route('admin.tagihan.edit', $biayas->id) }}"
                                                class="badge text-uppercase badge-sm bg-gradient-secondary text-xxs mx-1"
                                                data-toggle="tooltip" data-original-title="Edit">
                                                Ubah
                                            </a>
                                            <form action="{{ route('admin.tagihan.destroy', $biayas->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="badge border-0 text-uppercase badge-sm bg-gradient-danger text-xxs mx-1"
                                                    data-toggle="tooltip" data-original-title="hapus" type="submit">
                                                    Hapus
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
        const dataTableBasic = new simpleDatatables.DataTable("#templateTable", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
@endpush
