@extends('layouts.master')

@section('title', 'Tambah Banner')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Tambah Banner</h6>
                </div>
                <hr class="horizontal dark m-0">
                <form action="{{ route('admin.settings.banner.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="image">Gambar</label>
                            <p class="text-xs mb-2 text-dark text-end w-75">
                                Pilih salah satu dari 2 metode dibawah ( link / upload dari perangkat )
                            </p>
                        </div>
                        <div class="d-flex justify-content-center gap-4">
                            <div class="w-100">
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                <small class="text-muted text-xs mb-0">Upload gambar dari perangkat untuk versi file. Max ukuran 6 MB</small>
                            </div>
                            <div class="vr"></div>
                            <div class="w-100">
                                <input type="text" name="image_link" id="image_link" class="form-control" value="">
                                <small class="text-muted text-xs mb-0">Paste link gambar dari internet untuk versi tautan.</small>
                            </div>
                        </div>
                        @error('image')
                            <div class="text-danger text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Tipe</label>
                        <select name="type" id="typeSelect" class="form-select">
                            <option hidden selected>--- Pilih tipe banner ---</option>
                            <option value="WELCOME">WELCOME</option>
                            <option value="DASHBOARD">DASHBOARD</option>
                        </select>
                        @error('type')
                            <div class="text-danger text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="formDB" class="d-none">
                        <div class="form-group">
                            <label for="target">Target</label>
                            <select name="target" id="targetSelect" class="form-select">
                                <option hidden selected>--- Pilih target banner ---</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="MAHASISWA">MAHASISWA</option>
                                <option value="KURSUS">PESERTA KURSUS</option>
                                <option value="SEMUA">SEMUA</option>
                            </select>
                            @error('target')
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="desc">Deskripsi</label>
                            <textarea name="desc" id="desc" style="min-height: 5rem;" class="form-control">{{ old('desc') }}</textarea>
                        </div>
                        @error('desc')
                            <div class="text-danger text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr class="horizontal dark m-0">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.settings.component') }}" class="btn btn-warning">Back</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const typeSelect = document.getElementById('typeSelect');
        const formDB = document.getElementById('formDB');

        typeSelect.addEventListener('change', function () {
            if (typeSelect.value === 'DASHBOARD') {
                formDB.classList.remove('d-none');
            } else {
                formDB.classList.add('d-none');
            }
        });
    </script>
@endpush