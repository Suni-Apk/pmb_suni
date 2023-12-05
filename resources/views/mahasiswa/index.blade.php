@extends('layouts.master')

@section('title', 'Dashboard')


@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" rel="stylesheet">
@endpush

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
    @elseif(session('eror'))
    <script>
        Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "{{ session('eror') }}",
        });
    </script>
    @endif
@endpush

@section('content')
    <div class="row">
        <div class="col-12 text-center mb-4">
            <div class="card">
                <h6 class="text-secondary font-weight-normal my-3 px-3">proses pendaftaran kamu sampai dimana nih?</h6>
                <div class="multisteps-form">
                    <div class="row">
                        <div class="col-12 col-lg-10 mx-auto mb-3">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="Register">
                                    <span>Register</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active" type="button" title="Bayar Administrasi">
                                    <span>Bayar Administrasi</span>
                                </button>
                                @if ($biodata && !Auth::user()->document)
                                    <button class="multisteps-form__progress-btn js-active" type="button" title="Mengisi Biodata">
                                        <span>Mengisi Biodata</span>
                                    </button>
                                @else
                                    <button class="multisteps-form__progress-btn" type="button" title="Mengisi Biodata">
                                        <span>Mengisi Biodata</span>
                                    </button>
                                    <button class="multisteps-form__progress-btn js-active" type="button" title="Upload Dokumen">
                                        <span>Upload Dokumen</span>
                                    </button>
                                @endif
                                <button class="multisteps-form__progress-btn" type="button" title="Bayar Pra-Kuliah">
                                    <span>Bayar Pra-Kuliah</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Selesai">
                                    <span>Selesai!</span>
                                </button>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 mb-lg-0 mb-4">
            <div id="carouselDashboard" data-bs-ride="carousel" data-bs-interval="3000" class="carousel slide page-header align-items-start height-300 pb-7 rounded-3">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselDashboard" data-bs-slide-to="0" class="active" aria-current="true"></button>
                    @foreach ($banner->filter(function ($item) {
                        return $item->target == 'MAHASISWA' || $item->target == 'SEMUA';
                        }) as $item)
                    <button type="button" data-bs-target="#carouselDashboard" data-bs-slide-to="{{ $loop->index+1 }}" class="" aria-current="true"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row flex-column justify-content-center height-300"
                            style="
                            background-image: url('https://c0.wallpaperflare.com/path/196/594/379/quran-book-97f792a4ef76b251052800f9f56a4c0b.jpg'); 
                            background-size: cover; background-position: center;">
                            <span class="mask bg-gradient-dark opacity-6"></span>
                            <div
                                class="d-flex justify-content-center flex-column align-items-center text-white text-center z-index-1">
                                <h4 class="font-weight-bold mb-0 p-3 pb-0 text-white">
                                    Selamat Datang
                                    <b class="font-weight-bolder">{{ Auth::user()->name }}</b>!
                                </h4>
                                <p class="mb-0 px-4 px-sm-6">
                                    Sudah melakukan kebaikan apa kamu hari ini?
                                </p>
                            </div>
                        </div>
                    </div>
                    @foreach ($banner->filter(function ($item) {
                        return $item->target == 'MAHASISWA' || $item->target == 'SEMUA';
                        }) as $item)
                    <div class="carousel-item">
                        <div class="row flex-column justify-content-center height-300"
                        style="background-image: url('{{ $item->image }}'); background-size: cover; background-position: center;">
                            <span class="mask bg-gradient-dark opacity-6"></span>
                            <div class="d-flex justify-content-center flex-column align-items-center text-white text-center z-index-1">
                                <h4 class="font-weight-bold mb-0 p-3 pb-0 text-white">
                                    {{ $item->title }}
                                </h4>
                                <p class="mb-0 px-4 px-sm-6">
                                    {{ $item->desc }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDashboard" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselDashboard" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-12 mb-4 gy-3 g-lg-3 d-md-none row mx-auto justify-content-center">
        @if (!$biodata && !Auth::user()->document)
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.pendaftaran.s1') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Isi Biodata">
                    <i class="fas fa-user-shield text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Isi Biodata</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.pendaftaran.document') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Dokumen">
                    <i class="fas fa-folder text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Upload Dokumen</span>
            </div>
        @elseif ($biodata && !Auth::user()->document)
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.pendaftaran.document') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Dokumen">
                    <i class="fas fa-folder text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Upload Dokumen</span>
            </div>
        @elseif (!$biodata && Auth::user()->document)
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.pendaftaran.s1') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Isi Biodata">
                    <i class="fas fa-user-shield text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Isi Biodata</span>
            </div>
        @else
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.matkul') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Mata Kuliah">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Mata Kuliah</span>
            </div>
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.tagihan.index') }}" class="icon icon-shape p-0 bg-primary shadow text-center border-radius-md cursor-pointer"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tagihan">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Tagihan</span>
            </div>
        @endif
            <div class="col-3 col-md-2 text-center">
                <a href="{{ route('mahasiswa.profile.index') }}" class="icon icon-shape p-0 bg-yellow shadow text-center border-radius-md cursor-pointer"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Profile">
                    <i class="fas fa-user-alt text-lg opacity-10" aria-hidden="true"></i>
                </a>
                <span class="d-block mt-2" style="font-size: 13px;">Profile</span>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card h-100 p-3">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                style="background-image: url('https://suniindonesia.com/wp-content/uploads/2022/10/masjid-pogung-dalangan-fQET4BjQmvc-unsplash.jpg');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body position-relative z-index-1 d-flex flex-column justify-content-center gap-2">
                        <p class="text-white w-100 mb-0 text-center">Kalender hari ini,</p>
                        <h5 class="text-white font-weight-bolder fs-1 d-flex justify-content-evenly w-100 mb-0">
                            <span>{{ $hijriDateday }}</span>
                            <span class="text-green font-weight-normal" style="font-family: 'Rubik', sans-serif;">{{ $hijriDatemonth }}</span>
                        </h5>
                        <h5 class="w-100 mb-0 text-center lh-1 text-green font-weight-light" style="font-family: 'Rubik', sans-serif;">
                            {{ $hijriDatedayArabic }}
                        </h5>
                        <p class="text-white w-100 mb-0 text-center">
                            {{ $hijriDateyear }} Hijriyah
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @php
            $user = Auth::user();
            $biodataS1 = App\Models\Biodata::where('user_id', $user->id)
                ->where('program_belajar', 'S1')
                ->first();
            $documentS1 = App\Models\Document::where('user_id',$user->id)->first();
            $biodataKURSUS = App\Models\Biodata::where('user_id', $user->id)
                ->where('program_belajar', 'KURSUS')
                ->first();
            $jurusan = App\Models\Jurusan::all();
        @endphp
        @if ($biodataS1 && $biodataKURSUS)
            <div class="col-12 mt-4" id="informasi">
                <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                    <a id="list-sarjana-list" data-bs-toggle="list" href="#list-sarjana" role="tab"
                        aria-controls="list-sarjana"
                        class="list-group-item list-group-item-action border-0 shadow text-center active">Program Kuliah S1</a>
                    <a id="list-kursus-list" data-bs-toggle="list" href="#list-kursus" role="tab"
                        aria-controls="list-kursus"
                        class="list-group-item list-group-item-action border-0 shadow text-center">Program Kursus</a>
                </div>
            </div>
        @else
        <div class="col-12 mt-4" id="informasi">
            <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                <a id="list-sarjana-list" data-bs-toggle="list" href="#list-sarjana" role="tab"
                    aria-controls="list-sarjana"
                    class="list-group-item list-group-item-action border-0 shadow text-center active w-50">Program Kuliah S1</a>
        
                <form id="form-kursus" action="{{ route('administrasiKursus', ['id' => Auth::id()]) }}" class="w-50" method="POST">
                    @csrf
                    <a id="list-kursus-list" href="#" onclick="event.preventDefault(); document.getElementById('form-kursus').submit();" role="tab" aria-controls="list-kursus" class="list-group-item list-group-item-action border-0 shadow text-center">Program Kursus</a>
                </form>
            </div>
        </div>    
        @endif
        
        {{-- jika belum ada biodata maka bisa isi di dalam halaman dashboard --}}
        @if (!$biodataS1)
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h5>Formulir Biodata</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive text-nowrap">
                                <form action="{{ route('mahasiswa.pendaftaran.s1.process') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2Mb</p>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="alamat">Pilih Jurusan</label>
                                        <select name="jurusan_id" class="form-control">
                                            <option disabled selected>Pilih Jurusan</option>
                                            @foreach ($jurusan as $index => $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="birthdate">Tanggal Lahir</label>
                                        <input type="date" name="birthdate" id="birthdate" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="birthplace">Tempat Lahir</label>
                                        <input type="text" name="birthplace" id="birthplace" class="form-control"
                                            placeholder="Masukkan Tempat Lahir Anda">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="alamat">Alamat Kamu</label>
                                        <select name="provinsi" id="provinsi" class="form-control">
                                            <option value="" disabled selected>Pilih Provinsi</option>
                                            <!-- Data Provinsi dari API bisa dimasukkan di sini -->
                                        </select>
                                        <select name="kota" id="kota" class="form-control mt-2">
                                            <option value="" disabled selected>--- Pilih Kabupaten / Kota ---</option>
                                            <!-- Data Kabupaten dari API bisa dimasukkan di sini -->
                                        </select>
                                        <select name="kecamatan" id="kecamatan" class="form-control mt-2">
                                            <option value="" disabled selected>--- Pilih Kecamatan ---</option>
                                            <!-- Data Kota dari API bisa dimasukkan di sini -->
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="address">Jalan Dan Kode Pos</label>
                                        <textarea name="address" id="address" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="last_graduate">Pendidikan Terakhir</label>
                                        <input type="text" name="last_graduate" id="last_graduate" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                </form>
                            </div>
                        </div>
                        <script>
                            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
                                .then(response => response.json())
                                .then(provinces => {
                                    var data = provinces;
                                    var tampung = '<option>--- Pilih Provinsi ---</option>';
                                    data.forEach(element => {
                                        tampung +=
                                            `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`;
                                    });
                                    document.getElementById('provinsi').innerHTML = tampung;
                                });
                        </script>
                        <script>
                            const selectProvinsi = document.getElementById('provinsi');
                            selectProvinsi.addEventListener('change', (e) => {
                                var provinsi = e.target.options[e.target.selectedIndex].dataset.reg;
                                fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
                                    .then(response => response.json())
                                    .then(regencies => {
                                        var data = regencies;
                                        var tampung = '<option>--- Pilih Kota ---</option>';
                                        data.forEach(element => {
                                            tampung +=
                                                `<option data-dist="${element.id}" value="${element.name}">${element.name}</option>`;
                                        });
                                        document.getElementById('kota').innerHTML = tampung
        
                                    });
                            });
        
                            const selectKota = document.getElementById('kota');
                            selectKota.addEventListener('change', (e) => {
                                var kota = e.target.options[e.target.selectedIndex].dataset.dist;
                                fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
                                    .then(response => response.json())
                                    .then(districts => {
                                        var data = districts;
                                        var tampung = '<option>--- Pilih Kecamatan ---</option>';
                                        data.forEach(element => {
                                            tampung +=
                                                `<option data-vill="${element.id}" value="${element.name}">${element.name}</option>`;
                                        });
                                        document.getElementById('kecamatan').innerHTML = tampung;
                                    });
                            });
                        </script>
                    </div>
                </div>
            </div>
        @else
            @if (!$documentS1)
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Form Dokumen</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <form action="{{route('mahasiswa.pendaftaran.document.process')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group mb-3">
                                                    <label for="ijazah">Ijazah SMA/MA/Paket C Terlegalisir</label>
                                                    <input type="file" name="ijazah" id="ijazah" class="form-control" accept="application/pdf">
                                                </div>
                                            
                                                <div class="form-group mb-3">
                                                    <label for="ktp">KTP (Kartu Tanda Penduduk)</label>
                                                    <input type="file" name="ktp" id="ktp" class="form-control" accept="application/pdf">
                                                </div>
                                            
                                                <div class="form-group mb-3">
                                                    <label for="kk">Kartu Keluarga</label>
                                                    <input type="file" name="kk" id="kk" class="form-control" accept="application/pdf">
                                                </div>
                                            
                                                <div class="form-group mb-3">
                                                    <label for="transkip">Transkip Nilai (untuk mahasiswa pindahan)</label>
                                                    <input type="file" name="transkrip_nilai" id="transkip" class="form-control" accept="application/pdf">
                                                </div>
                                            
                                                <button type="submit" class="btn btn-success">Submit</button>
                                                <button type="reset" class="btn btn-warning">Reset</button>
                                            </form>                                                              
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row my-4">
                    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-lg-6 col-7">
                                        <h6>Daftar Tagihan</h6>
                                        <p class="text-sm mb-0">
                                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                                            Daftar tagihan yang harus dibayarkan
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-5 my-auto text-end">
                                        <a href="" class="btn btn-sm btn-white text-secondary px-3">Show All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Tagihan</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Tenggat</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($biayas->where('id_angkatans', Auth::user()->biodata->angkatan_id) as $item)
                                            <tr>
                                                <td>
                                                    <div class="ps-3 text-sm">
                                                        {{ $item->nama_biaya }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="ps-3 text-sm">
                                                        {{ $item->id }}
                                                    </div>
                                                </td>
                                                <td class="text-center ">
                                                    {{-- Rp. {{ number_format($tagihans->amount, 0, '', '.') }},- --}}
                                                </td>
                                                <td class="text-center ">
                                                    <a href="{{ route('mahasiswa.tagihan.index') }}" class="badge badge-sm bg-gradient-info text-xxs">Detail</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h6>Daftar Link</h6>
                                <p class="text-sm">
                                    <i class="fas fa-link text-success" aria-hidden="true"></i>
                                    Daftar link yang diikuti
                                </p>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline timeline-one-side">
                                    @php
                                        $gender = $user->gender;
                                        $gen = ($gender == 'Laki-Laki') ? 'ikhwan' : 'akhwat';
                                    @endphp
                                    @foreach ($links->filter(function ($item) use ($gen) {
                                        return $item->gender == $gen || $item->gender == 'all';
                                    }) as $item)
                                        <div class="timeline-block mb-3">
                                            <span class="timeline-step">
                                                <i class="ni ni-bell-55 text-success text-gradient"></i>
                                            </span>
                                            <div class="timeline-content">
                                                <a href="{{ $item->url }}" class="text-dark text-sm font-weight-bold mb-0">
                                                    {{ $item->jurusan->code }} . {{ $item->tahunAjaran->year }},
                                                    <span class="font-weight-normal">
                                                        {{ $item->url }}
                                                    </span>
                                                </a>
                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                    {{ $item->created_at->format('d M Y') }}, link {{ $item->type }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Menangani perubahan tab
            $('#list-tab a').on('click', function(e) {
                e.preventDefault();

                // Mendapatkan target tab yang diklik
                var target = $(this).attr('href');

                // Menampilkan atau menyembunyikan bagian dashboard berdasarkan tab yang dipilih
                if (target === "#list-sarjana") {
                    // Logika untuk menampilkan dashboard Sarjana
                    $("#dashboard-sarjana").show();
                    $("#dashboard-kursus").hide();
                } else if (target === "#list-kursus") {
                    // Logika untuk menampilkan dashboard Kursus
                    $("#dashboard-kursus").show();
                    $("#dashboard-sarjana").hide();
                }

                // Mengarahkan pengguna ke rute yang sesuai
                if (target === "#list-sarjana") {
                    window.location.href = "{{ route('mahasiswa.dashboard') }}";
                } else if (target === "#list-kursus") {
                    window.location.href = "{{ route('kursus.dashboard') }}";
                }

                // Menandai tab yang aktif
                $(this).tab('show');
            });
        });
    </script>
@endsection