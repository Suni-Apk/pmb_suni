@extends('layouts.master')

@section('title', 'Daftar Pendaftar')

@php
    $timestampsTitle = date('M Y'); // Mendapatkan bulan dan tahun saat ini
    $currentTimeStamp = date('Y-m'); // Mendapatkan bulan dan tahun saat ini
	
	$timestampsTitleBack = date('Y-m', strtotime($timestampsTitle . " -1 year +1 month"));
	$setahunkebelakang = date('Y-m', strtotime($currentTimeStamp . " -1 year +1 month"));
	
    $timetitle = []; // Deklarasi array timestamps
    $rawTimestamps = []; // Deklarasi array timestamps
    for ($i = 0; $i < 12; $i++) {
        $timetitle[] = date('M Y', strtotime($timestampsTitleBack . " +$i month"));
        $rawTimestamps[] = date('Y-m', strtotime($setahunkebelakang . " +$i month"));
    }

	$rawUsersChartAdmin = [];
	$rawUsersChartMahasiswa = [];
	foreach ($rawTimestamps as $key => $value) {
		$rawUsersChartAdmin[] = App\Models\User::where('role', 'Admin')
		->where(Illuminate\Support\Facades\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), $value)
		->count();

		$rawUsersChartMahasiswa[] = App\Models\User::where('role', 'Mahasiswa')
		->where(Illuminate\Support\Facades\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), $value)
		->count();
	}

	$timetitles = json_encode($timetitle,JSON_NUMERIC_CHECK);
	$timestamps = json_encode($rawTimestamps,JSON_NUMERIC_CHECK);
	$usersChartAdmin = json_encode($rawUsersChartAdmin,JSON_NUMERIC_CHECK);
	$usersChartMahasiswa = json_encode($rawUsersChartMahasiswa,JSON_NUMERIC_CHECK);

	// dump($timetitles);
	// dump($timestamps);
	// dd($usersChart);
