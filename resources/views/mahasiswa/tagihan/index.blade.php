@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')

@endpush

@section('content')
    <div class="row">

        {{-- INI ADALAH CARD BUAT TAGIHAN DAFTAR ULANG CICIL --}}

        <div class="col-12 text-center mb-4">
         <div class="card">
          <h3 class="mt-3">Tagihan</h3>
          <h5 class="text-secondary font-weight-normal">Daftar Ulang Nyicil</h5>
          <div class="multisteps-form">
            <div class="row">
              <div class="col-12 col-lg-8 mx-auto mb-5">
                <div class="multisteps-form__progress">
                  <button class="multisteps-form__progress-btn js-active" type="button" title="Cicil Pertama">
                    <span>Cicil Pertama</span>
                  </button>
                  <button class="multisteps-form__progress-btn" type="button" title="Cicil Kedua">
                    <span>Cicil Kedua</span>
                  </button>
                  <button class="multisteps-form__progress-btn" type="button" title="Cicil Ketiga">
                    <span>Cicil Ketiga</span>
                  </button>
                </div>
              </div>
              <div class="col-12 col-lg-8 mx-auto">
                <button class="btn btn-primary">
                  Bayar
                </button>
              </div>
            </div>
          </div>
         </div>
        </div>

        {{-- END TAGIHAN CICIL --}}
        
        <div class="col-12 text-center mb-4">
          <div class="card">
           <h3 class="mt-3">Tagihan</h3>
           <h5 class="text-secondary font-weight-normal">Daftar Ulang Langsung</h5>
           <div class="multisteps-form">
             <div class="row">
               <div class="col-12 col-lg-8 mx-auto mb-5">
                 <div class="multisteps-form__progress">
                   <button class="multisteps-form__progress-btn js-active" type="button" title="Bayar Cash">
                     <span>Bayar Cash</span>
                   </button>
                   <button class="multisteps-form__progress-btn js-active" type="button" title="Lunas">
                     <span>Lunas</span>
                   </button>
                 </div>
               </div>
               <div class="col-12 col-lg-8 mx-auto">
                 <button class="btn btn-primary">
                   Bayar
                 </button>
               </div>
             </div>
           </div>
          </div>
         </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="templateTable">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                          <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Nomor Telepon</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender / Admin</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joined</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                <img src="../soft-ui-dashboard-main/assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">John Michael</h6>
                                <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                              </div>
                            </div>
                          </td>
                          <td class="">
                            <span class="text-secondary text-xs font-weight-bold">08778464359</span>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0">Laki Laki</p>
                            <p class="text-xs text-secondary mb-0">ADMIN</p>
                          </td>
                          <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success">AKTIF</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                          </td>
                          <td class="align-middle text-center"> 
                            <a href="" class="badge badge-sm bg-gradient-info font-weight-bold text-xxs" data-toggle="tooltip" data-original-title="Edit user">
                              Detail
                            </a>
      
                            <a href="" class="badge badge-sm bg-gradient-secondary font-weight-bold text-xxs mx-1" data-toggle="tooltip" data-original-title="Edit user">
                              Ubah
                            </a>
      
                            <a href="" class="badge badge-sm bg-gradient-danger font-weight-bold text-xxs" data-toggle="tooltip" data-original-title="Edit user">
                              Hapus
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Pembayaran Routine</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="templateTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 width-32-px">ID</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Tagihan</th>
                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Jenis Tagihan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Angkatan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                        <h6 class="text-secondary mb-0 text-sm text-center">#1</h6>
                    </td>
                    <td class="">
                        <h6 class="text-xs font-weight-bold mb-0 text-capitalize">SPP</h6>
                    </td>
                    <td class="">
                      <span class="text-secondary text-xs font-weight-bold">Routine</span>
                    </td>
                    <td class="">
                      <span class="text-secondary text-xs font-weight-bold">2023</span>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Informatika</p>
                    </td>
                    <td class="">
                      <a href="{{route('mahasiswa.tagihan.detail',Auth::user()->name)}}" class="badge badge-sm bg-gradient-primary font-weight-bold text-xxs" data-toggle="tooltip" data-original-title="detail">
                        Detail
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Pembayaran Tidak Routine</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="templateTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Tagihan</th>
                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Jenis Tagihan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Angkatan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                          <h6 class="mb-0 text-sm text-center">KKN</h6>
                      </div>
                    </td>
                    <td class="align- text-start">
                      <span class="text-secondary text-xs font-weight-bold">Tidak Routine</span>
                    </td>
                    <td class="align- text-start">
                      <span class="text-secondary text-xs font-weight-bold">2023</span>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Informatika</p>
                    </td>
                    <td>
                      <a href="{{route('mahasiswa.tagihan.detail.tidak.routine',Auth::user()->name)}}" class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2" data-toggle="tooltip" data-original-title="Edit user">
                        Detail
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
                <table class="table align-items-center mb-0" id="templateTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Nomor Telepon</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender / Admin</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joined</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">John Michael</h6>
                            <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td class="align-">
                        <span class="text-secondary text-xs font-weight-bold">08778464359</span>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Laki Laki</p>
                        <p class="text-xs text-secondary mb-0">ADMIN</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">AKTIF</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle text-center"> 
                        <a href="" class="badge badge-sm bg-gradient-info font-weight-bold text-xxs" data-toggle="tooltip" data-original-title="Edit user">
                          Detail
                        </a>
  
                        <a href="" class="badge badge-sm bg-gradient-secondary font-weight-bold text-xxs mx-1" data-toggle="tooltip" data-original-title="Edit user">
                          Ubah
                        </a>
  
                        <a href="" class="badge badge-sm bg-gradient-danger font-weight-bold text-xxs" data-toggle="tooltip" data-original-title="Edit user">
                          Hapus
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
    </div>
    
@endsection

@push('scripts')
<script>
	const dataTableSearch = new simpleDatatables.DataTable("#searchable1", {
      searchable: true,
      fixedHeight: true,
    });
</script>
@endpush