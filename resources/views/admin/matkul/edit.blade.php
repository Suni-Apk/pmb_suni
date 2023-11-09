@extends('layouts.master')

@section('title', 'table template')

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
                                <form action="{{ route('admin.matkul.update', $matkuls->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="nama_matkuls">Nama Mata Kuliah</label>
                                        <input type="text" name="nama_matkuls" id="nama_matkuls" class="form-control" value="{{ old('name', $matkuls->nama_matkuls) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama_dosen">Nama Dosen Pengajar</label>
                                        <input type="text" name="nama_dosen" id="nama_dosen" class="form-control" value="{{ old('nama_dosen', $matkuls->nama_dosen) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="id_jurusans">Jurusan</label>
                                        <select name="id_jurusans" id="id_jurusans" class="form-control" required>
                                            <option hidden selected>-----------</option>
                                            @foreach ($jurusan as $item)
                                                <option value="{{ $item->id }}" {{ old('id_jurusans', $matkuls->id_jurusans) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>                                    
                                    <div class="form-group mb-3">
                                        <label for="id_semesters">Semester</label>
                                        <select name="id_semesters" id="id_semesters" class="form-control" required>
                                            <option hidden selected>-----------</option>
                                            @if (old('id_jurusans', $matkuls->id_jurusans))
                                                @foreach ($semesterGrouped[old('id_jurusans', $matkuls->id_jurusans)] as $semester)
                                                    <option value="{{ $semester->id }}" {{ old('id_semesters', $matkuls->id_semesters) == $semester->id ? 'selected' : '' }}>
                                                        {{ $semester->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="mulai">Mulai</label>
                                        <input type="text" name="mulai" id="mulai" class="form-control" value="{{ old('mulai', $matkuls->mulai) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="selesai">Selesai</label>
                                        <input type="text" name="selesai" id="selesai" class="form-control" value="{{ old('selesai', $matkuls->selesai) }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $matkuls->tanggal) }}">
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('admin.matkul.index') }}">
                                        <button type="button" class="btn btn-warning text-dark">Back</button>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const jurusanSelect = document.getElementById('id_jurusans');
        const semesterSelect = document.getElementById('id_semesters');
        
        const jurusanSemesterMap = @json($semesterGrouped);
        
        jurusanSelect.addEventListener('change', () => {
            const selectedJurusanId = jurusanSelect.value;
            const semesterOptions = jurusanSemesterMap[selectedJurusanId] || [];
        
            semesterSelect.innerHTML = '';
        
            semesterOptions.forEach(semester => {
                const option = document.createElement('option');
                option.value = semester.id;
                option.textContent = semester.name;
                semesterSelect.appendChild(option);
            });
        });
    </script>
@endsection
