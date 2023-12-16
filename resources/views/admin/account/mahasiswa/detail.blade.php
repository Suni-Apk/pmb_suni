@extends('layouts.master')

@section('title', 'Detail Mahasiswa')

@section('content')
    <div class="row">
        @if (!isset($mahasiswa->biodata) == true)
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Detail Mahasiswa <span class="text-danger">*</span></h4>
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
                                            <td class="text-sm">
                                                Nama :
                                                <strong> {{ $mahasiswa->name }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">
                                                Nomor Telepon :
                                                <strong>
                                                    {{ $mahasiswa->phone }}
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">
                                                Email :
                                                <strong>
                                                    {{ $mahasiswa->email }}
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm">
                                                Gender :
                                                <strong>
                                                    {{ $mahasiswa->gender }}
                                                </strong>
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
                            <h4>Detail Mahasiswa <span class="text-danger">*</span></h4>
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
                        </div>
                    </div>
                    @php
                        $transactionDaftar = App\Models\Transaksi::where('user_id', $biodatas->user_id)
                            ->where('jenis_tagihan', 'DaftarUlang')
                            ->where('status', 'berhasil')
                            ->where('jenis_pembayaran', 'cash')
                            ->first();
                        $biaya1 = App\Models\Biaya::where('program_belajar', 'S1')
                            ->where('jenis_biaya', 'DaftarUlang')
                            ->where('id_angkatans', $biodatas->angkatan_id)
                            ->latest()
                            ->first();

                        $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya1?->id)
                            ->where('id_users', $biodatas->user_id)
                            ->latest()
                            ->first();
                        $cicilans = App\Models\Cicilan::where('id_tagihan_details', $tagihan?->id)->first();
                        $cicilan2 = App\Models\Cicilan::where('id_tagihan_details', $tagihan?->id)
                            ->where('status', 'LUNAS')
                            ->get();
                        $transactions = App\Models\Transaksi::where('user_id', $biodatas->user_id)
                            ->where('tagihan_detail_id', $tagihan?->id)
                            ->where('jenis_tagihan', $biaya1?->jenis_biaya)
                            ->where('status', 'berhasil')
                            ->first();

                    @endphp
                    @if (!isset($cicilans) && !isset($transactionDaftar) && $tagihan)
                        <div class="col-12 text-center mb-4 shadow-ms">
                            <div class="card">
                                <h3 class="mt-3">Silahkan Pilih metode pembayaran Daftar ulang !</h3>
                                {{-- <h5 class="text-secondary font-weight-normal">Daftar Ulang Langsung !</h5> --}}
                                <div class="row mt-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <form action="{{ route('admin.mahasiswa.daftar-ulang', $biodatas->user->id) }}"
                                            method="POST" class="d-flex align-items-center justify-content-center w-100">
                                            @csrf
                                            @method('GET')
                                            <div class="mx-4">
                                                <button name="jenis_pembayaran" value="cash" type="submit"
                                                    class="btn bg-gradient-primary sm:w-50">
                                                    Cash
                                                </button>
                                            </div>
                                            <div class="mx-4">
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
                    @elseif (!isset($tagihan))

                    @elseif($cicilans)
                        @php
                            $biaya1 = App\Models\Biaya::where('program_belajar', 'S1')
                                ->where('jenis_biaya', 'DaftarUlang')
                                ->where('id_angkatans', $biodatas->angkatan_id)
                                ->latest()
                                ->first();

                            $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya1->id)
                                ->where('id_users', $biodatas->user_id)
                                ->latest()
                                ->first();

                            // Menghitung total pembayaran yang telah dilakukan
                            $total_pembayaran = App\Models\Transaksi::where('user_id', $biodatas->user_id)
                                ->where('tagihan_detail_id', $tagihan?->id)
                                ->where('jenis_tagihan', $biaya1?->jenis_biaya)
                                ->where('status', 'berhasil')
                                ->where('jenis_pembayaran', 'cicil')
                                ->sum('total');
                            $cicilannya = App\Models\Cicilan::where('id_tagihan_details', $tagihan?->id)->get();
                            $cicilan1 = App\Models\Cicilan::where('id_tagihan_details', $tagihan?->id)
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
                                @if ($biodatas->program_belajar === 'S1')
                                    <div class="col-12">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                @if ($errors->any())
                                                    @foreach ($errors->all() as $error)
                                                        <div class="alert alert-danger alert-dismissible fade show"
                                                            role="alert">
                                                            <span class="alert-text">{{ $error }}</span>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div></div>
                                                    @endforeach
                                                @endif
                                                <h4>Tagihan cicilan daftar ulang <span class="text-danger">*</span></h4>
                                            </div>
                                            <div class="card-body">

                                                <!--Routine-->
                                                @foreach ($biayaAll as $biayaHead)
                                                    @if ($biayaHead->jenis_biaya == 'DaftarUlang' && $biayaHead->id_angkatans == $biodatas->angkatan_id)
                                                        <div class="table-responsive mb-3">
                                                            <form
                                                                action="{{ route('admin.transactions.cicilan', $biodatas->user->id) }}"
                                                                method="GET">
                                                                @csrf
                                                                @method('GET')

                                                                <table class="table shadow-sm">
                                                                    <thead class="table-dark">
                                                                        <tr>
                                                                            <th class="text-sm">No</th>
                                                                            <th class="text-sm">Nama Tagihan
                                                                            </th>
                                                                            <th class="text-sm">Batas Tagihan
                                                                            </th>
                                                                            <th class="text-sm">Status</th>
                                                                            <th class="text-sm">Total tagihan
                                                                            </th>
                                                                            <th class="text-sm d-flex align-items-center">
                                                                                Pilih
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $no = 1;
                                                                        @endphp
                                                                        @foreach ($cicilannya as $key => $value)
                                                                            @if ($value->id_tagihan_details == $tagihan->id)
                                                                                <tr>
                                                                                    <td class="text-sm">
                                                                                        {{ $key + 1 }}
                                                                                    </td>
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
                                                                                        {{ number_format($value->harga, 0, '', '.') }}
                                                                                    </td>
                                                                                    <td>

                                                                                        @if ($key == 0)
                                                                                            <input type="radio"
                                                                                                name="id[]"
                                                                                                id=""
                                                                                                value="{{ $value->id }}"
                                                                                                class=""
                                                                                                {{ $key == 0 && $value->status == 'LUNAS' ? 'disabled' : '' }}>
                                                                                        @endif

                                                                                        @if ($key > 0)
                                                                                            @php
                                                                                                $previousStatus = $cicilannya[$key - 1]['status'];
                                                                                            @endphp

                                                                                            @if ($previousStatus != 'LUNAS')
                                                                                                <input type="radio"
                                                                                                    name="id[]"
                                                                                                    id=""
                                                                                                    value="{{ $value->id }}"
                                                                                                    class="" disabled>
                                                                                            @else
                                                                                                <input type="radio"
                                                                                                    name="id[]"
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
                                                                <button class="btn btn-primary btn-sm"
                                                                    type="submit">Bayar</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                @endif
                            </div>
                        @else
                            {{-- <div class="col-12 text-center mb-4">
                                <div class="card py-3">
                                    <h2 class="mt-3">Selamat !</h2>
                                    <h5 class="text-secondary font-weight-normal">Tagihan Daftar Ulang Cicil Sudah Lunas
                                    </h5>
                                </div>
                            </div> --}}
                        @endif

                        @if (!$cicilan1)
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        <span class="alert-text">{{ $error }}</span>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <h4>Tagihan Program S1 <span class="text-danger">*</span></h4>
                                        </div>
                                        <div class="card-body">
                                            <!--Routine-->
                                            @foreach ($biayaAll as $biayaHead)
                                                @if ($biayaHead->jenis_biaya == 'Routine' && $biayaHead->id_angkatans == $biodatas->angkatan_id)
                                                    <p class="text-bold">Tagihan Spp</p>
                                                    <div class="table-responsive mb-3">
                                                        <form
                                                            action="{{ route('admin.mahasiswa.bayar', $mahasiswa->id) }}"
                                                            method="GET">
                                                            @csrf
                                                            @method('GET')
                                                            <table class="table shadow-sm">
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
                                                                                id="select_all_ids" class="me-2">
                                                                            Pilih
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
                                                                                        <td class="text-sm">
                                                                                            {{ $no++ }}
                                                                                        </td>
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
                                                                                                <input type="checkbox"
                                                                                                    name="id[]"
                                                                                                    id=""
                                                                                                    value="{{ $tagihans->id }}"
                                                                                                    class=""
                                                                                                    disabled>
                                                                                            @else
                                                                                                <input type="checkbox"
                                                                                                    name="id[]"
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
                                                            <button class="btn btn-primary btn-sm"
                                                                type="submit">Bayar</button>
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
                                                    $biodatas->angkatan_id == $biayaHead?->id_angkatans)
                                                <div class="table-responsive mb-3">
                                                    <p class="text-bold">Tagihan Biaya Lain</p>
                                                    <form
                                                        action="{{ route('admin.mahasiswa.bayar', $mahasiswa->id) }}"
                                                        method="GET">
                                                        @csrf
                                                        @method('GET')
                                                        <table class="table shadow-sm">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th class="text-sm">No</th>
                                                                    <th class="text-sm">Nama Tagihan</th>
                                                                    <th class="text-sm">Tanggal Tagihan</th>
                                                                    <th class="text-sm">Status</th>
                                                                    <th class="text-sm">Total tagihan</th>
                                                                    <th class="text-sm d-flex align-items-center">
                                                                        <input type="checkbox" name=""
                                                                            id="select_all_ids2" class="me-2">
                                                                        Pilih
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
                                                                                    <td class="text-sm">
                                                                                        {{ $no++ }}
                                                                                    </td>

                                                                                    <td class="text-sm">
                                                                                        {{ $biayas->nama_biaya }}
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
                                                                                                name="id[]"
                                                                                                id=""
                                                                                                value="{{ $tagihans->id }}"
                                                                                                class=""
                                                                                                disabled>
                                                                                        @else
                                                                                            <input type="checkbox"
                                                                                                name="id[]"
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
                                                        <button class="btn btn-primary btn-sm"
                                                            type="submit">Bayar</button>
                                                    </form>
                                                </div>
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                @endif
            @elseif ($transactionDaftar)
                {{-- <div class="col-12 text-center mb-4">
                    <div class="card py-3">
                        <h2 class="mt-3">Selamat !</h2>
                        <h5 class="text-secondary font-weight-normal">Tagihan Daftar Ulang Sudah Lunas</h5>
                    </div>
                </div> --}}

            @endif
            @if (!isset($transactions))
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show"
                                            role="alert">
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
                                    @if ($biayaHead->jenis_biaya == 'Routine' && $biayaHead->id_angkatans == $biodatas->angkatan_id)
                                        <p class="text-bold">Tagihan Spp</p>

                                        <div class="table-responsive mb-3">
                                            <form action="{{ route('admin.mahasiswa.bayar', $mahasiswa->id) }}"
                                                method="GET">
                                                @csrf
                                                @method('GET')

                                                <table class="table shadow-sm">
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
                                                                    id="select_all_ids" class="me-2">
                                                                Pilih
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
                                                                            <td class="text-sm">
                                                                                {{ $no++ }}
                                                                            </td>
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
                                                                                    <input type="checkbox"
                                                                                        name="id[]"
                                                                                        id=""
                                                                                        value="{{ $tagihans->id }}"
                                                                                        class="" disabled>
                                                                                @else
                                                                                    <input type="checkbox"
                                                                                        name="id[]"
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
                                        <form action="{{ route('admin.mahasiswa.bayar', $mahasiswa->id) }}"
                                            method="GET">
                                            @csrf
                                            @method('GET')

                                            <table class="table shadow-sm">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th class="text-sm">No</th>
                                                        <th class="text-sm">Nama Tagihan</th>
                                                        <th class="text-sm">Tanggal Tagihan</th>
                                                        <th class="text-sm">Status</th>
                                                        <th class="text-sm">Total tagihan</th>
                                                        <th class="text-sm d-flex align-items-center">
                                                            <input type="checkbox" name=""
                                                                id="select_all_ids2" class="me-2">
                                                            Pilih
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
                                                                        <td class="text-sm">
                                                                            {{ $no++ }}
                                                                        </td>

                                                                        <td class="text-sm">
                                                                            {{ $biayas->nama_biaya }}
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
                                                                                    name="id[]"
                                                                                    id=""
                                                                                    value="{{ $tagihans->id }}"
                                                                                    class="" disabled>
                                                                            @else
                                                                                <input type="checkbox"
                                                                                    name="id[]"
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

                                            <button class="btn btn-primary btn-sm"
                                                type="submit">Bayar</button>
                                        </form>
                                    </div>
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

