@extends('layouts.master')

@section('title', 'Create Course')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Tambah Kursus</h5>
                </div>
                <hr class="horizontal dark m-0">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <form action="{{ route('admin.course.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Biaya Administrasi</label>
                                <div class="input-group">
                                    <span class="input-group-text text-bolder">Rp. </span>
                                    <input type="number" step="500" name="amount" id="amount" min="0" class="form-control" value="{{ old('amount') }}" required>
                                </div>
                                @error('amount')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <label for="notes">Notes</label>
                                    <div class="d-flex gap-2">
                                        <a id="resetBtn" href="javascript:location.reload();" class="badge badge-sm font-weight-bolder bg-gradient-danger pt-2 d-none">Reset <i class="fas fa-times ms-1"></i></a>
                                        <button id="notesBtn" type="button" onclick="addNotes()" class="badge badge-sm font-weight-bolder bg-gradient-dark border-0">Tambah Note <i class="fas fa-plus ms-1"></i></button>
                                    </div>
                                    </div>
                                <div id="notesContainer">
                                    <div class="note-input-container input-group mb-2">
                                        <input type="text" name="notes[]" class="form-control" value="{{ old('notes[]') }}" required>
                                    </div>
                                </div>
                                @error('notes')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                                <script>
                                    const notesBtn = document.getElementById('notesBtn');
                                    const notesContainer = document.getElementById('notesContainer');
                                    const resetBtn = document.getElementById('resetBtn');
                            
                                    function addNotes() {
                                        const newInputContainer = document.createElement('div');
                                        resetBtn.classList.remove('d-none');
                                        newInputContainer.className = 'note-input-container mb-2 input-group flex-row-reverse';
                            
                                        const newInput = document.createElement('input');
                                        newInput.type = 'text';
                                        newInput.name = 'notes[]';
                                        newInput.className = 'form-control';
                                        newInput.required = true;
                            
                                        const removeButton = document.createElement('button');
                                        removeButton.type = 'button';
                                        removeButton.className = 'btn btn-light shadow-none input-group-text px-3';
                                        removeButton.innerHTML = '<i class="fas fa-times"></i>';
                                        removeButton.onclick = function() {
                                            removeNotes(this);
                                        };
                            
                                        newInputContainer.appendChild(newInput);
                                        newInputContainer.appendChild(removeButton);
                                        notesContainer.appendChild(newInputContainer);
                                    }
                            
                                    function removeNotes(button) {
                                        const inputContainer = button.parentElement;
                                        notesContainer.removeChild(inputContainer);
                                    }
                                </script>
                            </div>
                            
                            <style type="text/css">
                                .ck-editor__editable {
                                    min-height: 250px;
                                    max-height: 500px;
                                }
                            </style>
                            
                            <div class="form-group mb-3">
                                <label for="">Deskripsi</label>
                                <textarea name="desc" id="desc" class="form-control min-height-200">{{ old('desc') }}</textarea>
                                @error('desc') <!-- Perubahan disini -->
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('admin.course.index') }}">
                                <button type="button" class="btn btn-warning">Back</button>
                            </a>
                        </form>                        
                    </div>
                </div>
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