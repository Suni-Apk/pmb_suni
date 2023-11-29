@extends('layouts.master')

@section('title', 'table template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Mata Pelajaran</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $mapel->name) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="id_courses">Kursus</label>
                                        <select name="id_courses" id="id_courses" class="form-control" required>
                                            <option hidden selected>-----------</option>
                                            @foreach ($kursus as $item)
                                                <option value="{{ $item->id }}" {{ old('id_courses', $mapel->id_courses) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description">Deskripsi Mata Pelajaran</label>
                                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $mapel->description) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="guru">Dosen Pengajar</label>
                                        <input type="text" name="guru" id="guru" class="form-control" value="{{ old('guru', $mapel->guru) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="mulai">Mulai</label>
                                        <input type="time" name="mulai" id="mulai" class="form-control" value="{{ old('mulai', $mapel->mulai) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="selesai">Selesai</label>
                                        <input type="time" name="selesai" id="selesai" class="form-control" value="{{ old('selesai', $mapel->selesai) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="hari">Hari</label>
                                        <select name="hari" id="hari" class="form-control" required>
                                            <option hidden selected>-----------</option>
                                            <option value="Senin" {{ old('hari', $mapel->hari) == 'Senin' ? 'selected' : '' }}>Senin</option> 
                                            <option value="Selasa" {{ old('hari', $mapel->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option> 
                                            <option value="Rabu" {{ old('hari', $mapel->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option> 
                                            <option value="Kamis" {{ old('hari', $mapel->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option> 
                                            <option value="Jumat" {{ old('hari', $mapel->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option> 
                                            <option value="Sabtu" {{ old('hari', $mapel->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option> 
                                            <option value="Ahad" {{ old('hari', $mapel->hari) == 'Ahad' ? 'selected' : '' }}>Ahad</option> 
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
