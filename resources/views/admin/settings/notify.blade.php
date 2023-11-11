@extends('layouts.master')


@section('title', 'Settings Notifikasi')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-bold">Notifikasi WhatsApp</h5>
                </div>
                <form action="{{route('admin.settings.notifications.process',$notif->id)}}" method="POST" class="card-body pt-0">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-0">
                                <label for="notif_otp">Pesan Notifikasi OTP</label>
                                <textarea id="notif_otp" class="form-control mb-3" style="min-height: 8rem" name="notif_otp">{{$notif->notif_otp}}</textarea>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                            <div class="form-group mb-0">
                                <label for="notif_otp">Pesan Notifikasi OTP</label>
                                <textarea id="notif_otp" class="form-control mb-3" style="min-height: 8rem" name="notif_otp">{{$notif->notif_otp}}</textarea>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
