@extends('layouts.master')

@section('title', 'table template')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Link</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form action="{{ route('admin.link_whatsapp.edit.process', $link->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Ubah Nama Linknya Disini" value="{{ old('name', $link->name) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="url">Url Link Whatsapp</label>
                                        <input type="text" name="url" id="url" class="form-control"
                                            placeholder="Ubah URL Linknya Disini" value="{{ old('url', $link->url) }}">
                                    </div>                                    
                                    <div class="form-group mb-3">
                                        <label for="id_tahun_ajarans">Tahun Ajaran</label>
                                        <select name="id_tahun_ajarans" id="id_tahun_ajarans" class="form-control" required>
                                            <option hidden selected>-----------</option>
                                            @foreach ($tahunAjaran as $tahunAjarans)
                                                <option value="{{ $tahunAjarans->id }}" {{ old('id_tahun_ajarans', $link->id_tahun_ajarans) == $tahunAjarans->id ? 'selected' : '' }}>
                                                    {{ $tahunAjarans->year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="id_jurusans">Jurusan</label>
                                        <select name="id_jurusans" id="id_jurusans" class="form-control" required>
                                            <option hidden selected>-----------</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="gender">Gender</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="ikhwan" value="ikhwan"
                                                {{ old('gender', $link->gender) == 'ikhwan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="ikhwan">
                                                Ikhwan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class= "form-check-input" type="radio" name="gender" id="akhwat" value="akhwat"
                                                {{ old('gender', $link->gender) == 'akhwat' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="akhwat">
                                                Akhwat
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="all" value="all"
                                                {{ old('gender', $link->gender) == 'all' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="all">
                                                Semua (ditujukan untuk seluruh mahasiswa)
                                            </label>
                                        </div>
                                    </div>
                                
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="#">
                                        <button type="button" class="btn btn-warning text-dark">Back</button>
                                    </a>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const tahunAjaranSelect = document.getElementById('id_tahun_ajarans');
        const jurusanSelect = document.getElementById('id_jurusans');
        
        const jurusanSemesterMap = @json($jurusanGrouped);
    
        tahunAjaranSelect.addEventListener('change', () => {
            const selectedTahunAjaranId = tahunAjaranSelect.value;
            const jurusanOptions = jurusanSemesterMap[selectedTahunAjaranId] || [];
    
            jurusanSelect.innerHTML = '';
    
            jurusanOptions.forEach(jurusan => {
                const option = document.createElement('option');
                option.value = jurusan.id;
                option.textContent = jurusan.name;
                jurusanSelect.appendChild(option);
            });
        });
    </script>    

@endsection
