@extends('auth.layouts.master')

@section('title', 'Register')

@section('content')
    <section class="min-vh-25">
        <div id="carouselRegister" class="carousel slide page-header align-items-start height-500 pb-7 m-3 border-radius-lg z-index-1" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators" style="top: 5rem;">
                @foreach ($banner->where('type', 'WELCOME') as $item)
                <button type="button" data-bs-target="#carouselRegister" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true"></button>
                @endforeach
              </div>
            <div class="carousel-inner">
                @foreach ($banner->where('type', 'WELCOME') as $item)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row flex-column justify-content-center height-500"
                    style="background-image: url('{{ $item->image }}'); background-size: cover; background-position: center;">
                        <span class="mask bg-gradient-dark opacity-3 z-index-1"></span>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselRegister" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselRegister" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container mt-lg-n12 mt-md-n12 mt-n12 position-relative z-index-3">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto pb-6">
                    <h1 class="text-white mb-1">Selamat Datang!</h1>
                    <p class="letter-spacing-1 text-white">Harap isi formulir dibawah ini dengan benar.</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-lg-n4 mt-md-n4 mt-n4 position-relative z-index-3">
                <div class="col-xl-8 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5 class="mb-0">Daftar disini <i class="fas fa-arrow-down text-sm text-secondary"></i></h5>

                            @if (session('noAccess'))
                                <div class="alert alert-warning mb-0 mt-3 text-white alert-dismissible fade show" role="alert">
                                    <strong>Maaf.</strong> {!! session('noAccess') !!}
                                    <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                            @endif
                        </div>
                        <div class="card-body pt-2">
                            <form role="form text-left" action="{{ route('register.process.new') }}" method="POST" id="registerForm">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        @php
                                            $tahunAjaran = App\Models\TahunAjaran::latest()->first();
                                        @endphp
                                        <input type="hidden" name="tahunAjaran" value="{{ $tahunAjaran->id }}">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nama Lengkap <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
                                            @error('name')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nomor Whatshap <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Enter Your Phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Password <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password">
                                            @error('password')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="birthdate" class="form-label">Ulangi Password <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                placeholder="Password" aria-label="Password">
                                            @error('password_confirmation')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Email <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter Your Phone" value="{{ old('email') }}">
                                            @error('email')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender / Jenis Kelamin <strong
                                                    class="text-danger">*</strong></label>
                                            <select name="gender" id="gender"
                                                class="form-select @error('gender') is-invalid @enderror">
                                                <option value="" disabled selected>Pilih Gender Anda</option>
                                                <option value="Laki-Laki" @selected(old('gender') == 'Laki-Laki')>Laki-Laki</option>
                                                <option value="Perempuan" @selected(old('gender') == 'Laki-Laki')>Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="program" class="form-label">Program Akademik<strong
                                                    class="text-danger">*</strong></label>
                                            <select name="program_belajar" id="programBelajar"
                                                class="form-select @error('program_belajar') is-invalid @enderror">
                                                <option value="" disabled selected>Pilih Program Akademik</option>
                                                <option value="S1" @selected(old('program_belajar') == 'S1')>S1</option>
                                                @php
                                                    $courses = App\Models\Course::get();
                                                @endphp
                                                @foreach ($courses as $item)
                                                    <option value="{{ $item->keyword }}" @selected(old('program_belajar') == $item->keyword)>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('program_belajar')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                var programBelajarDropdown = document.getElementById('programBelajar');
                                                var registerForm = document.getElementById('registerForm');
                                        
                                                programBelajarDropdown.addEventListener('change', function () {
                                                    var selectedProgram = programBelajarDropdown.value;
                                                    var baseUrl = '{{ route('register') }}';
                                                    
                                                    // Perbarui URL tanpa mereload halaman
                                                    history.pushState(null, null, baseUrl + '/' + selectedProgram);
                                                });
                                                
                                                // Jika ada parameter program pada URL, pilih nilainya dalam dropdown
                                                var currentProgram = window.location.pathname.split('/').pop();
                                                if (currentProgram) {
                                                    programBelajarDropdown.value = currentProgram;
                                                }
                                        
                                                // Tangkap perubahan URL dan perbarui dropdown
                                                window.addEventListener('popstate', function () {
                                                    var currentProgram = window.location.pathname.split('/').pop();
                                                    programBelajarDropdown.value = currentProgram;
                                                });
                                            });
                                        </script>                                                                               
                                        <div class="form-check form-check-info text-left">
                                            <input class="form-check-input" type="checkbox" value="" id="checkBill"
                                                checked>
                                            <label class="form-check-label" for="checkBill">
                                                I agree the <a href="" class="text-dark font-weight-bolder">Terms and
                                                    Conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="nextStep" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                        up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Sudah punya akun? <a href="{{ route('login') }}"
                                        class="text-dark text-gradient font-weight-bolder">Sign in</a></p>
                            </form>
                            {{-- <script>
                            var chk = document.getElementById("checkBill");
                            var nextStep = document.getElementById("nextStep");
                            var paymentLink = document.getElementById("paymentLink");

                            var nextTrue = "btn bg-gradient-dark w-100 my-4 mb-2";
                            var nextFalse = "btn bg-gradient-dark w-100 my-4 mb-2";

                            chk.addEventListener("change", function() {
                                if (chk.checked) {
                                    nextStep.setAttribute("type", "submit");
                                    nextStep.setAttribute("disabled", false);
                                } else {
                                    nextStep.setAttribute("type", "button");
                                    nextStep.setAttribute("disabled", true);
                                }
                            });
                        </script> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
