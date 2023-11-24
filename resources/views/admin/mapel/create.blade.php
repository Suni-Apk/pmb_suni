@extends('layouts.master')

@section('title', 'table template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Mata Pelajaran</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form action="{{ route('admin.mapel.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="id_courses">Kursus</label>
                                        <select name="id_courses" id="id_courses" class="form-control" required>
                                            <option hidden selected>-----------</option>
                                            @foreach ($kursus as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description">Deskripsi Mata Pelajaran</label>
                                        <input type="text" name="description" id="description" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="guru">Dosen Pengajar</label>
                                        <input type="text" name="guru" id="guru" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="mulai">Mulai</label>
                                        <input type="time" name="mulai" id="mulai" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="selesai">Selesai</label>
                                        <input type="time" name="selesai" id="selesai" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="hari">Hari</label>
                                        <select name="hari" id="hari" class="form-control" required>
                                            <option hidden selected>-----------</option>
                                            <option value="Senin">Senin</option> 
                                            <option value="Selasa">Selasa</option> 
                                            <option value="Rabu">Rabu</option> 
                                            <option value="Kamis">Kamis</option> 
                                            <option value="Jumat">Jumat</option> 
                                            <option value="Sabtu">Sabtu</option> 
                                            <option value="Ahad">Ahad</option> 
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('admin.mapel.index') }}">
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
