@extends('layouts.auth')

@section('title')
  Sign Up
@endsection

@section('content')
  <div class="signup-card card-block auth-body mr-auto ml-auto">
    <form class="md-float-material">
      {{-- <div class="text-center">
        <img src="assets/images/auth/logo-dark.png" alt="logo.png">
      </div> --}}
      <div class="auth-box">
        <div class="row m-b-20">
          <div class="col-md-12">
            <h3 class="text-center txt-primary">Sign Up</h3>
          </div>
        </div>
        <hr />
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Your Phone Number">
          <span class="md-line"></span>
        </div>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Enter Verification Code">
          <span class="input-group-addon btn btn-primary btn-sm" id="basic-addon10">
            <span class="">Send OTP</span>
          </span>
          <span class="md-line"></span>
        </div>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Your Email Address">
          <span class="md-line"></span>
        </div>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="Password">
          <span class="md-line"></span>
        </div>
        <div class="row m-t-30">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign Up
              Now</button>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-md-12">
            <p class="text-left">
              <a href="{{ route('login') }}" class="text-right f-w-600 text-primary">Already have an account?</a>
            </p>
          </div>
        </div>
      </div>
    </form>
    <!-- end of form -->
  </div>
@endsection
