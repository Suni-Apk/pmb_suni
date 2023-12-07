@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Tagihan table</h6>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                        data-bs-target="#modalTagihan">Tambah <i class="fas fa-plus me-1"></i></button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalTagihan" tabindex="-1" role="dialog"
                        aria-labelledby="modalTagihanLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTagihanLabel">Pilih Jenis Tagihan</h5>
                                    <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark"
                                        data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                </div>
                                <form action="{{ route('admin.tagihan.next') }}" method="GET">
                                    <div class="modal-body">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="spp" value="Routine">
                                            <label class="custom-control-label" for="spp">Spp</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="biaya_lain" value="Tidakroutine">
                                            <label class="custom-control-label" for="biaya_lain">Biaya Lain</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="daftar_ulang" value="DaftarUlang">
                                            <label class="custom-control-label" for="daftar_ulang">Daftar Ulang</label>
                                        </div>
                                        {{-- <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="jenis_tagihan"
                                                id="tingkatan" value="Tingkatan">
                                            <label class="custom-control-label" for="tingkatan">Tingkatan</label>
                                        </div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button> --}}
                                        <button class="btn bg-gradient-primary" type="submit">Lanjut <i
                                                class="fas fa-arrow-circle-right ms-1"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="templateTable">
                            <thead>
                                <tr>
                                    <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-8">
                                        Pilih</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">
                                        No</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Nama
                                        Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-8">
                                        Tahun / Angkatan</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Jurusan
                                        / Prodi</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Program
                                        Belajar</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Created
                                        at</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Jenis
                                        tagihan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($biaya as $key => $biayas)
                                    <tr>
                                        <td>
                                            <div>
                                                <input type="checkbox" name="ids" id="" class="checksAll"
                                                    value="{{ $biayas->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h6 class="mb-0 text-sm">{{ $key + 1 }}</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            <div>
                                                <strong>{{ $biayas->nama_biaya }}</strong>
                                            </div>
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            <div>
                                                {{ $biayas->tahunAjaran->year }}
                                            </div>
                                        </td>

                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            <div>
                                                @if ($biayas->jurusans?->name != null && $biayas->program_belajar == 'S1')
                                                    {{ $biayas->jurusans->name }}
                                                @elseif ($biayas->jurusans?->name == null && $biayas->program_belajar == 'KURSUS')
                                                    {{ $biayas->kursus->name }}
                                                @elseif ($biayas->jurusans?->name == null)
                                                    Semua Jurusan
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            <div>
                                                <strong>{{ $biayas->program_belajar }}</strong>
                                            </div>
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            {{ \Carbon\Carbon::parse($biayas->created_at)->format('d/m/Y H:i:s') }}
                                        </td>
                                        <td class="align-middle  text-secondary text-xs font-weight-bold">
                                            <strong>{{ $biayas->jenis_biaya }}</strong>

                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.tagihan.show', $biayas->id) }}"
                                                class="badge text-uppercase badge-sm bg-gradient-info text-xxs mx-1"
                                                data-toggle="tooltip" data-original-title="detail">
                                                Detail
                                            </a>

                                            <a href="{{ route('admin.tagihan.edit', $biayas->id) }}"
                                                class="badge text-uppercase badge-sm bg-gradient-secondary text-xxs mx-1"
                                                data-toggle="tooltip" data-original-title="Edit">
                                                Ubah
                                            </a>
                                            <form action="{{ route('admin.tagihan.destroy', $biayas->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="badge border-0 text-uppercase badge-sm bg-gradient-danger text-xxs mx-1"
                                                    data-toggle="tooltip" data-original-title="hapus" type="submit">
                                                    Hapus
                                                </button>
                                            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil!',
                "{{ session('success') }}", // Menggunakan session('success') untuk mengambil pesan
                'success'
            )
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire(
                'Gagal!',
                "{{ session('error') }}", // Menggunakan session('success') untuk mengambil pesan
                'error'
            )
        </script>
    @endif
    <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if (Session::has('delete'))
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if (Session::has('pesan'))
            toastr.error('{{ Session::get('pesan') }}')
        @endif
    </script>
    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#templateTable", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
    <script>
        function check() {
            // document.getElementByClassName('.checksAll').checked = true;
            var checkbox = document.getElementById("select_all_ids");
            checkbox.checked = !checkbox.checked;
        }
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
                        title: "Apakah Anda Yakin Ingin Menghapus Tagihan?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('admin.tagihan.deletes') }}",
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
                            location.reload();
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
