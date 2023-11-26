@extends('auth.layouts.master')

@section('content')
<section>
    <div class="page-header min-vh-100">
        <div class="container mt-5">
            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3 text-center">
                <form class="rounded bg-white shadow p-5" action="{{route('verify.process')}}" method="POST">
                    @csrf
                    @method('POST')
                    <h3 class="text-dark fw-bolder fs-4 mb-2">Two Step Verification</h3>
    
                    <div class="fw-normal text-muted mb-4">
                        Enter the verification code we sent to
                    </div>
    
                    <div class="d-flex align-items-center justify-content-center fw-bold mb-4">
                        <span>{{$user->phone}}</span>
                    </div>
    
                    <div class="otp_input text-start mb-2">
                        <label for="digit">Type your 6 digit security code</label>
                        <input type="hidden" name="program" value="{{$program}}">
                        {{-- @dd($program) --}}
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <input type="text" name="token" maxlength="6" class="form-control text-center" placeholder="" style="letter-spacing:1rem">
                        </div> 
                    </div>  
    
                    <button type="submit" class="btn btn-primary submit_btn my-4">Submit</button> 
    
                    <div class="fw-normal text-muted mb-2">
                        Didn’t get the code ? <a href="#" class="text-primary fw-bold text-decoration-none">Resend</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
