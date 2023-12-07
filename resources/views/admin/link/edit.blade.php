@extends('layouts.master')

@section('title', 'Edit Link')

@section('content')
<div class="page-header min-height-300 border-radius-xl"
    style="background-image: url('/assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
</div>
<div class="card blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="pt-4 pb-3">
        <div class="d-flex px-5 text-center justify-content-between fs-3 font-weight-bold">
            {{ $link->name }}
            @if ($link->type == 'whatsapp')
            <a href="{{ route('admin.link.whatsapp') }}" class="btn bg-gradient-secondary">Back</a>    
            @elseif ($link->type == 'zoom')
            <a href="{{ route('admin.link.zoom') }}" class="btn bg-gradient-secondary">Back</a>
            @endif
        </div>
    </div>

    <div class="card-body container-fluid pb-4 mt-n3">
        <form action="{{route('admin.link.edit.process', $link->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Nama</label>
                <small class="text-danger" style="font-size: 12px">*</small>
                <input type="text" class="form-control" name="name" id="name" value="{{ $link->name }}">
            </div>
            <div class="form-group">
                <label for="">Url Link</label>
                <small class="text-danger" style="font-size: 12px">*</small>
                <input type="url" class="form-control" name="url" id="url" value="{{ $link->url }}">
            </div>
            <div class="form-group mb-3">
                <label>Tipe Link</label>
                <small class="text-danger" style="font-size: 12px">*</small>
                <div class="form-check">
                    <input type="radio" name="type" id="Whatsapp" class="form-check-input" value="Whatsapp" @checked(old('type', $link->type))>
                    <label class="form-check-label" for="Whatsapp">Whatsapp</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="type" id="Zoom" class="form-check-input" value="Zoom" @checked(old('type', $link->type))>
                    <label class="form-check-label" for="Zoom">Zoom</label>
                </div>
            </div>
            <div class="form-group mb-3">
                <label>Gender</label>
                <small class="text-danger" style="font-size: 12px">*</small>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="ikhwan"
                        value="ikhwan" @checked(old('gender', $link->gender))>
                    <label class="form-check-label" for="ikhwan">
                        Ikhwan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="akhwat"
                        value="akhwat" @checked(old('gender', $link->gender))>
                    <label class="form-check-label" for="akhwat">
                        Akhwat
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="all"
                        value="all" @checked(old('gender', $link->gender))>
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
                        <option value="{{ $item->id }}" @selected(old('id_tahun_ajarans', $link->id_tahun_ajarans))>{{ $item->year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Jurusan</label>
                <select name="id_jurusans" id="id_jurusans" class="form-select">
                    <option value="" diasbled selected>-----------</option>
                    @foreach ($jurusans as $item)
                        <option value="{{ $item->id }}" @selected(old('id_jurusans', $link->id_jurusans))>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_courses">Kursus</label>
                <small class="text-info" style="font-size: 10px">Diisi ketika ingin menambahkan link untuk Kursus</small>
                <select name="id_courses" id="id_courses" class="form-select">
                    <option disabled selected>-----------</option>
                    @foreach ($kursus as $item)
                        <option value="{{ $item->id }}" @selected(old('id_courses', $link->id_courses))>{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('id_courses')
                    <label class="text-danger">{{$message}}</label>
                @enderror
            </div>       
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="javascript:location.reload()" class="btn btn-warning">Reset</a>
            </div>
        </form>
    </div>
</div>
@endsection