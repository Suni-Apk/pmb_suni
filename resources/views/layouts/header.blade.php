{{-- navbar --}}
@php
    $biodata = App\Models\Biodata::where('program_belajar', 'S1')
        ->where('user_id', Auth::user()->id)
        ->first();
@endphp
@if (Route::is('mahasiswa.program_belajar'))
@else
    <nav class="navbar navbar-main navbar-fixed navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky"
        id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <span role="button" class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none">
                <span class="nav-link text-white p-0">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line shadow" style="background: #28ce25"></i>
                        <i class="sidenav-toggler-line shadow" style="background: #1bba19"></i>
                        <i class="sidenav-toggler-line shadow" style="background: #0e8a0c"></i>
                    </div>
                </span>
            </span>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <ul class="ms-md-auto navbar-nav justify-content-end">
                    <li class="nav-item d-xl-none me-4 d-flex align-items-center">
                        <span role="button" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </span>
                    </li>

                    @if (Auth::user()->role == 'Admin')    
                    <li class="nav-item dropdown me-3 d-flex align-items-center">
                        <a href="" class="nav-link text-body py-1 px-2 rounded-circle border" id="dropdownTutorial"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-clipboard-check fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownTutorial">
                            <hr class="horizontal dark m-0">
                            <div class="d-flex justify-content-start align-items-center flex-column mb-1">
                                <img src="/assets/img/developer-2.svg" class="w-50 mb-1">
                                <span class="px-3 fw-bolder text-center text-xs text-dark w-100 d-inline-block text-uppercase">Tips dari Developer</span>
                            </div>
                            <hr class="horizontal dark m-0">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="">
                                    <div class="d-flex py-1">
                                        {{-- <div class="my-auto">
                                            <img src="/assets/img/developer.svg"
                                                class="avatar avatar-sm me-3">
                                        </div> --}}
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Dev Dzaki</span> said,
                                            </h6>
                                            <p class="text-xs text-secondary mb-0 ">
                                                <i class="far fa-check-circle me-1"></i>
                                                Buat data jurusan dan kursus terlebih dahulu
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item border-radius-md" href="">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Dev Farhan</span> said,
                                            </h6>
                                            <p class="text-xs text-secondary mb-0 ">
                                                <i class="far fa-check-circle me-1"></i>
                                                Lalu buat data mata kuliah dan mata pelajarannya
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item border-radius-md" href="">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Dev Rey</span> said,
                                            </h6>
                                            <p class="text-xs text-secondary mb-0 ">
                                                <i class="far fa-check-circle me-1"></i>
                                                Selanjutnya buat data tahun ajaran, ex. 2024
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item border-radius-md" href="">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Dev Haidar</span> said,
                                            </h6>
                                            <p class="text-xs text-secondary mb-0 ">
                                                <i class="far fa-check-circle me-1"></i>
                                                Selanjutnya buat data link grup wa ataupun grup zoom
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item border-radius-md" href="">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Dev Dzaki</span> said,
                                            </h6>
                                            <p class="text-xs text-secondary mb-0 ">
                                                <i class="far fa-check-circle me-1"></i>
                                                Selanjutnya buat data tagihan untuk siswa / mahasiswa
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item border-radius-md" href="">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Dev Farhan</span> said,
                                            </h6>
                                            <p class="text-xs text-secondary mb-0 text-wrap">
                                                <i class="far fa-check-circle me-1"></i>
                                                Setelahnya silahkan buka pendaftaran dengan mengaktifkan data tahun ajaran terbaru
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <div class="vr me-2 my-1 rounded-2" style="width: 2px;"></div>
                    @endif

                    <li class="nav-item dropdown d-flex align-items-center">
                        <span role="button" class="nav-link text-body font-weight-bold px-0" id="dropdownProfile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="@if (!Auth::user()->biodata) /assets/img/no-profile.png
                            @elseif($biodata)
                                {{ asset('storage/' . $biodata->image) }}
                            @else
                                /assets/img/no-profile.png @endif"
                                alt="" class="avatar avatar-sm ms-2">
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-2 me-sm-n3"
                            aria-labelledby="dropdownProfile">
                            <li class="mb-1">
                                <span class="dropdown-item border-radius-md">
                                    <div class="d-flex">
                                        <p class="mb-0 text-capitalize">{{ Auth::user()->name }}</p>
                                    </div>
                                </span>
                            </li>
                            <li class="mb-1">
                                @if (Auth::user()->role == 'Admin')
                                <a class="dropdown-item border-radius-md" href="{{ route('admin.profile') }}">
                                    <div class="d-flex">
                                        <p class="mb-0">Account Settings</p>
                                    </div>
                                </a>
                                @elseif (Auth::user()->role == 'Mahasiswa')
                                <a class="dropdown-item border-radius-md" href="{{ route('mahasiswa.profile.index') }}">
                                    <div class="d-flex">
                                        <p class="mb-0">Account Settings</p>
                                    </div>
                                </a>
                                @elseif (Auth::user()->role == 'Kursus')
                                <a class="dropdown-item border-radius-md" href="{{ route('kursus.profile.index') }}">
                                    <div class="d-flex">
                                        <p class="mb-0">Account Settings</p>
                                    </div>
                                </a>
                                @endif
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md" href="{{ route('logout') }}">
                                    <div class="d-flex">
                                        <p class="mb-0 fw-bold">Logout</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
@endif
