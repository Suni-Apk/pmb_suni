@extends('layouts.master')

@section('title', 'Detail Admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Detail Admin</h5>
                </div>
                <hr class="horizontal dark ">
                <div class="card-body">
                    <div class="row gx-4 mb-4">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <img src="/assets/img/no-profile.png" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    {{ $data->name }}
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    {{ $data->role }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                Name:</strong>
                            &nbsp; {{ $data->name }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No Telepon :</strong>
                            &nbsp;
                            {{ $data->phone }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email :</strong>
                            &nbsp;
                            {{ $data->email }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender :</strong>
                            &nbsp;
                            {{ $data->gender }}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Status :</strong>
                            &nbsp;
                            @if ($data->active == 1)
                            Aktif
                            @else
                            Nonaktif
                            @endif
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Bergabung pada :</strong>
                            &nbsp;
                            {{ $data->created_at }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection