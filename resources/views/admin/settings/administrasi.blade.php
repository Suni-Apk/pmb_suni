@extends('layouts.master')

@section('title', 'Settings Biaya Admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="text-bold">Silahkan Sesuaikan Biaya administrasi </h5>
        </div>
        <div class="card-body pt-0">
            @foreach ($administrasi as $item)
                <form action="{{ route('admin.administrasi.proses', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="" class="">Masukkan Harga Adminstrasi Program {{ $item->program_belajar }}<span class="text-danger">*</span></label>
                        <input type="hidden" name="program_belajar" value="{{ $item->program_belajar }}">
                        <div class="input-group mb-4">
                            <span class="input-group-text text-bolder">Rp. </span>
                            <input type="number" class="form-control" id="input" name="amount" placeholder="200.000" value="{{ $item->amount }}">
                        </div>
                        <button class="btn btn-primary py-2 px-3" type="submit">Update</button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.form-control').mask("#.##0", {
            reverse: true
        });
    </script>
@endpush
