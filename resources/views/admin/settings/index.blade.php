@extends('layouts.master')

@section('title', 'Settings General')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="text-bold">Settings General</h5>
                </div>
                <form action="{{ route('admin.settings.general.edit', $general->id) }}" method="post" class="card-body pt-0">
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-column">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" value="{{ $general->name }}" placeholder="Nama Perkuliahan" name="name" id="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="image">Logo</label>
                            <img src="{{ asset('storage/' . $general->image) }}" alt="" class="d-block w-100 w-sm-50 w-md-25">
                            <input type="file" name="image" id="image" class="form-control">
                            <small class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 4Mb</small>
                        </div>

                        <div class="form-group">
                            <label for="phone">No. Telepon</label>
                            <input type="tel" value="{{ $general->phone }}" placeholder="No. Telepon Perkuliahan" name="phone" id="phone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="{{ $general->email }}" placeholder="Email Perkuliahan" name="email" id="email" class="form-control">
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
                            <a href="" class="btn btn-warning">Reset</a>
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
                    }
                </style>
                <form action="{{ route('admin.settings.desc.edit', $descPro->id) }}" method="post" class="card-body pt-0">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="s1">Deskripsi Program Kuliah S1</label>
                            <textarea name="s1" id="s1" class="form-control min-height-200">{{ $descPro->s1 }}</textarea>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="kursus">Deskripsi Program Kursus MABANI</label>
                            <textarea name="kursus" id="kursus" class="form-control min-height-200">{{ $descPro->kursus }}</textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="javascript:window.location.reload();" class="btn btn-warning">Reset</a>
                        </div>
                    </div>
                </form>
            </div>{{ route('admin.settings.upload.file') }}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script type="text/javascript">
        ClassicEditor
            .create( document.getElementById( 's1' ), {
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

        ClassicEditor
            .create( document.getElementById( 'kursus' ), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.settings.upload.file').'?_token='.csrf_token() }}",
                }
            })
            .then( editor => {
                console.log(editor);
            })
            .catch( error => {
                console.log(error);
            })
    </script>
@endpush