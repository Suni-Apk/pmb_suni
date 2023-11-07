@if (!Route::is('mahasiswa.program_belajar'))
    {{-- navbar --}}
    <nav class="navbar navbar-main navbar-fixed navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <span role="button" class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none">
                <span class="nav-link text-white p-0">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line shadow" style="background: rgb(79, 206, 56)"></i>
                        <i class="sidenav-toggler-line shadow" style="background: rgb(63, 184, 42)"></i>
                        <i class="sidenav-toggler-line shadow" style="background: rgb(45, 149, 27)"></i>
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
                    <li class="nav-item dropdown me-3 d-flex align-items-center">
                        <a href="" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="/soft-ui-dashboard-main/assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0 ">
                                                <i class="fa fa-clock me-1"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown d-flex align-items-center">
                        <span role="button" class="nav-link text-body font-weight-bold px-0" id="dropdownProfile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="@if (!Auth::user()->biodata)
                            /soft-ui-dashboard-main/assets/img/no-profile.png
                            @else
                                {{ asset('storage/' . Auth::user()->biodata->image)}}
                            @endif" class="avatar avatar-sm ms-2">
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-2 me-sm-n2" aria-labelledby="dropdownProfile">
                            <li class="mb-1">
                                <span class="dropdown-item border-radius-md">
                                    <div class="d-flex">
                                        <p class="mb-0 text-capitalize">{{ Auth::user()->name }}</p>
                                    </div>
                                </span>
                            </li>
                            <li class="mb-1">
                                <a class="dropdown-item border-radius-md" 
                                href="{{ Auth::user()->role == 'Admin' ? route('admin.profile') : route('mahasiswa.profile.index') }}">
                                    <div class="d-flex">
                                        <p class="mb-0">Profile Settings</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md" 
                                    href="{{ route('logout') }}">
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
