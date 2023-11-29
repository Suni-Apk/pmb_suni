@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')

    @php
        $transactionDaftar = App\Models\Transaksi::where('user_id', Auth::user()->id)
            ->where('jenis_tagihan', 'DaftarUlang')
            ->where('status', 'berhasil')
            ->where('jenis_pembayaran', 'cash')
            ->first();
        $biaya = App\Models\Biaya::where('program_belajar', 'S1')
            ->where('jenis_biaya', 'DaftarUlang')
            ->where('id_angkatans', Auth::user()->biodata->angkatan_id)
            ->latest()
            ->first();

        $user = Auth::user();
        $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)
            ->where('id_users', $user->id)
            ->latest()
            ->first();
        $cicilans = App\Models\Cicilan::where('id_tagihan_details', $tagihan->id)->first();
        $cicilan2 = App\Models\Cicilan::where('id_tagihan_details', $tagihan->id)
            ->where('status', 'LUNAS')
            ->get();
        $total_pembayaran = round(
            App\Models\Cicilan::where('id_tagihan_details', $tagihan->id)
                ->where('status', 'belum')
                ->sum('harga'),
        );
        $setengah_jumlah_daftar_ulang = round(($tagihan->amount * 2) / 3);

    @endphp
    @if (!isset($cicilans) && !isset($transactionDaftar))
        <div class="col-12 text-center mb-4">
            <div class="card">
                <h3 class="mt-3">Tagihan</h3>
                <h5 class="text-secondary font-weight-normal">Daftar Ulang Langsung</h5>
                <div class="row">
                    <div class="d-flex align-items-center justify-content-center">
                        <form action="{{ route('mahasiswa.tagihan.daftar.ulang') }}" method="POST"
                            class="d-flex align-items-center justify-content-center w-100">
                            @csrf
                            @method('GET')
                            <div class="col-6 col-sm-4">
                                <input type="hidden" name="id" value="{{ $tagihan->id }}">
                                <button name="jenis_pembayaran" value="cash" type="submit"
                                    class="btn bg-gradient-primary sm:w-50">
                                    Cash
                                </button>
                            </div>
                            <div class="col-6 col-sm-4">
                                <button name="jenis_pembayaran" value="cicil" type="submit"
                                    class="btn bg-gradient-primary sm:w-50">
                                    Cicil 3x
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif($cicilans)
        @php
            $biaya = App\Models\Biaya::where('program_belajar', 'S1')
                ->where('jenis_biaya', 'DaftarUlang')
                ->where('id_angkatans', Auth::user()->biodata->angkatan_id)
                ->latest()
                ->firstOrfail();

            $user = Auth::user();
            $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)
                ->where('id_users', $user->id)
                ->latest()
                ->firstOrFail();

            // Menghitung total pembayaran yang telah dilakukan
            $total_pembayaran = round(
                App\Models\Transaksi::where('user_id', $user->id)
                    ->where('tagihan_detail_id', $tagihan->id)
                    ->where('jenis_tagihan', $biaya->jenis_biaya)
                    ->where('status', 'berhasil')
                    ->where('jenis_pembayaran', 'cicil')
                    ->sum('total'),
            );
            $cicilannya = App\Models\Cicilan::where('id_tagihan_details', $tagihan->id)->get();
            $cicilan1 = App\Models\Cicilan::where('id_tagihan_details', $tagihan->id)
                ->where('status', 'LUNAS')
                ->first();

            // Hitung setengah dari $jumlah_uang_daftar_ulang
            // $setengah_jumlah_daftar_ulang = ($tagihan->amount * 2) / 3;

            // Hitung sepersepuluh dari $jumlah_uang_daftar_ulang
            // $sepertiganya_jumlah_daftar_ulang = $tagihan->amount / 3;

            // Mengecek apakah mahasiswa telah berhasil membayar cicilan pertama

            // Mengecek apakah mahasiswa telah berhasil membayar cicilan kedua

            // Mengecek apakah mahasiswa telah berhasil membayar cicilan ketiga

            // dd($cicilan_pertama_terbayar, $cicilan_kedua_terbayar, $cicilan_ketiga_terbayar);

        @endphp
        @if ($cicilan2->count() != 3)
            <div class="row">
                @if ($biodata->program_belajar === 'S1')
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <span class="alert-text">{{ $error }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div></div>
                                    @endforeach
                                @endif
                                <h4>Tagihan Daftar Ulang <span class="text-danger">*</span></h4>
                            </div>
                            <div class="card-body">

                                <!--Routine-->
                                @foreach ($biayaAll as $biayaHead)
                                    @if ($biayaHead->jenis_biaya == 'DaftarUlang' && $biayaHead->id_angkatans == $biodata->angkatan_id)
                                        <p class="text-bold">Tagihan Daftar Ulang Cicil</p>

                                        <div class="table-responsive mb-3">
                                            <form action="{{ route('mahasiswa.transactions.cicilan', $mahasiswa->id) }}"
                                                method="GET">
                                                @csrf
                                                @method('GET')
                                                <div class="shadow-sm mb-3">
                                                    <table class="table">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th class="text-sm">No</th>
                                                                <th class="text-sm">Nama Tagihan</th>
                                                                <th class="text-sm">Batas Tagihan</th>
                                                                <th class="text-sm">Status</th>
                                                                <th class="text-sm">Total tagihan</th>
                                                                <th class="text-sm d-flex align-items-center">Pilih
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $no = 1;
                                                            @endphp
                                                            @foreach ($cicilanAll as $key => $value)
                                                                @if ($value->id_tagihan_details == $tagihan->id)
                                                                    <tr>
                                                                        <td class="text-sm">{{ $key + 1 }}</td>
                                                                        <td class="text-sm">
                                                                            {{ $value->nama_cicilan }}
                                                                        </td>
                                                                        <td class="text-sm">
                                                                            {{ \Carbon\Carbon::parse($value->end_date)->format('d F Y') }}
                                                                        </td>
                                                                        <td class="text-sm">
                                                                            <span
                                                                                class="badge badge-sm {{ $value->status == 'LUNAS' ? 'bg-gradient-success' : 'bg-gradient-danger' }}">{{ $value->status }}</span>

                                                                        </td>
                                                                        <td class="text-sm">Rp
                                                                            {{ number_format(round($value->harga, -2), 0, '', '.') }}
                                                                        </td>
                                                                        <td>

                                                                            @if ($key == 0)
                                                                                <input type="radio" name="id[]"
                                                                                    id=""
                                                                                    value="{{ $value->id }}"
                                                                                    class=""
                                                                                    {{ $key == 0 && $value->status == 'LUNAS' ? 'disabled' : '' }}>
                                                                            @endif

                                                                            @if ($key > 0)
                                                                                @php
                                                                                    $previousStatus = $cicilanAll[$key - 1]['status'];
                                                                                @endphp

                                                                                @if ($previousStatus != 'LUNAS')
                                                                                    <input type="radio" name="id[]"
                                                                                        id=""
                                                                                        value="{{ $value->id }}"
                                                                                        class="" disabled>
                                                                                @else
                                                                                    <input type="radio" name="id[]"
                                                                                        id=""
                                                                                        value="{{ $value->id }}"
                                                                                        class=""
                                                                                        {{ $value->status == 'LUNAS' ? 'disabled' : '' }}>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <button class="btn btn-primary btn-sm" type="submit">Bayar</button>
                                            </form>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                @endif
            </div>
        @else
            <div class="col-12 text-center mb-4">
                <div class="card py-3">
                    <h2 class="mt-3">Selamat !</h2>
                    <h5 class="text-secondary font-weight-normal">Tagihan Daftar Ulang Sudah Lunas</h5>
                </div>
            </div>
        @endif

        @if (!$cicilan1)
        @else
            <div class="row">
                @if ($biodata->program_belajar === 'S1')
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <span class="alert-text">{{ $error }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div></div>
                                    @endforeach
                                @endif
                                <h4>Tagihan Program S1 <span class="text-danger">*</span></h4>
                            </div>
                            <div class="card-body">

                                <!--Routine-->
                                @foreach ($biayaAll as $biayaHead)
                                    @if ($biayaHead->jenis_biaya == 'Routine' && $biayaHead->id_angkatans == $biodata->angkatan_id)
                                        <p class="text-bold">Tagihan Spp</p>

                                        <div class="table-responsive mb-3">
                                            <form action="{{ route('mahasiswa.tagihan.bayar', $mahasiswa->id) }}"
                                                method="GET">
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
                                                                        type="checkbox" name=""
                                                                        id="select_all_ids" class="me-2"> Pilih
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $no = 1;
                                                            @endphp
                                                            @foreach ($biayas as $index => $value)
                                                                @if ($value->jenis_biaya == 'Routine' && $value->id_angkatans == $biodata->angkatan_id)
                                                                    @foreach ($value->tagihanDetail as $key => $tagihans)
                                                                        @if ($tagihans->id_users == $mahasiswa->id)
                                                                            <tr>
                                                                                <td class="text-sm">
                                                                                    {{ $no++ }}
                                                                                </td>
                                                                                <td class="text-sm">
                                                                                    {{ $value->nama_biaya }}
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
                                                                                        <input type="checkbox"
                                                                                            name="id[]" id=""
                                                                                            value="{{ $tagihans->id }}"
                                                                                            class="" disabled>
                                                                                    @else
                                                                                        <input type="checkbox"
                                                                                            name="id[]" id=""
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
                                        $biayaHead?->id_jurusans == $biodata->jurusan_id &&
                                        $biodata->angkatan_id)
                                    <div class="table-responsive mb-3">
                                        <p class="text-bold">Tagihan Biaya Lain</p>

                                        <form action="{{ route('mahasiswa.tagihan.bayar', $mahasiswa->id) }}"
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
                                                                    type="checkbox" name=""
                                                                    id="select_all_ids2" class="me-2"> Pilih
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $no = 1;
                                                        @endphp
                                                        @foreach ($biayas as $index => $value)
                                                            @if (
                                                                $value->jenis_biaya == 'Tidakroutine' &&
                                                                    $value->id_angkatans == $biodata->angkatan_id &&
                                                                    $value->id_jurusans == $biodata->jurusan_id &&
                                                                    $value->program_belajar == $biodata->program_belajar)
                                                                @foreach ($value->tagihanDetail as $key => $tagihans)
                                                                    @if ($tagihans->id_users == $mahasiswa->id)
                                                                        <tr>
                                                                            <td class="text-sm">
                                                                                {{ $no++ }}
                                                                            </td>

                                                                            <td class="text-sm">
                                                                                {{ $value->nama_biaya }}
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
                                                                                    <input type="checkbox"
                                                                                        name="id[]" id=""
                                                                                        value="{{ $tagihans->id }}"
                                                                                        class="" disabled>
                                                                                @else
                                                                                    <input type="checkbox"
                                                                                        name="id[]" id=""
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
                    </div>
                </div>
        @endif
@endif
@elseif ($transactionDaftar)
@php
    $biaya = App\Models\Biaya::where('program_belajar', 'S1')
        ->where('jenis_biaya', 'DaftarUlang')
        ->where('id_angkatans', Auth::user()->biodata->angkatan_id)
        ->latest()
        ->firstOrFail();

    $user = Auth::user();
    $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)
        ->where('id_users', $user->id)
        ->latest()
        ->firstOrFail();

    // Menghitung total pembayaran yang telah dilakukan
    $total_pembayaran = App\Models\Transaksi::where('user_id', $user->id)
        ->where('tagihan_detail_id', $tagihan->id)
        ->where('jenis_tagihan', $biaya->jenis_biaya)
        ->where('status', 'berhasil')
        ->where('jenis_pembayaran', 'cicil')
        ->sum('total');
    $cicilannya = App\Models\Cicilan::where('id_tagihan_details', $tagihan->id);
    // Hitung setengah dari $jumlah_uang_daftar_ulang
    // $setengah_jumlah_daftar_ulang = ($tagihan->amount * 2) / 3;

    // Hitung sepersepuluh dari $jumlah_uang_daftar_ulang
    // $sepertiganya_jumlah_daftar_ulang = $tagihan->amount / 3;

    // Mengecek apakah mahasiswa telah berhasil membayar cicilan pertama

    // Mengecek apakah mahasiswa telah berhasil membayar cicilan kedua

    // Mengecek apakah mahasiswa telah berhasil membayar cicilan ketiga

    // dd($cicilan_pertama_terbayar, $cicilan_kedua_terbayar, $cicilan_ketiga_terbayar);
