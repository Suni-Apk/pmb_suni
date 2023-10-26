@extends('layouts.master')

@section('title', 'Profile')

@section('content')

    @if ($id == 'Routine')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Detail Tagihan Spp</h6>
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
                                    <td class="text-sm">Nama Tagihan : <strong>Spp Tahun 2022 / 2023</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Angkatan : <strong>2022 / 2023</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Jurusan / Prodi : <strong>Bahasa Arab</strong></td>
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
                                <tr>
                                    <td class="">1</td>
                                    <td class="">Agustus</td>
                                    <td class="">Rp 200.000</td>
                                    <td class="">30 Agustus 2023</td>
                                </tr>
                                <tr>
                                    <td class="">2</td>
                                    <td class="">September</td>
                                    <td class="">Rp 200.000</td>
                                    <td class="">30 September 2023</td>
                                </tr>
                                <tr>
                                    <td class="">3</td>
                                    <td class="">Oktober</td>
                                    <td class="">Rp 200.000</td>

                                    <td class="">30 Oktober 2023</td>

                                </tr>
                                <tr>
                                    <td class="">4</td>
                                    <td class="">November</td>
                                    <td class="">Rp 200.000</td>

                                    <td class="">30 November 2023</td>

                                </tr>
                                <tr>
                                    <td class="">5</td>
                                    <td class="">Desember</td>
                                    <td class="">Rp 200.000</td>

                                    <td class="">30 Desember 2023</td>

                                </tr>
                                <tr>
                                    <td class="">6</td>
                                    <td class="">Januari</td>
                                    <td class="">Rp 200.000</td>

                                    <td class="">30 Januari 2023</td>
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
    @if ($id == 'Tidakroutine')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
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
                                    <td class="text-sm">Nama Tagihan : <strong>Tagihan Kelas</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total Harga : <strong>Rp 200.000</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Angkatan : <strong>2022 / 2023</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Jurusan / Prodi : <strong>Bahasa Arab</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Tenggat Tagihan : <strong>23 Juni 2023</strong></td>
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
    @if ($id == 'DaftarUlang')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
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
                                    <td class="text-sm">Nama Tagihan : <strong>Tagihan Daftar Ulang</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total Harga : <strong>Rp 200.000</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total Harga Percicilan 3x : <strong>Rp 66.666</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Angkatan : <strong>2022 / 2023</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Untuk Jurusan / Prodi : <strong>Bahasa Arab</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Tenggat Tagihan : <strong>23 Juni 2023</strong></td>
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
