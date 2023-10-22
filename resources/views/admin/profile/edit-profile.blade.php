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
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="asep kastelo" value="{{ $auth->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="asepKastelo@gmail.com" value="{{ $auth->email }}">
                            </div>
                            <div class="form-group">
                                <label for="">No Tlp</label>
                                <input type="number" class="form-control" name="phone" id="telephone"
                                    placeholder="08312379424" value="{{ $auth->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="mb-3">Jenis kelamin</label>
                                <div class="d-flex">
                                    <div class="form-check me-2">
                                        <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                                        <input class="form-check-input" type="radio" name="gender" id="customRadio1"
                                            value="Laki-Laki" {{ $auth->gender == 'Laki-Laki' ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                        <input class="form-check-input" type="radio" name="gender" id="customRadio2"
                                            value="Perempuan" {{ $auth->gender == 'Perempuan' ? 'checked' : '' }}>
                                    </div>
                                </div>
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
