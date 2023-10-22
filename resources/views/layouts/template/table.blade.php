@extends('layouts.master')

@section('title', 'table template')

@push('styles')

@endpush

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Admin table</h6>
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
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="/soft-ui-dashboard-main/assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">John Michael</h6>
                          <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                        </div>
                      </div>
                    </td>
                    <td class="align- text-start">
                      <span class="text-secondary text-xs font-weight-bold">08778464359</span>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Laki Laki</p>
                      <p class="text-xs text-uppercase text-secondary mb-0">ADMIN</p>
                    </td>
                    <td class="align-middle text-center">
                    <span class="badge text-uppercase badge-sm bg-gradient-success">AKTIF</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                    </td>
                    <td class="align-middle text-center"> 
                      <a href="" class="badge text-uppercase badge-sm bg-gradient-info text-xxs mx-1" data-toggle="tooltip" data-original-title="detail">
                        Detail
                      </a>

                      <a href="" class="badge text-uppercase badge-sm bg-gradient-secondary text-xxs mx-1" data-toggle="tooltip" data-original-title="Edit">
                        Ubah
                      </a>

                      <a href="" class="badge text-uppercase badge-sm bg-gradient-danger text-xxs mx-1" data-toggle="tooltip" data-original-title="hapus">
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
@endsection

@push('scripts')
<script>
	const dataTableSearch = new simpleDatatables.DataTable("#templateTableNoSearch", {
      searchable: false,
      fixedHeight: true,
    });

	const dataTableBasic = new simpleDatatables.DataTable("#templateTable", {
      searchable: true,
      fixedHeight: true,
    });
</script>
@endpush