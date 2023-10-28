@extends('layouts.master')

@section('title', 'Detail Transaction')

@section('content')

    @if ($id == 'Routine')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transactions</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Detail Transaction Spp</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <div class="shadow-sm mb-3">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Transaction Information</th>
                                </tr>

                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="text-sm">Nama Pembayaran : <strong>Spp Tahun 2022 / 2023</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Nama Pembayar : <strong>Asep Mine</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Invoice Tagihan : <a href="#"
                                            class="btn btn-success py-2 px-3 ms-2 mb-0"> <i class="fas fa-file-invoice"></i>
                                            Cetak</a></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total Pembayaran : <strong>Rp 400.000</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Tanggal Pembayaran : <strong>28/10/2023</strong></td>
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
                                    <th class="text-uppercase text-sm font-weight-bolder text-center" colspan="3">Tagihan
                                        yang
                                        dibayarkan</th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase text-sm font-weight-bolder">No</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Tagihan</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Total harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="">1</td>
                                    <td class="">Agustus</td>
                                    <td class="">Rp 200.000</td>
                                </tr>
                                <tr>
                                    <td class="">2</td>
                                    <td class="">September</td>
                                    <td class="">Rp 200.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('admin.transaction.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                    Back</a>
            </div>

        </div>
    @endif
    @if ($id == 'Tidakroutine')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transactions</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Detail Tagihan Jas</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <div class="shadow-sm mb-3">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Transaction Information</th>
                                </tr>

                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="text-sm">Nama Pembayaran : <strong>Tagihan Jas</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Nama Pembayar : <strong>Bopak Kastelo</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Invoice Tagihan : <a href="#"
                                            class="btn btn-success py-2 px-3 ms-2 mb-0"> <i class="fas fa-file-invoice"></i>
                                            Cetak</a></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total Pembayaran : <strong>Rp 400.000</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Tanggal Pembayaran : <strong>28/10/2023</strong></td>
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
                                    <th class="text-uppercase text-sm font-weight-bolder" colspan="3">Tagihan
                                        yang
                                        dibayarkan</th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase text-sm font-weight-bolder">No</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Tagihan</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Total harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="">1</td>
                                    <td class="">Tagihan Jas</td>
                                    <td class="">Rp 400.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('admin.transaction.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                    Back</a>
            </div>
        </div>
    @endif
    @if ($id == 'DaftarUlang')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transactions</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Detail Daftar Ulang</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <div class="shadow-sm mb-3">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Transaction Information</th>
                                </tr>

                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="text-sm">Nama Pembayaran : <strong>Daftar Ulang 2022/2023</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Nama Pembayar : <strong>Cahyono</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Invoice Tagihan : <a href="#"
                                            class="btn btn-success py-2 px-3 ms-2 mb-0"> <i
                                                class="fas fa-file-invoice"></i>
                                            Cetak</a></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Total Pembayaran : <strong>Rp 400.000</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Tanggal Pembayaran : <strong>28/10/2023</strong></td>
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
                                    <th class="text-uppercase text-sm font-weight-bolder" colspan="3">Tagihan
                                        yang
                                        dibayarkan</th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase text-sm font-weight-bolder">No</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Tagihan</th>
                                    <th class="text-uppercase text-sm font-weight-bolder">Total harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="">1</td>
                                    <td class="">Cicilan 1</td>
                                    <td class="">Rp 400.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('admin.transaction.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
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