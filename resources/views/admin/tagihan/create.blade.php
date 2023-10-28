@extends('layouts.master')

@section('title', 'Profile')

@section('content')

    @if ($jenis_tagihan == 'Routine')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Create Tagihan Spp</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <label for="">Isi semua harga</label>
                <form onsubmit="return false">
                    <div class="d-flex align-items-center mb-3">
                        <input type="text" class="form-control rupiah" id="input_form" placeholder="Optional : 200.000">
                        <button class="btn btn-success ms-2 mb-0" id="tombol_form">Click</button>
                    </div>
                </form>
                <form action="{{ route('admin.tagihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="jenis_tagihan" value="{{ $jenis_tagihan }}">

                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase font-weight-bolder">No</th>
                                    <th class="text-center text-uppercase font-weight-bolder">Bulan</th>
                                    <th class="text-uppercase font-weight-bolder">Total harga</th>
                                    <th class="text-uppercase font-weight-bolder">Tenggat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-items-middle text-center">1</td>
                                    <td class="align-items-middle text-center">Agustus</td>
                                    <td><input type="text" placeholder="200.000" class="form-control hasil"></td>
                                    <td><input type="date" class="form-control" value="{{ date('Y') }}-08-30"></td>
                                </tr>
                                <tr>
                                    <td class="align-items-middle text-center">2</td>
                                    <td class="align-items-middle text-center">September</td>
                                    <td><input type="text" placeholder="200.000" class="form-control hasil"></td>
                                    <td><input type="date" class="form-control" value="{{ date('Y') }}-09-30"></td>
                                </tr>
                                <tr>
                                    <td class="align-items-middle text-center">3</td>
                                    <td class="align-items-middle text-center">Oktober</td>
                                    <td><input type="text" placeholder="200.000" class="form-control hasil"></td>
                                    <td><input type="date" class="form-control" value="{{ date('Y') }}-10-30"></td>
                                </tr>
                                <tr>
                                    <td class="align-items-middle text-center">4</td>
                                    <td class="align-items-middle text-center">November</td>
                                    <td><input type="text" placeholder="200.000" class="form-control hasil"></td>
                                    <td><input type="date" class="form-control" value="{{ date('Y') }}-11-30"></td>
                                </tr>
                                <tr>
                                    <td class="align-items-middle text-center">5</td>
                                    <td class="align-items-middle text-center">Desember</td>
                                    <td><input type="text" placeholder="200.000" class="form-control hasil"></td>
                                    <td><input type="date" class="form-control" value="{{ date('Y') }}-12-30"></td>
                                </tr>
                                <tr>
                                    <td class="align-items-middle text-center">6</td>
                                    <td class="align-items-middle text-center">Januari</td>
                                    <td><input type="text" placeholder="200.000" class="form-control hasil"></td>
                                    <td><input type="date" class="form-control" value="{{ date('Y') + 1 }}-01-30"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ul class="list-group">

                        <div class="form-group">
                            <label for="">Angkatan</label>
                            <select name="" id="" class="form-select">
                                <option selected>-- Pilih Angkatan --</option>
                                <option value="">2022 / 2023</option>
                                <option value="">2024 / 2025</option>
                                <option value="">2026 / 2027</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_jurusans">Jurusan</label>
                            <select name="" id="" class="form-select">
                                <option selected>-- Pilih Jurusan --</option>
                                <option value="">Bahasa Arab</option>
                                <option value="">Ilmu Fiqih</option>
                                <option value="">Tafsir</option>
                            </select>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                        </div>
                    </ul>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary end-0"><i class="fas fa-plus">
                            </i> Tambah</button>
                        <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($jenis_tagihan == 'Tidakroutine')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                        href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Create Tagihan Tidak routine</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <form action="{{ route('admin.tagihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="jenis_tagihan" value="{{ $jenis_tagihan }}">
                    <ul class="list-group">
                        <div class="form-group">
                            <label for="" class="form-control-label">Nama biaya</label>
                            <input type="text"
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                name="name" id="name" placeholder="Spp Tahun 2022">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Harga</label>
                            <input type="text"
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                name="name" id="amount" placeholder="Spp Tahun 2022">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Angkatan</label>
                            <select name="" id="" class="form-select">
                                <option selected>-- Pilih Angkatan --</option>
                                <option value="">2022 / 2023</option>
                                <option value="">2024 / 2025</option>
                                <option value="">2026 / 2027</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_jurusans">Jurusan</label>
                            <select name="" id="" class="form-select">
                                <option selected>-- Pilih Jurusan --</option>
                                <option value="">Bahasa Arab</option>
                                <option value="">Ilmu Fiqih</option>
                                <option value="">Tafsir</option>
                            </select>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                        </div>
                    </ul>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary end-0"><i class="fas fa-plus">
                            </i> Tambah</button>
                        <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($jenis_tagihan == 'DaftarUlang')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                        href="{{ route('dashboard') }}">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Create Tagihan Daftar ulang</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <form action="{{ route('admin.tagihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="jenis_tagihan" value="{{ $jenis_tagihan }}">

                    <ul class="list-group">
                        <div class="form-group">
                            <label for="" class="form-control-label">Harga</label>
                            <input type="text"
                                class="form-control @error('name')
                        is-invalid
                    @enderror"
                                name="name" id="amount" placeholder="Spp Tahun 2022">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Angkatan</label>
                            <select name="" id="" class="form-select">
                                <option selected>-- Pilih Angkatan --</option>
                                <option value="">2022 / 2023</option>
                                <option value="">2024 / 2025</option>
                                <option value="">2026 / 2027</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_jurusans">Jurusan</label>
                            <select name="" id="" class="form-select">
                                <option selected>-- Pilih Jurusan --</option>
                                <option value="">Bahasa Arab</option>
                                <option value="">Ilmu Fiqih</option>
                                <option value="">Tafsir</option>
                            </select>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                        </div>
                    </ul>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary end-0"><i class="fas fa-plus">
                            </i> Tambah</button>
                        <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script type="text/javascript">
        document.getElementById("tombol_form").addEventListener("click", tampilkan_nilai_form);

        function tampilkan_nilai_form() {
            event.preventDefault();
            var nilai_form = document.getElementById("input_form").value;
            const hasil = document.querySelectorAll('.hasil');
            for (var i = 0; i < hasil.length; i++) {
                hasil[i].setAttribute('value', nilai_form);
                hasil[i].value = nilai_form;
            }
        }
    </script>
@endpush
