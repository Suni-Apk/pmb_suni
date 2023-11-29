@extends('layouts.master')

@section('title', 'table template')

@push('styles')

@endpush

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h6>Daftar Admin</h6>
                <div class="d-flex gap-2">
                    <form action="{{ route('admin.admin.exportAdmin') }}" method="GET">
                      <button class="btn btn-success ms-2 d-flex align-items-center show_confirm">
                          <i class='bx bxs-file-export me-1'></i> Export
                      </button>
                    </form>
                    <a href="{{route('admin.admin.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
            </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="table">
                <thead>
                  <tr class="text-center">
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Nomor Telepon</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender / Role</th>
                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($admin as $index => $item)
                    <tr>
                        <td>
                            <div>
                                <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                            </div>
                        </td>
                        <td>
                            <span class="text-secondary text-xs font-weight-bold">{{$item->phone}}</span>
                        </td>
                        <td>
                            <span class="text-secondary text-xs font-weight-bold">{{$item->email}}</span>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{$item->gender}}</p>
                          <p class="text-xs text-uppercase text-secondary mb-0">{{$item->role}}</p>
                        </td>
                        <td>
                            @if ($item->status == 'on')
                            <span class="badge badge-sm bg-gradient-success">AKTIF</span>
                            @else
                              <span class="badge badge-sm bg-gradient-danger">OFF</span>
                            @endif
                        </td>
                        <td class="text-center"> 
                          <a style="letter-spacing: .02rem" href="" class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs" data-toggle="tooltip" data-original-title="detail">
                              Detail
                          </a>

                          <a style="letter-spacing: .02rem" href="{{route('admin.admin.edit',$item->id)}}" class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs ms-1" data-toggle="tooltip" data-original-title="edit">
                              Ubah
                          </a>
                          
                          <form action="{{route('admin.admin.delete',$item->id)}}" class="d-inline" id="form1" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="badge badge-sm bg-red font-weight-bolder text-xxs ms-1 border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Warning!!!! <i class="fas fa-exclamation-circle fa-xl text-danger"></i></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <i class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                    Apakah Anda Yakin Ingin Melakukan Penghapusan Admin?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Lanjut</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>

                          @if (Auth::user()->id !== $item->id)
                            <form action="{{route('admin.admin.status',$item->id)}}" method="POST" class="d-inline">
                              @csrf
                              @method('PUT')
                              @if ($item->status == 'on')
                                <input type="hidden" name="status" value="off">
                                <button class="badge badge-sm bg-dark font-weight-bolder text-xxs ms-1 border-0" type="submit">
                                  OFF
                                </button>
                              @elseif($item->status == 'off')
                              <input type="hidden" name="status" value="on">
                                <button class="badge badge-sm bg-teal font-weight-bolder text-xxs ms-1 border-0" type="submit">
                                  ON
                                </button>
                              @endif
                            </form>
                          @endif
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