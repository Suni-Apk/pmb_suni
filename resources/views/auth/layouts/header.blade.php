@if (!Route::is('mahasiswa.program_belajar'))
    <header class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav
                    class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid pe-0">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-n2 p-0 fs-6" href="{{ route('welcome') }}">
                            <img src="{{ App\Models\General::first()->image }}" class="avatar me-2" style="filter: drop-shadow(0 1rem 5px rgb(255, 255, 255));">
                            <span class="d-none d-sm-inline">{{ App\Models\General::first()->name }}</span>
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navigation">
                            <ul class="navbar-nav pt-3 pt-sm-0 me-lg-2">
                                @if (Auth::user())
                                    @if (Auth::user()->role == 'Admin')
                                        <li class="nav-item mb-2 mb-sm-0">
                                            <a class="btn mt-2 mt-lg-0 bg-gradient-dark mb-0 rounded-pill letter-spacing-1" href="{{route('admin.dashboard')}}">
                                                Dashboard
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item mb-2 mb-sm-0">
                                            <a class="btn mt-2 mt-lg-0 bg-gradient-dark mb-0 rounded-pill letter-spacing-1" href="{{route('mahasiswa.dashboard')}}">
                                                Dashboard
                                            </a>
                                        </li>
                                    @endif
                                    <li class="nav-item mb-2 mb-sm-0">
                                        <a class="btn mt-2 mt-lg-0 btn-outline-dark ms-2 rounded-pill mb-0" href="{{route('logout')}}">
                                            Logout
                                        </a>
                                    </li>
                                @else
                                    <div class="dropdown">
                                        <button class="btn btn-outline-dark dropdown-toggle me-2 mb-0 rounded-pill" data-bs-toggle="dropdown" id="dropdownReg">
                                            <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                            Daftar
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownReg">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('s1.register') }}">
                                                    <i class="me-2 fas fa-graduation-cap"></i>
                                                    Program Formal
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('kursus.register') }}">
                                                    <i class="me-2 fas fa-user-tag"></i>
                                                    Program Non Formal
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn bg-gradient-dark dropdown-toggle mb-0 rounded-pill" data-bs-toggle="dropdown" id="dropdownLogin">
                                            <i class="fas fa-key opacity-6 text-white me-1"></i>
                                            Masuk
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownLogin">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('login') }}">
                                                    <i class="fas me-3 fa-user"></i>
                                                  Mahasiswa
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.login') }}">
                                                    <i class="fas me-2 fa-user-cog"></i>
                                                  Admin
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </header>
@endif
