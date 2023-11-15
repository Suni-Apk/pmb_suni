@extends('layouts.master')

@section('title', 'Change Password')

@section('content')
    <div class="page-header min-height-300 border-radius-xl"
        style="background-image: url('/soft-ui-dashboard-main/assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="/soft-ui-dashboard-main/assets/img/bruce-mars.jpg" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $auth->name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ $auth->role }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-fill bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-dark mb-0 px-0 py-1" 
                                href="{{ route('admin.profile') }}" role="tab">
                                <span class="ms-1">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark mb-0 px-0 py-1"
                                href="{{ route('admin.change_password', Auth::user()->name) }}" role="tab">
                                <span class="ms-1">Change password</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Change password</h6>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.profile_edit') }}">
                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit Profile"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <hr class="horizontal gray-light">
                    <ul class="list-group">
                        <form action="{{ route('admin.change_password_proses', $auth->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Current password</label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('old_password')
                                        is-invalid
                                    @enderror"
                                        type="password" id="password" name="old_password" placeholder="****"
                                        style="border-top-right-radius: 0!important; border-bottom-right-radius: 0!important" />
                                    <button class="btn btn-outline-secondary mb-0" type="button" id="showOldPassword"><i
                                            class="fas fa-low-vision"></i> </button>
                                </div>
                                @error('old_password')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">New password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password')
                                    is-invalid                                @enderror form-check">
                                @error('password')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Confirmation password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation')
                                    is-invalid
                                @enderror form-check"
                                    name="password_confirmation">
                                @error('password_confirmation')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <button class="btn btn-primary" type="submit">Change</button>

                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const oldPasswordInput = document.getElementById('password');
        const showOldPasswordButton = document.getElementById('showOldPassword');

        showOldPasswordButton.addEventListener('click', function() {
            if (oldPasswordInput.type === 'password') {
                oldPasswordInput.type = 'text';
            } else {
                oldPasswordInput.type = 'password';
            }
        });
    </script>
@endpush
