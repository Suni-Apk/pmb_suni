@extends('layouts.master')

@section('title', 'Edit Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card h-100">
                <div class="card-body p-3">
                    <hr class="horizontal gray-light">
                    <ul class="list-group">
                        <form action="{{ route('admin.profile_proses', $auth->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="" class="form-control-label">Full name</label>
                                <input type="text"
                                    class="form-control @error('name')
                                    is-invalid
                                @enderror"
                                    name="name" id="name" placeholder="asep kastelo" value="{{ $auth->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email"
                                    class="form-control @error('email')
                                is-invalid
                            @enderror"
                                    name="email" id="email" placeholder="asepKastelo@gmail.com"
                                    value="{{ $auth->email }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">No Tlp</label>
                                <input type="number"
                                    class="form-control @error('phone')
                                is-invalid
                            @enderror"
                                    name="phone" id="telephone" placeholder="08312379424" value="{{ $auth->phone }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="mb-3">Jenis kelamin</label>
                                <div class="d-flex">
                                    <div class="form-check me-2">
                                        <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                                        <input class="form-check-input" type="radio" name="gender" id="customRadio1"
                                            value="Laki-Laki" {{ $auth->gender == 'Laki-Laki' ? 'checked' : '' }}>
                                        @error('gender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                        <input class="form-check-input" type="radio" name="gender" id="customRadio2"
                                            value="Perempuan" {{ $auth->gender == 'Perempuan' ? 'checked' : '' }}>
                                        @error('gender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal lahir</label>
                                <input type="date"
                                    class="form-control @error('birthdate')
                                is-invalid
                            @enderror"
                                    name="birthdate" id="birthdate" placeholder="" value="{{ $auth->birthdate }}">
                                @error('birthdate')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary end-0"><i class="fas fa-edit">
                                    </i> Edit</button>
                                <a href="{{ route('admin.profile') }}" class="btn btn-warning"><i
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
