@extends('kursus.layouts.parent')

@section('title', 'table template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Page</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form action="{{route('kursus.pendaftaran.s1.edit.process',$user->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <img src="{{asset('storage/'.$biodata->image)}}" alt="" class="w-25 h-25 d-block">
                                        <input type="file" name="image" id="image" class="form-control">
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2Mb</p>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="profesi">Profesi</label>
                                        <input type="text" name="profesi" id="profesi" class="form-control" value="{{$biodata->profesi}}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="">Bisa Baca Al-Qur'an?</label>
                                        <div class="d-block">
                                            <input type="radio" name="baca_quran" id="bisa" class="form-radio" {{$biodata->baca_quran == 'Bisa' ? 'checked' : ''}} value="Bisa">
                                            <label for="bisa">Bisa</label>
                                        </div>
                                        <div class="d-block">
                                            <input type="radio" name="baca_quran" id="tidakBisa" class="form-radio" {{$biodata->baca_quran == 'Tidak Bisa' ? 'checked' : ''}} value="Tidak Bisa">
                                            <label for="tidakBisa">Tidak Bisa</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="birthdate">Tanggal Lahir</label>
                                        <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{$biodata->birthdate}}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="birthplace">Tempat Lahir</label>
                                        <input type="text" name="birthplace" id="birthplace" class="form-control" value="{{$biodata->birthplace}}" placeholder="Masukkan Tempat Lahir Anda">
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
                                        <textarea name="address" id="address"  class="form-control">{{$biodata->address}}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-warning text-dark">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var loadFile = function(event){
                        var outputs = document.getElementById('output');
                        outputs.src = URL.createObjectURL(event.target.files[0]);
                    }
                  </script>
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
