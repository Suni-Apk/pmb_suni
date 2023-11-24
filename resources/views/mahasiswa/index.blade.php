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
                                <button class="multisteps-form__progress-btn" type="button" title="Bayar Registrasi">
                                <span>Bayar Registrasi</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Mengisi Biodata">
                                <span>Mengisi Biodata</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Upload Dokumen">
                                <span>Upload Dokumen</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Bayar Pra-Kuliah">
                                <span>Bayar Pra-Kuliah</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Bayar Pra-Kuliah">
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
        <div class="col-12" id="informasi">
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
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/assets/img/small-logos/logo-xd.svg"
                                                    class="avatar avatar-sm me-3" alt="xd">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Soft UI XD Version</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                                <img src="/assets/img/team-1.jpg" alt="team1">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                                <img src="/assets/img/team-2.jpg" alt="team2">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Alexander Smith">
                                                <img src="/assets/img/team-3.jpg" alt="team3">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                <img src="/assets/img/team-4.jpg" alt="team4">
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
                                                <div class="progress-bar bg-gradient-info w-60" role="progressbar"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/assets/img/small-logos/logo-atlassian.svg"
                                                    class="avatar avatar-sm me-3" alt="atlassian">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Add Progress Track</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                                <img src="/assets/img/team-2.jpg" alt="team5">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                <img src="/assets/img/team-4.jpg" alt="team6">
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
                                                <div class="progress-bar bg-gradient-info w-10" role="progressbar"
                                                    aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/assets/img/small-logos/logo-slack.svg"
                                                    class="avatar avatar-sm me-3" alt="team7">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Fix Platform Errors</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                                <img src="/assets/img/team-3.jpg" alt="team8">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                <img src="/assets/img/team-1.jpg" alt="team9">
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
                                                <div class="progress-bar bg-gradient-success w-100" role="progressbar"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/assets/img/small-logos/logo-spotify.svg"
                                                    class="avatar avatar-sm me-3" alt="spotify">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Launch our Mobile App</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                                <img src="/assets/img/team-4.jpg" alt="user1">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                                <img src="/assets/img/team-3.jpg" alt="user2">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Alexander Smith">
                                                <img src="/assets/img/team-4.jpg" alt="user3">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                <img src="/assets/img/team-1.jpg" alt="user4">
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
                                                <div class="progress-bar bg-gradient-success w-100" role="progressbar"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/assets/img/small-logos/logo-jira.svg"
                                                    class="avatar avatar-sm me-3" alt="jira">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Add the New Pricing Page</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                                <img src="/assets/img/team-4.jpg" alt="user5">
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
                                                <div class="progress-bar bg-gradient-info w-25" role="progressbar"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="25"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/assets/img/small-logos/logo-invision.svg"
                                                    class="avatar avatar-sm me-3" alt="invision">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Redesign New Online Shop</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                                <img src="/assets/img/team-1.jpg" alt="user6">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                <img src="/assets/img/team-4.jpg" alt="user7">
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
                                                <div class="progress-bar bg-gradient-info w-40" role="progressbar"
                                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
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
                    <h6>Daftar Link</h6>
                    <p class="text-sm">
                        <i class="fas fa-link text-success" aria-hidden="true"></i>
                        Daftar link yang diikuti
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-bell-55 text-success text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <a href="" class="text-dark text-sm font-weight-bold mb-0">$2400, Design
                                    changes</a>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-html5 text-danger text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <a href="" class="text-dark text-sm font-weight-bold mb-0">New order #1832412</a>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block">
                            <span class="timeline-step">
                                <i class="ni ni-money-coins text-dark text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <a href="" class="text-dark text-sm font-weight-bold mb-0">New order #9583120</a>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                            </div>
                        </div>
                    </div>
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
