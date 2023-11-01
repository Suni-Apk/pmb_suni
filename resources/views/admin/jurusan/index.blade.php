@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Jurusan</h6>
                    <a href="{{route('admin.jurusan.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0" id="table">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7" style="width: 25px">No</th>
                        <th class="text-uppercase text-start text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- @forelse ($admin as $index => $item) --}}
                        <tr>
                            <td class="text-center">
                                <h6 class="mb-0 text-sm">1</h6>
                            </td>
                            <td>
                                <h6 class="mb-0 text-sm">Hukum Ekonomi Syariah</h6>
                            </td>
                            <td class="text-center"> 
                                <a style="letter-spacing: .02rem" href="" class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs" data-toggle="tooltip" data-original-title="detail">
                                    Detail
                                </a>
    
                                <a style="letter-spacing: .02rem" href="{{route('admin.jurusan.edit',1)}}" class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs mx-1" data-toggle="tooltip" data-original-title="edit">
                                    Ubah
                                </a>
    
                                <a style="letter-spacing: .02rem" href="{{route('admin.jurusan.destroy',1)}}" class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs" data-toggle="tooltip" data-original-title="edit">
                                    hapus
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
@endsection

@push('scripts')
    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
@endpush
