@extends('layouts.master')

@section('title', 'Daftar Dokumen')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Dokumen</h6>
                    <a href="{{ route('admin.dokumen.create') }}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pilih
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">uploaded
                                        by</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($admin as $index => $item) --}}
                                <tr>
                                    <td>
                                        <div>
                                            <h6 class="mb-0 text-sm">1</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <h6 class="mb-0 text-sm">1</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center gap-3">
                                            <embed src="{{ asset('soft-ui-dashboard-main/Akte Haidar.pdf') }}"
                                                type="application/pdf" height="150">
                                            <h6 class="mb-0 text-sm">IJAZAH</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">Mahasiswa 2</span>
                                    </td>
                                    <td class="text-center">
                                        <a style="letter-spacing: .02rem" href=""
                                            class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs me-1"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Verify
                                        </a>

                                        <a style="letter-spacing: .02rem" href="{{ route('admin.dokumen.destroy', 1) }}"
                                            class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs"
                                            data-toggle="tooltip" data-original-title="hapus">
                                            Hapus
                                        </a>

                                    </td>
                                </tr>
                                {{-- @empty
                                
                            @endforelse --}}
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
