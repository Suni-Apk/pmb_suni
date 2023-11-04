@extends('layouts.master')

@section('title', 'Dashboard')

@push('scripts')
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                maxBarThickness: 6
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 15,
                        font: {
                            size: 14,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#fff"
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        display: false
                    },
                },
            },
        },
    });

    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(19, 169, 95,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3C9D9B",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: [1000, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                },
                {
                    label: "Websites",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#394A6D",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
                {
                    label: "People",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#52DE97",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [50, 100, 20, 120, 220, 220, 320, 220, 0],
                    maxBarThickness: 6
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
  </script>
@endpush

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        {{-- <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                <h5 class="font-weight-bolder mb-0">
                  $53,000
                  <span class="text-success text-sm font-weight-bolder">+55%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      {{-- <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                <h5 class="font-weight-bolder mb-0">
                  $103,430
                  <span class="text-success text-sm font-weight-bolder">+5%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-money text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-8 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="height-200 d-flex justify-content-center flex-column align-items-center bg-cover text-center"
          style="background: url(/soft-ui-dashboard-main/assets/img/admin-db.svg);
                background-position: center; background-repeat: no-repeat;">
              <h4 class="font-weight-bold mb-0 p-3 pb-0" style="background: rgba(255,255,255,.5)!important; backdrop-filter: blur(1px);">
                Selamat Datang 
                <b class="font-weight-bolder">{{ $user->name }}</b>!
              </h4>
              <p class="mb-0 mx-2 pb-3 px-3" style="background: rgba(255,255,255,.5)!important; backdrop-filter: blur(2px);">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ut, voluptate?
              </p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card h-100 p-3">
        <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" 
        {{-- style="background-image: url('/soft-ui-dashboard-main/assets/img/ivancik.jpg');"> --}}
        style="background-image: url('https://suniindonesia.com/wp-content/uploads/2022/10/masjid-pogung-dalangan-fQET4BjQmvc-unsplash.jpg');">
          <span class="mask bg-gradient-dark"></span>
          <div class="card-body position-relative z-index-1 d-flex flex-column justify-content-center gap-2">
            <h5 class="text-white font-weight-bolder fs-1 d-flex justify-content-around w-100">
              <span>{{ $hijriDateday }}</span>
              <span>{{ $hijriDatemonth }}</span>
            </h5>
            <p class="text-white w-100 mb-0 text-center">{{ $hijriDateyear }} Hijriyah</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-5 mb-lg-0 mb-4">
      <div class="card z-index-2">
        <div class="card-body p-3">
          <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
          <h6 class="ms-2 mt-4 mb-0"> Grafik Pengguna </h6>
          <p class="text-sm ms-2">Menampilkan statistik jumlah pengguna berdasarkan role</p>
          <div class="container border-radius-lg">
            <div class="row">
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-user-cog mt-2"></i>
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Admin</p>
                </div>
                <h4 class="font-weight-bolder">20</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-user mt-2"></i>
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">User</p>
                </div>
                <h4 class="font-weight-bolder">1K</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark w-90" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-user-tag mt-2"></i>
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Peserta</p>
                </div>
                <h4 class="font-weight-bolder">40</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark w-30" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-danger text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-users mt-2"></i>
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Semua</p>
                </div>
                <h4 class="font-weight-bolder">13K</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="card z-index-2">
        <div class="card-header pb-0">
          <h6>Traffic Pengguna Pertahun</h6>
          <p class="text-sm">
            <i class="fa fa-arrow-up text-success me-1"></i>
            Grafik perkembangan jumlah pengguna pertahun
          </p>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Daftar Pendaftar Terbaru</h6>
            </div>
            <div class="col-lg-6 col-5 my-auto text-end">
              <div class="dropdown float-lg-end pe-4">
                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-secondary"></i>
                </a>
                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                  <li><a class="dropdown-item border-radius-md" href="">Show All</a></li>
                  <li><a class="dropdown-item border-radius-md" href="">Another action</a></li>
                  <li><a class="dropdown-item border-radius-md" href="">Something else here</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Companies</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="/soft-ui-dashboard-main/assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Soft UI XD Version</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                        <img src="/soft-ui-dashboard-main/assets/img/team-1.jpg" alt="team1">
                      </a>
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                        <img src="/soft-ui-dashboard-main/assets/img/team-2.jpg" alt="team2">
                      </a>
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                        <img src="/soft-ui-dashboard-main/assets/img/team-3.jpg" alt="team3">
                      </a>
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="/soft-ui-dashboard-main/assets/img/team-4.jpg" alt="team4">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $14,000 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">60%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="/soft-ui-dashboard-main/assets/img/small-logos/logo-atlassian.svg" class="avatar avatar-sm me-3" alt="atlassian">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Add Progress Track</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                        <img src="/soft-ui-dashboard-main/assets/img/team-2.jpg" alt="team5">
                      </a>
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="/soft-ui-dashboard-main/assets/img/team-4.jpg" alt="team6">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $3,000 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">10%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="/soft-ui-dashboard-main/assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm me-3" alt="team7">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Fix Platform Errors</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                        <img src="/soft-ui-dashboard-main/assets/img/team-3.jpg" alt="team8">
                      </a>
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="/soft-ui-dashboard-main/assets/img/team-1.jpg" alt="team9">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> Not set </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">100%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="/soft-ui-dashboard-main/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm me-3" alt="spotify">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Launch our Mobile App</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                        <img src="/soft-ui-dashboard-main/assets/img/team-4.jpg" alt="user1">
                      </a>
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                        <img src="/soft-ui-dashboard-main/assets/img/team-3.jpg" alt="user2">
                      </a>
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                        <img src="/soft-ui-dashboard-main/assets/img/team-4.jpg" alt="user3">
                      </a>
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="/soft-ui-dashboard-main/assets/img/team-1.jpg" alt="user4">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $20,500 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">100%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="/soft-ui-dashboard-main/assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm me-3" alt="jira">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Add the New Pricing Page</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                        <img src="/soft-ui-dashboard-main/assets/img/team-4.jpg" alt="user5">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $500 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">25%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="25"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="/soft-ui-dashboard-main/assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm me-3" alt="invision">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Redesign New Online Shop</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                        <img src="/soft-ui-dashboard-main/assets/img/team-1.jpg" alt="user6">
                      </a>
                      <a href="" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="/soft-ui-dashboard-main/assets/img/team-4.jpg" alt="user7">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $2,000 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">40%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Daftar Transaksi Terbaru</h6>
          <p class="text-sm">
            <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
            <span class="font-weight-bold">24%</span> this month
          </p>
        </div>
        <div class="card-body p-3">
          <div class="timeline timeline-one-side">
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-bell-55 text-success text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-html5 text-danger text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-cart text-info text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-credit-card text-warning text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-key-25 text-primary text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
              </div>
            </div>
            <div class="timeline-block">
              <span class="timeline-step">
                <i class="ni ni-money-coins text-dark text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
