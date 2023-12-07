@extends('layouts.master')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h5 class="mb-0">Detail Transaksi {{ $transaksi->jenis_tagihan }}</h5>
                    <a href="{{ route('admin.transaksi.index') }}" class="btn bg-gradient-secondary">Back</a>
                </div>
                <hr class="horizontal dark m-0">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column w-100" style="user-select: none;">
                        <img src="/assets/img/transactions.svg" draggable="false" width="200" class="img-fluid">
                        @if ($transaksi->status == 'pending')
                        <span class="mb-0 badge bg-gradient-warning mt-n6 font-weight-bolder z-index-3">
                            {{ $transaksi->status }}
                        </span>
                        @elseif ($transaksi->status == 'berhasil')
                        <span class="mb-0 badge bg-gradient-success mt-n6 font-weight-bolder z-index-3">
                            {{ $transaksi->status }}
                        </span>
                        @elseif ($transaksi->status == 'expired')
                        <span class="mb-0 badge bg-gradient-danger mt-n6 font-weight-bolder z-index-3">
                            {{ $transaksi->status }}
                        </span>
                        @endif
                        <div class="mb-0 text-center text-dark py-3 px-4 shadow-lg rounded-4 mt-n3 bg-white font-weight-bolder">
                            <p class="mb-1 fw-light text-sm">
                                {{ $transaksi->user->email }}
                            </p>
                            <hr class="horizontal dark m-0">
                            <h5 class="font-weight-bolder mb-0 text-center px-2 px-sm-0">
                                Pembayaran {{ $transaksi->jenis_tagihan }} {{ $transaksi->program_belajar }}
                            </h5>
                            <hr class="horizontal dark m-0">
                            <a href="https://api.whatsapp.com/send?phone={{ $transaksi->user->phone }}&text=Hai!%20Kami%20dari%20{{ App\Models\General::first()->name }}" class="mb-0 fw-light text-sm">
                                {{ $transaksi->user->phone }}
                            </a>
                        </div>
                    </div>
                    <div class="row px-0 px-sm-5 mt-4">
                        <div class="col-6 px-2 px-sm-3 text-start d-flex flex-column justify-content-start align-items-start">
                            <h6 class="text-uppercase text-sm">Jenis Pembayaran</h6>
                            <h6 class="text-uppercase text-sm">nama Nasabah</h6>
                            <h6 class="text-uppercase text-sm">Program Belajar</h6>
                            <h6 class="text-uppercase text-sm">Invoice</h6>
                            <h6 class="text-uppercase text-sm">Tanggal Pembayaran</h6>
                            <h6 class="text-uppercase text-sm">total</h6>
                        </div>
                        <div class="col-6 px-2 px-sm-3 text-end d-flex flex-column justify-content-start align-items-end">
                            <p class="mb-1 text-uppercase">{{ $transaksi->jenis_pembayaran }}</p>
                            <p class="mb-1 text-capitalize font-weight-bold text-dark">{{ $transaksi->user->name }}</p>
                            <p class="mb-1">{{ $transaksi->program_belajar }}</p>
                            <p class="mb-1 badge bg-gradient-dark fst-italic" role="button" data-bs-toggle="modal" data-bs-target="#modalTagihan">
                                show<i class="fas fa-paperclip ms-1"></i>
                            </p>
                            <p class="mb-1">{{ $transaksi->created_at->format('d F Y') }}</p>
                            <p class="mb-1">Rp. {{ number_format($transaksi->total,0,'','.') }},-</p>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalTagihan" tabindex="-1" role="dialog"
                            aria-labelledby="modalTagihanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title" id="modalTagihanLabel">Invoice Transaksi</h5>
                                        <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                    </div>
                                    <div class="modal-body pt-0 pb-5">
                                        <div class="text-center p-3 pt-0 d-flex justify-content-center align-items-center flex-column">
                                            <span class="badge bg-gradient-info mb-n2 z-index-3">{{ $transaksi->jenis_pembayaran }}</span>
                                            <span class="border p-3 rounded-2">{!! QrCode::size(120)->generate($transaksi->payment_link) !!}</span>
                                            
                                            <form action="{{ route('admin.invoice.download',$transaksi->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button name="jenis_tagihan" value="{{$transaksi->jenis_tagihan}}" class="btn bg-gradient-success py-2 px-3 mb-0 mt-3">
                                                    <i class="fas fa-file-invoice "></i> Cetak
                                                </button>
                                            </form>
                                        </div>
                                        <hr class="horizontal dark mt-0">
                                        <p class="text-center mb-2 text-uppercase text-xs fw-bold">NO INVOICE :</p>
                                        <p class="text-center mb-2 text-sm">{{ $transaksi->no_invoice }}</p>
                                        <p class="text-center mb-0 h5 fw-bolder">Rp. {{ number_format($transaksi->total,0,'','.') }},-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table class="table table-border align-items-center mb-0" id="templateTable">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-uppercase text-sm font-weight-bolder text-center py-2 rounded-3" colspan="3">Tagihan yang dibayarkan</th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase text-xs text-center font-weight-bolder opacity-7 rounded-3">No</th>
                                    <th class="text-uppercase text-xs text-center font-weight-bolder opacity-7 rounded-3">Nama Tagihan</th>
                                    <th class="text-uppercase text-xs text-center font-weight-bolder opacity-7 rounded-3">Total harga</th>
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
                                            <td colspan="3" class="text-center">~ Tidak ada yang dibayarkan ~</td>
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
            </div>
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