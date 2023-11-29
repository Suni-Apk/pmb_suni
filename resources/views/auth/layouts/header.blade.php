@if (!Route::is('mahasiswa.program_belajar'))
    <header class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav
                    class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid pe-0">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ route('welcome') }}">
                            PMB SUNI Indonesia
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
                            <ul class="navbar-nav me-lg-2">
                                @if (Auth::user())
                                    @if (Auth::user()->role == 'Admin')
                                        <li class="nav-item">
                                            <a class="btn bg-gradient-secondary mb-0 me-2 rounded-pill letter-spacing-1" href="{{route('admin.dashboard')}}">
                                                Dashboard
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="btn bg-gradient-secondary mb-0 me-2 rounded-pill letter-spacing-1" href="{{route('mahasiswa.dashboard')}}">
                                                Dashboard
                                            </a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link me-2" href="{{route('s1.register')}}">
                                            <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                            Daftar
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link me-2" href="{{route('login')}}">
                                            <i class="fas fa-key opacity-6 text-dark me-1"></i>
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
