@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="page-header min-height-300 border-radius-xl mt-4"
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
                                href="{{ route('admin.change_password') }}" role="tab">
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
                            <h6 class="mb-0">Profile Information</h6>
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
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                Name:</strong>
                            &nbsp; {{ $auth->name }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No Tlp:</strong>
                            &nbsp;
                            {{ $auth->phone }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                            &nbsp;
                            {{ $auth->email }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender:</strong>
                            &nbsp;
                            {{ $auth->gender }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endsection
