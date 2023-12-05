@extends('layouts.master')

@section('title', 'Detail Kursus')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h5>Detail Kursus</h5>
                    <a href="{{ route('admin.course.index') }}" class="btn bg-gradient-secondary">Back</a>
                </div>
                <div class="card-body pt-0 row">
                    <div class="table-responsive col-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-sm" style="width: 130px; max-width: 200px;">Nama Kursus</td>
                                    <td class="font-weight-bold">{{ $course->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm" style="width: 130px; max-width: 200px;">Notes</td>
                                    <td class="font-weight-normal text-sm">
                                        @forelse ($course->notes as $item)
                                        <li>{{ $item }}</li>
                                        @empty
                                        <span class="fw-light">~ tidak ada catatan ~</span>
                                        @endforelse
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm" style="width: 130px; max-width: 200px;">Tanggal Dibuat</td>
                                    <td class="font-weight-bold text-sm">
                                        {{ $course->created_at->format('d F Y') }} - <span class="fw-normal">{{ $course->created_at->format('H:i:s') }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm" style="width: 130px; max-width: 200px;">Deskripsi</td>
                                    <td class="font-weight-normal text-sm">
                                        @if ($course->descProgram)
                                        {!! $course->descProgram->desc !!}
                                        @else
                                        <span class="fw-light">~ tidak ada deskripsi ~</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive col-12 pt-3">
                        <h6>Daftar Mata Pelajaran Kursus</h6>
                        <table class="table">
                            <thead>
                                <tr class="bg-gradient-primary text-white">
                                    <th class="font-weight-bolder text-xxs opacity-9 text-uppercase py-2">Nama</th>
                                    <th class="font-weight-bolder text-xxs opacity-9 text-uppercase py-2">Dosen</th>
                                    <th class="font-weight-bolder text-xxs opacity-9 text-center text-uppercase py-2">Waktu</th>
                                    <th class="font-weight-bolder text-xxs opacity-9 text-center text-uppercase py-2">Hari</th>
                                    <th class="font-weight-bolder text-xxs opacity-9 text-center text-uppercase py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mapels as $item)
                                <tr>
                                    <td class="text-sm">
                                        {{ $item->name }}
                                    </td>
                                    <td class="text-sm">
                                        {{ $item->guru }}
                                    </td>
                                    <td class="text-sm text-center">
                                        {{ $item->mulai }} - {{ $item->selesai }}
                                    </td>
                                    <td class="text-sm text-center">
                                        {{ $item->hari }}
                                    </td>
                                    <td class="text-sm text-center">
                                        <a href="{{ route('admin.mapel.show', $item->id) }}" class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-sm oblique">~ tidak ada data mapel ~</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive col-12 pt-3">
                        <h6>Daftar Link Kursus</h6>
                        <table class="table">
                            <thead>
                                <tr class="bg-gradient-primary text-white">
                                    <th class="font-weight-bolder text-xxs opacity-9 text-uppercase py-2">Nama</th>
                                    <th class="font-weight-bolder text-xxs opacity-9 text-uppercase py-2">Url</th>
                                    <th class="font-weight-bolder text-xxs opacity-9 text-center text-uppercase py-2">Tipe</th>
                                    <th class="font-weight-bolder text-xxs opacity-9 text-center text-uppercase py-2">Gender</th>
                                    <th class="font-weight-bolder text-xxs opacity-9 text-center text-uppercase py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($links as $item)
                                <tr>
                                    <td class="text-sm">
                                        {{ $item->name }}
                                    </td>
                                    <td class="text-sm">
                                        {{ $item->url }}
                                    </td>
                                    <td class="text-sm text-center">
                                        {{ $item->type }}
                                    </td>
                                    <td class="text-sm text-center">
                                        <span class="badge badge-sm rounded-pill bg-gradient-dark text-xxs">
                                        @if ($item->gender == 'all')
                                        semua
                                        @else
                                        {{ $item->gender }}
                                        @endif
                                        </span>
                                    </td>
                                    <td class="text-sm text-center">
                                        <a href="{{ route('admin.link.detail', $item->id) }}" class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-sm oblique">~ tidak ada data link ~</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection