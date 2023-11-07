@extends('layouts.master')
@php
    $biodataS1 = App\Models\Biodata::where('program_belajar', 'S1')
        ->where('user_id', Auth::user()->id)
        ->first();
@endphp
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
                    @if (!Auth::user()->biodata)
                    /soft-ui-dashboard-main/assets/img/no-profile.png
                    @else
                        {{ asset('storage/' . $biodataS1->image)}}
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
                    <ul class="nav nav-fill bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-dark mb-0 px-0 py-1" 
                                href="{{ route('mahasiswa.profile.index') }}" role="tab">
                                <span class="ms-1">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark mb-0 px-0 py-1"
                                href="{{ route('mahasiswa.profile.change_password', Auth::user()->name) }}" role="tab">
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
                                    Angkatan :</strong>
                                    &nbsp; {{ $biodata->angkatan->year }}</li>
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
