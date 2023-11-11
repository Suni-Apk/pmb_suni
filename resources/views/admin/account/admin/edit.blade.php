@extends('layouts.master')

@section('title', 'Edit Account Admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card h-100">
                <div class="card-body p-3">
                    <hr class="horizontal gray-light">
                    <ul class="list-group">
                        <form action="{{route('admin.admin.edit.process',$user->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="" class="form-control-label">Full name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    placeholder="asep kastelo" value="{{$user->name}}">
                                @error('name')
                                    <label for="" class="text-danger">{{$message}}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Email <strong class="text-danger">*</strong></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                    placeholder="asepKastelo@gmail.com" value="{{$user->email}}">
                                    @error('email')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="">No Tlp <strong class="text-danger">*</strong></label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="telephone"
                                    placeholder="08312379424" value="{{$user->phone}}">
                                    @error('phone')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password Lama <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="telephone"
                                    placeholder="**********" value="">
                                    @error('old_password')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password Baru <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="telephone"
                                    placeholder="**********" value="">
                                    @error('password')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Ulangi Password <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="telephone"
                                    placeholder="**********" value="">
                                    @error('password_confirmation')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="" class="mb-3">Jenis kelamin</label>
                                <div class="d-flex">
                                    <div class="form-check me-2">
                                        <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="Laki-Laki"
                                            id="customRadio1" {{$user->gender == 'Laki-Laki' ? 'checked' : ''}}>
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="Perempuan"
                                            id="customRadio2" {{$user->gender == 'Perempuan' ? 'checked' : ''}}>
                                    </div>
                                    @error('gender')
                                        <label for="" class="text-danger">{{$message}}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary end-0">Create</button>
                                <a href="{{ route('admin.admin.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                                    Back</a>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
