<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 overflow-x-hidden"
    id="sidenav-main">
    <div class="sidenav-header position-sticky">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="">
            <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">PMB SUNI Indonesia</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto min-vh-75" id="sidenav-collapse-main">
            <ul class="navbar-nav overflow-x-hidden" id="accordionSidebar">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('kursus.dashboard') ? 'active' : '' }}"
                        href="{{ route('kursus.dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                @if (!Auth::user()->biodata)
                    <!-- biodata -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('kursus.pendaftaran.kursus') ? 'active' : '' }}"
                            href="{{ route('kursus.pendaftaran.kursus') }}">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="nav-link-text ms-1">Isi Biodata</span>
                        </a>
                    </li>
                    <!-- profile -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('kursus.profile.*') ? 'active' : '' }}"
                            href="{{ route('kursus.profile.index') }}">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-alt"></i>
                            </div>
                            <span class="nav-link-text ms-1">Profile</span>
                        </a>
                    </li>
                @elseif(!$biodata)
                    <!-- biodata -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('kursus.pendaftaran.kursus') ? 'active' : '' }}"
                            href="{{ route('kursus.pendaftaran.kursus') }}">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="nav-link-text ms-1">Isi Biodata</span>
                        </a>
                    </li>
                    {{-- other --}}
                    <li class="nav-item">
                        <ul class="nav-link pb-0 mb-0">
                            <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                    class="fas fa-sliders-h"></i></span>
                            <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> other </span>
                        </ul>
                    </li>
    
                    <!-- profile -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('kursus.profile.*') ? 'active' : '' }}"
                            href="{{ route('kursus.profile.index') }}">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-alt"></i>
                            </div>
                            <span class="nav-link-text ms-1">Profile</span>
                        </a>
                    </li>
                    
                @elseif ($biodata)
                    {{-- academy --}}
                    <li class="nav-item">
                        <ul class="nav-link pb-0 mb-0">
                            <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                    class="fas fa-university"></i></span>
                            <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> academy </span>
                        </ul>
                    </li>

                    <!-- tahun ajaran -->
                    <li class="nav-item">
                        <a href="{{ route('kursus.mapel') }}"
                            class="nav-link {{ Route::is('kursus.mapel') ? 'active' : '' }}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                                <i class="ni ni-hat-3"></i>
                            </div>
                            <span class="nav-link-text ms-1"> Mata Pelajaran </span>
                        </a>
                    </li>
                    {{-- payment --}}
                    <li class="nav-item">
                        <ul class="nav-link pb-0 mb-0">
                            <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                    class="ni ni-credit-card"></i></span>
                            <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> payment </span>
                        </ul>
                    </li>
                    <!-- billing -->
                    <li class="nav-item">
                        <a href="{{ route('kursus.tagihan.index') }}"
                            class="nav-link {{ Route::is('kursus.tagihan.*') ? 'active' : '' }}"
                            aria-controls="billing" role="button" aria-expanded="false">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <span class="nav-link-text ms-1"> Tagihan </span>
                        </a>
                    </li>
                    {{-- other --}}
                    <li class="nav-item">
                        <ul class="nav-link pb-0 mb-0">
                            <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                    class="fas fa-sliders-h"></i></span>
                            <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> other </span>
                        </ul>
                    </li>

                    <!-- profile -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('kursus.profile.*') ? 'active' : '' }}"
                            href="{{ route('kursus.profile.index') }}">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-alt"></i>
                            </div>
                            <span class="nav-link-text ms-1">Profile</span>
                        </a>
                    </li>
                @endif

                
        </div>
        <div class="sidenav-footer mx-3 nav-item">
            <a class="btn bg-gradient-primary btn-tooltip mt-3 w-100 nav-link text-white"
                href="{{ route('logout') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout"
                data-container="body" data-animation="true">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
</aside>
