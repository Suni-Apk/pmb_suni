@extends('layouts.master')

@section('title', 'Komponen')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h5 class="text-bold">Banner Welcome</h5>
                    <a href="{{ route('admin.settings.banner.create') }}" class="btn bg-gradient-primary">Tambah +</a>
                </div>
                <hr class="horizontal dark m-0">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table" id="welcome">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Preview</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Uploaded By / Created At</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">ACtion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banner->where('type', 'WELCOME') as $item)   
                                <tr>
                                    <td class="">
                                        <img src="{{ $item->image }}" height="120" width="auto">
                                    </td>
                                    <td class="">
                                        <p class="font-weight-bolder text-sm">{{ $item->title }}</p>
                                    </td>
                                    <td class="">
                                        <p class="font-weight-bold text-sm mb-0">{{ $item->user->name }}</p>
                                        <p class="font-weight-bold text-uppercase text-secondary text-xs mb-0">{{ $item->created_at }}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.settings.banner.edit', $item->id) }}" class="badge badge-sm font-weight-bolder text-xxs bg-gradient-secondary">Edit</a>

                                        <form action="{{ route('admin.settings.banner.delete', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-sm font-weight-bolder text-xxs bg-gradient-danger border-0 ms-1">Hapus</button>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h5 class="text-bold">Banner Dashboard</h5>
                    <a href="{{ route('admin.settings.banner.create') }}" class="btn bg-gradient-primary">Tambah +</a>
                </div>
                <hr class="horizontal dark m-0">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table" id="dashboard">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Preview</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Message</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Target</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Uploaded By / Created At</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">ACtion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banner->where('type', 'DASHBOARD') as $item)    
                                <tr>
                                    <td class="">
                                        <img src="{{ $item->image }}" height="120" width="auto">
                                    </td>
                                    <td class="">
                                        <p class="font-weight-bolder text-sm">{{ $item->title }}</p>
                                    </td>
                                    <td class="">
                                        <p class="font-weight-normal text-wrap text-sm text-truncate" style="max-height: 90px">
                                            {{ $item->desc }}
                                        </p>
                                    </td>
                                    <td class="">
                                        <span class="badge badge-sm bg-gradient-info rounded-pill">{{ $item->target }}</span>
                                    </td>
                                    <td class="">
                                        <p class="font-weight-bold text-sm mb-0">{{ $item->user->name }}</p>
                                        <p class="font-weight-bold text-uppercase text-secondary text-xs mb-0">{{ $item->created_at }}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.settings.banner.edit', $item->id) }}" class="badge badge-sm font-weight-bolder text-xxs bg-gradient-secondary">Edit</a>

                                        <form action="{{ route('admin.settings.banner.delete', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-sm font-weight-bolder text-xxs bg-gradient-danger border-0 ms-1">Hapus</button>
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
@endsection

@push('scripts')
    <script>
        const tableWelcome = new simpleDatatables.DataTable("#welcome", {
        searchable: true,
        fixedHeight: true,
        });

        const indexColumnWelcome = 0;
        const welcomeTh = document.querySelectorAll("#welcome thead th");
        const welcomeAnchor = welcomeTh[indexColumnWelcome].querySelector('a');
        
        if (welcomeAnchor) {
            welcomeAnchor.removeAttribute('data-sortable');
            welcomeAnchor.classList.remove('dataTable-sorter');
        }

        const tableDashboard = new simpleDatatables.DataTable("#dashboard", {
        searchable: true,
        fixedHeight: true,
        });

        const indexColumnDb = 0;
        const dashboardTh = document.querySelectorAll("#dashboard thead th");
        const dashboardAnchor = dashboardTh[indexColumnDb].querySelector('a');
        
        if (dashboardAnchor) {
            dashboardAnchor.removeAttribute('data-sortable');
            dashboardAnchor.classList.remove('dataTable-sorter');
        }
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script type="text/javascript">
        ClassicEditor
            .create( document.getElementById( 's1' ), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.settings.upload.file').'?_token='.csrf_token() }}",
                }
            })
            .then( editor => {
                console.log(editor);
            })
            .catch( error => {
                console.log(error);
            });

        ClassicEditor
            .create( document.getElementById( 'kursus' ), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.settings.upload.file').'?_token='.csrf_token() }}",
                }
            })
            .then( editor => {
                console.log(editor);
            })
            .catch( error => {
                console.log(error);
            })
    </script>
@endpush