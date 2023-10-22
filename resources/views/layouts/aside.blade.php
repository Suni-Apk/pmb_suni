<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="">
            <img src="../soft-ui-dashboard-main/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100"
                alt="main_logo">
            <span class="ms-1 font-weight-bold">PMB SUNI Indonesia</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto min-vh-70" id="sidenav-collapse-main">
        <ul class="navbar-nav overflow-x-hidden" id="accordionSidebar">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-th-large"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <!-- kuliah -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#university" class="nav-link" aria-controls="university"
                    role="button" aria-expanded="false">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fas fa-university"></i>
                    </div>
                    <span class="nav-link-text ms-1">University</span>
                </a>
                <div class="collapse" id="university">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="fas fa-book"></i></span>
                                <span class="sidenav-normal"> Program Belajar </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="ni ni-hat-3"></i></span>
                                <span class="sidenav-normal"> Tahun Akademi </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="ni ni-paper-diploma"></i></span>
                                <span class="sidenav-normal"> Jurusan </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="ni ni-book-bookmark"></i></span>
                                <span class="sidenav-normal"> Mata Kuliah </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!--mahasiswa-->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('billing') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mahasiswa</span>
                </a>
            </li>

            <!--admin-->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('table') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-cog"></i>
                    </div>
<<<<<<< HEAD
                    <span class="nav-link-text ms-1">Admin</span>
                </a>
            </li>
=======
                </li>
                
                <!-- settings -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#settings" class="nav-link" aria-controls="settings" role="button" aria-expanded="false">
                        <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fas fa-cog"></i>
                        </div>
                        <span class="nav-link-text ms-1">Settings</span>
                    </a>
                    <div class="collapse " id="settings">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"><i class="ni ni-building"></i></span>
                                    <span class="sidenav-normal"> General </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"><i class="ni ni-bell-55"></i></span>
                                    <span class="sidenav-normal"> Notification </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- template -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#template" class="nav-link " aria-controls="template" role="button" aria-expanded="false">
                        <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fas fa-tools"></i>
                        </div>
                        <span class="nav-link-text ms-1">Template</span>
                    </a>
                    <div class="collapse " id="template">
                        <ul class="nav ms-4 ps-3">
                            {{-- <li class="nav-item ">
                                <a class="nav-link " href="{{ route('change-password') }}">
                                    <span class="sidenav-mini-icon"><i class="fas fa-key"></i></span>
                                    <span class="sidenav-normal"> Forgot Password </span>
                                </a>
                            </li> --}}
                            <li class="nav-item ">
                                <a class="nav-link " >
                                    <span class="sidenav-mini-icon"><i class="fas fa-table"></i></span>
                                    <span class="sidenav-normal"> Table </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " >
                                    <span class="sidenav-mini-icon"><i class="fas fa-user-circle"></i></span>
                                    <span class="sidenav-normal"> Profile </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " >
                                    <span class="sidenav-mini-icon"><i class="fas fa-user-circle"></i></span>
                                    <span class="sidenav-normal"> Edit Profile </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " >
                                    <span class="sidenav-mini-icon"><i class="fas fa-align-right"></i></span>
                                    <span class="sidenav-normal"> Form </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " >
                                    <span class="sidenav-mini-icon"><i class="fas fa-money-bill"></i></span>
                                    <span class="sidenav-normal"> Billing </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
>>>>>>> 65afec8 (update)

            <!-- biaya -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#payment" class="nav-link " aria-controls="payment" role="button"
                    aria-expanded="false">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="ni ni-credit-card"></i>
                    </div>
                    <span class="nav-link-text ms-1">Biaya</span>
                </a>
                <div class="collapse " id="payment">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="fas fa-wallet"></i></span>
                                <span class="sidenav-normal"> Biaya Tagihan </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="ni ni-ungroup"></i></span>
                                <span class="sidenav-normal"> Biaya Bawaan </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- transaksi -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('table') }}">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transaction</span>
                </a>
            </li>

            <!-- dokumen -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#document" class="nav-link " aria-controls="document"
                    role="button" aria-expanded="false">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <span class="nav-link-text ms-1">Document</span>
                </a>
                <div class="collapse " id="document">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="fas fa-file-pdf"></i></span>
                                <span class="sidenav-normal"> All Document </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="fas fa-file-pdf"></i></span>
                                <span class="sidenav-normal"> RPL Document </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- settings -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#settings" class="nav-link" aria-controls="settings"
                    role="button" aria-expanded="false">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fas fa-cog"></i>
                    </div>
                    <span class="nav-link-text ms-1">Settings</span>
                </a>
                <div class="collapse " id="settings">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="ni ni-building"></i></span>
                                <span class="sidenav-normal"> General </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon"><i class="ni ni-bell-55"></i></span>
                                <span class="sidenav-normal"> Notification </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- template -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#template" class="nav-link " aria-controls="template"
                    role="button" aria-expanded="false">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fas fa-tools"></i>
                    </div>
                    <span class="nav-link-text ms-1">Template</span>
                </a>
                <div class="collapse " id="template">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('change-password') }}">
                                <span class="sidenav-mini-icon"><i class="fas fa-key"></i></span>
                                <span class="sidenav-normal"> Forgot Password </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('table') }}">
                                <span class="sidenav-mini-icon"><i class="fas fa-table"></i></span>
                                <span class="sidenav-normal"> Table </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('profile') }}">
                                <span class="sidenav-mini-icon"><i class="fas fa-user-circle"></i></span>
                                <span class="sidenav-normal"> Profile </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('edit-profile') }}">
                                <span class="sidenav-mini-icon"><i class="fas fa-user-circle"></i></span>
                                <span class="sidenav-normal"> Edit Profile </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('form') }}">
                                <span class="sidenav-mini-icon"><i class="fas fa-align-right"></i></span>
                                <span class="sidenav-normal"> Form </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('billing') }}">
                                <span class="sidenav-mini-icon"><i class="fas fa-money-bill"></i></span>
                                <span class="sidenav-normal"> Billing </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- profile -->
            <li class="nav-item">
                <a class="nav-link " href="">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-alt"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 nav-item">
        <a class="btn bg-gradient-primary btn-tooltip mt-3 w-100 nav-link text-white"
            href="{{ route('admin.logout') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout"
            data-container="body" data-animation="true">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
</aside>
