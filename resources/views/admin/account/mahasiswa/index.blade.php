@extends('layouts.master')

@section('title', 'Daftar Mahasiswa')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Mahasiswa</h6>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.mahasiswa.exportMahasiswa') }}" method="GET">
                            <input type="hidden" name="angkatan_id" value="{{ $tahunAjaran }}">
                            <button class="btn btn-success ms-2 d-flex align-items-center">
                                <i class='bx bxs-file-export me-1'></i> Export
                            </button>
                        </form>
                        <a href="{{ route('admin.mahasiswa.create') }}" class="btn bg-gradient-primary float-end">Tambah + </a>
                    </div>
                </div>
                <form action="{{ route('admin.mahasiswa.index') }}" method="GET">
                    <div class="d-flex align-items-center justify-content-end">
                        <label for="angkatan_id" class="ms-3">Tahun Ajaran</label>
                        <select name="angkatan_id" id="tahunAjaranSelected" class="form-control w-20 ms-4">
                            <option value="">--SEMUA--</option>
                            @foreach ($tahun_ajaran as $tahun_ajarans)
                                <option value="{{ $tahun_ajarans->id }}">
                                    {{ $tahun_ajarans->year }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mt-xl-3 ms-3 me-3" id="searchButton">Cari</button>
                    </div>
                </form>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pilih</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Telepon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun Ajaran</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender / Role</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                    $mahasiswaData = $tahunAjaran ? $mahasiswa : $mahasiswaAll;
                                @endphp --}}
                                @foreach ($mahasiswa as $index => $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="ids" id="" class="checksAll" value="{{ $item->id }}">
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">{{$item->phone}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">{{$item->email}}</span>
                                    </td>
                                    <td class="text-center text-secondary font-weight-bold">
                                    @if ($item->biodata)
                                    <span class="badge badge-sm rounded-pill bg-gradient-success">
                                        {{ $item->biodata->angkatan->year }}
                                    </span>
                                    @else
                                    <span class="badge badge-sm rounded-pill bg-gradient-danger">
                                        biodata <i class="fas fa-times"></i>
                                    </span>
                                    @endif
                                    </td>
                                    <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$item->gender}}</p>
                                    <p class="text-xs text-uppercase text-secondary mb-0">{{$item->role}}</p>
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status == 'on')
                                        <span class="badge badge-sm bg-gradient-success">AKTIF</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-danger">OFF</span>
                                        @endif
                                    </td>
                                    <td class="text-center"> 
                                        <a style="letter-spacing: .02rem" href="{{ route('admin.mahasiswa.show',$item->id) }}" class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs" data-toggle="tooltip" data-original-title="detail">
                                            Detail
                                        </a>

                                        <a style="letter-spacing: .02rem"
                                            href="{{ route('admin.mahasiswa.edit', $item->id) }}"
                                            class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs mx-1"
                                            data-toggle="tooltip" data-original-title="edit">
                                            Ubah
                                        </a>

                                            <form action="{{ route('admin.mahasiswa.delete', $item->id) }}" class="d-inline"
                                                id="form1" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs border-0"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">Delete</button>
                                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModal{{ $item->id }}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModal{{ $item->id }}Label">
                                                                    Peringatan! <i
                                                                        class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <i class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                                                Apakah Anda Yakin Ingin Menghapus data Mahasiswa?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Ya, Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        <form action="{{ route('admin.mahasiswa.status', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            @if ($item->status == 'on')
                                                <input type="hidden" name="status" value="off">
                                                <button
                                                    class="badge badge-sm bg-gradient-dark font-weight-bolder text-xxs ms-1 border-0"
                                                    type="submit">
                                                    OFF
                                                </button>
                                            @elseif($item->status == 'off')
                                                <input type="hidden" name="status" value="on">
                                                <button
                                                    class="badge badge-sm bg-teal font-weight-bolder text-xxs ms-1 border-0"
                                                    type="submit">
                                                    ON
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
    <script>
        $(function(e) {
            $("#ClikKabeh").click(function() {
                $('.checksAll, #select_all_ids').prop('checked', function() {
                    return !$(this).prop("checked");
                });
            });
            $("#select_all_ids").click(function() {
                $('.checksAll').prop('checked', $(this).prop('checked'));
            });
            $("#All").click(function() {
                $('#deleteAll').click();
            });

            $("#deleteAll").click(function(e) {
                e.preventDefault();
                var all_ids = [];

                $('input:checkbox[name="ids"]:checked').each(function() {
                    all_ids.push($(this).val());
                });
                if ($('.checksAll').is(':checked')) {
                    Swal.fire({
                        title: "Apakah Anda Yakin Ingin Menghapus data mahasiswa?",
                        text: "Kamu tidak bisa mengembalikan perubahan ini!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('admin.mahasiswa.delete.all') }}",
                                type: "DELETE",
                                data: {
                                    ids: all_ids
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(response) {
                                    // Handle response jika diperlukan
                                    // Misalnya, menampilkan pesan sukses
                                    // Lakukan reload halaman setelah permintaan AJAX selesai

                                },
                                error: function(xhr, status, error) {
                                    // Handle error jika diperlukan

                                }
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then((result) => {});
                        }
                    });
                }
                if (!$('.checksAll').is(':checked')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pilih Minimal 1!',
                    })
                }

            });
        });
    </script>
@endpush
