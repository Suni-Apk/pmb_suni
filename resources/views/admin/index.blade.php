@extends('layouts.master')

@section('title', 'Dashboard')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" rel="stylesheet">
@endpush

@php
    $timestampsTitle = date('M Y'); // Mendapatkan bulan dan tahun saat ini
    $currentTimeStamp = date('Y-m'); // Mendapatkan bulan dan tahun saat ini

    $timestampsTitleBack = date('Y-m', strtotime($timestampsTitle . ' -1 year +1 month'));
    $setahunkebelakang = date('Y-m', strtotime($currentTimeStamp . ' -1 year +1 month'));

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

    $timetitles = json_encode($timetitle, JSON_NUMERIC_CHECK);
    $timestamps = json_encode($rawTimestamps, JSON_NUMERIC_CHECK);
    $usersChartAdmin = json_encode($rawUsersChartAdmin, JSON_NUMERIC_CHECK);
    $usersChartMahasiswa = json_encode($rawUsersChartMahasiswa, JSON_NUMERIC_CHECK);

    // dump($timetitles);
    // dump($timestamps);
    // dd($usersChart);

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

        var usersAdmin = <?php echo $usersChartAdmin; ?>;
        var usersMahasiswa = <?php echo $usersChartMahasiswa; ?>;
        var titleTimestamps = <?php echo $timetitles; ?>;
        var timestamps = <?php echo $timestamps; ?>;

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: titleTimestamps, // Ganti dengan nilai-nilai yang sesuai
                datasets: [{
                        label: "Admin",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3C9D9B",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: usersAdmin, // Ganti dengan nilai-nilai yang sesuai
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
        {{-- total users --}}
        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-3 mb-sm-4">
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
                            <span
                                class="h2 lh-1 font-weight-bold mb-0">{{ $users->where('role', 'Mahasiswa')->count() }}</span>
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
                            <span class="h2 lh-1 font-weight-bold mb-0">{{ $matkul->count() }}</span>
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
                            <span class="h2 lh-1 font-weight-bold mb-0">{{ $jurusan->count() }}</span>
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
                            <span class="h2 lh-1 font-weight-bold mb-0">{{ App\Models\Mapels::count() }}</span>
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
                            <span class="h2 lh-1 font-weight-bold mb-0" id="pemasukan">
                                <span>{{ number_format($pemasukan, 0, '', '.') }}</span><small
                                    class="fs-5 font-weight-normal">rupiah</small>
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
        <div class="col-12 col-lg-8 mb-lg-0 mb-4">
            <div id="carouselDashboard" data-bs-ride="carousel" data-bs-interval="3000"
                class="carousel slide page-header align-items-start height-300 pb-7 rounded-3">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselDashboard" data-bs-slide-to="0" class="active"
                        aria-current="true"></button>
                    @foreach ($banner->filter(function ($item) {
            return $item->target == 'ADMIN' || $item->target == 'SEMUA';
        }) as $item)
                        <button type="button" data-bs-target="#carouselDashboard"
                            data-bs-slide-to="{{ $loop->index + 1 }}" class="" aria-current="true"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row flex-column justify-content-center height-300"
                            style="
						background-image: url('https://c0.wallpaperflare.com/path/196/594/379/quran-book-97f792a4ef76b251052800f9f56a4c0b.jpg'); 
						background-size: cover; background-position: center;">
                            <span class="mask bg-gradient-dark opacity-6"></span>
                            <div
                                class="d-flex justify-content-center flex-column align-items-center text-white text-center z-index-1">
                                <h4 class="font-weight-bold mb-0 p-3 pb-0 text-white">
                                    Selamat Datang
                                    <b class="font-weight-bolder">{{ $user->name }}</b>!
                                </h4>
                                <p class="mb-0 px-4 px-sm-6">
                                    Sudah melakukan kebaikan apa kamu hari ini?
                                </p>
                            </div>
                        </div>
                    </div>
                    @foreach ($banner->filter(function ($item) {
            return $item->target == 'MAHASISWA' || $item->target == 'SEMUA';
        }) as $item)
                        <div class="carousel-item">
                            <div class="row flex-column justify-content-center height-300"
                                style="background-image: url('{{ $item->image }}'); background-size: cover; background-position: center;">
                                <span class="mask bg-gradient-dark opacity-6"></span>
                                <div
                                    class="d-flex justify-content-center flex-column align-items-center text-white text-center z-index-1">
                                    <h4 class="font-weight-bold mb-0 p-3 pb-0 text-white">
                                        {{ $item->title }}
                                    </h4>
                                    <p class="mb-0 px-4 px-sm-6">
                                        {{ $item->desc }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDashboard"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselDashboard"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-12 mb-4 gy-3 g-lg-3 d-md-none row mx-auto">
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.tahun_ajaran.index') }}"
                    class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tahun Ajaran">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Tahun Ajaran</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.jurusan.index') }}"
                    class="icon icon-shape p-0 bg-teal shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Jurusan">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Jurusan</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.matkul.index') }}"
                    class="icon icon-shape p-0 bg-green shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Mata Kuliah">
                    <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Mata Kuliah</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.admin.index') }}"
                    class="icon icon-shape p-0 bg-cyan shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Admin">
                    <i class="fas fa-user-cog text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Admin</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.mahasiswa.index') }}"
                    class="icon icon-shape p-0 bg-blue shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Mahasiswa">
                    <i class="fas fa-user-graduate text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Mahasiswa</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.tagihan.index') }}"
                    class="icon icon-shape p-0 bg-indigo shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tagihan">
                    <i class="fas fa-wallet text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Tagihan</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.transaksi.index') }}"
                    class="icon icon-shape p-0 bg-purple shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Transaksi">
                    <i class="fas fa-money-check-alt text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Transaksi</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.dokumen.index') }}"
                    class="icon icon-shape p-0 bg-pink shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Dokumen">
                    <i class="fas fa-folder-open text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Dokumen</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.link.zoom') }}"
                    class="icon icon-shape p-0 bg-red shadow text-center border-radius-md cursor-pointer"
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
                <a href="{{ route('admin.profile') }}"
                    class="icon icon-shape p-0 bg-yellow shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Profile">
                    <i class="fas fa-user-alt text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Profile</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('admin.settings.general') }}"
                    class="icon icon-shape p-0 bg-warning shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Pengaturan">
                    <i class="fas fa-cog text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Settings</span>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card h-100 p-3">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                    style="background-image: url('https://suniindonesia.com/wp-content/uploads/2022/10/masjid-pogung-dalangan-fQET4BjQmvc-unsplash.jpg');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body position-relative z-index-1 d-flex flex-column justify-content-center gap-2">
                        <p class="text-white w-100 mb-0 text-center">Kalender hari ini,</p>
                        <h5 class="text-white font-weight-bolder fs-1 d-flex justify-content-evenly w-100 mb-0">
                            <span>{{ $hijriDateday }}</span>
                            <span class="text-green font-weight-normal"
                                style="font-family: 'Rubik', sans-serif;">{{ $hijriDatemonth }}</span>
                        </h5>
                        <h5 class="w-100 mb-0 text-center lh-1 text-green font-weight-light"
                            style="font-family: 'Rubik', sans-serif;">
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
                        <div class="col-lg-6 col-5 my-auto text-end">
                            <div class="dropdown float-lg-end pe-4">
                                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                </a>
                                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a class="dropdown-item border-radius-md"
                                            href="{{ route('admin.pendaftar.index') }}">Tampilkan Pendaftar</a></li>
                                    <li><a class="dropdown-item border-radius-md"
                                            href="{{ route('admin.mahasiswa.index') }}">Tampilkan Mahasiswa</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama /
                                        Nomor Telepon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender
                                        / Role</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                        Biodata</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                        Dokumen</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                        Administrasi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                        Pra-Kuliah</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Bergabung pada</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users->where('role', 'Mahasiswa')->take(20) as $index => $item)
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
                                        <td class="text-secondary text-xs font-weight-bold text-center">
                                            @if ($item->biodata)
                                                <span class="badge rounded-pill bg-gradient-success">Lengkap <i
                                                        class="fas fa-plus ms-1"></i></span>
                                            @else
                                                <span class="badge rounded-pill bg-gradient-danger">Tidak Ada <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        {{-- status dokumen --}}
                                        <td class="text-secondary text-xs font-weight-bold text-center">
                                            @if ($item->document)
                                                <span class="badge rounded-pill bg-gradient-success">Lengkap <i
                                                        class="fas fa-plus ms-1"></i></span>
                                            @else
                                                <span class="badge rounded-pill bg-gradient-danger">Tidak Ada <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        {{-- status administrasi --}}
                                        <td class="text-secondary text-xs font-weight-bold text-center">
                                            @forelse ($item->transaksi->where('jenis_tagihan', 'Administrasi')->take(1) as $key)
                                                @if ($key->status == 'berhasil')
                                                    <span class="badge rounded-pill bg-gradient-success">Lunas <i
                                                            class="fas fa-check ms-1"></i></span>
                                                @elseif ($key->status == 'expired')
                                                    <span class="badge rounded-pill bg-gradient-danger">Gagal <i
                                                            class="fas fa-times ms-1"></i></span>
                                                @else
                                                    <span class="badge rounded-pill bg-gradient-warning">Belum
                                                        dibayar</span>
                                                @endif
                                            @empty
                                                <span class="badge rounded-pill bg-gradient-warning">Tidak ada</span>
                                            @endforelse
                                        </td>
                                        {{-- status pra-kuliah / daftar ulang --}}
                                        <td class="text-secondary text-xs font-weight-bold text-center">
                                            @forelse ($item->transaksi->where('jenis_tagihan', 'DaftarUlang')->take(1) as $key)
                                                @if ($key->status == 'berhasil')
                                                    <span class="badge rounded-pill bg-gradient-success">Lunas <i
                                                            class="fas fa-check ms-1"></i></span>
                                                @elseif ($key->status == 'expired')
                                                    <span class="badge rounded-pill bg-gradient-danger">Gagal <i
                                                            class="fas fa-times ms-1"></i></span>
                                                @else
                                                    <span class="badge rounded-pill bg-gradient-warning">Belum
                                                        dibayar</span>
                                                @endif
                                            @empty
                                                <span class="badge rounded-pill bg-gradient-warning">Tidak ada</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            <p class="text-xs text-uppercase text-secondary font-weight-bold mb-0">
                                                {{ $item->created_at->format('d M Y') }}</p>
                                            <p class="text-xxs text-uppercase text-secondary mb-0">
                                                {{ $item->created_at->format('H:i:s') }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a style="letter-spacing: .02rem"
                                                href="{{ route('admin.mahasiswa.show', $item->id) }}"
                                                class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs"
                                                data-toggle="tooltip" data-original-title="detail">
                                                Detail
                                            </a>

                                            <a style="letter-spacing: .02rem"
                                                href="{{ route('admin.mahasiswa.edit', $item->id) }}"
                                                class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs mx-1"
                                                data-toggle="tooltip" data-original-title="edit">
                                                Ubah
                                            </a>

                                            <form action="{{ route('admin.mahasiswa.delete', $item->id) }}"
                                                class="d-inline" id="form1" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs border-0"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>

                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                    Peringatan! <i
                                                                        class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                                                </h1>
                                                                <button type="button"
                                                                    class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close">&times;</button>
                                                            </div>
                                                            <div class="modal-body h6 mb-0">
                                                                <i class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                                                Apakah anda yakin ingin menghapus data pendaftar?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn bg-gradient-primary">Lanjut</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <form action="{{ route('admin.mahasiswa.status', $item->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                @if ($item->status == 'on')
                                                    <input type="hidden" name="status" value="off">
                                                    <button
                                                        class="badge badge-sm bg-gradient-dark font-weight-bolder text-xxs ms-1 border-0"
                                                        type="submit">
                                                        OFF
                                                    </button>
                                                @elseif($item->status == 'off')
                                                    <input type="hidden" name="status" value="on">
                                                    <button
                                                        class="badge badge-sm bg-teal font-weight-bolder text-xxs ms-1 border-0"
                                                        type="submit">
                                                        ON
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="text-center pt-4 fst-italic text-sm">
                                        ~ tidak ada pendaftar terbaru ~
                                    </div>
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
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Daftar Transaksi Terbaru</h6>
                        <a href="{{ route('admin.transaksi.index') }}"
                            class="badge badge-sm text-xxs font-weight-bolder bg-gradient-info">Show</a>
                    </div>
                </div>
                <div class="card-body p-3">
                    @forelse ($transaksi->take(20) as $item)
                        <div class="timeline timeline-one-side">
                            <div class="timeline-block mb-2">
                                <span class="timeline-step">
                                    <i class="fas fa-money-check-alt text-success text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <a href="{{ route('admin.transaksi.show', $item->id) }}"
                                        class="text-dark text-sm font-weight-bold mb-0">
                                        Rp. {{ number_format($item->total, 0, '', '.') }},
                                        <span class="font-weight-normal">
                                            @if ($item->tagihanDetails)
                                                {{ $item->tagihanDetails->biayasDetail->nama_biaya }}
                                            @else
                                                {{ $item->jenis_tagihan }}
                                            @endif
                                        </span>
                                    </a>
                                    <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                        {{ $item->created_at->format('d M y H:i:s') }} -
                   
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center pt-4 fst-italic text-sm">
                            ~ tidak ada transaksi yang dilakukan ~
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
