@extends('layouts.master')

@section('title', 'Detail Transaction')

@section('content')

    @if ($tagihan->biayasDetail->jenis_biaya == 'Routine')
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
                <form action="">
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
                                        <td class="text-sm">Tagihan yang dibayarkan :
                                            <strong>{{ $tagihan->biayasDetail->nama_biaya }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm">Nama Mahasiswa : <strong>{{ $mahasiswa->name }}</strong></td>
                                    </tr>

                                    <tr>
                                        <td class="text-sm">Total Pembayaran : <strong>Rp 2000.000</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm">Tanggal Pembayaran : <strong>28/10/2023</strong></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="text-bold">Tagihan Yang Dibayarkan</p>
                    <div class="shadow-sm">
                        <div class="table-responsive mb-3 p-0">
                            <table class="table table-border align-items-center mb-0 " id="templateTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-uppercase text-sm font-weight-bolder">No</th>
                                        <th class="text-uppercase text-sm font-weight-bolder">Nama Tagihan</th>
                                        <th class="text-uppercase text-sm font-weight-bolder">Total harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ids as $key => $idTagihan)
                                        @php
                                            $tagihanDetail = App\Models\TagihanDetail::where('id', $idTagihan)->get();
                                        @endphp
                                        @foreach ($tagihanDetail as $valueTagihanDetail)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="">
                                                    {{ \Carbon\Carbon::parse($valueTagihanDetail->end_date)->format('F') }}
                                                </td>
                                                <td class="">Rp
                                                    {{ number_format($valueTagihanDetail->amount, 0, '', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-primary me-2">Bayar Cash</button>
                        <a href="{{ route('admin.mahasiswa.show', $id) }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($tagihan->biayasDetail->jenis_biaya == 'Tidakroutine')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transactions</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Bayar Tagihan Tidak Routine</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <form action="">
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
                                        <td class="text-sm">Nama Mahasiswa :
                                            <strong>{{ $tagihan->biayasDetail->nama_biaya }}</strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-sm">Total Pembayaran : <strong>Rp
                                                {{ number_format($total, 0, '', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm">Tanggal Pembayaran : <strong>{{ date('Y/m/d') }}</strong></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="text-bold">Tagihan Yang Dibayarkan</p>
                    <div class="shadow-sm">
                        <div class="table-responsive mb-3 p-0">
                            <table class="table table-border align-items-center mb-0 " id="templateTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-uppercase text-sm font-weight-bolder">No</th>
                                        <th class="text-uppercase text-sm font-weight-bolder">Tagihan Bulan</th>
                                        <th class="text-uppercase text-sm font-weight-bolder">Total harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ids as $key => $idTagihan)
                                        @php
                                            $tagihanDetail = App\Models\TagihanDetail::where('id', $idTagihan)->get();
                                        @endphp
                                        @foreach ($tagihanDetail as $valueTagihanDetail)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="">
                                                    {{ $valueTagihanDetail->biayasDetail->nama_biaya }}
                                                </td>
                                                <td class="">Rp
                                                    {{ number_format($valueTagihanDetail->amount, 0, '', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-primary me-2">Bayar Cash</button>
                        <a href="{{ route('admin.mahasiswa.show', $id) }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($tagihan->biayasDetail->jenis_biaya == 'DaftarUlang')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                        href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tagihan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Bayar {{ $tagihan->biayasDetail->nama_biaya }}</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <form action="">
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
                                        <td class="text-sm">Tagihan yang dibayarkan :
                                            <strong>{{ $tagihan->biayasDetail->nama_biaya }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm">Nama Mahasiswa : <strong>{{ $mahasiswa->name }}</strong></td>
                                    </tr>

                                    <tr>
                                        <td class="text-sm">Total Pembayaran : <strong>Rp
                                                {{ number_format($total, 0, '', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm">Tanggal Pembayaran : <strong>{{ date('Y/m/d') }}</strong></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-primary me-2">Bayar Cash</button>
                        <a href="#" class="btn btn-secondary me-2">Bayar Cicilan</a>
                        <a href="{{ route('admin.mahasiswa.show', $id) }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    {{-- @if ($jenis == 'Tingkatan')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transactions</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Detail Transaction Tingkatan</h6>
        </nav>
        <div class="card h-100 mt-4">
            <div class="card-body p-3">
                <form action="">
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
                                        <td class="text-sm">Tagihan yang dibayarkan : <strong>Tingkatan</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm">Nama Mahasiswa : <strong>Cahyono</strong></td>
                                    </tr>

                                    <tr>
                                        <td class="text-sm">Total Pembayaran : <strong>Rp 2.000.000</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm">Tanggal Pembayaran : <strong>28/10/2023</strong></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="text-bold">Tagihan Yang Dibayarkan</p>
                    <div class="shadow-sm">
                        <div class="table-responsive mb-3 p-0">
                            <table class="table table-border align-items-center mb-0 " id="templateTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-uppercase text-sm font-weight-bolder">No</th>
                                        <th class="text-uppercase text-sm font-weight-bolder">Nama Tagihan</th>
                                        <th class="text-uppercase text-sm font-weight-bolder">Total harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="">1</td>
                                        <td class="">Mubtadai'</td>
                                        <td class="">Rp 200.000</td>
                                    </tr>
                                    <tr>
                                        <td class="">2</td>
                                        <td class="">Mutawassith</td>
                                        <td class="">Rp 200.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-primary me-2">Bayar Cash</button>
                        <a href="{{ route('admin.mahasiswa.show', $id) }}" class="btn btn-warning"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    @endif --}}


@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush
