@extends('auth.layouts.master')

@section('title', 'Register')

@section('content')
    <section class="min-vh-25 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('/soft-ui-dashboard-main/assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
                        <p class="text-lead text-white">Mahasiswa Ini Adalah Tempat Registrasi Akun.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-8 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register Disini</h5>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" action="{{ route('register.process.new') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-6">
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
                                                placeholder="Password" value="{{ old('password') }}">
                                            @error('password')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-check form-check-info text-left">
                                            <input class="form-check-input" type="checkbox" value="" id="checkBill"
                                                checked>
                                            <label class="form-check-label" for="checkBill">
                                                I agree the <a href="" class="text-dark font-weight-bolder">Terms and
                                                    Conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
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
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender / Jenis Kelamin <strong
                                                    class="text-danger">*</strong></label>
                                            <select name="program_belajar" id="gender"
                                                class="form-select @error('program_belajar') is-invalid @enderror">
                                                <option value="" disabled selected>Pilih Program Belajar</option>
                                                <option value="S1" selected>S1</option>
                                                <option value="KURSUS">KURSUS</option>
                                            </select>
                                            @error('program_belajar')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="birthdate" class="form-label">Ulangi Password <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                placeholder="Password" aria-label="Password" value="{{ old('password_confirmation') }}">
                                            @error('password_confirmation')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="nextStep" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                        up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Sudah punya akun? <a href=""
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
