@extends('kursus.layouts.parent')

@section('title', 'Profile')

@section('content')
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="
                    @if (!Auth::user()->biodata)
                    /assets/img/no-profile.png
                    @elseif(!$biodata)
                        /assets/img/no-profile.png
                    @else
                        {{ asset('storage/' . $biodata['image']) }} @endif
                    "
                        alt="profile_image">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ Auth::user()->name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        Kursus
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:location.reload();"
                                role="tab" aria-selected="true">
                                <span class="ms-1">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1"
                                href="{{ route('kursus.profile.change_password', Auth::user()->name) }}" role="tab"
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
            <div class="col-12 col-sm-6 mt-3">
                <div class="card h-100 mt-2">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Profile Information</h6>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="{{ route('kursus.profile.edit-profile', Auth::user()->name) }}">
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
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tanggal
                                    Lahir:</strong>
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
                            @if (!$biodata)
                            @else
                                <div class="col-md-4 text-end">
                                    <a href="{{ route('kursus.pendaftaran.s1.edit', $user->id) }}">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit Biodata"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if (!$biodata)
                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <a href="" class="btn btn-danger mt-4">Silahkan Lengkapi Biodata</a>
                        </div>
                    @else
                        <div class="card-body p-3">
                            <hr class="horizontal gray-light">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">
                                        Program Belajar :</strong>
                                    &nbsp; {{ $biodata->program_belajar }}</li>
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">
                                        Kursus :</strong>
                                    &nbsp; {{ $biodata->course->name ?? 'Bahasa Arab' }}</li>
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">
                                        Profesi :</strong>
                                    &nbsp; {{ $biodata->profesi }}</li>
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">
                                        Bisa Baca Al-Qur'an? :</strong>
                                    &nbsp; {{ $biodata->baca_quran }}</li>
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">
                                        Tanggal Lahir :</strong>
                                    &nbsp; {{ \Carbon\Carbon::parse($biodata->birthdate)->translatedFormat('d F Y') }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tempat Lahir
                                        :</strong>
                                    &nbsp;
                                    {{ $biodata->birthplace }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Provinsi
                                        :</strong>
                                    &nbsp;
                                    {{ $biodata->provinsi }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Kota
                                        :</strong>
                                    &nbsp;
                                    {{ $biodata->kota }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Kecamatan
                                        :</strong>
                                    &nbsp;
                                    {{ $biodata->kecamatan }}
                                </li>
                            </ul>
                        </div>
                    @endif
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
