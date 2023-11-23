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
                            <h3 class="font-weight-bolder text-dark text-gradient">Selamat Datang Kembali</h3>
                            <p class="mb-0">Enter your phone and password to sign in</p>
                        </div>
                        <div class="card-body">
                            <form role="form" action="{{route('admin.login.process')}}" method="POST">
                                @csrf
                                @method('POST')
                                <label>No. Handphone</label>
                                <div class="mb-3">
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukkan Nomor" aria-label="nomor" value="{{ old('phone') }}" aria-describedby="nomor-addon">
                                    @error('phone')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                                </div>

                                <label>Password</label>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 mt-4 mb-0">Sign in</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Belum punya akun? &nbsp;
                                <a href="" class="text-dark text-gradient font-weight-bold">Sign up</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pt-4">
                    <div class="d-none d-md-block p-4">
                        <img src="/assets/img/login-admin.svg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection