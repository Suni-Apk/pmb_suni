@extends('layouts.master')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card h-100">
                <div class="card-body p-3">
                    <hr class="horizontal gray-light">
                    <ul class="list-group">
                        <form action="{{route('admin.mahasiswa.create.process')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="" class="form-control-label">Full name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    placeholder="asep kastelo" value="{{ old('name') }}">
                                @error('name')
                                    <label for="" class="text-danger">{{$message}}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Email <strong class="text-danger">*</strong></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                    placeholder="asepKastelo@gmail.com" value="{{ old('email') }}"">
                                    @error('email')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="">No Tlp <strong class="text-danger">*</strong></label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="telephone"
                                    placeholder="08312379424" value="{{ old('phone') }}"">
                                    @error('phone')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="telephone"
                                    placeholder="**********" value="{{ old('password') }}"">
                                    @error('password')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Ulangi Password <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="telephone"
                                    placeholder="**********" value="{{ old('password_confirmation') }}"">
                                    @error('password_confirmation')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="" class="mb-3">Jenis kelamin <strong class="text-danger">*</strong></label>
                                <div class="d-flex">
                                    <div class="form-check me-2">
                                        <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="Laki-Laki"
                                            id="customRadio1">
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="Perempuan"
                                            id="customRadio2">
                                    </div>
                                    @error('gender')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="mb-3">Program Belajar (Untuk Administrasi) <strong class="text-danger">*</strong></label>
                                <select class="form-select" name="program">
                                    <option selected disabled>Pilih Program Belajar</option>
                                    <option value="S1">S1</option>
                                    <option value="KURSUS">KURSUS</option>
                                  </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary end-0">Create</button>
                                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                                    Back</a>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
