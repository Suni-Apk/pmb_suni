{{-- navbar --}}
<nav class="navbar navbar-main navbar-fixed navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky"
    id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <span class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none">
            <span role="button" class="nav-link text-white p-0">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-primary"></i>
                    <i class="sidenav-toggler-line bg-primary"></i>
                    <i class="sidenav-toggler-line bg-primary"></i>
                </div>
            </span>
        </span>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            {{-- <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div> --}}
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
                    <span role="button" class="nav-link text-body font-weight-bold px-0" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/soft-ui-dashboard-main/assets/img/team-2.jpg" class="avatar avatar-sm ms-2">
                    </span>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-2 me-sm-n2" aria-labelledby="dropdownProfile">
                        <li class="mb-1">
                            <span class="dropdown-item border-radius-md">
                                <div class="d-flex">
                                    <p class="mb-0">Admin</p>
                                </div>
                            </span>
                        </li>
                        <li class="mb-1">
                            <a class="dropdown-item border-radius-md" href="">
                                <div class="d-flex">
                                    <p class="mb-0">Account Settings</p>
                                </div>
                            </a>
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
        <ul class="navbar-nav justify-content-end">
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
                                    <img src="../soft-ui-dashboard-main/assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
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
                <span role="button" class="nav-link text-body font-weight-bold px-0" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../soft-ui-dashboard-main/assets/img/team-2.jpg" class="avatar avatar-sm ms-2">
                </span>
                <ul class="dropdown-menu dropdown-menu-end px-2 py-2 me-sm-n2" aria-labelledby="dropdownProfile">
                    <li class="mb-1">
                        <span class="dropdown-item border-radius-md">
                            <div class="d-flex">
                                <p class="mb-0">Admin</p>
                            </div>
                        </span>
                    </li>
                    <li class="mb-1">
                        <a class="dropdown-item border-radius-md" href="">
                            <div class="d-flex">
                                <p class="mb-0">Account Settings</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item border-radius-md" href="{{route('logout')}}">
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
