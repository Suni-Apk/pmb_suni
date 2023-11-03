@extends('layouts.master')

@section('title', 'table template')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Mata Kuliah</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form action="{{ route('admin.matkul.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nama_matkuls">Nama</label>
                                        <input type="text" name="nama_matkuls" id="nama_matkuls" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="id_jurusans">Jurusan</label>
                                        <select name="id_jurusans" id="id_jurusans" class="form-control" required>
                                            <option disabled selected>-----------</option>
                                            @foreach ($jurusan as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="id_semesters">Semester</label>
                                        <select name="id_semesters" id="id_semesters" class="form-control" required>
                                            <option disabled selected>-----------</option>
                                            <!-- Pilihan semester akan diisi melalui JavaScript -->
                                        </select>
                                    </div>                                    
                                    <div class="form-group mb-3">
                                        <label for="nama_dosen">Dosen Pengajar</label>
                                        <input type="text" name="nama_dosen" id="nama_dosen" class="form-control">
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
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control">
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
