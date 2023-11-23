<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 overflow-x-hidden"
    id="sidenav-main">
    <div class="sidenav-header position-sticky">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="">
            <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100"
                alt="main_logo">
            <span class="ms-1 font-weight-bold">PMB SUNI Indonesia</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    @if (Auth::user()->role == 'Admin')
        <div class="collapse navbar-collapse w-auto min-vh-75" id="sidenav-collapse-main">
        <ul class="navbar-nav overflow-x-hidden" id="accordionSidebar">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-th-large"></i>
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

            <!-- mata kuliah -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#matkul" class="nav-link" aria-controls="matkul" role="button" aria-expanded="false">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="ni ni-hat-3"></i>
                    </div>
                    <span class="nav-link-text ms-1"> Mata Kuliah </span>
                </a>
                <div class="collapse" id="matkul">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                <span class="sidenav-normal"> Daftar Mata Kuliah </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                <span class="sidenav-normal"> Tambah Mata Kuliah </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            {{-- users --}}
            <li class="nav-item">
                <ul class="nav-link pb-0 mb-0">
                    <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i class="fas fa-users"></i></span>
                    <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> users </span>
                </ul>
            </li>

            <!-- admin -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#admin" class="nav-link" aria-controls="admin" role="button" aria-expanded="false">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <span class="nav-link-text ms-1"> Admin </span>
                </a>
                <div class="collapse" id="admin">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                <span class="sidenav-normal"> Daftar Admin </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                <span class="sidenav-normal"> Tambah Admin </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- mahasiswa -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#mahasiswa" class="nav-link" aria-controls="mahasiswa" role="button" aria-expanded="false">
                    <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <span class="nav-link-text ms-1"> Mahasiswa </span>
                </a>
                <div class="collapse" id="mahasiswa">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                <span class="sidenav-normal"> Daftar Mahasiswa </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                <span class="sidenav-normal"> Tambah Mahasiswa </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- payment --}}
            <li class="nav-item">
                <ul class="nav-link pb-0 mb-0">
                    <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i class="ni ni-credit-card"></i></span>
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
                    <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i class="ni ni-credit-card"></i></span>
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
                            <a class="nav-link " href="{{ url('change-password') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-key"></i></span>
                                <span class="sidenav-normal"> Forgot Password </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('table') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-table"></i></span>
                                <span class="sidenav-normal"> Table </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('profile') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-user-circle"></i></span>
                                <span class="sidenav-normal"> Profile </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('edit-profile') }}">
                                <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-user-circle"></i></span>
                                <span class="sidenav-normal"> Edit Profile </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ url('form') }}">
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
    @else
        <div class="collapse navbar-collapse w-auto min-vh-75" id="sidenav-collapse-main">
            <ul class="navbar-nav overflow-x-hidden" id="accordionSidebar">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('mahasiswa.dashboard') ? 'active' : '' }}" href="{{ route('mahasiswa.dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-th-large"></i>
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
                    <a href="{{route('mahasiswa.matkul')}}" class="nav-link {{ Route::is('mahasiswa.matkul') ? 'active' : '' }}" >
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="ni ni-hat-3"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Mata Kuliah </span>
                    </a>
                </li>

                {{-- payment --}}
                <li class="nav-item">
                    <ul class="nav-link pb-0 mb-0">
                        <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i class="ni ni-credit-card"></i></span>
                        <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> payment </span>
                    </ul>
                </li>

                <!-- billing -->
                <li class="nav-item">
                    <a  href="{{route('mahasiswa.tagihan')}}" class="nav-link {{ Route::is('mahasiswa.tagihan') ? 'active' : '' }}" aria-controls="billing" role="button" aria-expanded="false">
                        <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Tagihan </span>
                    </a>
                </li>
                
                {{-- other --}}
                <li class="nav-item">
                    <ul class="nav-link pb-0 mb-0">
                        <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i class="fas fa-sliders-h"></i></span>
                        <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> other </span>
                    </ul>
                </li>

                <!-- profile -->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('mahasiswa.profile') ? 'active' : '' }}" href="{{route('mahasiswa.profile')}}">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-alt"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
        </div>
        <div class="sidenav-footer mx-3 nav-item">
            <a class="btn bg-gradient-primary btn-tooltip mt-3 w-100 nav-link text-white" href="" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout" data-container="body" data-animation="true">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    @endif
</aside>
