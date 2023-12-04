@extends('kursus.layouts.parent')

@section('title', 'Dashboard Kursus')


@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" rel="stylesheet">
@endpush

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
        <div class="col-12 text-center mb-4">
            <div class="card">
                <h6 class="text-secondary font-weight-normal my-3">Proses pendaftaran kamu sampai dimana nih?</h6>
                <div class="multisteps-form">
                    <div class="row">
                        <div class="col-12 col-lg-10 mx-auto mb-3">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="Register">
                                    <span>Register</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active" type="button"
                                    title="Bayar Registrasi">
                                    <span>Bayar Registrasi</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active" type="button"
                                    title="Mengisi Biodata">
                                    <span>Mengisi Biodata</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active" type="button"
                                    title="Bayar Pra-Kuliah">
                                    <span>Selesai!</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 mb-lg-0">
            <div id="carouselDashboard" data-bs-ride="carousel" data-bs-interval="3000"
                class="carousel slide page-header align-items-start height-300 pb-7 rounded-3">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselDashboard" data-bs-slide-to="0" class="active"
                        aria-current="true"></button>
                    @foreach ($banner->filter(function ($item) {
            return $item->target == 'MAHASISWA' || $item->target == 'SEMUA';
        }) as $item)
                        <button type="button" data-bs-target="#carouselDashboard" data-bs-slide-to="{{ $loop->index + 1 }}"
                            class="" aria-current="true"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row flex-column justify-content-center height-300"
                            style="background-image: url('/assets/img/curved-images/curved14.jpg'); background-size: cover; background-position: center;">
                            <span class="mask bg-gradient-dark opacity-6"></span>
                            <div
                                class="d-flex justify-content-center flex-column align-items-center text-white text-center z-index-1">
                                <h4 class="font-weight-bold mb-0 p-3 pb-0 text-white">
                                    Selamat Datang
                                    <b class="font-weight-bolder">{{ $mahasiswa->name }}</b>!
                                </h4>
                                <p class="mb-0 mx-2">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ut, voluptate?
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
                                    <p class="mb-0 mx-2">
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
        <div class="col-12 mb-4 gy-3 g-lg-3 d-md-none row mx-auto justify-content-center">
            @if (!$biodata && !Auth::user()->document)
                <div class="col-3 col-md-2 text-center">
                    <a href="{{ route('mahasiswa.pendaftaran.s1') }}"
                        class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Isi Biodata">
                        <i class="fas fa-user-shield text-lg opacity-10" aria-hidden="true"></i>
                    </a>
                    <span class="d-block mt-2" style="font-size: 13px;">Isi Biodata</span>
                </div>
                <div class="col-3 col-md-2 text-center">
                    <a href="{{ route('mahasiswa.pendaftaran.document') }}"
                        class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Dokumen">
                        <i class="fas fa-folder text-lg opacity-10" aria-hidden="true"></i>
                    </a>
                    <span class="d-block mt-2" style="font-size: 13px;">Upload Dokumen</span>
                </div>
            @elseif ($biodata && !Auth::user()->document)
                <div class="col-3 col-md-2 text-center">
                    <a href="{{ route('mahasiswa.pendaftaran.document') }}"
                        class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Dokumen">
                        <i class="fas fa-folder text-lg opacity-10" aria-hidden="true"></i>
                    </a>
                    <span class="d-block mt-2" style="font-size: 13px;">Upload Dokumen</span>
                </div>
            @elseif (!$biodata && Auth::user()->document)
                <div class="col-3 col-md-2 text-center">
                    <a href="{{ route('mahasiswa.pendaftaran.s1') }}"
                        class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Isi Biodata">
                        <i class="fas fa-user-shield text-lg opacity-10" aria-hidden="true"></i>
                    </a>
                    <span class="d-block mt-2" style="font-size: 13px;">Isi Biodata</span>
                </div>
            @else
                <div class="col-3 col-md-2 text-center">
                    <a href="{{ route('kursus.mapel') }}"
                        class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Mata Kuliah">
                        <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                    </a>
                    <span class="d-block mt-2" style="font-size: 13px;">Mata Kuliah</span>
                </div>
                <div class="col-3 col-md-2 text-center">
                    <a href="{{ route('kursus.tagihan.index') }}"
                        class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tagihan">
                        <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                    </a>
                    <span class="d-block mt-2" style="font-size: 13px;">Tagihan</span>
                </div>
            @endif
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('kursus.profile.index') }}"
                    class="icon icon-shape p-0 bg-yellow shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Profile">
                    <i class="fas fa-user-alt text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Profile</span>
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
        @php
            $user = Auth::user();
            $biodataS1 = App\Models\Biodata::where('user_id', $user->id)
                ->where('program_belajar', 'S1')
                ->first();
            $biodataKURSUS = App\Models\Biodata::where('user_id', $user->id)
                ->where('program_belajar', 'KURSUS')
                ->first();
        @endphp
        @if ($biodataS1 && $biodataKURSUS)
            <div class="col-12 mt-4" id="informasi">
                <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                    <a id="list-sarjana-list" data-bs-toggle="list" href="#list-sarjana" role="tab"
                        aria-controls="list-sarjana"
                        class="list-group-item list-group-item-action border-0 shadow text-center">Program Kuliah S1</a>
                    <a id="list-kursus-list" data-bs-toggle="list" href="#list-kursus" role="tab"
                        aria-controls="list-kursus"
                        class="list-group-item list-group-item-action border-0 shadow text-center active">Program
                        Kursus</a>
                </div>
            </div>
        @else
            {{-- Ini buat misalkan ia mau daftar jadi S1 tinggal pencet Program S1 nanti ia akan disuruh membayar Administrasi Trus Lanjut ke Pendaftaran S1 --}}
            <div class="col-12 mt-4" id="informasi">
                <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                    <form id="form-S1" action="{{ route('administrasiS1', ['id' => Auth::id()]) }}" class="w-50"
                        method="POST">
                        @csrf
                        <a id="list-S1-list" href="#"
                            onclick="event.preventDefault(); document.getElementById('form-S1').submit();" role="tab"
                            aria-controls="list-kursus"
                            class="list-group-item list-group-item-action border-0 shadow text-center">Program S1</a>
                    </form>

                    {{-- Ini buat misalkan ia mau daftar jadi KURSUS tinggal pencet Program KURSUS nanti ia akan disuruh membayar Administrasi Trus Lanjut ke Pendaftaran KURSUS --}}
                    <form id="form-kursus" action="{{ route('administrasiKursus', ['id' => Auth::id()]) }}"
                        class="w-50" method="POST">
                        @csrf
                        <a id="list-kursus-list" href="#"
                            onclick="event.preventDefault(); document.getElementById('form-kursus').submit();"
                            role="tab" aria-controls="list-kursus"
                            class="list-group-item list-group-item-action border-0 shadow text-center active">Program
                            Kursus</a>
                    </form>
                </div>
            </div>
        @endif
    </div>
    @if (!$kursusBiodata)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Isi Biodata Anda</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <form action="{{route('kursus.pendaftaran.kursus.process')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2Mb</p>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="alamat">Pilih Kursus</label>
                                            <select name="course_id" class="form-control">
                                                <option value="" disabled selected>Pilih Kursus</option>
                                                @foreach ($kursus as $index => $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="profesi">Profesi</label>
                                            <input type="text" name="profesi" id="profesi" class="form-control">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="">Bisa Baca Al-Qur'an?</label>
                                            <div class="d-block">
                                                <input type="radio" name="baca_quran" id="bisa" class="form-radio" value="Bisa">
                                                <label for="bisa">Bisa</label>
                                            </div>
                                            <div class="d-block">
                                                <input type="radio" name="baca_quran" id="tidakBisa" class="form-radio" value="Tidak Bisa">
                                                <label for="tidakBisa">Tidak Bisa</label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="birthdate">Tanggal Lahir</label>
                                            <input type="date" name="birthdate" id="birthdate" class="form-control">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="birthplace">Tempat Lahir</label>
                                            <input type="text" name="birthplace" id="birthplace" class="form-control" placeholder="Masukkan Tempat Lahir Anda">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="alamat">Alamat Kamu</label>
                                            <select name="provinsi" id="provinsi" class="form-control">
                                                <option value="" disabled selected>Pilih Provinsi</option>
                                                <!-- Data Provinsi dari API bisa dimasukkan di sini -->
                                            </select>
                                            <select name="kota" id="kota" class="form-control mt-2">
                                                <option value="" disabled selected>--- Pilih Kabupaten / Kota ---</option>
                                                <!-- Data Kabupaten dari API bisa dimasukkan di sini -->
                                            </select>
                                            <select name="kecamatan" id="kecamatan" class="form-control mt-2">
                                                <option value="" disabled selected>--- Pilih Kecamatan ---</option>
                                                <!-- Data Kota dari API bisa dimasukkan di sini -->
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="address">Jalan Dan Kode Pos</label>
                                            <textarea name="address" id="address" class="form-control"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
                            .then(response => response.json())
                            .then(provinces => {
                                var data = provinces;
                                var tampung = '<option>--- Pilih Provinsi ---</option>';
                                data.forEach(element => {
                                    tampung +=
                                        `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`;
                                });
                                document.getElementById('provinsi').innerHTML = tampung;
                            });
                    </script>
                    <script>
                        const selectProvinsi = document.getElementById('provinsi');
                        selectProvinsi.addEventListener('change', (e) => {
                            var provinsi = e.target.options[e.target.selectedIndex].dataset.reg;
                            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
                                .then(response => response.json())
                                .then(regencies => {
                                    var data = regencies;
                                    var tampung = '<option>--- Pilih Kota ---</option>';
                                    data.forEach(element => {
                                        tampung +=
                                            `<option data-dist="${element.id}" value="${element.name}">${element.name}</option>`;
                                    });
                                    document.getElementById('kota').innerHTML = tampung

                                });
                        });

                        const selectKota = document.getElementById('kota');
                        selectKota.addEventListener('change', (e) => {
                            var kota = e.target.options[e.target.selectedIndex].dataset.dist;
                            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
                                .then(response => response.json())
                                .then(districts => {
                                    var data = districts;
                                    var tampung = '<option>--- Pilih Kecamatan ---</option>';
                                    data.forEach(element => {
                                        tampung +=
                                            `<option data-vill="${element.id}" value="${element.name}">${element.name}</option>`;
                                    });
                                    document.getElementById('kecamatan').innerHTML = tampung;
                                });
                        });
                    </script>
                </div>
            </div>
        </div>
    @else
        <div class="row" style="max-height: 500px; overflow-y: auto;">
            @foreach ($kursus as $kursuss)
            <div class="col-sm-6 mb-3 mb-sm-0 mt-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $kursuss->name }}</h5>
                        <label for="">Mapel : @foreach ($kursuss->mapel as $item)
                            <strong>{{$item->name}} , </strong>
                        @endforeach</label>
                        <p class="card-text">
                            @if(strlen($kursuss->desc) > 80)
                                <span class="short-desc">{{ substr($kursuss->desc, 0, 80) }}...</span>
                                <span class="full-desc" style="display: none;">{{ $kursuss->desc }}</span>
                                <a href="#" class="read-more">Lihat Selengkapnya</a>
                            @else
                                {{ $kursuss->desc }}
                            @endif
                        </p>                                              
                        <a href="{{ route('kursus.pendaftaran.kursus') }}" class="btn btn-primary">Daftar Sekarang!!</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Daftar Tagihan</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                Daftar tagihan yang harus dibayarkan
                            </p>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            <div class="dropdown float-lg-end pe-4">
                                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                </a>
                                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li>
                                        <a class="dropdown-item border-radius-md" href="javascript:;">Action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item border-radius-md" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item border-radius-md" href="javascript:;">Something else
                                            here</a>
                                    </li>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Companies</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Members</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Budget</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Completion</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h3>Daftar Link</h3>
                    <p class="text-sm">
                        <i class="fas fa-link text-success" aria-hidden="true"></i>
                        Daftar link yang diikuti
                    </p>
                </div>
                <div class="container mb-3" style="max-height: 340px; overflow-y: auto;">
                    @foreach ($linkKursus as $item)
                        <div class="card border mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <a href="{{ $item->url }}" class="btn btn-primary mt-3">Klik Untuk Bergabung</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.read-more').click(function() {
                $('.short-desc').hide();
                $('.full-desc').show();
                $(this).hide();
                return false;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Menangani perubahan tab
            $('#list-tab a').on('click', function(e) {
                e.preventDefault();

                // Mendapatkan target tab yang diklik
                var target = $(this).attr('href');

                // Menampilkan atau menyembunyikan bagian dashboard berdasarkan tab yang dipilih
                if (target === "#list-sarjana") {
                    // Logika untuk menampilkan dashboard Sarjana
                    $("#dashboard-sarjana").show();
                    $("#dashboard-kursus").hide();
                } else if (target === "#list-kursus") {
                    // Logika untuk menampilkan dashboard Kursus
                    $("#dashboard-kursus").show();
                    $("#dashboard-sarjana").hide();
                }

                // Mengarahkan pengguna ke rute yang sesuai
                if (target === "#list-sarjana") {
                    window.location.href = "{{ route('mahasiswa.dashboard') }}";
                } else if (target === "#list-kursus") {
                    window.location.href = "{{ route('kursus.dashboard') }}";
                }

                // Menandai tab yang aktif
                $(this).tab('show');
            });
        });
    </script>
@endsection