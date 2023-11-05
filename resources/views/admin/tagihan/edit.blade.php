@extends('layouts.master')

@section('title', 'Profile')

@section('content')

    @if ($biaya->jenis_biaya == 'Routine')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Edit Tagihan Spp
                {{ $biaya->tahunAjaran->year ? '>> Tahun ajaran ' . $biaya->tahunAjaran->year : '' }}
                {{ $biaya->jurusans->name ? '>> Jurusan ' . $biaya->jurusans->name : '' }}
                {{ $biaya->program_belajar ? '>> Program belajar ' . $biaya->program_belajar : '' }}
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
                <form action="{{ route('admin.tagihan.update', $biaya->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="jenis_biaya" value="{{ $biaya->jenis_biaya }}">
                    @error('jenis_biaya')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                                @foreach ($tagihan as $key => $value)
                                    <tr>
                                        <td class="align-items-middle text-center">{{ $key + 1 }}</td>
                                        <td class="align-items-middle text-center">{{ $value->mounth }}</td>
                                        <td><input type="text" placeholder="200.000" name="amount[]"
                                                value="{{ $value->amount }}"
                                                class="form-control @error('amount.' . $key)
                                                    is-invalid
                                                @enderror hasil rupiah">
                                            @error('amount.' . $key)
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td><input type="date"
                                                class="form-control @error('end_date.' . $key)
                                            is-invalid
                                        @enderror"
                                                name="end_date[]" value="{{ $value->end_date }}">
                                            @error('end_date.' . $key)
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
                        <button type="submit" class="btn btn-primary end-0"><i class="fas fa-edit">
                            </i> Update</button>
                        <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($biaya->jenis_biaya == 'Tidakroutine')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                        href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Edit {{ $biaya->nama_biaya }}
                {{ $biaya->tahunAjaran->year ? '>> Tahun ajaran ' . $biaya->tahunAjaran->year : '' }}
                {{ $biaya->jurusans->name ?? '' ? '>> Jurusan ' . $biaya->jurusans->name : '' }}
                {{ $biaya->program_belajar ? '>> Program belajar ' . $biaya->program_belajar : '' }}</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <form action="{{ route('admin.tagihan.update', $biaya->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="jenis_biaya" value="{{ $biaya->jenis_biaya }}">
                    <ul class="list-group">
                        <div class="form-group">
                            <label for="" class="form-control-label">Nama biaya</label>
                            <input type="text"
                                class="form-control @error('nama_biaya')
                                is-invalid
                            @enderror"
                                name="nama_biaya" id="nama_biaya" placeholder="Spp Tahun 2022"
                                value="{{ $biaya->nama_biaya }}">
                            @error('nama_biaya')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Harga</label>
                            <input type="text"
                                class="form-control @error('amount')
                                is-invalid
                            @enderror rupiah"
                                name="amount" id="amount" placeholder="200.000" value="{{ $tagihans->amount }}">
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
                                name="end_date" id="end_date" value="{{ $tagihans->end_date }}">
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </ul>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary end-0"><i class="fas fa-edit">
                            </i> Update</button>
                        <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($biaya->jenis_biaya == 'DaftarUlang')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                        href="{{ route('dashboard') }}">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Edit {{ $biaya->nama_biaya }}
                {{ $biaya->tahunAjaran->year ? '>> Tahun ajaran ' . $biaya->tahunAjaran->year : '' }}
                {{ $biaya->jurusans->name ?? '' ? '>> Jurusan ' . $biaya->jurusans->name : '' }}
                {{ $biaya->program_belajar ? '>> Program belajar ' . $biaya->program_belajar : '' }}</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <form action="{{ route('admin.tagihan.update', $biaya->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="jenis_biaya" value="{{ $biaya->jenis_biaya }}">

                    <div class="form-group">
                        <label for="" class="form-control-label">Harga</label>
                        <input type="text"
                            class="form-control @error('amount')
                        is-invalid
                    @enderror rupiah"
                            name="amount" id="amount" placeholder="500.000" value="{{ $tagihans->amount }}">
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label">Tenggat</label>
                        <input type="text"
                            class="form-control @error('end_date')
                        is-invalid
                    @enderror"
                            name="end_date" id="end_date" value="{{ $tagihans->end_date }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary end-0"><i class="fas fa-edit">
                            </i> Update</button>
                        <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($biaya->jenis_biaya == 'Tingkatan')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                        href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Edit {{ $biaya->nama_biaya }}
                {{ $biaya->tahunAjaran->year ? '>> Tahun ajaran ' . $biaya->tahunAjaran->year : '' }}
                {{ $biaya->jurusans->name ?? '' ? '>> Jurusan ' . $biaya->jurusans->name : '' }}
                {{ $biaya->program_belajar ? '>> Program belajar ' . $biaya->program_belajar : '' }}
            </h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <label for="">Isi semua harga</label>
                <form onsubmit="return false">
                    <div class="d-flex align-items-center mb-3">
                        <input type="text" class="form-control rupiah" id="input_form"
                            placeholder="Optional : 200.000">
                        <button class="btn btn-success ms-2 mb-0" id="tombol_form">Click</button>
                    </div>
                </form>
                <form action="{{ route('admin.tagihan.update', $biaya->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="jenis_biaya" value="{{ $biaya->jenis_biaya }}">
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
                                @foreach ($tagihan as $key => $value)
                                    <tr>
                                        <td class="align-items-middle text-center">{{ $key + 1 }}</td>
                                        <td class="align-items-middle text-center">{{ $value->mounth }}</td>
                                        <td><input type="text" placeholder="200.000"
                                                class="form-control @error('amount.' . $key)
                                            is-invalid
                                        @enderror hasil rupiah"
                                                value="{{ $value->amount }}" name="amount[]">
                                            @error('amount.' . $key)
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td><input type="date"
                                                class="form-control @error('end_date.' . $key)
                                            is-invalid 
                                        @enderror"
                                                value="{{ $value->end_date }}" name="end_date[]">
                                            @error('end_date.' . $key)
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
                        <button type="submit" class="btn btn-primary end-0"><i class="fas fa-edit">
                            </i> Update</button>
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
    <script>
        $('.rupiah').mask("#.##0", {
            reverse: true
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
            toastr.error('{{ Session::get('pesan') }}')
        @endif
    </script>
@endpush
