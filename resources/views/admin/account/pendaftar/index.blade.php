@extends('layouts.master')

@section('title', 'Daftar Pendaftar')

@push('styles')
@endpush

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header pb-0 d-flex justify-content-between">
            <h6>Daftar Pendaftar</h6>
            <a href="{{route('admin.mahasiswa.create')}}" class="btn bg-gradient-primary float-end">Tambah + </a>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="table">
                <thead>
                  <tr class="text-center">
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pilih</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama / Nomor Telepon</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender / Role</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Biodata</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Dokumen</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Administrasi</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pra-Kuliah</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Bergabung pada</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($mahasiswa as $index => $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="ids" id="" class="checksAll"
                                value="{{ $item->id }}">
                        </td>
                        <td>
                          <style>
                            .wa-hover:hover {
                              color: #434c5a!important;
                              transition: .2s ease;
                            }
                          </style>
                          <p class="text-xs font-weight-bold text-dark mb-0">{{$item->name}}</p>
                          <a class="text-secondary text-xs d-block wa-hover"
                          href="https://api.whatsapp.com/send?phone={{ $item->phone }}&text=Hai!%20Kami%20dari%20{{ App\Models\General::first()->name }}">{{$item->phone}}</a>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{$item->gender}}</p>
                          <p class="text-xs text-uppercase text-secondary mb-0">{{$item->role}}</p>
                        </td>
                        {{-- status biodata --}}
                        <td class="text-secondary text-xs font-weight-bold">
                            @if ($item->biodata)
                            <span class="badge rounded-pill bg-gradient-success">Lengkap <i class="fas fa-plus ms-1"></i></span> 
                            @else
                            <span class="badge rounded-pill bg-gradient-danger">Tidak Ada <i class="fas fa-times ms-1"></i></span> 
                            @endif
                        </td>
                        {{-- status dokumen --}}
                        <td class="text-secondary text-xs font-weight-bold">
                            @if ($item->document)
                            <span class="badge rounded-pill bg-gradient-success">Lengkap <i class="fas fa-plus ms-1"></i></span> 
                            @else
                            <span class="badge rounded-pill bg-gradient-danger">Tidak Ada <i class="fas fa-times ms-1"></i></span> 
                            @endif
                        </td>
                        {{-- status administrasi --}}
                        <td class="text-secondary text-xs font-weight-bold">
                            @if ($item->biodata)
                            <span class="badge rounded-pill bg-gradient-success">Lunas <i class="fas fa-plus ms-1"></i></span> 
                            @else
                            <span class="badge rounded-pill bg-gradient-danger">Belum dibayar <i class="fas fa-times ms-1"></i></span> 
                            @endif
                        </td>
                        {{-- status pra-kuliah / daftar ulang --}}
                        <td class="text-secondary text-xs font-weight-bold">
                            @if ($item->biodata)
                              @if ($item->biodata->address) {{-- kalau udah selesai --}}
                                <span class="badge rounded-pill bg-gradient-success">Lunas <i class="fas fa-plus ms-1"></i></span>
                              @elseif ($item->biodata->angkatan) {{-- kalau masih nyicil --}}
                                <span class="badge rounded-pill bg-gradient-warning">Cicil <i class="fas fa-circle ms-1"></i></span>
                              @endif
                            @else {{-- kalau belum blas --}}
                            <span class="badge rounded-pill bg-gradient-danger">Belum dibayar <i class="fas fa-times ms-1"></i></span>
                            @endif
                        </td>
                        <td>
                          <p class="text-xs text-uppercase text-secondary font-weight-bold mb-0">{{$item->created_at->format('d M Y')}}</p>
                          <p class="text-xxs text-uppercase text-secondary mb-0">{{$item->created_at->format('H:i:s')}}</p>
                        </td>
                        <td class="text-center"> 
                            <a style="letter-spacing: .02rem" href="{{ route('admin.mahasiswa.show',$item->id) }}" class="badge badge-sm bg-gradient-info font-weight-bolder text-xxs" data-toggle="tooltip" data-original-title="detail">
                                Detail
                            </a>

                            <a style="letter-spacing: .02rem" href="{{route('admin.mahasiswa.edit',$item->id)}}" class="badge badge-sm bg-gradient-secondary font-weight-bolder text-xxs mx-1" data-toggle="tooltip" data-original-title="edit">
                                Ubah
                            </a>

                            <form action="{{route('admin.mahasiswa.delete',$item->id)}}" class="d-inline" id="form1" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="badge badge-sm bg-gradient-danger font-weight-bolder text-xxs border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>

                              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Warning!!!! <i class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                      </h1>
                                      <button type="button" class="btn-close border rounded-circle p-1 fs-3 lh-1 text-dark" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                      <i class="fas fa-exclamation-circle fa-xl text-danger"></i>
                                      Apakah anda yakin ingin menghapus data pendaftar?
                                    </div>
                                    <div class="modal-footer">
                                      {{-- <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button> --}}
                                      <button type="submit" class="btn bg-gradient-primary">Lanjut</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                        </td>
                    </tr>
                  @empty
                      
                  @endforelse
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
