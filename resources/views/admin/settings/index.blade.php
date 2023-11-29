@extends('layouts.master')

@section('title', 'Settings General')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="text-bold">Settings General</h5>
                </div>
                <form action="{{ route('admin.settings.general.edit', $general->id) }}" method="post" class="card-body pt-0" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-column">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" value="{{ $general->name }}" placeholder="Nama Perkuliahan" name="name" id="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="image">Logo</label>
                            <img src="{{ $general->image }}" alt="" class="d-block w-100 w-sm-50 w-md-25 border mb-3 rounded-3">
                            <p class="text-xs mb-2 text-dark text-center">
                                Pilih salah satu dari 2 metode dibawah ( link / upload dari perangkat )
                            </p>
                            <div class="d-flex justify-content-center gap-4">
                                <div class="w-100">
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    <small class="text-muted text-xs mb-0">Upload gambar dari perangkat untuk versi file. Max ukuran 4 MB</small>
                                </div>
                                <div class="vr"></div>
                                <div class="w-100">
                                    <input type="text" name="image_link" id="image_link" class="form-control" value="{{ $general->image }}">
                                    <small class="text-muted text-xs mb-0">Paste link gambar dari internet untuk versi tautan.</small>
                                </div>
                            </div>

                            @error('image')
                                <div class="text-danger text-sm" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex flex-column flex-md-row gap-4">
                            <div class="form-group w-100">
                                <label for="phone">No. Telepon</label>
                                <input type="tel" value="{{ $general->phone }}" placeholder="No. Telepon Perkuliahan" name="phone" id="phone" class="form-control">
                            </div>
                            
                            <div class="form-group w-100">
                                <label for="email">Email</label>
                                <input type="email" value="{{ $general->email }}" placeholder="Email Perkuliahan" name="email" id="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Website Title</label>
                            <input type="text" value="{{ $general->title }}" placeholder="Judul Website" name="title" id="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="url">Website Url Utama</label>
                            <input type="url" value="{{ $general->url }}" placeholder="https://www.example.com" name="url" id="url" class="form-control">
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="javascript:location.reload();" class="btn btn-warning">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-bold">Deskripsi Program Belajar</h5>
                </div>
                <style type="text/css">
                    .ck-editor__editable {
                        min-height: 250px;
                        max-height: 500px;
                    }
                </style>
                <form action="{{ route('admin.settings.desc.edit', $descPro->id) }}" method="post" class="card-body pt-0">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="desc">Deskripsi Program Kuliah S1</label>
                            <textarea name="desc" id="desc" class="form-control">{{ $descPro->desc }}</textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="javascript:location.reload();" class="btn btn-warning">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script type="text/javascript">
        ClassicEditor
            .create( document.getElementById( 'desc' ), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.settings.upload.file').'?_token='.csrf_token() }}",
                }
            })
            .then( editor => {
                console.log(editor);
            })
            .catch( error => {
                console.log(error);
            });
    </script>
@endpush