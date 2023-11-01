@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('../soft-ui-dashboard-main/assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="
                    @if (!Auth::user()->biodata->image)
                    /soft-ui-dashboard-main/assets/img/no-profile.png
                    @else
                        {{ asset('storage/' . $biodata['image'])}}
                    @endif
                    " alt="profile_image">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ Auth::user()->name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ Auth::user()->role }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                role="tab" aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <style>
                                        svg {
                                            fill: #3a4164
                                        }
                                    </style>
                                    <path
                                        d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z" />
                                </svg>
                                <span class="ms-1">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1"
                                href="{{ route('mahasiswa.profile.change_password', Auth::user()->name) }}" role="tab"
                                aria-selected="true">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>document</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(154.000000, 300.000000)">
                                                    <path class="color-background"
                                                        d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                        opacity="0.603585379"></path>
                                                    <path class="color-background"
                                                        d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
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
            <div class="col-12 col-sm-6 mt-3">
                <div class="card h-100 mt-2">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Profile Information</h6>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="{{ route('mahasiswa.profile.edit-profile', Auth::user()->name) }}">
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
                                &nbsp; {{ Auth::user()->name }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No Tlp:</strong>
                                &nbsp;
                                {{ Auth::user()->phone }}</li>
                            @if (Auth::user()->email == false)
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                    &nbsp;
                                    Lengkapi Email</li>
                            @else
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                    &nbsp;
                                    {{ Auth::user()->email }}</li>
                            @endif
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tanggal Lahir:</strong>
                                &nbsp;
                                {{ Auth::user()->birthdate }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender:</strong>
                                &nbsp;
                                {{ Auth::user()->gender }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 mt-3">
                <div class="card h-100 mt-2">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Biodata Information</h6>
                            </div>
                            @if (!$user->biodata)
                                
                            @else
                                <div class="col-md-4 text-end">
                                    <a href="{{ route('mahasiswa.pendaftaran.s1.edit',$user->id) }}">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit Biodata"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if (!$user->biodata)
                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <a href="" class="btn btn-danger mt-4">Silahkan Lengkapi Biodata</a>
                        </div>
                    @else
                        <div class="card-body p-3">
                            <hr class="horizontal gray-light">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">
                                        Tanggal Lahir :</strong>
                                    &nbsp; {{ $biodata->birthdate }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tempat Lahir :</strong>
                                    &nbsp;
                                    {{ $biodata->birthplace }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Provinsi :</strong>
                                    &nbsp;
                                    {{ $biodata->provinsi }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Kota :</strong>
                                    &nbsp;
                                    {{ $biodata->kota }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Kecamatan :</strong>
                                    &nbsp;
                                    {{ $biodata->kecamatan }}
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-12 mt-3">
                <div class="card h-100 mt-2">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Document Information</h6>
                            </div>
                            @if (!$user->document)
                                
                            @else
                                <div class="col-md-4 text-end">
                                    <a href="{{ route('mahasiswa.pendaftaran.document.edit',$user->id) }}">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit Biodata"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <hr class="horizontal gray-light">
                        {{-- <a href="" class="btn btn-primary fs-6 p-2 px-3">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="" class="btn btn-secondary fs-6 p-2 px-3 ms-2">
                            <i class="fas fa-file-download"></i>
                        </a> --}}
                        <div class="row">
                            @if (!$user->document)
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="" class="btn btn-danger">Silahkan Lengkapi Dokumen Anda</a>
                                </div>
                            @else
                                <div class="col-12 col-sm-3">
                                    <div class="mb-2">
                                        <label for="">Document KTP</label>
                                        <div class="d-flex">
                                            <a href="{{ asset('storage/' . $user->document->ktp) }}" target="_blank" class="btn btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('mahasiswa.pendaftaran.document.ijazah',$user->id)}}" class="btn btn-secondary ms-2">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                        </div>
                                    <input type="text" value="{{$user->document->ktp}}" class="form-control rounded-4" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="mb-2">
                                        <label for="">Document KK</label>
                                        <div class="d-flex">
                                            <a href="{{ asset('storage/' . $user->document->kk) }}" target="_blank" class="btn btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('mahasiswa.pendaftaran.document.kk',$user->id)}}" class="btn btn-secondary ms-2">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                        </div>
                                    <input type="text" value="{{$user->document->kk}}" class="form-control rounded-4" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="mb-2">
                                        <label for="">Document IJAZAH</label>
                                        <div class="d-flex">
                                            <a href="{{ asset('storage/' . $user->document->ijazah) }}" target="_blank" class="btn btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('mahasiswa.pendaftaran.document.ijazah',$user->id)}}" class="btn btn-secondary ms-2">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                        </div>
                                    <input type="text" value="{{$user->document->ijazah}}" class="form-control rounded-4" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="mb-2">
                                        <label for="">Document Transkrip Nilai</label>
                                        <div class="d-flex">
                                            <a href="{{ asset('storage/' . $user->document->transkrip_nilai) }}" target="_blank" class="btn btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('mahasiswa.pendaftaran.document.transkrip_nilai',$user->id)}}" class="btn btn-secondary ms-2">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                        </div>
                                    <input type="text" value="{{$user->document->transkrip_nilai}}" class="form-control rounded-4" disabled>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
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
