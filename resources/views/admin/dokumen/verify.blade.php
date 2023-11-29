@extends('layouts.master')

@section('title', 'Verifikasi Dokumen')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <div class="">
                        <h5 class="mb-0">Verifikasi Dokumen - 
                            <span class="font-weight-normal fs-6">uploaded by {{ $document->user->name }}</span>
                        </h5>
                        <a class="badge bg-gradient-{{ $document->status == 'accept' ? 'info' : 'warning' }} mb-1">status : 
                            @if ($document->status == 'accept')
                            Terverifikasi
                            @else
                            Belum Terverifikasi
                            @endif
                        </a>
                    </div>
                    <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#modalVerify">
                        Verify <i class="fas fa-check-circle ms-1"></i>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modalVerify" tabindex="-1" aria-labelledby="modalVerifyLabel" aria-hidden="true">
                        <form method="POST" action="{{ route('admin.document.verify.process', $document->id) }}" class="modal-dialog modal-dialog-centered">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h1 class="modal-title fs-5" id="modalVerifyLabel">Verifikasi</h1>
                                <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body text-center">
                                <h5>Yakin ingin memverifikasi dokumen?</h5>
                                <p>~ diupload oleh {{ $document->user->name }} ~</p>
                            </div>
                            <div class="modal-footer border-0 justify-content-center">
                                <input type="hidden" name="status" value="accept">
                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Deny</button>
                                <button type="submit" class="btn bg-gradient-primary">Accept</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <hr class="horizontal dark m-0">
                <div class="card-body row gy-2">
                    <div class="form-group col-6">
                        <label for="">Dokumen KTP</label>
                        <embed src="{{ asset('storage/' . $document->ktp) }}" type="application/pdf" class="form-control height-400">
                    </div>
                    <div class="form-group col-6">
                        <label for="">Dokumen KK</label>
                        <embed src="{{ asset('storage/' . $document->kk) }}" type="application/pdf" class="form-control height-400">
                    </div>
                    <div class="form-group col-6">
                        <label for="">Dokumen IJAZAH</label>
                        <embed src="{{ asset('storage/' . $document->ijazah) }}" type="application/pdf" class="form-control height-400">
                    </div>
                    <div class="form-group col-6">
                        <label for="">Dokumen TRANSKRIP NILAI</label>
                        @if ($document->transkrip_nilai)
                        <embed src="{{ asset('storage/' . $document->transkrip_nilai) }}" type="application/pdf" class="form-control height-400">
                        @else
                        tidak ada transkrip nilai
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection