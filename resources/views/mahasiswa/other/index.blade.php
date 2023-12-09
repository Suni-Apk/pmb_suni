@extends('layouts.master')

@section('title', 'Lain-Lain')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Daftar Link</h5>
                </div>
                <hr class="horizontal dark my-2">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th class="opacity-7 text-secondary text-uppercase fw-bolder text-xxs">Topik Link / Jurusan</th>
                                    <th class="opacity-7 text-secondary text-uppercase fw-bolder text-xxs">Url</th>
                                    <th class="opacity-7 text-secondary text-uppercase fw-bolder text-xxs">Gender</th>
                                    <th class="opacity-7 text-secondary text-uppercase fw-bolder text-xxs text-center">Tipe</th>
                                    <th class="opacity-7 text-secondary text-uppercase fw-bolder text-xxs text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($link->where(function ($query) use ($user) {
                                    $query->where('gender', $user->gender)
                                          ->orWhere('gender', 'all');
                                })->get() as $item)
                                <tr>
                                    <td class="text-sm text-dark fw-bold">
                                        {{ $item->name }}
                                        <p class="m-0 text-xxs text-uppercase text-secondary fw-normal">{{$item->jurusan->name}}</p>
                                    </td>
                                    <td class="text-sm text-dark">
                                        <span class="d-block fw-light text-truncate" style="max-width: 300px;">
                                            {{ $item->url }}
                                        </span>
                                    </td>
                                    <td class="text-xs text-dark fw-bold text-uppercase">
                                        @if ($item->gender == 'all')
                                            semua
                                        @else
                                            {{ $item->gender }}
                                        @endif
                                    </td>
                                    <td class="text-sm text-dark fw-bold">
                                        @if ($item->type == 'whatsapp')
                                        <span class="badge badge-sm text-xxs bg-gradient-success rounded-4">{{ $item->type }}</span>
                                        @elseif ($item->type == 'zoom')
                                        <span class="badge badge-sm text-xxs bg-gradient-dark rounded-4">{{ $item->type }}</span>
                                        @endif
                                    </td>
                                    <td class="text-sm text-dark">
                                        <a href="{{ $item->url }}" target="_blank" class="badge badge-sm text-xxs bg-gradient-info shadow">Join <i class="fas fa-external-link-alt ms-1"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Daftar Transaksi</h5>
                </div>
                <hr class="horizontal dark my-2">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th class="fw-bolder text-xxs opacity-7 text-secondary text-uppercase">Nama Transaksi</th>
                                    <th class="fw-bolder text-xxs opacity-7 text-secondary text-uppercase">Tanggal Pembayaran</th>
                                    <th class="fw-bolder text-xxs opacity-7 text-secondary text-uppercase">Total Biaya</th>
                                    <th class="fw-bolder text-xxs opacity-7 text-secondary text-uppercase">Status</th>
                                    <th class="fw-bolder text-xxs opacity-7 text-secondary text-uppercase">Jenis Tagihan / Pembayaran</th>
                                    <th class="fw-bolder text-xxs opacity-7 text-secondary text-uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                <tr>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        @if ($item->tagihanDetails)
                                            {{$item->tagihanDetails->biayasDetail->nama_biaya}}
                                        @else
                                            {{ $item->jenis_tagihan }}
                                        @endif
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        @if ($item->updated_at)
                                            <h6 class="mb-0 text-xs">{{ $item->updated_at->format('d F Y') }}</h6>
                                            <p class="mb-0 text-xs">{{ $item->updated_at->format('H:i:s') }}</p>
                                        @else
                                            <h6 class="mb-0 text-xs">{{ $item->created_at->format('d F Y') }}</h6>
                                            <p class="mb-0 text-xs">{{ $item->created_at->format('H:i:s') }}</p>
                                        @endif
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp. {{ number_format($item->total,0,'','.') }},-
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        @if (strtolower($item->status) == 'berhasil')
                                        <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-success">{{ $item->status }}</span>
                                        @elseif (strtolower($item->status) == 'pending')
                                            @php
                                                $now = now();
                                                $created_at = \Carbon\Carbon::parse($item->created_at);
                                                $expired = $created_at->addHours(24);
                                            @endphp
                                            @if ($now->greaterThan($expired))
                                                <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-danger">expired</span>
                                            @else
                                                <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-warning">{{ $item->status }}</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->jenis_tagihan }}</p>
                                        <p class="text-xs text-uppercase text-secondary mb-0">{{ $item->jenis_pembayaran }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="badge text-xxs bg-gradient-dark" role="button" data-bs-toggle="modal" data-bs-target="#modalTagihan">
                                            invoice <i class="fas fa-paperclip ms-1"></i>
                                        </p>

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
                                                            <span class="badge bg-gradient-info mb-n2 z-index-3">{{ $item->jenis_pembayaran }}</span>
                                                            <span class="border p-3 rounded-2">{!! QrCode::size(120)->generate($item->payment_link) !!}</span>
                                                            <span class="badge bg-gradient-success mt-n2 z-index-3">{{ $item->status }}</span>
                                                        </div>
                                                        <hr class="horizontal dark mt-0">
                                                        <p class="text-center mb-2 text-uppercase text-xs fw-bold">NO INVOICE :</p>
                                                        <p class="text-center mb-2 text-sm">{{ $item->no_invoice }}</p>
                                                        <p class="text-center mb-0 h5 fw-bolder">Rp. {{ number_format($item->total,0,'','.') }},-</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const table1 = new simpleDatatables.DataTable("#table1", {
        searchable: true,
        fixedHeight: true,
    });

    const table2 = new simpleDatatables.DataTable("#table2", {
        searchable: true,
        fixedHeight: true,
    });
</script>
@endpush