@endif
@if ($biodatas->program_belajar == 'KURSUS')
<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <h4>Tagihan Program Kursus {{ $biodatas->course->name }} <span class="text-danger">*</span>
            </h4>
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
                            <tr>
                                <td class="text-sm">
                                    Jenis kursus :
                                    <strong>{{ $biodatas->course->name }}</strong>
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
                        $biayaHead?->program_belajar == $biodatas->program_belajar &&
                        $biayaHead?->id_kursus == $biodatas->course_id)
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
                                            <th class="text-sm">Jenis kursus</th>
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
                                            @if (
                                                $biayas->jenis_biaya == 'Tidakroutine' &&
                                                    $biayas->id_angkatans == $biodatas->angkatan_id &&
                                                    $biayas->program_belajar == $biodatas->program_belajar &&
                                                    $biayas?->id_kursus == $biodatas->course_id)
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
                                                            <td class="text-sm">
                                                                {{ $biayas->kursus->name }}
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
    </div>
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
        $("#select_all_ids0").click(function() {
            $('.checksAll0').prop('checked', $(this).prop('checked'));
        });
        $("#select_all_ids1").click(function() {
            $('.checksAll1').prop('checked', $(this).prop('checked'));
        });
        $("#select_all_ids2").click(function() {
            $('.checksAll2').prop('checked', $(this).prop('checked'));
        });
    });
</script>
@endpush
