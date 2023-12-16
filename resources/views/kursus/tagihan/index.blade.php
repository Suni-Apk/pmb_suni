@extends('kursus.layouts.parent')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
    @foreach ($biodata as $keyss => $biodatas)
        @if ($biodatas->program_belajar == 'KURSUS')
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Tagihan Program Kursus {{ $biodatas->course->name }}<span class="text-danger">*</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-4 shadow-sm">
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
                                            Kursus :
                                            <strong>{{ $biodatas->course?->name }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                                    $biayaHead->id_kursus == $biodatas->course_id)
                                <p class="text-bold">Tagihan Biaya lain</p>
                                <div class="table-responsive mb-3">
                                    <form action="{{ route('kursus.tagihan.bayar', $mahasiswa->id) }}" method="GET">
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
