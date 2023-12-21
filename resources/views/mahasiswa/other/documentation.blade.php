@extends('layouts.master')

@section('title', 'Panduan User')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Panduan User</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-3">
                            <div id="list-example" class="list-group list-group-flush position-sticky" style="top: 2rem;">
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-action">
                                    ## Tombol Aksi
                                </a>
                                <button class="list-group-item list-group-item-action fw-light text-xs border-0" disabled>
                                    DATA USER
                                </button>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-user-1">
                                    ## Buat Admin Baru
                                </a>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-user-2">
                                    ## Tambah Mahasiswa Baru
                                </a>
                                <button class="list-group-item list-group-item-action fw-light text-xs border-0" disabled>
                                    DATA AKADEMIK - MASTER
                                </button>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-1">
                                    #1 Buat Jurusan Baru
                                </a>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-2">
                                    #2 Tambah Mata Kuliah
                                </a>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-3">
                                    #3 Buat Kursus Baru
                                </a>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-4">
                                    #4 Tambah Mata Pelajaran
                                </a>
                                <button class="list-group-item list-group-item-action fw-light text-xs border-0" disabled>
                                    DATA AKADEMIK - PENDUKUNG
                                </button>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-5">
                                    #5 Buat Tahun Ajaran Baru
                                </a>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-6">
                                    #6 Tambah Link Baru
                                </a>
                                <button class="list-group-item list-group-item-action fw-light text-xs border-0" disabled>
                                    DATA PEMBAYARAN
                                </button>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-7">
                                    #7 Buat Tagihan Baru
                                </a>
                                <a class="list-group-item list-group-item-action fw-bold text-sm" href="#list-item-8">
                                    #8 Buka Pendaftaran
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-9">
                            <style>
                                article li p {
                                    margin-bottom: 0;
                                }
                            </style>
                            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true"
                                class="scrollspy-example" tabindex="0">
                                <h3 class="mt-5 text-uppercase">PANDUAN USER</h3>
                                <article title="panduan tombol aksi">
                                    <h5 class="mb-3" id="list-action">Tombol Aksi Administrator</h5>
                                    <p>
                                        pada halaman daftar tiap data, admin akan diberikan akses mengelola data di akhir
                                        tiap baris, pada kolom aksi. Pada kolom tersebut, ada beberapa tombol yang
                                        ditampilkan, berikut macam-macam nya beserta penjelasan terkait penggunaannya.
                                    </p>
                                    <div class="">
                                        <hr class="horizontal dark">
                                        <p class="text-center text-sm mb-2"># preview tombol aksi administrator #</p>
                                        <div id="preview" class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                            <button class="badge badge-sm bg-gradient-info border-0 text-xxs font-weight-bolder">LINK</button>
                                            <button class="badge badge-sm bg-gradient-info border-0 text-xxs font-weight-bolder">VERIFY</button>
                                            <button class="badge badge-sm bg-gradient-warning border-0 text-xxs font-weight-bolder">DETAIL</button>
                                            <button class="badge badge-sm bg-gradient-secondary border-0 text-xxs font-weight-bolder">EDIT</button>
                                            <button class="badge badge-sm bg-gradient-danger border-0 text-xxs font-weight-bolder">DELETE</button>
                                            <button class="badge badge-sm bg-gradient-success border-0 text-xxs font-weight-bolder">AKTIF</button>
                                            <button class="badge badge-sm bg-gradient-primary border-0 text-xxs font-weight-bolder">ON</button>
                                            <button class="badge badge-sm bg-gradient-dark border-0 text-xxs font-weight-bolder">OFF</button>
                                        </div>
                                        <hr class="horizontal dark">
                                    </div>
                                    <ul>
                                        <li style="list-style-type:disc;font-size:12pt;">
                                            <p>Tombol Kelola Utama</p>
                                            <ul>
                                                <li style="list-style-type:circle;font-size:12pt;">
                                                    <p>Tombol Edit (ubah), digunakan untuk mengubah / mengupdate data yang
                                                        dipilih sesuai dengan data yang lebih relevan pada halaman form edit
                                                        data.</p>
                                                </li>
                                                <li style="list-style-type:circle;font-size:12pt;">
                                                    <p>Tombol Show (detail), digunakan untuk menampilkan data yang dipilih
                                                        tanpa memberikan akses untuk mengubah data tersebut.</p>
                                                </li>
                                                <li style="list-style-type:circle;font-size:12pt;">
                                                    <p>Tombol Delete (hapus), digunakan untuk menghapus data yang dipilih
                                                        jika terdapat beberapa kondisi seperti dibawah ini :</p>
                                                    <ul>
                                                        <li style="list-style-type:square;font-size:12pt;">
                                                            <p>Data tidak dapat diperbarui, namun ada kesalahan dalam
                                                                pembuatan sebuah data.&nbsp;</p>
                                                        </li>
                                                        <li style="list-style-type:square;font-size:12pt;">
                                                            <p>Untuk data Jurusan dan Kursus, pastikan menghapus data Mata
                                                                Kuliah atau Mata Pelajaran yang berkaitan dengan jurusan
                                                                atau kursus tersebut terlebih dahulu, baru menghapus data
                                                                Jurusan atau Kursus tersebut.</p>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="list-style-type:disc;font-size:12pt;">
                                            <p>Tombol Kelola Pendukung</p>
                                            <ul>
                                                <li style="list-style-type:circle;font-size:12pt;">
                                                    <p>Tombol On / Off (Aktif/Nonaktif), digunakan untuk mengubah status
                                                        aktif menjadi sebaliknya. dengan catatan :&nbsp;</p>
                                                    <ul>
                                                        <li style="list-style-type:square;font-size:12pt;">
                                                            <p>pada daftar akun admin / mahasiswa, jika tombol On / Off
                                                                ditekan dan status berubah menjadi nonaktif / off, maka akun
                                                                yang dipilih tidak akan bisa masuk ke halaman dashboard.
                                                                kecuali status menjadi aktif kembali. Hal tersebut berguna
                                                                demi membatasi akses pengguna yang dimaksud namun tanpa
                                                                perlu menghapus data tersebut.</p>
                                                        </li>
                                                        <li style="list-style-type:square;font-size:12pt;">
                                                            <p>pada daftar tahun ajaran, tombol on / off berguna untuk
                                                                membuka serta menutup pendaftaran.&nbsp;</p>
                                                        </li>
                                                        <li style="list-style-type:square;font-size:12pt;">
                                                            <p>pada daftar mata pelajaran, tombol on / off berguna untuk
                                                                membatasi mata pelajaran tersebut akan tampil di dashboard
                                                                peserta kursus. jika statusnya aktif, maka mata pelajaran
                                                                tersebut akan masuk ke daftar mata pelajaran yang hendak
                                                                dipelajari oleh peserta kursus. begitu pula sebaliknya.</p>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li style="list-style-type:circle;font-size:12pt;">
                                                    <p>Tombol Verify (verifikasi), pada daftar dokumen, tombol verify
                                                        digunakan untuk memverifikasi dokumen yang diupload dengan data pada
                                                        form biodata &nbsp;yang telah diisi oleh pendaftar mahasiswa
                                                        (berguna hanya untuk pendaftaran formal (S1)).</p>
                                                </li>
                                                <li style="list-style-type:circle;font-size:12pt;">
                                                    <p>Tombol Link + (tambah link), adalah shortcut untuk membuat data link
                                                        tautan yang dituju untuk tahun ajaran tersebut / jurusan serta
                                                        kursus tersebut.</p>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </article>
                                <hr class="horizontal dark">
                                <h3 class="mt-5 text-uppercase">DATA PENGGUNA</h3>
                                <hr class="horizontal dark">
                                <article title="panduan user 1">
                                    <h5 class="mb-3" id="list-item-user-1">Tambah Admin Baru</h5>
                                    <p>
                                        Kamu bisa pergi ke halaman Tambah Admin dengan menekan tombol di menu sidebar,
                                        ataupun menekan tombol &quot;Tambah +&quot; pada halaman daftar admin.
                                    </p>
                                    <ol>
                                        <li style="list-style-type:disc;">
                                            <p>
                                                Di halaman ini, kamu bisa menambahkan user Admin lainnya untuk hak akses
                                                mengelola data secara keseluruhan.
                                            </p>
                                        </li>
                                        <li style="list-style-type:disc;">
                                            <p>
                                                Pada halaman Tambah Admin, lengkapi formulir yang ada dengan informasi yang
                                                dibutuhkan. seperti :
                                            </p>
                                            <ul>
                                                <li style="list-style-type:circle;">
                                                    <p>nama : nama lengkap admin yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>email : alamat email admin yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>nomor : nomor whatsapp admin yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>password : tentukan password untuk akun tersebut.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>konfirmasi password : ulangi password untuk mengonfirmasi password
                                                        yang sebelumnya.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>jenis kelamin : pilih jenis kelamin untuk admin yang hendak
                                                        ditambahkan.</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="list-style-type:disc;">
                                            <p>Lalu, setelah melengkapi formulir, tekan tombol &quot;Submit&quot; untuk
                                                mengirim data.</p>
                                        </li>
                                    </ol>
                                </article>
                                <hr class="horizontal dark">
                                <article title="panduan user 2">
                                    <h5 class="mb-3" id="list-item-user-2">Tambah Mahasiswa Baru <span
                                            class="fw-light">(manual)</span></h5>
                                    <p>
                                        Kamu bisa pergi ke halaman Tambah Admin dengan menekan tombol di menu sidebar,
                                        ataupun menekan tombol &quot;Tambah +&quot; pada halaman daftar admin.
                                    </p>
                                    <ul>
                                        <li style="list-style-type:disc;">
                                            <p>Di halaman ini, kamu bisa menambahkan user Mahasiswa untuk pendaftaran
                                                mahasiswa secara manual oleh admin.</p>
                                        </li>
                                        <li style="list-style-type:disc;">
                                            <p>Pada halaman Tambah Admin, lengkapi formulir yang ada dengan informasi yang
                                                dibutuhkan. seperti :</p>
                                        </li>
                                        <ol>
                                            <li style="list-style-type:circle;">
                                                <p>nama : nama lengkap mahasiswa yang hendak ditambahkan.</p>
                                            </li>
                                            <li style="list-style-type:circle;">
                                                <p>email : alamat email mahasiswa yang hendak ditambahkan.</p>
                                            </li>
                                            <li style="list-style-type:circle;">
                                                <p>nomor : nomor whatsapp mahasiswa yang hendak ditambahkan.</p>
                                            </li>
                                            <li style="list-style-type:circle;">
                                                <p>password : tentukan mahasiswa untuk akun tersebut.</p>
                                            </li>
                                            <li style="list-style-type:circle;">
                                                <p>konfirmasi password : ulangi password untuk mengonfirmasi password yang
                                                    sebelumnya.</p>
                                            </li>
                                            <li style="list-style-type:circle;">
                                                <p>jenis kelamin : pilih jenis kelamin untuk mahasiswa yang hendak
                                                    ditambahkan.</p>
                                            </li>
                                            <li style="list-style-type:circle;">
                                                <p>program belajar : pilih program belajar yang hendak dipilih untuk
                                                    mahasiswa.</p>
                                            </li>
                                        </ol>
                                        <li style="list-style-type:disc;">
                                            <p>Lalu, setelah melengkapi formulir, tekan tombol &quot;Submit&quot; untuk
                                                mengirim data.</p>
                                        </li>
                                    </ul>
                                    <div class="alert alert-info text-white py-2 px-4">
                                        <p class="mb-0"><strong>note :</strong></p>
                                        <ul>
                                            <li style="list-style-type:disc;">
                                                <p class="mb-0">pastikan mahasiswa sudah melakukan permintaan pembuatan
                                                    akun kepada admin.</p>
                                            </li>
                                            <li style="list-style-type:disc;">
                                                <p class="mb-0">lengkap dengan biodata singkat serta pilihan program
                                                    belajarnya.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <hr class="horizontal dark">
                                <h3 class="mt-5 text-uppercase">DATA AKADEMIK - <span class="fw-normal">MASTER</span></h3>
                                <hr class="horizontal dark">
                                <article title="panduan akademik 1">
                                    <h5 class="mb-3" id="list-item-1">Menambahkan Jurusan Baru</h5>
                                    <p>Kamu bisa pergi ke halaman Tambah Jurusan dengan menekan tombol di menu sidebar,
                                        ataupun menekan tombol &quot;Tambah +&quot; pada halaman daftar jurusan.</p>
                                    <ul>
                                        <li style="list-style-type:disc;">
                                            <p>Pada halaman Tambah Jurusan, lengkapi formulir yang ada dengan informasi yang
                                                dibutuhkan. seperti :</p>
                                            <ul>
                                                <li style="list-style-type:circle;">
                                                    <p>nama : nama jurusan yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>code : inisial jurusan atau kode lainnya dari nama jurusan yang
                                                        hendak ditambahkan.</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="list-style-type:disc;">
                                            <p>Lalu, setelah melengkapi formulir, tekan tombol &quot;Submit&quot; untuk
                                                mengirim data.</p>
                                        </li>
                                    </ul>
                                </article>
                                <hr class="horizontal dark">
                                <article title="panduan akademik 2">
                                    <h5 class="mb-3" id="list-item-2">Menambahkan Mata Kuliah</h5>
                                    <p>Kamu bisa pergi ke halaman Tambah Mata Kuliah dengan menekan tombol di menu sidebar,
                                        ataupun menekan tombol &quot;Tambah +&quot; pada halaman daftar mata kuliah.</p>
                                    <ul>
                                        <li style="list-style-type:disc;">
                                            <p>Pada halaman Tambah Mata Kuliah, lengkapi formulir yang ada dengan informasi
                                                yang dibutuhkan. seperti :</p>
                                            <ul>
                                                <li style="list-style-type:circle;">
                                                    <p>nama : nama mata kuliah yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>jurusan : pilih jurusan apa mata kuliah tsb dituju.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>semester : pilih semester berapa mata kuliah tsb dituju.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>dosen pengajar : nama dosen lengkap dengan gelarnya (jika ada).<span
                                                            style="font-size: 14px;" class="d-block fw-bold">contoh
                                                            :<em>&nbsp;Bapak John Doe, S. Pd</em></span></p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>mulai : waktu mulai mata kuliah di jam berapa.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>selesai : waktu berakhir mata kuliah di jam berapa.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>hari : jadwal mata kuliah berdasarkan di hari apa.</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="list-style-type:disc;">
                                            <p>Lalu, setelah melengkapi formulir, tekan tombol &quot;Submit&quot; untuk
                                                mengirim data.</p>
                                        </li>
                                    </ul>
                                </article>
                                <hr class="horizontal dark">
                                <article title="panduan akademik 3">
                                    <h5 class="mb-3" id="list-item-3">Membuat Kursus / Program Non Formal</h5>
                                    <p>Kamu bisa pergi ke halaman Tambah Kursus dengan menekan tombol di menu sidebar,
                                        ataupun menekan tombol &quot;Tambah +&quot; pada halaman daftar kursus.</p>
                                    <ul>
                                        <li style="list-style-type:disc;">
                                            <p>Pada halaman Tambah Kursus, lengkapi formulir yang ada dengan informasi yang
                                                dibutuhkan. seperti :</p>
                                            <ul>
                                                <li style="list-style-type:circle;">
                                                    <p>nama : nama kursus / program non formal yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>biaya administrasi : berapa biaya administrasi untuk program tsb.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>notes : note terkait kursus / program non formal tsb yang akan
                                                        diinformasikan ke calon pendaftar.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>deskripsi : deskripsi terkait kursus / program non formal tsb yang
                                                        akan diinformasikan ke calon pendaftar.</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="list-style-type:disc;">
                                            <p>Lalu, setelah melengkapi formulir, tekan tombol &quot;Submit&quot; untuk
                                                mengirim data.</p>
                                        </li>
                                    </ul>
                                </article>
                                <hr class="horizontal dark">
                                <article title="panduan akademik 4">
                                    <h5 class="mb-3" id="list-item-4">Menambahkan Mata Pelajaran</h5>
                                    <p>Kamu bisa pergi ke halaman Tambah Mata Pelajaran dengan menekan tombol di menu
                                        sidebar, ataupun menekan tombol &quot;Tambah +&quot; pada halaman daftar mata
                                        pelajaran.</p>
                                    <ul>
                                        <li style="list-style-type:disc;">
                                            <p>Pada halaman Tambah Kursus, lengkapi formulir yang ada dengan informasi yang
                                                dibutuhkan. seperti :</p>
                                            <ul>
                                                <li style="list-style-type:circle;">
                                                    <p>nama : nama mata pelajaran yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>jurusan : pilih kursus apa mata pelajaran tsb dituju.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>deskripsi : deskripsi singkat terkait mata pelajaran tsb.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>dosen pengajar : nama dosen lengkap dengan gelarnya (jika ada).<span
                                                            style="font-size: 14px;" class="d-block fw-bold">contoh
                                                            :<em>&nbsp;Bapak John Doe, S. Pd</em></span></p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>mulai : waktu mulai mata pelajaran di jam berapa</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>selesai : waktu berakhir mata pelajaran di jam berapa</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>hari : jadwal mata pelajaran berdasarkan harinya</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="list-style-type:disc;">
                                            <p>Lalu, setelah melengkapi formulir, tekan tombol &quot;Submit&quot; untuk
                                                mengirim data.</p>
                                        </li>
                                    </ul>
                                </article>
                                <hr class="horizontal dark">
                                <h3 class="mt-5 text-uppercase">DATA AKADEMIK - <span class="fw-normal">PENDUKUNG</span>
                                </h3>
                                <hr class="horizontal dark">
                                <article title="panduan akademik 5">
                                    <h5 class="mb-3" id="list-item-5">Menambahkan Tahun Ajaran Baru</h5>
                                    <p>
                                        Kamu bisa pergi ke halaman Tambah Tahun Ajaran dengan menekan tombol di menu
                                        sidebar, ataupun menekan tombol &quot;Tambah +&quot; pada halaman daftar tahun
                                        ajaran.
                                    </p>
                                    <ul>
                                        <li style="list-style-type:disc;">
                                            <p>Pada halaman Tambah Tahun Ajaran, lengkapi formulir yang ada dengan informasi
                                                yang dibutuhkan. seperti :</p>
                                            <ul>
                                                <li style="list-style-type:circle;">
                                                    <p>tahun ajaran : nama tahun ajaran yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>mulai : tanggal mulai pendaftaran pada angkatan / tahun ajaran
                                                        tersebut.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>selesai : tanggal selesai pendaftaran pada angkatan / tahun ajaran
                                                        tersebut.</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="list-style-type:disc;">
                                            <p>Lalu, setelah melengkapi formulir, tekan tombol &quot;Submit&quot; untuk
                                                mengirim data.</p>
                                        </li>
                                    </ul>
                                </article>
                                <hr class="horizontal dark">
                                <article title="panduan akademik 6">
                                    <h5 class="mb-3" id="list-item-6">Menambahkan Link Tautan</h5>
                                    <p>
                                        Kamu bisa pergi ke halaman Tambah Link dengan menekan tombol di menu sidebar,
                                        ataupun menekan tombol &quot;Tambah +&quot; pada halaman daftar link zoom /
                                        whatsapp, serta tombol &quot;Link +&quot; pada halaman daftar tahun ajaran, jurusan,
                                        dan kursus.
                                    </p>
                                    <ul>
                                        <li style="list-style-type:disc;">
                                            <p>Pada halaman Tambah Link, lengkapi formulir yang ada dengan informasi yang
                                                dibutuhkan. seperti :</p>
                                            <ul>
                                                <li style="list-style-type:circle;">
                                                    <p>nama : topik / nama link yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>url : url link zoom / whatsapp yang hendak ditambahkan.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>tipe link : pilih tipe link. (Zoom atau Whatsapp).</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>gender : target link untuk jenis kelamin yang mana. (Ikhwan / Akhwat
                                                        / Semua).</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>tahun ajaran : tahun ajaran mana link tersebut hendak dituju.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>jurusan : jurusan apa link tersebut hendak dituju.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>kursus : kursus apa link tersebut hendak dituju.</p>
                                                </li>
                                                <li style="list-style-type:circle;">
                                                    <p>note :</p>
                                                    <ul>
                                                        <li style="list-style-type:square;">
                                                            <p>jurusan dan kursus bisa dikosongi.</p>
                                                        </li>
                                                        <li style="list-style-type:square;">
                                                            <p>jika jurusan dipilih, kursus harus dikosongi.</p>
                                                        </li>
                                                        <li style="list-style-type:square;">
                                                            <p>jika kursus dipilih, jurusan harus dikosongi.</p>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="list-style-type:disc;">
                                            <p>Lalu, setelah melengkapi formulir, tekan tombol &quot;Submit&quot; untuk
                                                mengirim data.</p>
                                        </li>
                                    </ul>
                                </article>
                                <hr class="horizontal dark">
                                <h3 class="mt-5 text-uppercase">DATA PEMBAYARAN</h3>
                                <hr class="horizontal dark">
                                <article title="panduan pembayaran">
                                    <h5 class="mb-3" id="list-item-7">Membuat Tagihan Baru</h5>

                                </article>
                                <h3 class="mt-5 text-uppercase">PENDAFTARAN</h3>
                                <hr class="horizontal dark">
                                <article title="panduan pendaftaran 1">
                                    <h5 class="mb-3" id="list-item-8">Membuka Pendaftaran</h5>
                                    <p>
                                        Kamu bisa pergi ke halaman daftar Tahun Ajaran, lalu menekan tombol &ldquo;on&rdquo;
                                        agar status menjadi &ldquo;active&rdquo;, dengan begitu maka pendaftaran pada tahun
                                        tersebut telah dibuka.
                                    </p>
                                    <div class="alert alert-info text-white py-2 px-4">
                                        <p class="mb-0"><strong>note :</strong></p>
                                        <ul>
                                            <li style="list-style-type:disc;">
                                                <p class="mb-0">
                                                    hanya satu data tahun ajaran yang bisa diaktifkan dalam satu waktu.
                                                </p>
                                            </li>
                                            <li style="list-style-type:disc;">
                                                <p class="mb-0">
                                                    selepas waktu pendaftaran selesai, pastikan status di-<b>nonaktif</b>kan
                                                    kembali.
                                                </p>
                                            </li>
                                            <li style="list-style-type:disc;">
                                                <p class="mb-0 fw-bolder">
                                                    pastikan bahwa tahun ajaran yang diaktifkan adalah tahun ajaran terbaru.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
