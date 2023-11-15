@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Jurusan</h6>
                </div>
                <div class="card-body">
                    <div>
                        <div >
                            <div class="table-responsive text-nowrap">
                                <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="id_tahun_ajarans">Tahun Ajaran</label>
                                        <select name="id_tahun_ajarans" id="id_tahun_ajarans" class="form-select" required>
                                            <option hidden selected>-----------</option>
                                            @foreach ($tahun_ajaran as $item)
                                                <option value="{{ $item->id }}" {{ old('id_tahun_ajarans', $jurusan->id_tahun_ajarans) == $item->id ? 'selected' : '' }}>{{ $item->year }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_tahun_ajarans')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $jurusan->name) }}" class="form-control" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="code">Code</label>
                                        <small class="text-danger" style="font-size: 12px">bisa diisi dengan singkatan/inisial jurusan</small>
                                        <input type="text" name="code" id="code" value="{{ old('code', $jurusan->code) }}" class="form-control" required>
                                        @error('code') 
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>                                    
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('admin.jurusan.index') }}">
                                        <button type="button" class="btn btn-warning">Back</button>
                                    </a>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
