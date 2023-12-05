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
                            <p class="mb-0">
                                Rp. {{ number_format($transaksi->total,0,'','.') }},-
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
                            <h6 class="text-uppercase text-sm">total</h6>
                        </div>
                        <div class="col-6 px-2 px-sm-3 text-end d-flex flex-column justify-content-start align-items-end">
                            <p class="mb-1 text-uppercase">{{ $transaksi->jenis_pembayaran }}</p>
                            <p class="mb-1 text-capitalize font-weight-bold text-dark">{{ $transaksi->user->name }}</p>
                            <p class="mb-1">{{ $transaksi->program_belajar }}</p>
                            <p class="mb-1 badge bg-gradient-dark fst-italic" role="button" data-bs-toggle="modal" data-bs-target="#modalTagihan">
                                show<i class="fas fa-paperclip ms-1"></i>
                            </p>
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
    </div>
@endsection
