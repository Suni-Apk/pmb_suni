@extends('layouts.master')

@section('title', 'Tambah Link')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Tambah Link Baru</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.link.create.process') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="">Nama</label>
                        <small class="text-danger" style="font-size: 12px">*</small>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Url Link</label>
                        <small class="text-danger" style="font-size: 12px">*</small>
                        <input type="url" class="form-control" name="url" id="url" value="{{ old('url') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Tipe Link</label>
                        <small class="text-danger" style="font-size: 12px">*</small>
                        <div class="form-check">
                            <input type="radio" name="type" id="whatsapp" class="form-check-input" value="whatsapp">
                            <label class="form-check-label" for="whatsapp">Whatsapp</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="type" id="zoom" class="form-check-input" value="zoom">
                            <label class="form-check-label" for="zoom">Zoom</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Gender</label>
                        <small class="text-danger" style="font-size: 12px">*</small>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="ikhwan"
                                value="ikhwan">
                            <label class="form-check-label" for="ikhwan">
                                Ikhwan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="akhwat"
                                value="akhwat">
                            <label class="form-check-label" for="akhwat">
                                Akhwat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="all"
                                value="all">
                            <label class="form-check-label" for="all">
                                Semua (ditujukan untuk seluruh mahasiswa)
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="id_tahun_ajarans">Tahun Ajaran</label>
                        <small class="text-danger" style="font-size: 12px">*</small>
                        <select name="id_tahun_ajarans" id="id_tahun_ajarans" class="form-select" required>
                            <option disabled selected>-----------</option>
                            @foreach ($tahun_ajarans as $item)
                                <option value="{{ $item->id }}">{{ $item->year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_jurusans">Jurusan</label>
                        <select name="id_jurusans" id="id_jurusans" class="form-select">
                            <option selected disabled>-----------</option>
                            @foreach ($jurusans as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_courses">Kursus</label>
                        <small class="text-info" style="font-size: 10px">Diisi ketika ingin menambahkan link untuk Kursus</small>
                        <select name="id_courses" id="id_courses" class="form-select">
                            <option selected disabled value="">-----------</option>
                            @foreach ($kursus as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="javascript:location.reload()" class="btn btn-warning">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection