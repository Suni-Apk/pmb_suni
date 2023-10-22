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
    @if (Auth::user()->role == 'Admin')
        <div class="collapse navbar-collapse w-auto min-vh-70" id="sidenav-collapse-main">
            <ul class="navbar-nav overflow-x-hidden accordion" id="accordionSidebar">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item accordion-item">
                    <span role="button" class="nav-link accordion-button collapsed d-flex justify-content-between pe-5"
                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne">
                        <div
                            class="icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-university"></i>
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
                    <span class="nav-link-text ms-1">University</span>
                    </span>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
                        <div class="accordion-body py-1">
                            <a href="{{ route('billing') }}" class="nav-link">
                                <i class="fas fa-book"></i>
                                Program Belajar
                            </a>
                        </div>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
                        <div class="accordion-body py-1">
                            <a href="{{ route('billing') }}" class="nav-link">
                                <i class="ni ni-hat-3"></i>
                                Tahun Academy
                            </a>
                        </div>
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
                        </div>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            {{-- academy --}}
            <li class="nav-item">
                <ul class="nav-link pb-0 mb-0">
                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-university"></i></span>
                    <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> academy </span>
                </ul>
            </li>

            <!-- tahun ajaran -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#angkatan" class="nav-link" aria-controls="angkatan" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="ni ni-hat-3"></i>
                    </div>
                    <span class="nav-link-text ms-1">University</span>
                    </span>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
                        <div class="accordion-body py-1">
                            <a href="{{ route('billing') }}" class="nav-link">
                                <i class="fas fa-book"></i>
                                Program Belajar
                            </a>
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
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            {{-- academy --}}
            <li class="nav-item">
                <ul class="nav-link pb-0 mb-0">
                    <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i class="fas fa-university"></i></span>
                    <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> academy </span>
                </ul>
            </li>

            <!-- tahun ajaran -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#angkatan" class="nav-link" aria-controls="angkatan" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="ni ni-hat-3"></i>
                    </div>
                    <span class="nav-link-text ms-1"> Tahun Ajaran </span>
                </a>
                <div class="collapse" id="angkatan">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                <span class="sidenav-normal"> Daftar Tahun Ajaran </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                <span class="sidenav-normal"> Tambah Tahun Ajaran </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- jurusan -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#jurusan" class="nav-link" aria-controls="jurusan" role="button" aria-expanded="false">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="ni ni-paper-diploma"></i>
                    </div>
                    <span class="nav-link-text ms-1"> Jurusan </span>
                </a>
                <div class="collapse" id="jurusan">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                <span class="sidenav-normal"> Daftar Jurusan </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                <span class="sidenav-normal"> Tambah Jurusan </span>
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
                        <span class="nav-link-text ms-1">Admin</span>
                    </a>
                </li>
                
                <!-- biaya -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#payment" class="nav-link " aria-controls="payment" role="button" aria-expanded="false">
                        <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
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

            {{-- payment --}}
            <li class="nav-item">
                <ul class="nav-link pb-0 mb-0">
                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="ni ni-credit-card"></i></span>
                    <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> payment </span>
                </ul>
            </li>

            <!-- billing -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#billing" class="nav-link" aria-controls="billing" role="button" aria-expanded="false">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <span class="nav-link-text ms-1"> Biaya Tagihan </span>
                </a>
                <div class="collapse" id="billing">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                <span class="sidenav-normal"> Daftar Biaya Tagihan </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                <span class="sidenav-normal"> Tambah Biaya Tagihan </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- transaction -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#transaction" class="nav-link" aria-controls="transaction" role="button" aria-expanded="false">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <span class="nav-link-text ms-1"> Transaksi </span>
                </a>
                <div class="collapse" id="transaction">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                <span class="sidenav-normal"> Daftar Transaksi </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                <span class="sidenav-normal"> Tambah Transaksi </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            {{-- other --}}
            <li class="nav-item">
                <ul class="nav-link pb-0 mb-0">
                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="ni ni-credit-card"></i></span>
                    <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> other </span>
                </ul>
            </li>

            <!-- document -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#document" class="nav-link" aria-controls="document" role="button" aria-expanded="false">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <span class="nav-link-text ms-1"> Dokumen </span>
                </a>
                <div class="collapse" id="document">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                <span class="sidenav-normal"> Daftar Dokumen </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                <span class="sidenav-normal"> Tambah Dokumen </span>
                            </a>
                        </li>
                    </ul>
                </div>
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
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="ni ni-building"></i></span>
                                <span class="sidenav-normal"> General </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="ni ni-bell-55"></i></span>
                                <span class="sidenav-normal"> Notifikasi </span>
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
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('change-password') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-key"></i></span>
                                <span class="sidenav-normal"> Forgot Password </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('table') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-table"></i></span>
                                <span class="sidenav-normal"> Table </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('profile') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-user-circle"></i></span>
                                <span class="sidenav-normal"> Profile </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('edit-profile') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-user-circle"></i></span>
                                <span class="sidenav-normal"> Edit Profile </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('form') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-align-right"></i></span>
                                <span class="sidenav-normal"> Form </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('billing') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-money-bill"></i></span>
                                <span class="sidenav-normal"> Billing </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 nav-item">
        <a class="btn bg-gradient-primary btn-tooltip mt-3 w-100 nav-link text-white" href="" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout" data-container="body" data-animation="true">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
</aside>
