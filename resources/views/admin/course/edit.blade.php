@extends('layouts.master')

@section('title', 'Create Course')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Kursus</h6>
                </div>
                <div class="card-body pb-2">
                    <div class="table-responsive text-nowrap">
                        <form action="{{ route('admin.course.update', $course->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $course->name }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('admin.jurusan.index') }}">
                                <button type="button" class="btn btn-warning text-dark">Back</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
