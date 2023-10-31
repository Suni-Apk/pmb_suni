@extends('layouts.master')

@section('title', 'Detail mahasiswa')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h6></h6>
                </div>
                <div class="card-body">
                    <div class="avatar avatar-xl position-relative">
                        <img src="/soft-ui-dashboard-main/assets/img/bruce-mars.jpg" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                    <ul class="list-group mt-3 mb-3">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Name :</strong>
                            &nbsp; {{ $mahasiswa->name }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No Tlp :</strong>
                            &nbsp;
                            {{ $mahasiswa->phone }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email :</strong> &nbsp;
                            {{ $mahasiswa->email }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender :</strong>
                            &nbsp;
                            {{ $mahasiswa->gender }}
                        </li>
                    </ul>
                    <p class="text-bold">Tagihan Spp</p>
                    <div class="table-responsive mb-3">
                        <form action="{{ route('admin.mahasiswa.bayar') }}" method="POST">
                            @csrf
                            @method('POST')
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-sm">No</th>
                                        <th class="text-sm">Nama Tagihan</th>
                                        <th class="text-sm">Bulan</th>
                                        <th class="text-sm">Tanggal Tagihan</th>
                                        <th class="text-sm">Status</th>
                                        <th class="text-sm">Total tagihan</th>
                                        <th class="text-sm d-flex align-items-center"><input type="checkbox" name=""
                                                id="" class="me-2"> Pilih
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-sm">1</td>
                                        <td class="text-sm">Spp Tahun 2022</td>
                                        <td class="text-sm">Agustus</td>
                                        <td class="text-sm">30 Agustus 2022</td>
                                        <td class="text-sm">
                                            <span class="badge badge-sm bg-gradient-success">Sudah</span>

                                        </td>
                                        <td class="text-sm">Rp 2000.000</td>
                                        <td><input type="checkbox" name="jenis_tagihan" id="" value="Routine"></td>
                                    </tr>
                                </tbody>
                                <input type="hidden" name="id" value="{{ $mahasiswa->id }}" required>
                            </table>
                            <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                        </form>
                    </div>


                    <p class="text-bold">Tagihan Biaya lain</p>
                    <div class="table-responsive mb-3">
                        <form action="{{ route('admin.mahasiswa.bayar') }}" method="POST">
                            @csrf
                            @method('POST')
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-sm">No</th>
                                        <th class="text-sm">Nama Tagihan</th>
                                        <th class="text-sm">Tanggal Tagihan</th>
                                        <th class="text-sm">Status</th>
                                        <th class="text-sm">Total tagihan</th>
                                        <th class="text-sm d-flex align-items-center"><input type="checkbox" name=""
                                                id="" class="me-2"> Pilih
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-sm">1</td>
                                        <td class="text-sm">Tagihan Pembelian Jas</td>
                                        <td class="text-sm">30 April 2022</td>
                                        <td class="text-sm">
                                            <span class="badge badge-sm bg-gradient-danger">Belum</span>
                                        </td>
                                        <td class="text-sm">Rp 2000.000</td>
                                        <td><input type="checkbox" name="jenis_tagihan" value="TidakRoutine" id="">
                                        </td>
                                    </tr>
                                </tbody>
                                <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                            </table>
                            <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                        </form>
                    </div>

                    <p class="text-bold">Tagihan Daftar Ulang</p>
                    <div class="table-responsive">
                        <form action="{{ route('admin.mahasiswa.bayar') }}" method="POST">
                            @csrf
                            @method('POST')
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-sm">No</th>
                                        <th class="text-sm">Nama Tagihan</th>
                                        <th class="text-sm">Tanggal Tagihan</th>
                                        <th class="text-sm">Status</th>
                                        <th class="text-sm">Total tagihan</th>
                                        <th class="text-sm d-flex align-items-center"> Pilih
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-sm">1</td>
                                        <td class="text-sm">Tagihan Daftar Ulang</td>
                                        <td class="text-sm">30 Mei 2022</td>
                                        <td class="text-sm">
                                            <span class="badge badge-sm bg-gradient-danger">Belum</span>

                                        </td>
                                        <td class="text-sm">Rp 2000.000</td>
                                        <td><input type="radio" name="jenis_tagihan" id=""
                                                value="DaftarUlang" class=""></td>

                                    </tr>
                                </tbody>
                                <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                            </table>
                            <div class="d-flex">
                                <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                            </div>
                        </form>
                    </div>

                    <p class="text-bold">Tagihan Tingkatan</p>
                    <div class="table-responsive">
                        <form action="{{ route('admin.mahasiswa.bayar') }}" method="POST">
                            @csrf
                            @method('POST')
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-sm">No</th>
                                        <th class="text-sm">Nama Tagihan</th>
                                        <th class="text-sm">Tanggal Tagihan</th>
                                        <th class="text-sm">Tingkatan</th>
                                        <th class="text-sm">Status</th>
                                        <th class="text-sm">Total tagihan</th>
                                        <th class="text-sm d-flex align-items-center"><input type="checkbox"
                                                name="" id="" class="me-2"> Pilih
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-sm">1</td>
                                        <td class="text-sm">Tagihan Tingkatan</td>
                                        <td class="text-sm">30 Mei 2022</td>
                                        <td class="text-sm">Mubtadi'</td>
                                        <td class="text-sm">
                                            <span class="badge badge-sm bg-gradient-danger">Belum</span>

                                        </td>
                                        <td class="text-sm">Rp 850.000</td>
                                        <td><input type="checkbox" name="jenis_tagihan" id="" value="Tingkatan"
                                                class=""></td>

                                    </tr>
                                </tbody>
                                <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                            </table>
                            <div class="d-flex">
                                <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
