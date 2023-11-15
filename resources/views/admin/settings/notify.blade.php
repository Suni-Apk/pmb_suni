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
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>    
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-0">
                                <label for="notif_isi_biodata_nonformal">Notif Isi Biodata <strong class="text-danger">* Non Formal</strong></label>
                                <textarea id="notif_isi_biodata_nonformal" name="notif_isi_biodata_nonformal" class="form-control mb-3" style="min-height: 8rem">{{$notif->notif_isi_biodata_nonformal}}</textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-0">
                                <label for="notif_isi_biodata_formal">Notif Isi Biodata <strong class="text-danger">* Formal</strong></label>
                                <textarea id="notif_isi_biodata_formal" class="form-control mb-3" style="min-height: 8rem" name="notif_isi_biodata_formal">{{$notif->notif_isi_biodata_formal}}</textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-0">
                                <label for="notif_administrasi_nonformal">Notif Bayar Biaya Administrasi <strong class="text-danger">* Non Formal</strong></label>
                                <textarea id="notif_administrasi_nonformal" class="form-control mb-3" style="min-height: 8rem" name="notif_administrasi_nonformal">{{$notif->notif_administrasi_nonformal}}</textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-0">
                                <label for="notif_isi_document">Notif Isi Document <strong class="text-danger">* Formal</strong></label>
                                <textarea id="notif_isi_document" class="form-control mb-3" style="min-height: 8rem" name="notif_isi_document">{{$notif->notif_isi_document}}</textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                        
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-0">
                                <label for="notif_administrasi_formal">Notif Bayar Biaya Administrasi <strong class="text-danger">* Formal</strong></label>
                                <textarea id="notif_administrasi_formal" class="form-control mb-3" style="min-height: 8rem" name="notif_administrasi_formal">{{$notif->notif_administrasi_formal}}</textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
                
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
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#templateTableNoSearch", {
            searchable: false,
            fixedHeight: true,
        });

        const dataTableBasic = new simpleDatatables.DataTable("#templateTable", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
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

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}")
        @endif
    </script>
@endpush
