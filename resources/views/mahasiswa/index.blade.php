@extends('layouts.master')

@section('title', 'Dashboard')


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
@endpush

@section('content')
    <div class="row">
        
        <div class="col-12 text-center mb-4">
            <div class="card">
                <h6 class="text-secondary font-weight-normal my-3 px-3">proses pendaftaran kamu sampai dimana nih?</h6>
                <div class="multisteps-form">
                    <div class="row">
                        <div class="col-12 col-lg-10 mx-auto mb-3">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="Register">
                                    <span>Register</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active" type="button" title="Bayar Administrasi">
                                    <span>Bayar Administrasi</span>
                                </button>
                                @if ($biodata && !Auth::user()->document)
                                    <button class="multisteps-form__progress-btn js-active" type="button" title="Mengisi Biodata">
                                        <span>Mengisi Biodata</span>
                                    </button>
                                @else
                                    <button class="multisteps-form__progress-btn" type="button" title="Mengisi Biodata">
                                        <span>Mengisi Biodata</span>
                                    </button>
                                    <button class="multisteps-form__progress-btn js-active" type="button" title="Upload Dokumen">
                                        <span>Upload Dokumen</span>
                                    </button>
                                @endif
                                <button class="multisteps-form__progress-btn" type="button" title="Bayar Pra-Kuliah">
                                    <span>Bayar Pra-Kuliah</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Selesai">
                                    <span>Selesai!</span>
                                </button>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 mb-lg-0 mb-4">
            <div id="carouselDashboard" data-bs-ride="carousel" data-bs-interval="3000" class="carousel slide page-header align-items-start height-300 pb-7 rounded-3">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselDashboard" data-bs-slide-to="0" class="active" aria-current="true"></button>
                    @foreach ($banner->filter(function ($item) {
                        return $item->target == 'MAHASISWA' || $item->target == 'SEMUA';
                        }) as $item)
                    <button type="button" data-bs-target="#carouselDashboard" data-bs-slide-to="{{ $loop->index+1 }}" class="" aria-current="true"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row flex-column justify-content-center height-300"
                        style="background-image: url('/assets/img/curved-images/curved14.jpg'); background-size: cover; background-position: center;">
                            <span class="mask bg-gradient-dark opacity-6"></span>
                            <div class="d-flex justify-content-center flex-column align-items-center text-white text-center z-index-1">
                                <h4 class="font-weight-bold mb-0 p-3 pb-0 text-white">
                                    Selamat Datang 
                                    <b class="font-weight-bolder">{{ $user->name }}</b>!
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
                            <div class="d-flex justify-content-center flex-column align-items-center text-white text-center z-index-1">
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
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDashboard" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselDashboard" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-12 mb-4 gy-3 g-lg-3 d-md-none row mx-auto justify-content-center">
        @if (!$biodata && !Auth::user()->document)
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.pendaftaran.s1') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Isi Biodata">
                    <i class="fas fa-user-shield text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Isi Biodata</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.pendaftaran.document') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Dokumen">
                    <i class="fas fa-folder text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Upload Dokumen</span>
            </div>
        @elseif ($biodata && !Auth::user()->document)
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.pendaftaran.document') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Dokumen">
                    <i class="fas fa-folder text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Upload Dokumen</span>
            </div>
        @elseif (!$biodata && Auth::user()->document)
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.pendaftaran.s1') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Isi Biodata">
                    <i class="fas fa-user-shield text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Isi Biodata</span>
            </div>
        @else
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.matkul') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Mata Kuliah">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Mata Kuliah</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.tagihan.index') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tagihan">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Tagihan</span>
            </div>
        @endif
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.profile.index') }}" class="icon icon-shape p-0 bg-yellow shadow text-center border-radius-md cursor-pointer"
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
                        class="list-group-item list-group-item-action border-0 shadow text-center active">Program Kuliah S1</a>
                    <a id="list-kursus-list" data-bs-toggle="list" href="#list-kursus" role="tab"
                        aria-controls="list-kursus"
                        class="list-group-item list-group-item-action border-0 shadow text-center">Program Kursus</a>
                </div>
            </div>
        @else
        <div class="col-12 mt-4" id="informasi">
            <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                <a id="list-sarjana-list" data-bs-toggle="list" href="#list-sarjana" role="tab"
                    aria-controls="list-sarjana"
                    class="list-group-item list-group-item-action border-0 shadow text-center active w-50">Program Kuliah S1</a>
        
                <form id="form-kursus" action="{{ route('administrasiKursus', ['id' => Auth::id()]) }}" class="w-50" method="POST">
                    @csrf
                    <a id="list-kursus-list" href="#" onclick="event.preventDefault(); document.getElementById('form-kursus').submit();" role="tab" aria-controls="list-kursus" class="list-group-item list-group-item-action border-0 shadow text-center">Program Kursus</a>
                </form>
            </div>
        </div>    
        @endif
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
                    {{-- @foreach ($linkKursus as $item) --}}
                        <div class="card border mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Hukum Ekonomi Syariah</h5>
                                <a href="#" class="btn btn-primary mt-3">Klik Untuk Bergabung</a>
                            </div>
                        </div>
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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