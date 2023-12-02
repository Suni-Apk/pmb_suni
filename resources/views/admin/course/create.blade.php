@extends('layouts.master')

@section('title', 'Create Course')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Tambah Kursus</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <form action="{{ route('admin.course.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="note">Note</label>
                                <input type="text" name="notes" id="notes" class="form-control" required>
                                @error('notes') <!-- Perubahan disini -->
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="desc">Deskripsi</label>
                                <input type="text" name="desc" id="desc" class="form-control" required>
                                @error('desc') <!-- Perubahan disini -->
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('admin.course.index') }}">
                                <button type="button" class="btn btn-warning">Back</button>
                            </a>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
