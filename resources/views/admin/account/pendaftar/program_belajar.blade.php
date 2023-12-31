@extends('layouts.master')

@section('title', 'Detail Mahasiswa')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h6></h6>
                </div>
                <div class="card-body">
                    @foreach ($biodata as $biodatas)
                        @if ($biodatas->program_belajar === 'S1')
                            <div class="shadow-sm mb-3">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Mahasiswa Information</th>
                                            </tr>

                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td class="text-sm">Nama : <strong>{{ $mahasiswa->name }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Nomor Tlp :
                                                    <strong>{{ $mahasiswa->phone }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Email :
                                                    <strong>{{ $mahasiswa->email }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Gender :
                                                    <strong>{{ $mahasiswa->gender }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Jurusan :
                                                    <strong>{{ $biodatas->jurusan->name }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Angkatan : <strong>{{ $biodatas->angkatan->year }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Program belajar : <strong>{{ $biodatas->program_belajar }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!--Routine-->
                            @if ($biayaAngkatan->jenis_biaya ?? '' == 'Routine')
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
                                                    <th class="text-sm d-flex align-items-center"><input type="checkbox"
                                                            name="" id="" class="me-2"> Pilih
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($biaya as $index => $biayas)
                                                    @if ($biayas->jenis_biaya == 'Routine' && $biayas->id_angkatans == $biodatas->angkatan_id)
                                                        @foreach ($biayas->tagihanDetail as $key => $tagihans)
                                                            @if ($tagihans->id_users == $mahasiswa->id)
                                                                <tr>
                                                                    <td class="text-sm">{{ $no++ }}</td>
                                                                    <td class="text-sm">
                                                                        {{ $biayas->nama_biaya }}
                                                                    </td>
                                                                    <td class="text-sm">{{ $tagihans->tagihans->mounth }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        {{ \Carbon\Carbon::parse($tagihans->end_date)->format('d F Y') }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        <span
                                                                            class="badge badge-sm {{ $tagihans->status == 'SUDAH' ? 'bg-gradient-success' : 'bg-gradient-danger' }}">{{ $tagihans->status }}</span>

                                                                    </td>
                                                                    <td class="text-sm">Rp
                                                                        {{ number_format($tagihans->amount, 0, '', '.') }}
                                                                    </td>
                                                                    <td><input type="checkbox" name="jenis_tagihan"
                                                                            id="" value="Routine">
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <input type="hidden" name="id" value="{{ $mahasiswa->id }}" required>
                                        </table>
                                        <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                    </form>
                                </div>
                            @endif
                            <!--Tidak routine / Biaya lain-->
                            @if ($biayaAngkatan->jenis_biaya ?? '' == 'Tidakroutine')
                                <div class="table-responsive mb-3">
                                    <p class="text-bold">Tagihan Biaya Lain</p>

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
                                                    <th class="text-sm d-flex align-items-center"><input type="checkbox"
                                                            name="" id="" class="me-2"> Pilih
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($biaya as $index => $biayas)
                                                    @if (
                                                        $biayas->jenis_biaya == 'Tidakroutine' &&
                                                            $biayas->id_angkatans == $biodatas->angkatan_id &&
                                                            $biayas->id_jurusans == $biodatas->jurusan_id)
                                                        @foreach ($biayas->tagihanDetail as $key => $tagihans)
                                                            @if ($tagihans->id_users == $mahasiswa->id)
                                                                <tr>
                                                                    <td class="text-sm">{{ $no++ }}</td>

                                                                    <td class="text-sm">{{ $biayas->nama_biaya }}</td>
                                                                    <td class="text-sm">
                                                                        {{ \Carbon\Carbon::parse($tagihans->end_date)->format('d F Y') }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-danger">{{ $tagihans->status }}</span>
                                                                    </td>
                                                                    <td class="text-sm">Rp
                                                                        {{ number_format($tagihans->amount, 0, '', '.') }}
                                                                    </td>
                                                                    <td><input type="checkbox" name="jenis_tagihan"
                                                                            value="TidakRoutine" id="">
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                                        </table>
                                        <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                    </form>

                                </div>
                            @endif
                            <!--Daftar Ulang -->
                            @if ($biayaAngkatan->jenis_biaya ?? '' == 'DaftarUlang')
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
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($biaya as $index => $biayas)
                                                    @if ($biayas->jenis_biaya == 'DaftarUlang' && $biayas->id_angkatans == $biodatas->angkatan_id)
                                                        @foreach ($biayas->tagihanDetail as $key => $tagihans)
                                                            @if ($tagihans->id_users == $mahasiswa->id)
                                                                <tr>
                                                                    <td class="text-sm">1</td>
                                                                    <td class="text-sm">Tagihan Daftar Ulang</td>
                                                                    <td class="text-sm">30 Mei 2022</td>
                                                                    <td class="text-sm">
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-danger">Belum</span>

                                                                    </td>
                                                                    <td class="text-sm">Rp 2000.000</td>
                                                                    <td><input type="radio" name="jenis_tagihan"
                                                                            id="" value="DaftarUlang"
                                                                            class=""></td>

                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                                        </table>
                                        <div class="d-flex">
                                            <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif


                        @if ($biodatas->program_belajar == 'KURSUS')
                            <div class="shadow-sm mb-3">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Mahasiswa Information</th>
                                            </tr>

                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td class="text-sm">Nama : <strong>{{ $mahasiswa->name }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Nomor Tlp :
                                                    <strong>{{ $mahasiswa->phone }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Email :
                                                    <strong>{{ $mahasiswa->email }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Gender :
                                                    <strong>{{ $mahasiswa->gender }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Angkatan : <strong>{{ $biodatas->angkatan->year }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Program belajar : <strong>{{ $biodatas->program_belajar }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if ($biayaAngkatan->jenis_biaya ?? '' == 'Tingkatan')
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
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($biaya as $index => $biayas)
                                                    @if ($biayas->jenis_biaya == 'Tingkatan' && $biayas->id_angkatans == $biodatas->angkatan_id)
                                                        @foreach ($biayas->tagihanDetail as $key => $tagihans)
                                                            @if ($tagihans->id_users == $mahasiswa->id)
                                                                <tr>
                                                                    <td class="text-sm">{{ $no++ }}</td>
                                                                    <td class="text-sm">{{ $biayas->nama_biaya }}</td>
                                                                    <td class="text-sm">
                                                                        {{ \Carbon\Carbon::parse($tagihans->end_date)->format('d F Y') }}
                                                                    </td>
                                                                    <td class="text-sm">{{ $tagihans->tagihans->mounth }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-danger">{{ $tagihans->status }}</span>

                                                                    </td>
                                                                    <td class="text-sm">Rp
                                                                        {{ number_format($tagihans->amount, 0, '', '.') }}
                                                                    </td>
                                                                    <td><input type="checkbox" name="jenis_tagihan"
                                                                            id="" value="{{ $tagihans->id }}"
                                                                            class="">
                                                                    </td>

                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                                        </table>
                                        <div class="d-flex">
                                            <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            @if ($biayaAngkatan->jenis_biaya ?? false == 'Tidakroutine')
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
                                                    <th class="text-sm d-flex align-items-center"><input type="checkbox"
                                                            name="" id="" class="me-2"> Pilih
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($biaya as $index => $biayas)
                                                    @if ($biayas->jenis_biaya == 'Tidakroutine' && $biayas->id_angkatans == $biodatas->angkatan_id)
                                                        @foreach ($biayas->tagihanDetail as $key => $tagihans)
                                                            @if ($tagihans->id_users == $mahasiswa->id)
                                                                <tr>
                                                                    <td class="text-sm">1</td>
                                                                    <td class="text-sm">Tagihan Pembelian Jas</td>
                                                                    <td class="text-sm">30 April 2022</td>
                                                                    <td class="text-sm">
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-danger">Belum</span>
                                                                    </td>
                                                                    <td class="text-sm">Rp 2000.000</td>
                                                                    <td><input type="checkbox" name="jenis_tagihan"
                                                                            value="TidakRoutine" id="">
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                                        </table>
                                        <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    @endforeach


                    {{-- @if ($tagihanNoloop->tagihans->biayas->jenis_biaya == 'Tingkatan')
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
                                        @foreach ($tagihanLooping as $tagihans)
                                            <tr>
                                                <td class="text-sm">1</td>
                                                <td class="text-sm">Tagihan Tingkatan</td>
                                                <td class="text-sm">30 Mei 2022</td>
                                                <td class="text-sm">Mubtadi'</td>
                                                <td class="text-sm">
                                                    <span class="badge badge-sm bg-gradient-danger">Belum</span>

                                                </td>
                                                <td class="text-sm">Rp 850.000</td>
                                                <td><input type="checkbox" name="jenis_tagihan" id=""
                                                        value="Tingkatan" class=""></td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                                </table>
                                <div class="d-flex">
                                    <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                </div>
                            </form>
                        </div>
                    @endif --}}

                </div>
            </div>
        </div>
    </div>
@endsection
