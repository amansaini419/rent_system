@extends('layouts.auth')

@section('title')
  Login
@endsection

@section('content')
  <div class="login-card card-block auth-body mr-auto ml-auto">
    <form class="md-float-material" method="POST" action="{{ route('login.user') }}">
      @csrf
      {{-- <div class="text-center">
          <img src="assets/images/auth/logo-dark.png" alt="logo.png">
      </div> --}}
      <div class="auth-box">
        <div class="row m-b-20">
          <div class="col-md-12">
            <h3 class="text-left txt-primary">Log In</h3>
          </div>
        </div>
        <hr />
        <div class="input-group">
          <input type="email" class="form-control" placeholder="Your Email Address" name="email">
          <span class="md-line"></span>
        </div>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <span class="md-line"></span>
        </div>
        <div class="row m-t-25 text-left">
          <div class="col-12">
            <div class="checkbox-fade fade-in-primary d-">
              <label>
                <input type="checkbox" value="">
                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                <span class="text-inverse">Remember me</span>
              </label>
            </div>
            <div class="forgot-phone text-right f-right">
              <a href="{{ route('forgot-password') }}" class="text-right f-w-600 text-primary">Forgot Password?</a>
            </div>
          </div>
        </div>
        <div class="row m-t-30">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Log
              In</button>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-md-12">
            <p class="text-left">
              <a href="{{ route('signup') }}" class="text-primary f-w-600">Don't have an account? Sign Up?</a>
            </p>
          </div>
        </div>

      </div>
    </form>
    <!-- end of form -->
  </div>
@endsection
