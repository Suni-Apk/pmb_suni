@extends('auth.layouts.master')

@section('title', 'Login')

@section('content')
<section>
    <div class="page-header min-vh-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h3 class="font-weight-bolder text-primary text-gradient">Selamat Datang Kembali</h3>
                            <p class="mb-0">Enter your phone and password to sign in</p>
                        </div>
                        <div class="card-body">
                            <form role="form" action="{{ route('login.process') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="mb-3 form-floating">
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" placeholder="0896XXXXXXXX">
                                    <label class="font-weight-bold text-dark" for="phone">No. Handphone</label>
                                    @error('phone')
                                        <p style="font-size: 11px;" class="font-weight-bold text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 form-floating">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                                    value="{{ old('password') }}" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                                    <label class="font-weight-bold text-dark" for="password">Password</label>
                                    @error('password')
                                        <p style="font-size: 11px;" class="font-weight-bold text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="card-footer pt-0 px-lg-2 pb-0">
                                    <p class="mb-4 text-sm mx-auto">
                                        Lupa
                                        <a href="{{ route('forgot.password') }}" class="text-primary text-gradient font-weight-bold">Password Anda ?</a>
                                    </p>
                                </div>
                                
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0">Sign in</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Belum punya akun? &nbsp;
                                <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign Up</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pt-4">
                    <div class="d-none d-md-block p-1">
                        <img src="/assets/img/learning.svg" class="img-fluid" draggable="false">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection