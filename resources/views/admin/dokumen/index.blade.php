@extends('layouts.master')

@section('title', 'Daftar Dokumen')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h6>Daftar Admin</h6>
                <a href="{{route('admin.dokumen.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="table">
                        <thead>
                            <tr class="text-center">
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Nomor Telepon</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender / Role</th>
                                <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
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
                                            <h6 class="mb-0 text-sm">IJAZAH</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">asdfsadf</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">adfasdf</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">asfdasdf</p>
                                        <p class="text-xs text-uppercase text-secondary mb-0">adfasdf</p>
                                    </td>
                                    <td>
                                        {{-- @if ($item->status == 'on') --}}
                                        <span class="badge badge-sm bg-gradient-success">AKTIF</span>
                                        {{-- @else
                                            <span class="badge badge-sm bg-gradient-danger">OFF</span>
                                        @endif --}}
                                    </td>
                                    <td class="text-center"> 
                                        <a style="letter-spacing: .02rem" href="" class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs" data-toggle="tooltip" data-original-title="detail">
                                            Verify
                                        </a>

                                        <a style="letter-spacing: .02rem" href="{{route('admin.dokumen.edit',1)}}" class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs mx-1" data-toggle="tooltip" data-original-title="edit">
                                            Ubah
                                        </a>

                                        <a style="letter-spacing: .02rem" href="{{route('admin.dokumen.destroy',1)}}" class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs" data-toggle="tooltip" data-original-title="edit">
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