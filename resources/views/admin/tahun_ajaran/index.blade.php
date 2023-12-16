@extends('layouts.master')

@section('title', 'Tahun Ajaran')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Tahun Ajaran</h6>
                    <a href="{{route('admin.tahun-ajaran.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Pilih
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        angkatan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                        Mulai
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                        Selesai
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7 text-center">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tahun_ajaran as $index => $angkatans)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <input type="checkbox" name="ids" id="" class="checksAll"
                                                value="{{ $angkatans->id }}">
                                        </td>
                                        <td class="align-middle text-start text-sm">
                                            <span class="text-bold">{{ $angkatans->year }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-bold">{{ \Carbon\Carbon::parse($angkatans->start_at)->format('d F') }}</span>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="text-bold">{{ \Carbon\Carbon::parse($angkatans->end_at)->format('d F') }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($angkatans->status == 'nonActive')
                                                <span
                                                    class="text-uppercase badge badge-sm bg-gradient-danger">{{ $angkatans->status }}</span>
                                            @else
                                                <span
                                                    class="text-uppercase badge badge-sm bg-gradient-success">{{ $angkatans->status }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <button type="button" class="badge badge-sm border-0 bg-gradient-info"
                                                data-bs-toggle="modal" data-bs-target="#modalLink{{ $angkatans->id }}">Link
                                                <i class="fas fa-link ms-1"></i></button>

                                        <a href="{{ route('admin.tahun-ajaran.detail', $angkatans->id) }}" class="badge badge-sm bg-gradient-secondary text-xxs font-weight-bolder ms-1">Detail</a>
                                        
                                        <form action="{{ route('admin.tahun-ajaran.destroy',$angkatans->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="letter-spacing: .02rem"
                                                class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs show_confirm border-0 mx-1" data-toggle="tooltip" data-original-title="Hapus">
                                                Hapus
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.tahun-ajaran.active',$angkatans->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @if($angkatans->status == 'nonActive')
                                                <button type="submit" class="badge border-0 badge-sm bg-gradient-success font-weight-bold text-xxs">
                                                    <strong>On</strong>
                                                </button>
                                            @else
                                                <button type="submit" class="badge border-0 badge-sm bg-gradient-dark font-weight-bold text-xxs">
                                                    <strong>Off</strong>
                                                </button>
                                            @endif
                                        </form>
                                        
                                        {{-- modal --}}
                                        <div class="modal fade text-start" id="modalLink{{ $angkatans->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modalLinkLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLinkLabel">Tambah Link</h5>
                                                        <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <form action="{{ route('admin.link.create.process') }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label for="name">Nama</label>
                                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama linknya Disini" value="{{ old('name') }}">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="url">URL Link</label>
                                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                                <input type="url" name="url" id="url" class="form-control" placeholder="Masukkan URL linknya Disini" {{ old('url') }}>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label>Tipe Link</label>
                                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                                <div class="form-check">
                                                                    <input type="radio" name="type" id="Whatsapp" class="form-check-input" value="whatsapp">
                                                                    <label class="form-check-label" for="Whatsapp">Whatsapp</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="radio" name="type" id="Zoom" class="form-check-input" value="zoom">
                                                                    <label class="form-check-label" for="Zoom">Zoom</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label>Gender</label>
                                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="gender" id="ikhwan"
                                                                        value="ikhwan">
                                                                    <label class="form-check-label" for="ikhwan">
                                                                        Ikhwan
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="gender" id="akhwat"
                                                                        value="akhwat">
                                                                    <label class="form-check-label" for="akhwat">
                                                                        Akhwat
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="gender" id="all"
                                                                        value="all">
                                                                    <label class="form-check-label" for="all">
                                                                        Semua (ditujukan untuk seluruh mahasiswa)
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <label for="id_tahun_ajarans">Tahun Ajaran</label>
                                                                <small class="text-danger" style="font-size: 12px">*</small>
                                                                <select name="id_tahun_ajarans" id="id_tahun_ajarans" class="form-select" required>
                                                                    <option disabled selected>-----------</option>
                                                                    @foreach ($tahun_ajaran as $item)
                                                                        <option value="{{ $item->id }}" {{ $angkatans->id == $item->id ? 'selected' : '' }}>{{ $item->year }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn bg-gradient-primary" type="submit">
                                                                Submit <i class="fas fa-arrow-circle-right ms-1"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex ms-4 mb-4 mt-3">
                        <input type="checkbox" id="select_all_ids" class="chek me-2">
                        <a href="#" id="ClikKabeh" class="text-secondary">Pilih Semua</a>
                        <div class=" ms-4">
                            <i class="fas fa-trash me-1 cursor-pointer" style="color: #ff0000;" id="deleteAll"></i>
                            <a href="#" class="text-secondary" id="All">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}')
        @endif

        @if (Session::has('delete'))
            toastr.success('{{ Session::get('success') }}')
        @endif

        @if (Session::has('pesan'))
            toastr.error('{{ Session::get('pesan') }}')
        @endif
    </script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Yakin?',
                text: "Kamu Akan Menghapus Tahun Ajaran!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya,  Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Terhapus!',
                        'Kamu telah menghapus Tahun Ajaran!!.',
                        'success'
                    )
                }
            });
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
                        title: "Apakah Anda Yakin Ingin Menghapus Tahun Ajaran?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('admin.tahun-ajaran.delete.all') }}",
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
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
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
