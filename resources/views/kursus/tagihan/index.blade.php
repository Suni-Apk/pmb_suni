@extends('kursus.layouts.parent')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Pembayaran Tingakatan</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Jenis Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Angkatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm text-center">Easy</h6>
                                        </div>
                                    </td>
                                    <td class="align- text-start">
                                        <span class="text-secondary text-xs font-weight-bold">Tingakatan</span>
                                    </td>
                                    <td class="align- text-start">
                                        <span class="text-secondary text-xs font-weight-bold">2023</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Informatika</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('kursus.tagihan.detail.spp', Auth::user()->name) }}"
                                            class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
<<<<<<< HEAD
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
                                $biayaHead->id_kursus == $biodatas->course_id)
                            <p class="text-bold">Tagihan Biaya lain</p>
                            <div class="table-responsive mb-3">
                                <form action="{{ route('kursus.tagihan.bayar', $mahasiswa->id) }}" method="GET">
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
                                                    <th class="text-sm d-flex align-items-center"><input type="checkbox"
                                                            name="" id="select_all_ids3" class="me-2"> Pilih
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
                                                            $biayas->id_kursus == $biodatas->course_id)
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
                                                                                id="" value="{{ $tagihans->id }}"
                                                                                class="" disabled>
                                                                        @else
                                                                            <input type="checkbox" name="id[]"
                                                                                id="" value="{{ $tagihans->id }}"
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
=======
                </div>
>>>>>>> 070ed8d75ac994a582d7aa489bce10a9a0e8d514
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Pembayaran Tidak Routine</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Jenis Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Angkatan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm text-center">KKN</h6>
                                        </div>
                                    </td>
                                    <td class="align- text-start">
                                        <span class="text-secondary text-xs font-weight-bold">Tidak Routine</span>
                                    </td>
                                    <td class="align- text-start">
                                        <span class="text-secondary text-xs font-weight-bold">2023</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Informatika</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('kursus.tagihan.detail.tidak.routine', Auth::user()->name) }}"
                                            class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @push('scripts')
        <script>
            const dataTableSearch = new simpleDatatables.DataTable("#templateTableNoSearch", {
                searchable: false,
                fixedHeight: true,
            });

            const dataTableBasic = new simpleDatatables.DataTable("#templateTable", {
                searchable: true,
                fixedHeight: true,
            });
        </script>
    @endpush
