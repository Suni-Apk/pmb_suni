@extends('layouts.master')

@section('title', 'table template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Form Page</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <form action="#" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Kata Sandi</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2Mb</p>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="usia">Usia</label>
                                        <input type="number" name="usia" id="usia" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="" class="btn btn-warning">Back</a>
                                    <button type="submit" class="btn btn-warning">Back</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
