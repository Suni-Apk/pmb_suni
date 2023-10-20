<header class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid pe-0">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ route('dashboard') }}">
                    PMB SUNI Indonesia
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav me-lg-2">
                            <li class="nav-item">
                            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ route('dashboard') }}">
                                <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                                Dashboard
                            </a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link me-2" href="">
                                <i class="fa fa-user opacity-6 text-dark me-1"></i>
                                Profile
                            </a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link me-2" href="">
                                <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                Sign Up
                            </a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link me-2" href="">
                                <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                Sign In
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</header>