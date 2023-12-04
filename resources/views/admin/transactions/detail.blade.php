@extends('layouts.master')

@section('title', 'Detail Transaction')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Pages</a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transactions</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Detail Transaction {{$transaksi->jenis_tagihan}}</h6>
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
                                <td class="text-sm">Nama Pembayaran : <strong>{{$transaksi->jenis_tagihan}}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-sm">Nama Pembayar : <strong>{{$transaksi->user->name}}</strong></td>
                            </tr>
                            <tr>
                                <form action="{{ route('admin.invoice.download',$transaksi->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <td class="text-sm">Invoice Tagihan : <button name="jenis_tagihan" value="{{$transaksi->jenis_tagihan}}"
                                        class="btn btn-success py-2 px-3 ms-2 mb-0"> <i class="fas fa-file-invoice"></i>
                                        Cetak</button></td>
                                </form>
                            </tr>
                            <tr>
                                <td class="text-sm">Total Pembayaran : <strong>Rp {{ number_format($transaksi->total) }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-sm">Tanggal Pembayaran : <strong>{{ $transaksi->created_at->format('d F Y') }}</strong></td>
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
                                <th class="text-uppercase text-sm font-weight-bolder">Nama Tagihan</th>
                                <th class="text-uppercase text-sm font-weight-bolder">Total harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($transaksi->jenis_tagihan == 'Administrasi')
                                @if ($transaksi->status == 'berhasil')
                                    <tr>
                                        <td class="">{{ 1 }}</td>
                                        <td class="">{{ $transaksi->jenis_tagihan ?? '' }}</td>
                                        <td class="">Rp {{ number_format($transaksi->total) }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak Ada Yang Di Bayarkan</td>
                                    </tr>
                                @endif
                            @elseif($transaksi->jenis_tagihan == 'Daftar Ulang Cicilan')
                                @php
                                    $biaya = App\Models\Biaya::where('program_belajar', 'S1')->where('jenis_biaya', 'DaftarUlang')->latest()->first();
                                    $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)->latest()->first();
                                    $transaksiCicilan = App\Models\Cicilan::where('id_tagihan_details',$tagihan->id)->where('status','LUNAS')
                                    ->get();
                                    $berhasil = App\Models\Transaksi::where('status','berhasil')->where('jenis_tagihan','Daftar Ulang Cicilan')->get();
                                    @endphp
                                @foreach ($transaksiCicilan as $cicilan)
                                @php
                                    $nomor = 1;
                                    $transaksi = App\Models\Transaksi::where('id_cicilans', $cicilan->id)->get();
                                @endphp
                            
                                @foreach ($transaksi as $transaksiItem)
                                    <tr>
                                        <td class="">{{ $loop->parent->iteration }}</td>
                                        <td class="">{{ $transaksiItem->jenis_tagihan }} {{ $loop->parent->iteration }}</td>
                                        <td class="">Rp {{ number_format($transaksiItem->total) }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            
                            
                            @elseif($transaksi->jenis_tagihan == 'DaftarUlang')
                                    @if ($transaksi->status == 'berhasil')
                                        <tr>
                                            <td class="">{{ 1 }}</td>
                                            <td class="">{{ $transaksi->jenis_tagihan ?? '' }}</td>
                                            <td class="">Rp {{ number_format($transaksi->total) }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="3">Tidak Ada Yang Di Bayarkan</td>
                                        </tr>
                                    @endif
                            @elseif ($transaksi->jenis_tagihan == 'Routine')
                                @foreach ($transaksi->tagihanDetails as $index => $transaksis)
                                    <tr>
                                        <td class="">{{ $index + 1 }}</td>
                                        <td class="">{{ $transaksis->biayasDetail->nama_Biaya ?? '' }}</td>
                                        <td class="">Rp anjay</td>
                                    </tr>
                                @endforeach
                            @elseif ($transaksi->jenis_tagihan == 'TidakRoutine')
                                @if ($transaksi->status == 'berhasil')
                                    <tr>
                                        <td class="">{{ 1 }}</td>
                                        <td class="">{{ $transaksi->jenis_tagihan ?? '' }}</td>
                                        <td class="">Rp {{ number_format($transaksi->total) }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="3">Tidak Ada Yang Di Bayarkan</td>
                                    </tr>
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                Back</a>
        </div>

    </div>
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
