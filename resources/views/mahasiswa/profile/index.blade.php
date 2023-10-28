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
                        {{Auth::user()->name}}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{Auth::user()->role}}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="{{ route('mahasiswa.profile.index') }}"
                                role="tab" aria-selected="true">
                                
                                <span class="ms-1">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1"  href="{{route('mahasiswa.profile.change_password',Auth::user()->name)}}" role="tab"
                                aria-selected="true">
                                
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
                            <a href="{{ route('mahasiswa.profile.edit-profile',Auth::user()->name) }}">
                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit Profile"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    {{-- <hr class="horizontal gray-light"> --}}
                    <table class="table align-items-center mb-0 table-borderless" id="profile">
                        <tbody>
                            <tr class="text-start text-sm">
                                <td class="text-capitalize font-weight-bold text-dark">Nama Lengkap</td>
                                <td class="text-secondary font-weight-bold">: &nbsp;&nbsp; {{ Auth::user()->name }}</td>
                            </tr>
                            <tr class="text-start text-sm">
                                <td class="text-capitalize font-weight-bold text-dark">No. Whatsapp</td>
                                <td class="text-secondary">: &nbsp;&nbsp; {{ Auth::user()->phone }}</td>
                            </tr>
                            <tr class="text-start text-sm">
                                <td class="text-capitalize font-weight-bold text-dark">Email</td>
                                <td class="text-secondary">: &nbsp;&nbsp; {{ Auth::user()->email }}</td>
                            </tr>
                            <tr class="text-start text-sm">
                                <td class="text-capitalize font-weight-bold text-dark">Tanggal Lahir</td>
                                <td class="text-secondary">: &nbsp;&nbsp; {{ Auth::user()->birthdate }}</td>
                            </tr>
                            <tr class="text-start text-sm">
                                <td class="text-capitalize font-weight-bold text-dark">Jenis Kelamin</td>
                                <td class="text-secondary">: &nbsp;&nbsp; {{ Auth::user()->gender }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire(
                "{{ session('success') }}", // Menggunakan session('success') untuk mengambil pesan
                'You clicked the button!',
                'success'
            )
        </script>
    @endif
@endpush
