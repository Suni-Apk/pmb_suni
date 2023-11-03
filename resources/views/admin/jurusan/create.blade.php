@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Jurusan</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form action="{{ route('admin.jurusan.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="id_tahun_ajarans">Tahun Ajaran / Angkatan</label>
                                        <select name="id_tahun_ajarans" id="id_tahun_ajarans" class="form-control" required>
                                            <option disabled selected>-----------</option>
                                            @foreach ($tahun_ajaran as $item)
                                                <option value="{{ $item->id }}">{{ $item->year }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_tahun_ajarans')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="name">Code / Singkatan</label>
                                        <input type="text" name="code" id="code" class="form-control" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('admin.jurusan.index') }}">
                                        <button type="button" class="btn btn-warning text-dark">Back</button>
                                    </a>
                                </form
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
