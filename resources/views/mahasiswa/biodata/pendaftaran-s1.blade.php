@extends('layouts.master')

@section('title', 'table template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Page</h6>
                </div>
                <div class="card-body px-0 pt-0 pb- 2">
                    <div class="card">
                        <div class="card-body">
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
                                            <option value="" disabled selected>Pilih Jurusan</option>
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
@endsection
