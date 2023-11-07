@extends('layouts.master')

@section('title', 'Mata Kuliah')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Mata Kuliah</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form action="{{ route('admin.matkul.create') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama Dosen Pengajar</label>
                                        <input type="text" name="dosen" id="dosen" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama">Semester</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama">Deskripsi</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama">Mulai</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama">Selesai</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama">Tanggal</label>
                                        <input type="date" name="nama" id="nama" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('admin.matkul.index') }}">
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
