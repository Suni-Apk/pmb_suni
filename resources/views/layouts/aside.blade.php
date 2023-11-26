@php
    $biodata = App\Models\Biodata::where('program_belajar', 'S1')
        ->where('user_id', Auth::user()->id)
        ->first();
@endphp
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white overflow-hidden"
    id="sidenav-main">
    <div class="sidenav-header position-sticky">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand text-center m-0" href="{{ route('welcome') }}">
            <img src="{{ App\Models\General::first()->image }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">{{ App\Models\General::first()->name }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    @if (Auth::user()->role == 'Admin')
        <div class="collapse navbar-collapse w-auto min-vh-75" id="sidenav-collapse-main">
            <ul class="navbar-nav overflow-x-hidden" id="accordionSidebar">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
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
                        <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                class="fas fa-university"></i></span>
                        <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> academy </span>
                    </ul>
                </li>

                <!-- tahun ajaran -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#angkatan" class="nav-link {{ Route::is('admin.tahun_ajaran.*') ? 'active' : '' }}" aria-controls="angkatan" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="ni ni-hat-3"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Tahun Ajaran </span>
                    </a>
                    <div class="collapse {{ Route::is('admin.tahun_ajaran.*') ? 'show' : '' }}" id="angkatan">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.tahun_ajaran.index') ? 'active' : '' }} "
                                    href="{{ route('admin.tahun_ajaran.index') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-border-all"></i></span>
                                    <span class="sidenav-normal"> Daftar Tahun Ajaran </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.tahun_ajaran.create') ? 'active' : '' }} "
                                    href="{{ route('admin.tahun_ajaran.create') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                    <span class="sidenav-normal"> Tambah Tahun Ajaran </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- jurusan -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#jurusan"
                        class="nav-link {{ Route::is('admin.jurusan.*') ? 'active' : '' }}" aria-controls="jurusan"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="ni ni-paper-diploma"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Jurusan </span>
                    </a>
                    <div class="collapse {{ Route::is('admin.jurusan.*') ? 'show' : '' }}" id="jurusan">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.jurusan.index') ? 'active' : '' }} "
                                    href="{{ route('admin.jurusan.index') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-border-all"></i></span>
                                    <span class="sidenav-normal"> Daftar Jurusan </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.jurusan.create') ? 'active' : '' }} "
                                    href="{{ route('admin.jurusan.create') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                    <span class="sidenav-normal"> Tambah Jurusan </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- mata kuliah -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#matkul"
                        class="nav-link {{ Route::is('admin.matkul.*') ? 'active' : '' }}" aria-controls="matkul"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="ni ni-hat-3"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Mata Kuliah </span>
                    </a>
                    <div class="collapse {{ Route::is('admin.matkul.*') ? 'show' : '' }}" id="matkul">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.matkul.index') ? 'active' : '' }} "
                                    href="{{ route('admin.matkul.index') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-border-all"></i></span>
                                    <span class="sidenav-normal"> Daftar Mata Kuliah </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.matkul.create') ? 'active' : '' }} "
                                    href="{{ route('admin.matkul.create') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-plus"></i></span>
                                    <span class="sidenav-normal"> Tambah Mata Kuliah </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#mapel" class="nav-link {{ Route::is('admin.mapel.*') ? 'active' : '' }}" aria-controls="matkul" role="button" aria-expanded="false">
                        <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Mata Pelajaran </span>
                    </a>
                    <div class="collapse {{ Route::is('admin.mapel.*') ? 'show' : '' }}" id="mapel">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.mapel.index') ? 'active' : '' }} " href="{{ route('admin.mapel.index') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                    <span class="sidenav-normal"> Daftar Mata Pelajaran </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.mapel.create') ? 'active' : '' }} " href="{{ route('admin.mapel.create') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                    <span class="sidenav-normal"> Tambah Mata Kuliah </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Course -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#course" class="nav-link {{ Route::is('admin.course.*') ? 'active' : '' }}" aria-controls="course" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="ni ni-book-bookmark"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Kursus </span>
                    </a>
                    <div class="collapse {{ Route::is('admin.course.*') ? 'show' : '' }}" id="course">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('admin.course.index') ? 'active' : '' }}" href="{{ route('admin.course.index') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-border-all"></i></span>
                                    <span class="sidenav-normal"> Daftar Kursus </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('admin.course.create') ? 'active' : '' }}" href="{{ route('admin.course.create') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="fas fa-plus"></i></span>
                                    <span class="sidenav-normal"> Tambah Kursus </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- users --}}
                <li class="nav-item">
                    <ul class="nav-link pb-0 mb-0">
                        <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                class="fas fa-users"></i></span>
                        <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> users </span>
                    </ul>
                </li>

                <!-- admin -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#admin"
                        class="nav-link {{ Route::is('admin.admin.*') ? 'active' : '' }}" aria-controls="admin"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Admin </span>
                    </a>
                    <div class="collapse {{ Route::is('admin.admin.*') ? 'show' : '' }}" id="admin">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.admin.index') ? 'active' : '' }} "
                                    href="{{ route('admin.admin.index') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-border-all"></i></span>
                                    <span class="sidenav-normal"> Daftar Admin </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.admin.create') ? 'active' : '' }} "
                                    href="{{ route('admin.admin.create') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-plus"></i></span>
                                    <span class="sidenav-normal"> Tambah Admin </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- mahasiswa -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#mahasiswa"
                        class="nav-link {{ Route::is('admin.mahasiswa.*') ? 'active' : '' }}"
                        aria-controls="mahasiswa" role="button" aria-expanded="false">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Mahasiswa </span>
                    </a>
                    <div class="collapse {{ Route::is('admin.mahasiswa.*') ? 'show' : '' }}" id="mahasiswa">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.mahasiswa.index') ? 'active' : '' }} "
                                    href="{{ route('admin.mahasiswa.index') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-border-all"></i></span>
                                    <span class="sidenav-normal"> Daftar Mahasiswa </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.mahasiswa.create') ? 'active' : '' }} "
                                    href="{{ route('admin.mahasiswa.create') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-plus"></i></span>
                                    <span class="sidenav-normal"> Tambah Mahasiswa </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- pendaftar -->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.pendaftar.*') ? 'active' : '' }}" href="{{ route('admin.pendaftar.index') }}">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pendaftar</span>
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

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.tagihan.*') ? 'active' : '' }}" href="{{ route('admin.tagihan.index') }}">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <span class="nav-link-text ms-1">Biaya Tagihan</span>
                    </a>
                    <div class="collapse {{ Route::is('admin.tagihan.*') ? 'show' : '' }}" id="billing">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('admin.tagihan.index') ? 'active' : '' }}" href="{{ route('admin.tagihan.index') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-border-all"></i></span>
                                    <span class="sidenav-normal"> Daftar Biaya Tagihan </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.tagihan.create') ? 'active' : '' }}" href="{{ route('admin.tagihan.create') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-plus"></i></span>
                                    <span class="sidenav-normal"> Tambah Biaya Tagihan </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- transaction -->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.transaksi.index') ? 'active' : '' }}"
                        href="{{ route('admin.transaksi.index') }}">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <span class="nav-link-text ms-1">Transaksi</span>
                    </a>
                </li>

                {{-- other --}}
                <li class="nav-item">
                    <ul class="nav-link pb-0 mb-0">
                        <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                class="ni ni-credit-card"></i></span>
                        <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> other </span>
                    </ul>
                </li>

                <!-- document -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#document"
                        class="nav-link {{ Route::is('admin.dokumen.*') ? 'active' : '' }}" aria-controls="document"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Dokumen </span>
                    </a>
                    <div class="collapse {{ Route::is('admin.dokumen.*') ? 'show' : '' }}" id="document">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.dokumen.index') ? 'active' : '' }}"
                                    href="{{ route('admin.dokumen.index') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-border-all"></i></span>
                                    <span class="sidenav-normal"> Daftar Dokumen </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.dokumen.create') ? 'active' : '' }}"
                                    href="{{ route('admin.dokumen.create') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-plus"></i></span>
                                    <span class="sidenav-normal"> Tambah Dokumen </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- link -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#link" aria-controls="link" role="button" aria-expanded="false"
                    class="nav-link {{ Route::is('admin.link.*') ? 'active' : '' }}">
                        <div class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2">
                            <i class="fas fa-link"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Link </span>
                    </a>
                    <div class="collapse {{ Route::is('admin.link.*') ? 'show' : '' }}" id="link">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.link.zoom') ? 'active' : '' }}" href="{{ route('admin.link.zoom') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block">
                                        <img src="/assets/img/icon-zoom.svg" width="14px">
                                    </span>
                                    <span class="sidenav-normal"> Link Zoom </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.link.whatsapp') ? 'active' : '' }}" href="{{ route('admin.link.whatsapp') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i class="fab fa-whatsapp"></i></span>
                                    <span class="sidenav-normal"> Link Whatsapp </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- report -->
                <li class="nav-item">
                    <a class="nav-link " href="">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-flag"></i>
                        </div>
                        <span class="nav-link-text ms-1">Laporan</span>
                    </a>
                </li>

                <!-- profile -->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.profile') ? 'active' : '' }}"
                        href="{{ route('admin.profile') }}">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-alt"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>

                <!-- settings -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#settings"
                        class="nav-link {{ Route::is('admin.administrasi') || Route::is('admin.settings.*') ? 'active' : '' }}"
                        aria-controls="settings" role="button" aria-expanded="false">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fas fa-cog"></i>
                        </div>
                        <span class="nav-link-text ms-1">Settings</span>
                    </a>
                    <div class="collapse {{ Route::is('admin.administrasi') || Route::is('admin.settings.*') ? 'show' : '' }}"
                        id="settings">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.settings.general') ? 'active' : '' }}"
                                    href="{{ route('admin.settings.general') }}">
                                    <span class="sidenav-mini-icon"><i class="ni ni-building"></i></span>
                                    <span class="sidenav-normal"> General </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.administrasi') ? 'active' : '' }}"
                                    href="{{ route('admin.administrasi') }}">
                                    <span class="sidenav-mini-icon"><i class="fas fa-stream"></i></span>
                                    <span class="sidenav-normal"> Administrasi </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.settings.notifications') ? 'active' : '' }}"
                                    href="{{ route('admin.settings.notifications') }}">
                                    <span class="sidenav-mini-icon"><i class="ni ni-bell-55"></i></span>
                                    <span class="sidenav-normal"> Notifikasi </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.settings.component') ? 'active' : '' }}"
                                    href="{{ route('admin.settings.component') }}">
                                    <span class="sidenav-mini-icon"><i class="fas fa-layer-group"></i></span>
                                    <span class="sidenav-normal"> Komponen </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- template -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#template"
                        class="nav-link {{ Route::is('template.*') ? 'active' : '' }}" aria-controls="template"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fas fa-tools"></i>
                        </div>
                        <span class="nav-link-text ms-1">Template</span>
                    </a>
                    <div class="collapse {{ Route::is('template.*') ? 'show' : '' }}" id="template">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('forgot') ? 'active' : '' }} "
                                    href="{{ route('forgot') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-key"></i></span>
                                    <span class="sidenav-normal"> Forgot Password </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('table') ? 'active' : '' }} "
                                    href="{{ route('table') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-table"></i></span>
                                    <span class="sidenav-normal"> Table </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.profile') ? 'active' : '' }} "
                                    href="{{ route('admin.profile') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-user-circle"></i></span>
                                    <span class="sidenav-normal"> Profile </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('admin.profile') ? 'active' : '' }} "
                                    href="{{ route('admin.profile') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-user-circle"></i></span>
                                    <span class="sidenav-normal"> Edit Profile </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('form') ? 'active' : '' }} "
                                    href="{{ route('form') }}">
                                    <span class="sidenav-mini-icon"><i class="fas fa-align-right"></i></span>
                                    <span class="sidenav-normal"> Form </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::is('billing') ? 'active' : '' }} "
                                    href="{{ route('billing') }}">
                                    <span class="sidenav-mini-icon d-none d-xl-block"><i
                                            class="fas fa-money-bill"></i></span>
                                    <span class="sidenav-normal"> Billing </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer mx-3 nav-item">
            <a href="{{ route('logout') }}"
                class="btn bg-gradient-primary btn-tooltip mt-3 w-100 nav-link text-white" data-bs-toggle="tooltip"
                data-bs-placement="right" title="Logout" data-container="body" data-animation="true">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    @else
        <div class="collapse navbar-collapse w-auto min-vh-75" id="sidenav-collapse-main">
            <ul class="navbar-nav overflow-x-hidden" id="accordionSidebar">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('mahasiswa.dashboard') ? 'active' : '' }} {{ Route::is('mahasiswa.dashboard') ? 'active' : '' }}"
                        href="{{ route('mahasiswa.dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                {{-- @php
                $biaya = App\Models\Biaya::where('program_belajar','S1')->where('jenis_biaya','DaftarUlang')->where('id_angkatans',Auth::user()->biodata->angkatan_id)->latest()->first();
                
                $user = Auth::user();
                $tagihan = App\Models\TagihanDetail::where('id_biayas',$biaya->id)->where('id_users',$user->id)->latest()->first();
                // $bagi3 = $tagihan->amount / 3;
                // dd($bagi3);
                $transaction = round(App\Models\Transaksi::where('user_id',$user->id)->where('tagihan_detail_id',$tagihan->id)->where('jenis_tagihan',$biaya->jenis_biaya)->where('status','berhasil')->sum('total'));
                @endphp --}}
                @if (!$biodata && !Auth::user()->document)
                    <!-- biodata -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('mahasiswa.pendaftaran.s1') ? 'active' : '' }}"
                            href="{{ route('mahasiswa.pendaftaran.s1') }}">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="nav-link-text ms-1">Isi Biodata</span>
                        </a>
                    </li>
                    <!-- document -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('mahasiswa.pendaftaran.document') ? 'active' : '' }}"
                            href="{{ route('mahasiswa.pendaftaran.document') }}">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-folder"></i>
                            </div>
                            <span class="nav-link-text ms-1">Upload Dokumen</span>
                        </a>
                    </li>
                @elseif ($biodata && !Auth::user()->document)
                    <!-- dcoment -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('mahasiswa.pendaftaran.document') ? 'active' : '' }}"
                            href="{{ route('mahasiswa.pendaftaran.document') }}">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-folder"></i>
                            </div>
                            <span class="nav-link-text ms-1">Upload Dokumen</span>
                        </a>
                    </li>

                    {{-- payment --}}
                    <li class="nav-item">
                        <ul class="nav-link pb-0 mb-0">
                            <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                    class="ni ni-credit-card"></i></span>
                            <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> payment
                            </span>
                        </ul>
                    </li>

                    <!-- billing -->
                    <li class="nav-item">
                        <a href="{{ route('mahasiswa.tagihan.index') }}"
                            class="nav-link {{ Route::is('mahasiswa.tagihan.*') ? 'active' : '' }}"
                            aria-controls="billing" role="button" aria-expanded="false">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <span class="nav-link-text ms-1"> Tagihan </span>
                        </a>
                    </li>
                @elseif(!$biodata && Auth::user()->document)
                    <!-- biodata -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('mahasiswa.pendaftaran.s1') ? 'active' : '' }}"
                            href="{{ route('mahasiswa.pendaftaran.s1') }}">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="nav-link-text ms-1">Isi Biodata</span>
                        </a>
                    </li>
                @else
                    @if (!$transaction == $tagihan->amount)
                        
                    @else
                        {{-- academy --}}
                        <li class="nav-item">
                            <ul class="nav-link pb-0 mb-0">
                                <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                        class="fas fa-university"></i></span>
                                <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> academy
                                </span>
                            </ul>
                        </li>

                        <!-- matkul -->
                        <li class="nav-item">
                            <a href="{{ route('mahasiswa.matkul') }}"
                                class="nav-link {{ Route::is('mahasiswa.matkul') ? 'active' : '' }}">
                                <div
                                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                                    <i class="ni ni-hat-3"></i>
                                </div>
                                <span class="nav-link-text ms-1"> Mata Kuliah </span>
                            </a>
                        </li>
                    @endif

                    {{-- payment --}}
                    <li class="nav-item">
                        <ul class="nav-link pb-0 mb-0">
                            <span class="sidenav-mini-icon d-none d-xl-block" style="color:rgb(196, 196, 196)"><i
                                    class="ni ni-credit-card"></i></span>
                            <span class="sidenav-normal text-uppercase text-xs ms-2 font-weight-bolder"> payment
                            </span>
                        </ul>
                    </li>

                    <!-- billing -->
                    <li class="nav-item">
                        <a href="{{ route('mahasiswa.tagihan.index') }}"
                            class="nav-link {{ Route::is('mahasiswa.tagihan.*') ? 'active' : '' }}"
                            aria-controls="billing" role="button" aria-expanded="false">
                            <div
                                class="icon icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <span class="nav-link-text ms-1"> Tagihan </span>
                        </a>
                    </li>
                @endif

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
                    <a class="nav-link {{ Route::is('mahasiswa.profile.*') ? 'active' : '' }}"
                        href="{{ route('mahasiswa.profile.index') }}">
                        <div
                            class="icon icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-alt"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
        </div>
        <div class="sidenav-footer mx-3 nav-item">
            <a class="btn bg-gradient-primary btn-tooltip mt-3 w-100 nav-link text-white"
                href="{{ route('logout') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout"
                data-container="body" data-animation="true">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    @endif
</aside>
