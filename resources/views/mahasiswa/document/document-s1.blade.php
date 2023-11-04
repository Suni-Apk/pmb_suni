@extends('layouts.master')

@section('title', 'table template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Dokumen</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form action="{{route('mahasiswa.pendaftaran.document.process')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group mb-3">
                                        <label for="ijazah">Ijazah SMA/MA/Paket C Terlegalisir</label>
                                        <input type="file" name="ijazah" id="ijazah" class="form-control" accept="application/pdf">
                                    </div>
                                
                                    <div class="form-group mb-3">
                                        <label for="ktp">KTP (Kartu Tanda Penduduk)</label>
                                        <input type="file" name="ktp" id="ktp" class="form-control" accept="application/pdf">
                                    </div>
                                
                                    <div class="form-group mb-3">
                                        <label for="kk">Kartu Keluarga</label>
                                        <input type="file" name="kk" id="kk" class="form-control" accept="application/pdf">
                                    </div>
                                
                                    <div class="form-group mb-3">
                                        <label for="transkip">Transkip Nilai (untuk mahasiswa pindahan)</label>
                                        <input type="file" name="transkrip_nilai" id="transkip" class="form-control" accept="application/pdf">
                                    </div>
                                
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-warning text-dark">Reset</button>
                                </form>                                                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire(
                "{{ session('success') }}", // Menggunakan session('success') untuk mengambil pesan
                'You clicked the button!',
                'success'
            )
        </script>
    @endif
@endpush
