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
            <h6 class="font-weight-bolder mb-0">Detail Tagihan {{ $biaya->nama_biaya }}</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <div class="shadow-sm mb-3">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tagihan Information</th>
                                </tr>

                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="text-sm">Nama Tagihan : <strong>{{ $biaya->nama_biaya }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Angkatan : <strong>{{ $biaya->tahunAjaran->year }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Program Belajar :
                                        <strong>{{ $biaya->program_belajar }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="shadow-sm">
                    <div class="table-responsive mb-3 p-0">
                        <table class="table table-border align-items-center mb-0 " id="templateTable">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-uppercase text-sm font-weight-bolder">No</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Bulan</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Total harga</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Tenggat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan as $key => $value)
                                    <tr>
                                        <td class="">{{ $key + 1 }}</td>
                                        <td class="">{{ $value->mounth }}</td>
                                        <td class="">Rp {{ number_format($value->amount, 0, '', '.') }}</td>
                                        <td class="">
                                            {{ Carbon\Carbon::parse($value->end_date)->format('d F Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                    Back</a>
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
            <h6 class="font-weight-bolder mb-0">Detail {{ $biaya->nama_biaya }}</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <div class="shadow-sm mb-3">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tagihan Information</th>
                                </tr>

                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="text-sm">Nama Tagihan : <strong>{{ $biaya->nama_biaya }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Angkatan : <strong>{{ $biaya->tahunAjaran->year }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Program Belajar :
                                        <strong>{{ $biaya->program_belajar }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total :
                                        <strong>Rp {{ number_format($total, 0, '', '.') }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="shadow-sm">
                    <div class="table-responsive mb-3 p-0">
                        <table class="table table-border align-items-center mb-0 " id="templateTable">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-uppercase text-sm font-weight-bolder">No</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Tingkatan</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Total harga</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Tenggat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan as $key => $value)
                                    <tr>
                                        <td class="">{{ $key + 1 }}</td>
                                        <td class="">{{ $value->mounth }}</td>
                                        <td class="">Rp {{ number_format($value->amount, 0, '', '.') }}</td>
                                        <td class="">{{ Carbon\Carbon::parse($value->end_date)->format('d F Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                    Back</a>
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
            <h6 class="font-weight-bolder mb-0">Detail Tagihan Tidak routine</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <div class="shadow-sm mb-3">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tagihan Information</th>
                                </tr>

                            </thead>
                            <tbody class="table-border">
                                <tr>
                                    <td class="text-sm">Nama Tagihan : <strong>{{ $biaya->nama_biaya }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total Harga : <strong>Rp
                                            {{ number_format($tagihans->amount, 0, '', '.') }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Angkatan : <strong>{{ $biaya->tahunAjaran->year }}</strong>
                                    </td>
                                </tr>
                                @if ($biaya->program_belajar == 'S1')
                                    <tr>
                                        <td class="text-sm">Untuk Jurusan / Prodi :
                                            <strong>{{ $biaya->jurusans->name }}</strong>
                                        </td>

                                    </tr>
                                @endif
                                @if ($biaya->program_belajar == 'KURSUS')
                                    <tr>
                                        <td class="text-sm">Untuk Kursus :
                                            <strong>{{ $biaya->kursus->name }}</strong>
                                        </td>

                                    </tr>
                                @endif
                                <tr>
                                    <td class="text-sm">Tenggat Tagihan :
                                        <strong>{{ Carbon\Carbon::parse($tagihans->end_date)->format('d F Y') }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Progam belajar :
                                        <strong>{{ $biaya->program_belajar }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                    Back</a>
            </div>
        </div>
    @endif
    @if ($biaya->jenis_biaya == 'DaftarUlang')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                        href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Detail Tagihan Daftar ulang</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <div class="shadow-sm mb-3">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tagihan Information</th>
                                </tr>

                            </thead>
                            <tbody class="table-border">
                                <tr>
                                    <td class="text-sm">Nama Tagihan : <strong>{{ $biaya->nama_biaya }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total Harga : <strong>Rp
                                            {{ number_format($tagihans->amount, 0, '', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total Harga Percicilan 3x : <strong>Rp
                                            {{ number_format($tagihans->amount / 3, 0, '', '.') }}</strong></td>
                                </tr>

                                <tr>
                                    <td class="text-sm">Tenggat Tagihan : <strong>23 Juni 2023</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Angkatan :
                                        <strong>{{ $biaya->tahunAjaran->year }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Program Belajar :
                                        <strong>{{ $biaya->program_belajar }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('admin.tagihan.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                    Back</a>
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
