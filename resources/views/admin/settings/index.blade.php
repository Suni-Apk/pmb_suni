@extends('layouts.master')


@section('title', 'Settings Notification')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card h-100 mt-4">
                <div class="card-header">
                    <h5 class="text-bold">Notification Whatsaap</h5>
                </div>
                <form action="{{route('admin.settings.notifications.process',$notif->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="">Pesan notification OTP</label>
                                    <textarea class="form-control mb-3" name="notif_otp">{{$notif->notif_otp}}</textarea>
                                    <button class="btn btn-primary py-2 px-3" type="submit">Submit</button>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="" class="">Pesan notification sebelum waktu tagihan</label>
                                    <input type="text" class="form-control mb-3"
                                        placeholder="Assalamualaikum tagihan ikan goreng akan mendekati jatuh tempo">
                                    <button class="btn btn-primary py-2 px-3" type="submit">Submit</button>
                                </div> --}}
                            </div>
                        </div>
                        {{-- <div class="col-12 col-sm-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="">Pesan notification tepat tenggat tagihan</label>
                                    <input type="text" class="form-control mb-3"
                                        placeholder="Assalamualaikum anda mempunyai tagihan berikut">
                                    <button class="btn btn-primary py-2 px-3" type="submit">Submit</button>
                                </div>
                                <div class="form-group">
                                    <label for="" class="">Pesan notification sebelum waktu tagihan</label>
                                    <input type="text" class="form-control mb-3"
                                        placeholder="Assalamualaikum tagihan ikan goreng akan mendekati jatuh tempo">
                                    <button class="btn btn-primary py-2 px-3" type="submit">Submit</button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
