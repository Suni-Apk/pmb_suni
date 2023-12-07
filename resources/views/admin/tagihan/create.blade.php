@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    @error('error')
        {{ $message }}
    @enderror

    @if ($jenis_tagihan == 'Routine')
        <div class="card h-100 mt-4">
            <div class="card-header">
                <h6>Buat Tagihan</h6>
            </div>
            <div class="card-body p-3">
                <label for="">Isi semua harga</label>
                <form onsubmit="return false">
                    <div class="d-flex align-items-center mb-3">
                        <input type="text" class="form-control rupiah" id="input_form" placeholder="Optional : 200.000">
                        <button class="btn btn-success ms-2 mb-0" id="tombol_form">Click</button>
                    </div>
                </form>
                <form action="{{ Route('admin.tagihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="jenis_biaya" value="{{ $jenis_tagihan }}">
                    @error('jenis_biaya')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase font-weight-bolder text-sm">No</th>
                                    <th class="text-center text-uppercase font-weight-bolder text-sm">Bulan</th>
                                    <th class="text-uppercase font-weight-bolder text-sm">Total harga</th>
                                    <th class="text-uppercase font-weight-bolder text-sm">Tenggat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $mounth = [date('Y') . '-08-30', date('Y') . '-09-30', date('Y') . '-10-30', date('Y') . '-11-30', date('Y') . '-12-30', date('Y') + 1 . '-01-30'];
                                @endphp
                                @foreach ($mounth as $key => $value)
                                    <tr>
                                        <td class="align-items-middle text-center text-sm">{{ $key + 1 }}</td>
                                        <td class="align-items-middle text-center text-sm">
                                            {{ Carbon\Carbon::parse($value)->format('F') }}</td>
                                        <input type="hidden" name="mounth[]"
                                            value="{{ Carbon\Carbon::parse($value)->format('F') }}">
                                        @error('mounth.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <td><input type="text" placeholder="200.000" name="amount[]"
                                                class="form-control @error('amount.*')
                                                    is-invalid
                                                @enderror hasil rupiah"
                                                value="{{ old('amount.' . $key) }}">
                                            @error('amount.*')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td><input type="date"
                                                class="form-control @error('amount.*')
                                            is-invalid
                                        @enderror"
                                                name="end_date[]" value="{{ $value ?? old('end_date.' . $key) }}">
                                            @error('end_date.*')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <label for="id_angkatans">Angkatan</label>
                        <select name="id_angkatans" id="id_angkatans"
                            class="form-select @error('id_angkatans.*')
                        is-invalid
                    @enderror">
                            <option selected>-- Pilih Angkatan --</option>
                            @foreach ($onlyTahunAjaran as $key => $angkatanOnly)
                                <option value="{{ $angkatanOnly->id }}">{{ $angkatanOnly->year }}</option>
                            @endforeach
                        </select>
                    </div>

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
        <div class="card h-100 mt-4">
            <div class="card-header">
                <h6>Buat Tagihan</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('admin.tagihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="jenis_biaya" value="{{ $jenis_tagihan }}">
                    <ul class="list-group">
                        <div class="form-group">
                            <label for="" class="form-control-label">Nama biaya</label>
                            <input type="text"
                                class="form-control @error('nama_biaya')
                            is-invalid
                        @enderror"
                                name="nama_biaya" id="nama_biaya" placeholder="Spp Tahun 2022">
                            @error('nama_biaya')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Harga</label>
                            <input type="text"
                                class="form-control @error('amount')
                            is-invalid
                        @enderror rupiah"
                                name="amount" id="amount" placeholder="Spp Tahun 2022">
                            @error('amount')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Tanggal Tenggat</label>
                            <input type="date"
                                class="form-control @error('end_date')
                            is-invalid
                        @enderror"
                                name="end_date" id="end_date" value="{{ date('Y-m-d') }}">
                            @error('end_date')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="program_belajar">Program Belajar</label>
                            <select name="program_belajar"
                                class="form-select @error('program_belajar')
                                is-invalid
                            @enderror"
                                id="program_belajar" onchange="enableProgram(this)">
                                <option disabled selected value="">-- Pilih Program belajar --</option>
                                <option value="S1" {{ old('program_belajar') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="Kursus" {{ old('program_belajar') == 'Kursus' ? 'selected' : '' }}>
                                    Kursus</option>
                            </select>
                            @error('program_belajar')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!--Jenis Kursus-->
                        <div class="form-group d-none" id="kursus">
                            <label for="id_course">Jenis Kursus</label>
                            <select name="id_kursus" id="id_kursus"
                                class="form-select @error('id_kursus')
                            is-invalid
                        @enderror">
                                <option disabled selected>-- Pilih Kursus --</option>
                                @foreach ($course as $value)
                                    <option value="{{ $value->id }}"
                                        {{ old('id_kursus') == $value->id ? 'selected' : '' }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kursus')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!--Tahun Ajaran-->
                        <div class="form-group d-none" id="angkatans">
                            <label for="id_angkatans">Angkatan</label>
                            <select name="id_angkatans" id="id_angkatans"
                                class="form-select @error('id_angkatans')
                            is-invalid
                        @enderror">
                                <option disabled selected>-- Pilih Angkatan --</option>
                                @foreach ($tahunAjaran as $angkatan)
                                    <option value="{{ $angkatan->id }}"
                                        {{ old('id_angkatans') == $angkatan->id ? 'selected' : '' }}>
                                        {{ $angkatan->year }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_angkatans')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </ul>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary end-0">
                            <i class="fas fa-plus me-1"></i>
                            Tambah
                        </button>
                        <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning">
                            <i class="fas fa-backward me-1"></i>
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($jenis_tagihan == 'DaftarUlang')
        <h3 class="font-weight-bolder">Buat Tagihan</h3>
        <div class="card h-100">
            <div class="card-body p-3">
                <form action="{{ route('admin.tagihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="jenis_biaya" value="{{ $jenis_tagihan }}">
                    <div class="form-group">
                        <label for="" class="form-label">Harga</label>
                        <input type="text"
                            class="form-control @error('amount')
                        is-invalid
                    @enderror rupiah"
                            name="amount" id="amount" placeholder="200.000">
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label">Tanggal Tenggat</label>
                        <input type="date"
                            class="form-control @error('end_date')
                                is-invalid
                            @enderror"
                            name="end_date" id="end_date" value="{{ date('Y-m-d') }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Angkatan</label>
                        <select name="id_angkatans" id="" class="form-select">
                            <option selected>-- Pilih Angkatan --</option>
                            @foreach ($onlyTahunAjaran2 as $angkatan2)
                                <option value="{{ $angkatan2->id }}">{{ $angkatan2->year }}</option>
                            @endforeach
                        </select>
                        @error('id_angkatans')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

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
    @if ($jenis_tagihan == 'Tingkatan')
        <h3 class="font-weight-bolder">Buat Tagihan</h3>
        <div class="card h-100">
            <div class="card-body p-3">
                <label for="">Isi semua harga</label>
                <form onsubmit="return false">
                    <div class="d-flex align-items-center mb-3">
                        <input type="text" class="form-control rupiah" id="input_form"
                            placeholder="Optional : 200.000">
                        <button class="btn btn-success ms-2 mb-0" id="tombol_form">Click</button>
                    </div>
                </form>
                <form action="{{ route('admin.tagihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="jenis_biaya" value="{{ $jenis_tagihan }}">
                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase font-weight-bolder text-sm">No</th>
                                    <th class="text-center text-uppercase font-weight-bolder text-sm">Tingkatan</th>
                                    <th class="text-uppercase font-weight-bolder text-sm">Total harga</th>
                                    <th class="text-uppercase font-weight-bolder text-sm">Tenggat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tingkatan = ["Mubtadi'", 'Muttawassith', 'Mutaqaddim'];
                                @endphp
                                @foreach ($tingkatan as $key => $tingkatans)
                                    <tr>
                                        <td class="align-items-middle text-center">{{ $key + 1 }}</td>
                                        <td class="align-items-middle text-center"><input type="hidden" name="mounth[]"
                                                value="{{ $tingkatans }}">{{ $tingkatans }}</td>
                                        <td><input type="text" placeholder="200.000" name="amount[]"
                                                class="form-control @error('amount.*')
                                                is-invalid
                                            @enderror hasil rupiah"
                                                value="{{ old('amount.' . $key) }}">
                                            @error('amount.*')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="date"
                                                class="form-control @error('end_date.*')
                                            is-invalid
                                        @enderror"
                                                value="{{ old('end_date.' . $key) }}" name="end_date[]">
                                            @error('end_date.*')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="id_angkatans">Angkatan</label>
                        <select name="id_angkatans" id="id_angkatans"
                            class="form-select @error('id_angkatans')
                        is-invalid
                    @enderror">
                            <option disabled selected>-- Pilih Angkatan --</option>
                            @foreach ($tahunAjaran as $angkatan)
                                <option value="{{ $angkatan->id }}">{{ $angkatan->year }}</option>
                            @endforeach
                        </select>
                        @error('id_angkatans')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary end-0">
                            <i class="fas fa-plus"></i>
                            Tambah
                        </button>
                        <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning">
                            <i class="fas fa-backward"></i>
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        $('.rupiah').mask("#.##0", {
            reverse: true
        });
    </script>
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
    <script type="text/javascript">
        const program = document.getElementById('program_belajar');
        program.dispatchEvent(new Event('change'));

        function enableProgram(program) {
            event.preventDefault();
            if (program.value == "S1") {
                document.getElementById("angkatans").classList.remove('d-none');
                document.getElementById("jurusans").classList.remove('d-none');
                document.getElementById("kursus").classList.add('d-none');
                document.getElementById("id_jurusans").setAttribute('name', 'id_jurusans');
                document.getElementById("id_kursus").removeAttribute('name');

            } else if (program.value == "Kursus") {
                document.getElementById("angkatans").classList.remove('d-none');
                document.getElementById("kursus").classList.remove('d-none');
                document.getElementById("jurusans").classList.add('d-none');
                document.getElementById("id_kursus").setAttribute('name', 'id_kursus');
                document.getElementById("id_jurusans").removeAttribute('name');



            } else {

            }

        }
    </script>
@endpush
