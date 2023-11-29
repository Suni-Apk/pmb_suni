@extends('layouts.master')

@section('title', 'Settings Biaya Admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="text-bold">Settings Administrasi</h5>
        </div>
        <div class="card-body pt-0">
            @foreach ($administrasi as $item)
                <form action="{{ route('admin.administrasi.proses', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-0">
                        <label for="" class="">Biaya Administrasi Program {{ $item->program_belajar }} {{ $item->course ? $item->course->name : '' }} <span class="text-danger">*</span></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text text-bolder">Rp. </span>
                            <input type="number" class="form-control" id="input" name="amount" min="0" step="500" placeholder="200.000" value="{{ $item->amount }}">
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
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
