@extends('layouts.master')

@section('title', 'table template')

@push('styles')
@endpush

@section('content')
<div class="card-header pb-0">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h6>Tambah Tahun Ajaran</h6>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive text-nowrap">
                        <form action="{{ route('admin.tahun-ajaran.create.process') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label for="year">Tahun Ajaran</label>
                                <input type="text" name="year" id="year" class="form-control">
                            </div>

                                <div class="form-group mb-3">
                                    <label for="start_at">Mulai</label>
                                    <input type="date" name="start_at" id="start_at" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end_at">Selesai</label>
                                    <input type="date" name="end_at" id="end_at" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{ route('admin.tahun-ajaran.index') }}">
                                    <button type="button" class="btn btn-warning">Back</button>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
