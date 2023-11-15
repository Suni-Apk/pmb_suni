@extends('layouts.master')

@section('title', 'Dashboard')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" rel="stylesheet">
@endpush

@php
    $months = [];
    $currentMonth = date('M Y'); // Mendapatkan bulan dan tahun saat ini
    for ($i = 0; $i < 12; $i++) {
        $months[] = date('M Y', strtotime($currentMonth . " +$i month"));
    }

    // dd($months);
@endphp

@push('scripts')
  <script>
    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(19, 169, 95,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)');

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: [
				'Mai',
				'Abril',
				'Novimbir',
				'Decimbir'
            ],
            datasets: [{
                    label: "Admin",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3C9D9B",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: [
                      340,
                      40,
                      300,
                      220,
                      500,
                      250,
                      400,
                      230,
                      500,
                    ],
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
		{{-- total users --}}
		<div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4">
			<div class="card card-stats mb-xl-0">
				<div class="card-body" style="padding: 1rem 1.4rem;">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="card-title text-uppercase text-muted mb-0">Total User</h6>
							<span class="h2 lh-1 font-weight-bold mb-0">{{ $users->count() }}</span>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape bg-danger text-white rounded-circle shadow text-center">
								<i class="fas fa-users"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- admin, mahasiswa, mata kuliah, jurusan for pc --}}
		<div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4 d-none d-sm-block">
			<div class="card card-stats mb-xl-0">
				<div class="card-body" style="padding: 1rem 1.4rem;">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="card-title text-uppercase text-muted mb-0">Admin</h6>
							<span class="h2 lh-1 font-weight-bold mb-0">{{ $users->where('role', 'Admin')->count() }}</span>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape bg-orange text-white rounded-circle shadow text-center">
								<i class="fas fa-user-cog"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4 d-none d-sm-block">
			<div class="card card-stats mb-xl-0">
				<div class="card-body" style="padding: 1rem 1.4rem;">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="card-title text-uppercase text-muted mb-0">Mahasiswa</h6>
							<span class="h2 lh-1 font-weight-bold mb-0">{{ $users->where('role', 'Mahasiswa')->count() }}</span>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape bg-warning text-white rounded-circle shadow text-center">
								<i class="fas fa-user"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4 d-none d-sm-block">
			<div class="card card-stats mb-xl-0">
				<div class="card-body" style="padding: 1rem 1.4rem;">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="card-title text-uppercase text-muted mb-0">Mata Kuliah</h6>
							<span class="h2 lh-1 font-weight-bold mb-0">{{ App\Models\Matkuls::count() }}</span>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape bg-green text-white rounded-circle shadow text-center">
								<i class="ni ni-hat-3"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4 d-none d-sm-block">
			<div class="card card-stats mb-xl-0">
				<div class="card-body" style="padding: 1rem 1.4rem;">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="card-title text-uppercase text-muted mb-0">Jurusan</h6>
							<span class="h2 lh-1 font-weight-bold mb-0">{{ App\Models\Jurusan::count() }}</span>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape bg-teal text-white rounded-circle shadow text-center">
								<i class="ni ni-paper-diploma"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		{{-- admin, mahasiswa, mata kuliah, jurusan for mobile --}}
		<div class="col-6 mb-4 d-block d-sm-none">
			<div class="card">
				<div class="card-body p-3 text-center">
					<div class="d-flex justify-content-center align-items-center gap-2">
						<i class="fas fa-user-cog opacity-10 text-orange"></i>
						<h6 class="text-center mb-0 text-uppercase text-muted">Admin</h6>
					</div>
					<hr class="horizontal dark my-1">
					<h5 class="mb-0">{{ $users->where('role', 'Admin')->count() }}</h5>
				</div>
			</div>
		</div>
		<div class="col-6 mb-4 d-block d-sm-none">
			<div class="card">
				<div class="card-body p-3 text-center">
					<div class="d-flex justify-content-center align-items-center gap-2">
						<i class="fas fa-user opacity-10 text-warning"></i>
						<h6 class="text-center mb-0 text-uppercase text-muted">Mahasiswa</h6>
					</div>
					<hr class="horizontal dark my-1">
					<h5 class="mb-0">{{ $users->where('role', 'Mahasiswa')->count() }}</h5>
				</div>
			</div>
		</div>
		<div class="col-6 mb-4 d-block d-sm-none">
			<div class="card">
				<div class="card-body p-3 text-center">
					<div class="d-flex justify-content-center align-items-center gap-2">
						<i class="ni ni-hat-3 opacity-10 text-green"></i>
						<h6 class="text-center mb-0 text-uppercase text-muted">Mata Kuliah</h6>
					</div>
					<hr class="horizontal dark my-1">
					<h5 class="mb-0">{{ App\Models\Matkuls::count() }}</h5>
				</div>
			</div>
		</div>
		<div class="col-6 mb-4 d-block d-sm-none">
			<div class="card">
				<div class="card-body p-3 text-center">
					<div class="d-flex justify-content-center align-items-center gap-2">
						<i class="ni ni-paper-diploma opacity-10 text-teal"></i>
						<h6 class="text-center mb-0 text-uppercase text-muted">Jurusan</h6>
					</div>
					<hr class="horizontal dark my-1">
					<h5 class="mb-0">{{ App\Models\Jurusan::count() }}</h5>
				</div>
			</div>
		</div>

		{{-- total pemasukan --}}
		<div class="col-12 col-sm-6">
			<div class="card card-stats mb-xl-0">
				<div class="card-body" style="padding: 1rem 1.4rem;">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="card-title text-uppercase text-muted mb-0">Pemasukan</h6>
							<span class="h2 lh-1 font-weight-bold mb-0">
								134.000 <small class="fs-5 font-weight-normal">rupiah</small>
							</span>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape bg-cyan text-white rounded-circle shadow text-center">
								<i class="fas fa-money-check-alt"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8 mb-lg-0 mb-4 d-none d-sm-block">
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
			<div class="col-12 mb-4 gy-3 g-lg-3 d-md-none row mx-auto">
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.tahun-ajaran.index') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Tahun Ajaran">
						<i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Tahun Ajaran</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.jurusan.index') }}" class="icon icon-shape p-0 bg-teal shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Jurusan">
						<i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Jurusan</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.matkul.index') }}" class="icon icon-shape p-0 bg-green shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Mata Kuliah">
						<i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Mata Kuliah</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.admin.index') }}" class="icon icon-shape p-0 bg-cyan shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Admin">
						<i class="fas fa-user-cog text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Admin</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.mahasiswa.index') }}" class="icon icon-shape p-0 bg-blue shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Mahasiswa">
						<i class="fas fa-user-graduate text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Mahasiswa</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.tagihan.index') }}" class="icon icon-shape p-0 bg-indigo shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Tagihan">
						<i class="fas fa-wallet text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Tagihan</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.transaksi.index') }}" class="icon icon-shape p-0 bg-purple shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Transaksi">
						<i class="fas fa-money-check-alt text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Transaksi</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.dokumen.index') }}" class="icon icon-shape p-0 bg-pink shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Dokumen">
						<i class="fas fa-folder-open text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Dokumen</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="" class="icon icon-shape p-0 bg-red shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Link">
						<i class="fas fa-link text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Link</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="" class="icon icon-shape p-0 bg-orange shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Laporan">
						<i class="fas fa-flag text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Laporan</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.profile') }}" class="icon icon-shape p-0 bg-yellow shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Profile">
						<i class="fas fa-user-alt text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Profile</span>
				</div>
				<div class="col-3 col-md-2 text-center">
					<a href="{{ route('admin.settings.general') }}" class="icon icon-shape p-0 bg-warning shadow text-center border-radius-md cursor-pointer"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Pengaturan">
						<i class="fas fa-cog text-lg opacity-10" aria-hidden="true"></i>
					</a>
					<span class="d-block mt-2" style="font-size: 13px;">Settings</span>
				</div>
			</div>
		<div class="col-12 col-lg-4">
			<div class="card h-100 p-3">
			<div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" 
			{{-- style="background-image: url('/soft-ui-dashboard-main/assets/img/ivancik.jpg');"> --}}
			style="background-image: url('https://suniindonesia.com/wp-content/uploads/2022/10/masjid-pogung-dalangan-fQET4BjQmvc-unsplash.jpg');">
				<span class="mask bg-gradient-dark"></span>
				<div class="card-body position-relative z-index-1 d-flex flex-column justify-content-center gap-2">
					<p class="text-white w-100 mb-0 text-center">Kalender hari ini</p>
					<h5 class="text-white font-weight-bolder fs-1 d-flex justify-content-evenly w-100 mb-0">
						<span>{{ $hijriDateday }}</span>
						<span class="text-green font-weight-normal" style="font-family: 'Rubik', sans-serif;">{{ $hijriDatemonth }}</span>
					</h5>
					<h5 class="w-100 mb-0 text-center lh-1 text-green font-weight-light" style="font-family: 'Rubik', sans-serif;">
						{{ $hijriDatedayArabic }}
					</h5>
					<p class="text-white w-100 mb-0 text-center">
						{{ $hijriDateyear }} Hijriyah
					</p>
				</div>
			</div>
			</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-12">
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
					</div>
				</div>
				<div class="card-body px-0 pb-2">
					<div class="table-responsive">
						<table class="table align-items-center mb-0">
							<thead>
								<tr>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. Telepon</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pembayaran</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Biodata</th>
								</tr>
							</thead>
							<tbody>
								{{-- @forelse ($users->where('role', 'Mahasiswa')->where('tahunajaran_id', $tahunAjaran->terakhir)->take(10) as $item) --}}
								@forelse ($users->where('role', 'Mahasiswa')->take(10) as $item)
								<tr>
									<td>
										<div class="d-flex px-2 py-1">
											<div>
												<img src="@if (!Auth::user()->biodata)
												/soft-ui-dashboard-main/assets/img/no-profile.png
												@else
													{{ asset('storage/' . Auth::user()->biodata->image)}}
												@endif" class="avatar avatar-sm me-3" alt="xd">
											</div>
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-sm">{{ $item->name }}</h6>
											</div>
										</div>
									</td>
									<td class="font-weight-bold text-sm" id="phone">
										{{ $item->phone }}
									</td>
									<td class="align-middle text-center text-sm">
										<span class="badge badge-sm {{ $item ? 'bg-gradient-primary' : 'bg-gradient-danger' }}"
										>{{ $item ? 'Lunas' : 'Belum' }}</span>
									</td>
									<td class="align-middle text-center text-sm">
										<span class="badge badge-sm {{ $item ? 'bg-gradient-primary' : 'bg-gradient-danger' }}"
										>{{ $item ? 'Lengkap' : 'Belum' }}</span>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="4" class="text-center text-xs">
										tidak ada data pendaftar
									</td>
								</tr>
								@endforelse
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
				<p class="text-xs text-secondary">
					<i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
					<span class="ms-1">diurutkan dari yang terbaru</span>
				</p>
			</div>
			<div class="card-body p-3">
				<div class="timeline timeline-one-side">
					@forelse ($users->take(10) as $item)
					<div class="timeline-block mb-3">
						<span class="timeline-step">
							@if ($item->role == 'Admin') <!-- kalau tagihan termasuk tagihan spp -->
							<i class="far fa-credit-card text-success text-gradient"></i>
							@else <!-- kalau tagihan termasuk tagihan tingkatan, dll, total ada 4-5 kondisi mengikuti macam-macam jenis tagihan -->
							<i class="far fa-bell text-warning text-gradient"></i>
							@endif
						</span>
						<div class="timeline-content">
							<h6 class="text-dark text-sm font-weight-bold mb-0">
								Rp. 250.000<!-- biaya yang dibayarkan -->, {{ $item->name }} <!-- nama orang -->
								<span class="d-block text-secondary font-weight-normal text-xxs">({{ $item->role }})<!-- nama tagihan --></span>
							</h6>
							<style>
								.hr { height: 1.7px; width: 20px; display: inline-block; background: #dee2e6; margin-bottom: 3px; }
							</style>
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
								{{ $item->created_at->format('H:i:s') }} <span class="hr"></span> {{ $item->created_at->format('d M Y') }}
							</p>
						</div>
					</div>
					@empty
						
					@endforelse
					
				</div>
			</div>
			</div>
		</div>
	</div>
@endsection
