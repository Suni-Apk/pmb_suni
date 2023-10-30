@extends('layouts.master')

@section('title', 'Edit Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card h-100">
                <div class="card-body p-3">
                    <hr class="horizontal gray-light">
                    <ul class="list-group">
                        <form action="{{ route('mahasiswa.profile.edit-profile.process', $mahasiswa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="" class="form-control-label">Full name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="asep kastelo" value="{{ $mahasiswa->name }}">
                                @error('name')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="asepKastelo@gmail.com"
                                    value="{{ $mahasiswa->email }}">
                                @error('email')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">No Tlp</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" id="telephone" placeholder="08312379424" value="{{ $mahasiswa->phone }}">
                                @error('phone')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    name="birthdate" id="telephone" value="{{ $mahasiswa->birthdate }}">
                                @error('birthdate')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="mb-3">Jenis kelamin</label>
                                <div class="d-flex">
                                    <div class="form-check me-2">
                                        <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                            name="gender" value="Laki-Laki" id="customRadio1"
                                            {{ Auth::user()->gender == 'Laki-Laki' ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                            name="gender" value="Perempuan" id="customRadio2"
                                            {{ Auth::user()->gender == 'Perempuan' ? 'checked' : '' }}>
                                    </div>
                                    @error('gender')
                                        <label for="" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"></textarea>
                            </div> --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary end-0"><i class="fas fa-edit">
                                    </i> Edit</button>
                                <a href="{{ route('mahasiswa.profile.index') }}" class="btn btn-warning"><i
                                        class="fas fa-backward"></i>
                                    Back</a>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
