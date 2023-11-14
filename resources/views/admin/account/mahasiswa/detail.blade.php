@extends('layouts.master')

@section('title', 'Detail Mahasiswa')

@section('content')
    <div class="row">
        @if (!isset($mahasiswa->biodata) == true)
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                    </div>
                    <div class="card-body">


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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
        @foreach ($biodata as $biodatas)
            @if ($biodatas->program_belajar === 'S1')
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span class="alert-text">{{ $error }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div></div>
                                @endforeach
                            @endif
                            <h4>Tagihan Program S1 <span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">


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
                            @foreach ($biayaAll as $biayaHead)
                                @if ($biayaHead->jenis_biaya == 'Routine' && $biayaHead->id_angkatans == $biodatas->angkatan_id)
                                    <p class="text-bold">Tagihan Spp</p>

                                    <div class="table-responsive mb-3">
                                        <form action="{{ route('admin.mahasiswa.bayar', $mahasiswa->id) }}" method="GET">
                                            @csrf
                                            @method('GET')
                                            <div class="shadow-sm mb-3">
                                                <table class="table">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th class="text-sm">No</th>
                                                            <th class="text-sm">Nama Tagihan</th>
                                                            <th class="text-sm">Bulan</th>
                                                            <th class="text-sm">Tanggal Tagihan</th>
                                                            <th class="text-sm">Status</th>
                                                            <th class="text-sm">Total tagihan</th>
                                                            <th class="text-sm d-flex align-items-center"><input
                                                                    type="checkbox" name="" id="select_all_ids"
                                                                    class="me-2"> Pilih
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
                                                                            <td class="text-sm">
                                                                                {{ $tagihans->tagihans->mounth }}
                                                                            </td>
                                                                            <td class="text-sm">
                                                                                {{ \Carbon\Carbon::parse($tagihans->end_date)->format('d F Y') }}
                                                                            </td>
                                                                            <td class="text-sm">
                                                                                <span
                                                                                    class="badge badge-sm {{ $tagihans->status == 'LUNAS' ? 'bg-gradient-success' : 'bg-gradient-danger' }}">{{ $tagihans->status }}</span>

                                                                            </td>
                                                                            <td class="text-sm">Rp
                                                                                {{ number_format($tagihans->amount, 0, '', '.') }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($tagihans->status === 'LUNAS')
                                                                                    <input type="checkbox" name="id[]"
                                                                                        id=""
                                                                                        value="{{ $tagihans->id }}"
                                                                                        class="" disabled>
                                                                                @else
                                                                                    <input type="checkbox" name="id[]"
                                                                                        id=""
                                                                                        value="{{ $tagihans->id }}"
                                                                                        class="checksAll">
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                        </form>
                                    </div>
                                @break
                            @endif
                        @endforeach

                        <!--Tidak routine / Biaya lain-->
                        @foreach ($biayaAll as $biayaHead)
                            @if (
                                $biayaHead?->jenis_biaya == 'Tidakroutine' &&
                                    $biayaHead?->id_jurusans == $biodatas->jurusan_id &&
                                    $biodatas->angkatan_id)
                                <div class="table-responsive mb-3">
                                    <p class="text-bold">Tagihan Biaya Lain</p>

                                    <form action="{{ route('admin.mahasiswa.bayar', $mahasiswa->id) }}" method="GET">
                                        @csrf
                                        @method('GET')
                                        <div class="shadow-sm mb-3">

                                            <table class="table">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th class="text-sm">No</th>
                                                        <th class="text-sm">Nama Tagihan</th>
                                                        <th class="text-sm">Tanggal Tagihan</th>
                                                        <th class="text-sm">Status</th>
                                                        <th class="text-sm">Total tagihan</th>
                                                        <th class="text-sm d-flex align-items-center"><input
                                                                type="checkbox" name="" id="select_all_ids2"
                                                                class="me-2"> Pilih
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
                                                                $biayas->id_jurusans == $biodatas->jurusan_id &&
                                                                $biayas->program_belajar == $biodatas->program_belajar)
                                                            @foreach ($biayas->tagihanDetail as $key => $tagihans)
                                                                @if ($tagihans->id_users == $mahasiswa->id)
                                                                    <tr>
                                                                        <td class="text-sm">{{ $no++ }}</td>

                                                                        <td class="text-sm">{{ $biayas->nama_biaya }}
                                                                        </td>
                                                                        <td class="text-sm">
                                                                            {{ \Carbon\Carbon::parse($tagihans->end_date)->format('d F Y') }}
                                                                        </td>
                                                                        <td class="text-sm">
                                                                            <span
                                                                                class="badge badge-sm {{ $tagihans->status == 'LUNAS' ? 'bg-gradient-success' : 'bg-gradient-danger' }}">{{ $tagihans->status }}</span>
                                                                        </td>
                                                                        <td class="text-sm">Rp
                                                                            {{ number_format($tagihans->amount, 0, '', '.') }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($tagihans->status === 'LUNAS')
                                                                                <input type="checkbox" name="id[]"
                                                                                    id=""
                                                                                    value="{{ $tagihans->id }}"
                                                                                    class="" disabled>
                                                                            @else
                                                                                <input type="checkbox" name="id[]"
                                                                                    id=""
                                                                                    value="{{ $tagihans->id }}"
                                                                                    class="checksAll2">
                                                                            @endif

                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                    </form>
                                </div>
                            @break
                        @endif
                    @endforeach

                    <!--Daftar Ulang -->
                    @foreach ($biayaAll as $biayaHead)
                        @if ($biayaHead->jenis_biaya == 'DaftarUlang' && $biayaHead->id_angkatans == $biodatas->angkatan_id)
                            <p class="text-bold">Tagihan Daftar Ulang</p>
                            <div class="table-responsive">
                                <form action="{{ route('admin.mahasiswa.bayar', $mahasiswa->id) }}"
                                    method="GET">
                                    @csrf
                                    @method('GET')
                                    <div class="shadow-sm mb-3">

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
                                                                    <td class="text-sm">{{ $no++ }}</td>
                                                                    <td class="text-sm">{{ $biayas->nama_biaya }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        {{ \Carbon\Carbon::parse($tagihans->end_date)->format('d M Y') }}
                                                                    </td>
                                                                    <td class="text-sm">
                                                                        <span
                                                                            class="badge badge-sm {{ $tagihans->status == 'LUNAS' ? 'bg-gradient-success' : 'bg-gradient-danger' }}">{{ $tagihans->status }}</span>

                                                                    </td>
                                                                    <td class="text-sm">Rp
                                                                        {{ number_format($tagihans->amount, 0, '', '.') }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($tagihans->status === 'LUNAS')
                                                                            <input type="radio" name="id[]"
                                                                                id=""
                                                                                value="{{ $tagihans->id }}"
                                                                                class="" disabled>
                                                                        @else
                                                                            <input type="radio" name="id[]"
                                                                                id=""
                                                                                value="{{ $tagihans->id }}"
                                                                                class="">
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                    </div>
                                </form>
                            </div>
                        @break
                    @endif
                @endforeach
            </div>
        </div>
@endif
@if ($biodatas->program_belajar == 'KURSUS')
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Tagihan Program Kursus <span class="text-danger">*</span></h4>
            </div>
            <div class="card-body">
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
                                    <td class="text-sm">Nama : <strong>{{ $mahasiswa->name }}</strong>
                                    </td>
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
                                        Program belajar :
                                        <strong>{{ $biodatas->program_belajar }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- @foreach ($biayaAll as $biayaHead)
                    @if ($biayaHead->jenis_biaya == 'Tingkatan')
                        <p class="text-bold">Tagihan Tingkatan</p>
                        <div class="table-responsive">
                            <form action="{{ route('admin.mahasiswa.bayar', $mahasiswa->id) }}"
                                method="GET">
                                @csrf
                                @method('GET')
                                <div class="shadow-sm mb-3">
                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-sm">No</th>
                                                <th class="text-sm">Nama Tagihan</th>
                                                <th class="text-sm">Tanggal Tagihan</th>
                                                <th class="text-sm">Tingkatan</th>
                                                <th class="text-sm">Status</th>
                                                <th class="text-sm">Total tagihan</th>
                                                <th class="text-sm d-flex align-items-center"><input
                                                        type="checkbox" name="" id=""
                                                        class="me-2"> Pilih
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
                                                                <td class="text-sm">{{ $no++ }}
                                                                </td>
                                                                <td class="text-sm">
                                                                    {{ $biayas->nama_biaya }}
                                                                </td>
                                                                <td class="text-sm">
                                                                    {{ \Carbon\Carbon::parse($tagihans->end_date)->format('d F Y') }}
                                                                </td>
                                                                <td class="text-sm">
                                                                    <span
                                                                        class="badge badge-sm bg-gradient-danger">{{ $tagihans->status }}</span>

                                                                </td>
                                                                <td class="text-sm">
                                                                    {{ $tagihans->tagihans->mounth }}
                                                                </td>
                                                                <td class="text-sm">Rp
                                                                    {{ number_format($tagihans->amount, 0, '', '.') }}
                                                                </td>
                                                                <td><input type="checkbox"
                                                                        name="jenis_tagihan" id=""
                                                                        value="{{ $tagihans->id }}"
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
                                </div>

                                <div class="d-flex">
                                    <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                </div>
                            </form>
                        </div>
                    @break
                @endif
            @endforeach --}}
                @foreach ($biayaAll as $biayaHead)
                    @if (
                        $biayaHead->jenis_biaya == 'Tidakroutine' &&
                            $biayaHead?->id_angkatans == $biodatas->angkatan_id &&
                            $biayaHead?->program_belajar == $biodatas->program_belajar)
                        <p class="text-bold">Tagihan Biaya lain</p>
                        <div class="table-responsive mb-3">
                            <form action="{{ route('admin.mahasiswa.bayar', $mahasiswa->id) }}"
                                method="GET">
                                @csrf
                                @method('GET')
                                <div class="shadow-sm mb-3">

                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-sm">No</th>
                                                <th class="text-sm">Nama Tagihan</th>
                                                <th class="text-sm">Tanggal Tagihan</th>
                                                <th class="text-sm">Status</th>
                                                <th class="text-sm">Total tagihan</th>
                                                <th class="text-sm d-flex align-items-center"><input
                                                        type="checkbox" name="" id="select_all_ids3"
                                                        class="me-2"> Pilih
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
                                                        $biayas->program_belajar == $biodatas->program_belajar)
                                                    @foreach ($biayas->tagihanDetail as $key => $tagihans)
                                                        @if ($tagihans->id_users == $mahasiswa->id)
                                                            <tr>
                                                                <td class="text-sm">{{ $no++ }}</td>
                                                                <td class="text-sm">{{ $biayas->nama_biaya }}
                                                                </td>
                                                                <td class="text-sm">
                                                                    {{ \Carbon\Carbon::parse($tagihans->end_date)->format('d F Y') }}
                                                                </td>
                                                                <td class="text-sm">
                                                                    <span
                                                                        class="badge badge-sm {{ $tagihans->status == 'LUNAS' ? 'bg-gradient-success' : 'bg-gradient-danger' }}">{{ $tagihans->status }}</span>
                                                                </td>
                                                                <td class="text-sm">Rp
                                                                    {{ number_format($tagihans->amount, 0, '', '.') }}
                                                                </td>
                                                                <td>
                                                                    @if ($tagihans->status === 'LUNAS')
                                                                        <input type="checkbox" name="id[]"
                                                                            id=""
                                                                            value="{{ $tagihans->id }}"
                                                                            class="" disabled>
                                                                    @else
                                                                        <input type="checkbox" name="id[]"
                                                                            id=""
                                                                            value="{{ $tagihans->id }}"
                                                                            class="checksAll3">
                                                                    @endif


                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                            </form>
                        </div>
                    @break
                @endif
            @endforeach
        </div>
@endif
@endforeach
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
@if (session('error'))
<script>
    Swal.fire(
        "{{ session('error') }}", // Menggunakan session('success') untuk mengambil pesan
        'You clicked the button!',
        'error'
    )
</script>
@endif
<script>
        $(function(e) {
            $("#select_all_ids").click(function() {
                $('.checksAll').prop('checked', $(this).prop('checked'));
            });
            $("#select_all_ids2").click(function() {
                $('.checksAll2').prop('checked', $(this).prop('checked'));
            });
            $("#select_all_ids3").click(function() {
                $('.checksAll3').prop('checked', $(this).prop('checked'));
            });
        });
</script>
@endpush
