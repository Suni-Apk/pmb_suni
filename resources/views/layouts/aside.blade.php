<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 overflow-x-hidden"
    id="sidenav-main">
    <div class="sidenav-header position-sticky">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="">
            <img src="/soft-ui-dashboard-main/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100"
                alt="main_logo">
            <span class="ms-1 font-weight-bold">PMB SUNI Indonesia</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
                            class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

    @if (Auth::user()->role == 'Admin')
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
>>>>>>> 59a316c (update)
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
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
                        <div class="accordion-body py-1">
                            <a href="" class="nav-link">
                                <i class="ni ni-paper-diploma"></i>
                                Jurusan
                            </a>
                        </div>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
                        <div class="accordion-body py-1">
                            <a href="" class="nav-link">
                                <i class="ni ni-book-bookmark"></i>
                                Matakuliah
                            </a>
<<<<<<< HEAD
                        </div>
                    </div>
            </li>
            <!--Mahasiswa-->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('billing') }}">
                    <div
                        class="icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mahasiswa</span>
                </a>
            </li>
            <!--Admin-->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('billing') }}">
                    <div
                        class="icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-circle-08"></i>
                    </div>
                    <span class="nav-link-text ms-1">Admin</span>
                </a>
            </li>
            <!--Tagihan-->
            <li class="nav-item accordion-item">
                <span role="button" class="nav-link accordion-button collapsed d-flex justify-content-between pe-5"
                    data-bs-toggle="collapse" data-bs-target="#collapseTagihan" aria-expanded="false"
                    aria-controls="collapseTagihan">
                    <div
                        class="icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card"></i>
                        <title>credit-card</title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                    <g transform="translate(453.000000, 454.000000)">
                                        <path class="color-background opacity-6"
                                            d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Biaya</span>
                </span>
                <div id="collapseTagihan" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body py-1">
                        <a href="{{ route('billing') }}" class="nav-link">
                            <i class="fas fa-wallet"></i>
                            Biaya Tagihan
                        </a>
                    </div>
                </div>
                <div id="collapseTagihan" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body py-1">
                        <a href="{{ route('billing') }}" class="nav-link">
                            <i class="ni ni-ungroup"></i>
                            Biaya Bawaan
                        </a>
                    </div>
                </div>
            </li>
            <!--Transaction-->

            <li class="nav-item">
                <a class="nav-link" href="{{ route('table') }}">
                    <div
                        class="icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transaction</span>
                </a>
            </li>
            <!--Document-->

            <li class="nav-item accordion-item">
                <span role="button" class="nav-link accordion-button collapsed d-flex justify-content-between pe-5"
                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <div
                        class="icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-folder-open"></i>
                    </div>
<<<<<<< HEAD
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>customer-support</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(1.000000, 0.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="20px" viewBox="0 0 40 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>spaceship</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(4.000000, 301.000000)">
                                                <path class="color-background"
                                                    d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z">
                                                </path>
                                                <path class="color-background opacity-6"
                                                    d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z">
                                                </path>
                                                <path class="color-background opacity-6"
                                                    d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z">
                                                </path>
                                                <path class="color-background opacity-6"
                                                    d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Sign Up</span>
=======
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
                            {{-- <li class="nav-item ">
                                <a class="nav-link " href="{{ route('change-password') }}">
                                    <span class="sidenav-mini-icon"><i class="fas fa-key"></i></span>
                                    <span class="sidenav-normal"> Forgot Password </span>
                                </a>
                            </li> --}}
                            <li class="nav-item ">
                                <a class="nav-link ">
                                    <span class="sidenav-mini-icon"><i class="fas fa-table"></i></span>
                                    <span class="sidenav-normal"> Table </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link ">
                                    <span class="sidenav-mini-icon"><i class="fas fa-user-circle"></i></span>
                                    <span class="sidenav-normal"> Profile </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link ">
                                    <span class="sidenav-mini-icon"><i class="fas fa-user-circle"></i></span>
                                    <span class="sidenav-normal"> Edit Profile </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link ">
                                    <span class="sidenav-mini-icon"><i class="fas fa-align-right"></i></span>
                                    <span class="sidenav-normal"> Form </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link ">
                                    <span class="sidenav-mini-icon"><i class="fas fa-money-bill"></i></span>
                                    <span class="sidenav-normal"> Billing </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            <!-- biaya -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#payment" class="nav-link " aria-controls="payment" role="button"
                    aria-expanded="false">
                    <div
                        class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="ni ni-credit-card"></i>
                    </div>
<<<<<<< HEAD
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
                                <a class="nav-link " href="{{ route('forgot') }}">
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
                href="{{ route('admin.logout') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Logout" data-container="body" data-animation="true">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
        </li>
    @endif
>>>>>>> c36d872 (update)
=======
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
