@extends('layouts.auth')

@section('title')
  Reset Password
@endsection

@section('content')
  <div class="login-card card-block auth-body mr-auto ml-auto">
    <form class="md-float-material">
      {{-- <div class="text-center">
        <img src="assets/images/auth/logo-dark.png" alt="logo.png">
      </div> --}}
      <div class="auth-box">
        <div class="row m-b-20">
          <div class="col-md-12">
            <h3 class="text-left">Reset Your Password</h3>
          </div>
        </div>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="Choose Password">
          <span class="md-line"></span>
        </div>
        <div class="input-group">
          <input type="password" class="form-control" placeholder="Confirm Password">
          <span class="md-line"></span>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Reset
              Password</button>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-md-12">
            <p class="text-left m-b-0"><a href="{{ route('login') }}" class="text-primary f-w-600">Already have an
                account?</a></p>
            <p class="text-left"><a href="{{ route('signup') }}" class="text-primary f-w-600">Don't have an account? Sign
                Up?</a></p>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