@endphp
<div class="col-12 text-center mb-4">
    <div class="card py-3">
        <h2 class="mt-3">Selamat !</h2>
        <h5 class="text-secondary font-weight-normal">Tagihan Daftar Ulang Sudah Lunas</h5>
    </div>
</div>
@php
    $biaya = App\Models\Biaya::where('program_belajar', 'S1')
        ->where('jenis_biaya', 'DaftarUlang')
        ->where('id_angkatans', Auth::user()->biodata->angkatan_id)
        ->latest()
        ->firstOrFail();

    $user = Auth::user();
    $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)
        ->where('id_users', $user->id)
        ->latest()
        ->firstOrFail();
    // $bagi3 = $tagihan->amount / 3;
    // dd($bagi3);
    $transaction = App\Models\Transaksi::where('user_id', $user->id)
        ->where('tagihan_detail_id', $tagihan->id)
        ->where('jenis_tagihan', $biaya->jenis_biaya)
        ->where('status', 'berhasil')
        ->where('jenis_pembayaran', 'cash')
        ->firstOrFail();
@endphp
@if (!$transaction)
@else
    <div class="row">
        @if ($biodata->program_belajar === 'S1')
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text">{{ $error }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div></div>
                            @endforeach
                        @endif
                        <h4>Tagihan Program S1 <span class="text-danger">*</span></h4>
                    </div>
                    <div class="card-body">

                        <!--Routine-->
                        @foreach ($biayaAll as $biayaHead)
                            @if ($biayaHead->jenis_biaya == 'Routine' && $biayaHead->id_angkatans == $biodata->angkatan_id)
                                <p class="text-bold">Tagihan Spp</p>

                                <div class="table-responsive mb-3">
                                    <form action="{{ route('mahasiswa.tagihan.bayar', $mahasiswa->id) }}"
                                        method="GET">
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
                                                        <th class="text-sm d-flex align-items-center">
                                                            <input type="checkbox" name=""
                                                                id="select_all_ids" class="me-2"> Pilih
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($biayas as $index => $value)
                                                        @if ($value->jenis_biaya == 'Routine' && $value->id_angkatans == $biodata->angkatan_id)
                                                            @foreach ($value->tagihanDetail as $key => $tagihans)
                                                                @if ($tagihans->id_users == $mahasiswa->id)
                                                                    <tr>
                                                                        <td class="text-sm">
                                                                            {{ $no++ }}
                                                                        </td>
                                                                        <td class="text-sm">
                                                                            {{ $value->nama_biaya }}
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
                                                                                <input type="checkbox"
                                                                                    name="id[]" id=""
                                                                                    value="{{ $tagihans->id }}"
                                                                                    class="" disabled>
                                                                            @else
                                                                                <input type="checkbox"
                                                                                    name="id[]" id=""
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
                                $biayaHead?->id_jurusans == $biodata->jurusan_id &&
                                $biodata->angkatan_id)
                            <div class="table-responsive mb-3">
                                <p class="text-bold">Tagihan Biaya Lain</p>

                                <form action="{{ route('mahasiswa.tagihan.bayar', $mahasiswa->id) }}"
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
                                                    <th class="text-sm d-flex align-items-center">
                                                        <input type="checkbox" name=""
                                                            id="select_all_ids2" class="me-2"> Pilih
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($biayas as $index => $value)
                                                    @if (
                                                        $value->jenis_biaya == 'Tidakroutine' &&
                                                            $value->id_angkatans == $biodata->angkatan_id &&
                                                            $value->id_jurusans == $biodata->jurusan_id &&
                                                            $value->program_belajar == $biodata->program_belajar)
                                                        @foreach ($value->tagihanDetail as $key => $tagihans)
                                                            @if ($tagihans->id_users == $mahasiswa->id)
                                                                <tr>
                                                                    <td class="text-sm">
                                                                        {{ $no++ }}
                                                                    </td>

                                                                    <td class="text-sm">
                                                                        {{ $value->nama_biaya }}
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
                                                                            <input type="checkbox"
                                                                                name="id[]" id=""
                                                                                value="{{ $tagihans->id }}"
                                                                                class="" disabled>
                                                                        @else
                                                                            <input type="checkbox"
                                                                                name="id[]" id=""
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
            </div>
        </div>
@endif
@endif
@endif



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
