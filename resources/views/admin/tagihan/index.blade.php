@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Tagihan</h6>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    >Tambah <i class="fas fa-plus me-1"></i></button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Tagihan</h5>
                                    <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                </div>
                                <form action="{{ route('admin.tagihan.next') }}" method="GET">
                                    <div class="modal-body">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="spp" value="rutin">
                                            <label class="custom-control-label" for="spp">Spp</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="biaya_lain" value="tidak-rutin">
                                            <label class="custom-control-label" for="biaya_lain">Biaya Lain</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="daftar_ulang" value="daftar-ulang">
                                            <label class="custom-control-label" for="daftar_ulang">Daftar Ulang</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="tingkatan" value="tingkatan">
                                            <label class="custom-control-label" for="tingkatan">Tingkatan</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn bg-gradient-primary" type="submit">
                                            Lanjut <i class="fas fa-arrow-circle-right ms-1"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Id</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Nama Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-8">Angkatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Jurusan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Program Belajar</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Created at</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Jenis tagihan</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
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
        const dataTableBasic = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
@endpush
