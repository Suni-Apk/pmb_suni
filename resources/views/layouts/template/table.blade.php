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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Nomor Telepon</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender / Admin</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joined</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
<<<<<<< HEAD
<<<<<<< HEAD
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joined</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
=======
                    <th class="text-secondary opacity-7"></th>
>>>>>>> 46e3398b5282bba2241af524ee2f88c8839a5162
=======
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joined</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
>>>>>>> 47bc6f05a93c7cec9a855e75b2132e90b72c9e75
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
                    <td class="align- text-start">
                      <span class="text-secondary text-xs font-weight-bold">08778464359</span>
                    </td>
                    <td class="align- text-start">
                      <span class="text-secondary text-xs font-weight-bold">08778464359</span>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Laki Laki</p>
                      <p class="text-xs text-secondary mb-0">ADMIN</p>
                      <p class="text-xs font-weight-bold mb-0">Laki Laki</p>
                      <p class="text-xs text-secondary mb-0">ADMIN</p>
                    </td>
                    <td class="align-middle text-center text-sm">
<<<<<<< HEAD
<<<<<<< HEAD
                    <td class="align-middle text-center text-sm">
=======
>>>>>>> 46e3398b5282bba2241af524ee2f88c8839a5162
=======
>>>>>>> 47bc6f05a93c7cec9a855e75b2132e90b72c9e75
                    <span class="badge badge-sm bg-gradient-success">AKTIF</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                    </td>
                    <td class="align-middle text-center"> 
                      <a href="" class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2" data-toggle="tooltip" data-original-title="Edit user">
<<<<<<< HEAD
<<<<<<< HEAD
                      <a href="" class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2" data-toggle="tooltip" data-original-title="Edit user">
=======
>>>>>>> 46e3398b5282bba2241af524ee2f88c8839a5162
=======
>>>>>>> 47bc6f05a93c7cec9a855e75b2132e90b72c9e75
                        Detail
                      </a>

                      <a href="" class="badge badge-sm bg-gradient-success font-weight-bold text-xs mx-2" data-toggle="tooltip" data-original-title="Edit user">
<<<<<<< HEAD
<<<<<<< HEAD
                      <a href="" class="badge badge-sm bg-gradient-success font-weight-bold text-xs mx-2" data-toggle="tooltip" data-original-title="Edit user">
=======
>>>>>>> 46e3398b5282bba2241af524ee2f88c8839a5162
=======
>>>>>>> 47bc6f05a93c7cec9a855e75b2132e90b72c9e75
                        Ubah
                      </a>

                      <a href="" class="badge badge-sm bg-gradient-danger font-weight-bold text-xs mx-2" data-toggle="tooltip" data-original-title="Edit user">
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
            <h6>Projects table</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center justify-content-center mb-0" id="templateTableNoSearch">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Budget</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Completion</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="../soft-ui-dashboard-main/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Spotify</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">$2,500</p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">working</span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold">60%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0">
                        <i class="fa fa-ellipsis-v text-xs"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="../soft-ui-dashboard-main/assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm rounded-circle me-2" alt="invision">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Invision</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">$5,000</p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">done</span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold">100%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-xs"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="../soft-ui-dashboard-main/assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2" alt="jira">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Jira</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">$3,400</p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">canceled</span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold">30%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-xs"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="../soft-ui-dashboard-main/assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2" alt="slack">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Slack</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">$1,000</p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">canceled</span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold">0%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-xs"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="../soft-ui-dashboard-main/assets/img/small-logos/logo-webdev.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Webdev</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">$14,000</p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">working</span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold">80%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-xs"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="../soft-ui-dashboard-main/assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm rounded-circle me-2" alt="xd">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">Adobe XD</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">$2,300</p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">done</span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold">100%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-xs"></i>
                      </button>
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