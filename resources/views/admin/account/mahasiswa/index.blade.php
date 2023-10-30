@extends('layouts.master')

@section('title', 'Create Account Mahasiswa')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Mahasiswa table</h6>
                    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary float-end">Tambah + </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Nomor Telepon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gender / Admin</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswa as $index => $item)
                                    <tr class="text-center">
                                        <td>
                                            <div class="align- text-center">
                                                <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                            </div>
                                        </td>
                                        <td class="align- text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->phone }}</span>
                                        </td>
                                        <td class="align- text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->email }}</span>
                                        </td>
                                        <td class="align- text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->gender }}</span>
                                        </td>
                                        <td class="align- text-center">
                                            <p class="text-xs text-secondary mb-0">{{ $item->role }}</p>
                                        </td>
                                        <td class="align- text-center">
                                            @if ($item->status == 'on')
                                                <span class="badge badge-sm bg-gradient-success">AKTIF</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">OFF</span>
                                            @endif
                                        </td>
                                        <td class="align- text-center">
                                            <a href="{{ route('admin.mahasiswa.show', $item->id) }}"
                                                class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Detail
                                            </a>

                                            <a href="{{ route('admin.mahasiswa.edit', $item->id) }}"
                                                class="badge badge-sm bg-gradient-success font-weight-bold text-xs mx-2"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Ubah
                                            </a>

                                            <form action="{{ route('admin.mahasiswa.status', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                @if ($item->status == 'on')
                                                    <button name="status" value="off"
                                                        class="badge badge-sm bg-gradient-danger font-weight-bold text-xs mx-2  border-0"
                                                        type="submit">
                                                        OFF
                                                    </button>
                                                @elseif($item->status == 'off')
                                                    <button name="status" value="on"
                                                        class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2  border-0"
                                                        type="submit">
                                                        ON
                                                    </button>
                                                @endif
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
@endpush