@endphp

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
        const table1 = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
        });
        const table2 = new simpleDatatables.DataTable("#table2", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
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

		var usersAdmin = <?= $usersChartAdmin; ?>;
		var usersMahasiswa = <?= $usersChartMahasiswa; ?>;
		var titleTimestamps = <?= $timetitles; ?>;
		var timestamps = <?= $timestamps; ?>;

		new Chart(ctx2, {
			type: "line",
			data: {
				labels: titleTimestamps,  // Ganti dengan nilai-nilai yang sesuai
				datasets: [
					{
					label: "Admin",
					tension: 0.4,
					borderWidth: 0,
					pointRadius: 0,
					borderColor: "#3C9D9B",
					borderWidth: 3,
					backgroundColor: gradientStroke1,
					fill: true,
					data: usersAdmin,  // Ganti dengan nilai-nilai yang sesuai
					maxBarThickness: 6
				},
				{
					label: "Pendaftar",
					tension: 0.4,
					borderWidth: 0,
					pointRadius: 0,
					borderColor: "#A9A9A9", // Ganti dengan warna yang sesuai
					borderWidth: 3,
					backgroundColor: gradientStroke2,
					fill: true,
					data: usersMahasiswa, // Ganti dengan nilai-nilai yang sesuai
					maxBarThickness: 6
				}
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
        @foreach ($tahunAjaran as $angkatan)
        <div class="col-6 col-sm-3 p-2 mb-3">
            <div class="card card-stats p-2 pt-4">
                <h5 class="text-center">Data Mahasiswa Angkatan {{ $angkatan->year }}</h5>
                <form action="{{ route('admin.laporan.exportMahasiswaLaporan', $angkatan->id) }}" method="get" class="d-flex justify-content-center align-items-center mt-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary px-3 text-center">Unduh</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <hr class="horizontal dark mb-4 mt-1">
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
                            <span class="h2 lh-1 font-weight-bold mb-0">{{$matkul->count()}}</span>
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
                            <span class="h2 lh-1 font-weight-bold mb-0">{{$jurusan->count()}}</span>
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
        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4 d-none d-sm-block">
			<div class="card card-stats mb-xl-0">
				<div class="card-body" style="padding: 1rem 1.4rem;">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="card-title text-uppercase text-muted mb-0">Mata Pelajaran</h6>
							<span class="h2 lh-1 font-weight-bold mb-0">{{App\Models\Mapels::count()}}</span>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape bg-blue text-white rounded-circle shadow text-center">
								<i class="fas fa-book-reader"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		{{-- admin, mahasiswa, mata kuliah, jurusan for mobile --}}
		<div class="col-6 mb-3 d-block d-sm-none">
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
		<div class="col-6 mb-3 d-block d-sm-none">
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
		<div class="col-6 mb-3 d-block d-sm-none">
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
		<div class="col-6 mb-3 d-block d-sm-none">
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
		<div class="col-12 mb-3 d-block d-sm-none">
			<div class="card">
				<div class="card-body p-3 text-center">
					<div class="d-flex justify-content-center align-items-center gap-2">
						<i class="fas fa-book-reader opacity-10 text-blue"></i>
						<h6 class="text-center mb-0 text-uppercase text-muted">Mata Pelajaran</h6>
					</div>
					<hr class="horizontal dark my-1">
					<h5 class="mb-0">{{ App\Models\Mapels::count() }}</h5>
				</div>
			</div>
		</div>

        {{-- total pemasukan --}}
        <div class="col-12 col-sm-6 mb-4">
            <div class="card card-stats mb-xl-0">
                <div class="card-body" style="padding: 1rem 1.4rem;">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-0">Pemasukan</h6>
                            <span class="h2 lh-1 font-weight-bold mb-0">
                                {{number_format($pemasukan,0,'','.')}} <small class="fs-5 font-weight-normal">rupiah</small>
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
        <div class="col-12 mb-4">
            <div class="card">
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

        <div class="col-12 mb-4 row">
            <div class="col-12 col-sm-6 p-2">
                <div class="card">
                    <div class="card-header text-center pb-0">
                        <h5 class="mb-0">Gender</h5>
                    </div>
                    <hr class="horizontal dark">
                    <div class="card-body pt-0 d-flex justify-content-center align-items-center gap-2">
                        <div class="py-2 px-3 rounded-4 bg-gradient-dark border border-dark border-2 text-center">
                            <h6 class="text-center mb-0 text-white opacity-9">
                                <span class="badge bg-gradient-light px-2">
                                    <i class="text-lg fas fa-mars text-dark"></i>
                                </span>
                                Pria
                            </h6>
                            <h3 class="text-white font-weight-bolder mb-0 mt-1">
                                {{ $users->where('gender', 'Laki-Laki')->count() }}
                            </h3>
                            <p class="text-light text-white text-center m-0">Orang</p>
                        </div>
                        <div class="py-2 px-3 rounded-4 bg-transparent border border-dark border-2 text-center">
                            <h6 class="text-center mb-0 text-dark opacity-9">
                                <span class="badge bg-gradient-dark">
                                    <i class="text-lg fas fa-venus text-white"></i>
                                </span>
                                Wanita
                            </h6>
                            <h3 class="text-dark font-weight-bolder mb-0 mt-1">
                                {{ $users->where('gender', 'Perempuan')->count() }}
                            </h3>
                            <p class="text-light text-dark text-center m-0">Orang</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 p-2">
                <div class="card">
                    <div class="card-header text-center pb-0">
                        <h5 class="mb-0">Program Belajar</h5>
                        <p class="mb-0 text-xs">jumlah peserta tiap program</p>
                    </div>
                    <hr class="horizontal dark">
                    <div class="card-body pt-0 d-flex justify-content-center align-items-center gap-2">
                        @php
                            $usersFormal = App\Models\User::whereHas('biodata', function ($query) {
                                $query->where('jurusan_id', '=', 'nilai_kursus_yang_ingin_dicari');
                            })->count();
                            $usersNonFormal = App\Models\User::whereHas('biodata', function ($query) {
                                $query->where('course_id', '=', 'nilai_kursus_yang_ingin_dicari');
                            })->count();
                        @endphp
                        <div class="py-2 px-3 rounded-4 bg-gradient-dark border border-dark border-2 text-center">
                            <h6 class="text-center mb-0 text-white opacity-9">
                                Formal
                            </h6>
                            <h3 class="text-white font-weight-bolder mb-0 mt-1">
                                {{ $usersFormal }}
                            </h3>
                            <p class="text-light text-white text-center m-0">Orang</p>
                        </div>
                        <div class="py-2 px-3 rounded-4 bg-transparent border border-dark border-2 text-center">
                            <h6 class="text-center mb-0 text-dark opacity-9">
                                Non Formal
                            </h6>
                            <h3 class="text-dark font-weight-bolder mb-0 mt-1">
                                {{ $usersNonFormal }}
                            </h3>
                            <p class="text-light text-dark text-center m-0">Orang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Pendaftar</h6>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.laporan.exportPendaftar') }}" method="GET">
                            <input type="hidden" name="angkatan_id" value="#">
                            <button class="btn btn-success ms-2 d-flex align-items-center">
                                <i class='bx bxs-file-export me-1'></i> Export
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama / Nomor Telepon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender / Role</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Biodata</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Dokumen</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Administrasi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pra-Kuliah</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Bergabung pada</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswa as $index => $item)
                                    <tr>
                                        <td>
                                            <style>
                                                .wa-hover:hover {
                                                    color: #434c5a !important;
                                                    transition: .2s ease;
                                                }
                                            </style>
                                            <p class="text-xs font-weight-bold text-dark mb-0">{{ $item->name }}</p>
                                            <a class="text-secondary text-xs d-block wa-hover"
                                                href="https://api.whatsapp.com/send?phone={{ $item->phone }}&text=Hai!%20Kami%20dari%20{{ App\Models\General::first()->name }}">{{ $item->phone }}</a>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->gender }}</p>
                                            <p class="text-xs text-uppercase text-secondary mb-0">{{ $item->role }}</p>
                                        </td>
                                        {{-- status biodata --}}
                                        <td class="text-secondary text-xs font-weight-bold">
                                            @if ($item->biodata)
                                                <span class="badge rounded-pill bg-gradient-success">Lengkap <i
                                                        class="fas fa-plus ms-1"></i></span>
                                            @else
                                                <span class="badge rounded-pill bg-gradient-danger">Tidak Ada <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        {{-- status dokumen --}}
                                        <td class="text-secondary text-xs font-weight-bold">
                                            @if ($item->document)
                                                <span class="badge rounded-pill bg-gradient-success">Lengkap <i
                                                        class="fas fa-plus ms-1"></i></span>
                                            @else
                                                <span class="badge rounded-pill bg-gradient-danger">Tidak Ada <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        {{-- status administrasi --}}
                                        <td class="text-secondary text-xs font-weight-bold">
                                            @if ($item->biodata)
                                                <span class="badge rounded-pill bg-gradient-success">Lunas <i
                                                        class="fas fa-plus ms-1"></i></span>
                                            @else
                                                <span class="badge rounded-pill bg-gradient-danger">Belum dibayar <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        {{-- status pra-kuliah / daftar ulang --}}
                                        <td class="text-secondary text-xs font-weight-bold">
                                            @if ($item->biodata)
                                                @if ($item->biodata->address)
                                                    {{-- kalau udah selesai --}}
                                                    <span class="badge rounded-pill bg-gradient-success">Lunas <i
                                                            class="fas fa-plus ms-1"></i></span>
                                                @elseif ($item->biodata->angkatan)
                                                    {{-- kalau masih nyicil --}}
                                                    <span class="badge rounded-pill bg-gradient-warning">Cicil <i
                                                            class="fas fa-circle ms-1"></i></span>
                                                @endif
                                            @else
                                                {{-- kalau belum blas --}}
                                                <span class="badge rounded-pill bg-gradient-danger">Belum dibayar <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs text-uppercase text-secondary font-weight-bold mb-0">
                                                {{ $item->created_at->format('d M Y') }}</p>
                                            <p class="text-xxs text-uppercase text-secondary mb-0">
                                                {{ $item->created_at->format('H:i:s') }}</p>
                                        </td>
                                        <td class="text-center"> 
                                            <a style="letter-spacing: .02rem" href="{{ route('admin.mahasiswa.show',$item->id) }}" class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs" data-toggle="tooltip" data-original-title="detail">
                                                Detail
                                            </a>

                                            <a style="letter-spacing: .02rem" href="{{route('admin.mahasiswa.edit',$item->id)}}" class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs mx-1" data-toggle="tooltip" data-original-title="edit">
                                                Ubah
                                            </a>

                                            <form action="{{route('admin.mahasiswa.delete',$item->id)}}" class="d-inline" id="form1" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>

                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        Warning!!!! <i class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                                    </h1>
                                                    <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <i class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                                    Apakah anda yakin ingin menghapus data pendaftar?
                                                    </div>
                                                    <div class="modal-footer">
                                                    {{-- <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button> --}}
                                                    <button type="submit" class="btn bg-gradient-primary">Lanjut</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </form>

                                            <form action="{{route('admin.mahasiswa.status',$item->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            @if ($item->status == 'on')
                                                <input type="hidden" name="status" value="off">
                                                <button class="badge badge-sm bg-gradient-dark font-weight-bolder text-xxs ms-1 border-0" type="submit">
                                                OFF
                                                </button>
                                            @elseif($item->status == 'off')
                                                <input type="hidden" name="status" value="on">
                                                <button class="badge badge-sm bg-teal font-weight-bolder text-xxs ms-1 border-0" type="submit">
                                                ON
                                                </button>
                                            @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Transaksi</h6>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.laporan.exportPendaftar') }}" method="GET">
                            <input type="hidden" name="angkatan_id" value="#">
                            <button class="btn btn-success ms-2 d-flex align-items-center">
                                <i class='bx bxs-file-export me-1'></i> Export
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table mb-0" id="table2">
                            <thead>
                                <tr>
                                    <th class=" text-uppercase text-secondary text-xxs  font-weight-bolder opacity-7">
                                        Nama Tagihan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Pembayaran
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pembayar
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Pembayaran
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        program
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis Tagihan / Pembayaran
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                 
                                <tr>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        @if ($item->tagihanDetails)
                                        {{$item->tagihanDetails->biayasDetail->nama_biaya}}
                                        @else
                                        {{ $item->jenis_tagihan }}
                                        @endif
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        <h6 class="mb-0 text-xs">{{ $item->created_at->format('d F Y') }}</h6>
                                        <p class="mb-0 text-xs">{{ $item->created_at->format('H:i:s') }}</p>
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        {{ $item->user->name }}
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-bold">
                                        Rp. {{ number_format($item->total,0,'','.') }},-
                                    </td>
                                    <td class="align-middle  text-secondary text-xs font-weight-bold">
                                        {{ $item->program_belajar }}
                                    </td>
                                    <td class="align-middle  text-secondary font-weight-bold">
                                        @if ($item->status == 'berhasil')
                                        <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-success">{{ $item->status }}</span>
                                        @elseif ($item->status == 'pending')
                                        <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-warning">{{ $item->status }}</span>
                                        @else
                                        <span class="badge text-uppercase badge-sm rounded-pill bg-gradient-danger">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->jenis_tagihan }}</p>
                                        <p class="text-xs text-uppercase text-secondary mb-0">{{ $item->jenis_pembayaran }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.transaksi.show', $item->id) }}"
                                            class="badge badge-sm bg-gradient-info font-weight-bold text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>
                                        <a href=""
                                            class="badge badge-sm bg-gradient-danger font-weight-bold text-xxs show_confirm"
                                            data-toggle="tooltip" data-original-title="hapus">
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
@endsection