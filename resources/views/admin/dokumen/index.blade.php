@extends('layouts.master')

@section('title', 'Daftar Dokumen')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h6>Daftar Dokumen</h6>
                {{-- <a href="{{route('admin.dokumen.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a> --}}
            </div>
            <hr class="horizontal dark m-0">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="table">
                        <thead>
                            <tr class="text-center">
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">uploaded by</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $index => $item)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-12 col-sm-3">
                                                <div class="mb-2">
                                                    <label for="">Dokumen KTP</label>
                                                    <div class="d-flex input-group">
                                                        <a href="{{ asset('storage/' . $item->ktp) }}" target="_blank" class="input-group-text">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <input type="text" value="{{$item->ktp}}" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="mb-2">
                                                    <label for="">Dokumen KK</label>
                                                    <div class="d-flex input-group">
                                                        <a href="{{ asset('storage/' . $item->kk) }}" target="_blank" class="input-group-text">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <input type="text" value="{{$item->kk}}" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="mb-2">
                                                    <label for="">Dokumen IJAZAH</label>
                                                    <div class="d-flex input-group">
                                                        <a href="{{ asset('storage/' . $item->ijazah) }}" target="_blank" class="input-group-text">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <input type="text" value="{{$item->ijazah}}" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item->transkrip_nilai)
                                            <div class="col-12 col-sm-3">
                                                <div class="mb-2">
                                                    <label for="">Dokumen TRANSKRIP NILAI</label>
                                                    <div class="d-flex input-group">
                                                        <a href="{{ asset('storage/' . $item->transkrip_nilai) }}" target="_blank" class="input-group-text">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <input type="text" value="{{$item->transkrip_nilai}}" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            tidak ada dokumen transkrip nilai
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->user->name }}</span>
                                    </td>
                                    <td>
                                        @if ($item->status == 'deny')
                                        <span class="badge badge-sm bg-gradient-warning text-xxs font-weight-bold">{{ $item->status }}</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-primary text-xxs font-weight-bold">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.document.verify', $item->id) }}" class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs me-1" data-toggle="tooltip" data-original-title="detail">
                                            Verify
                                        </a>
                                        <a href="{{route('admin.dokumen.destroy', $item->id)}}" class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs" data-toggle="tooltip" data-original-title="hapus">
                                            Hapus
                                        </a>
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
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire(
                "{{ session('success') }}", // Menggunakan session('success') untuk mengambil pesan
                'You clicked the button!',
                'success'
            )
        </script>
    @endif
<script>
	const dataTableSearch = new simpleDatatables.DataTable("#table", {
      searchable: true,
      fixedHeight: true,
    });
</script>
@endpush