@extends('layouts.auth')

@section('title')
  Sign Up
@endsection

@section('content')
  <div class="signup-card card-block auth-body mr-auto ml-auto">
    <form class="md-float-material" method="POST" action="{{ route('signup-user') }}">
      @csrf
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
        @if (isset($errors) && count($errors) > 0)
          <div class="alert alert-danger" role="alert">
            <ul class="list-unstyled mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @if (Session::get('success', false))
          <?php $data = Session::get('success'); ?>
          @if (is_array($data))
            @foreach ($data as $msg)
              <div class="alert alert-warning" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
              </div>
            @endforeach
          @else
            <div class="alert alert-warning" role="alert">
              <i class="fa fa-check"></i>
              {{ $data }}
            </div>
          @endif
        @endif
        <div class="input-group">
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone Number" value="{{ old('phone') }}" required>
          <button type="button" class="input-group-addon btn btn-primary btn-sm" id="sendOtpBtn">Verify Number</button>
          <span class="md-line"></span>
        </div>
        <p style="display: none;" class="text-right text-inverse" id="countdown"><span class="text-danger f-w-600">60</span> seconds remaining for Send OTP again.</p>
        <div class="input-group">
          <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter Verification Code" required>
          <span class="md-line"></span>
        </div>
        <div class="input-group">
          <input type="email" class="form-control" id="email" name="email" placeholder="Your Email Address" value="{{ old('email') }}" required>
          <span class="md-line"></span>
        </div>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <span class="md-line"></span>
        </div>
        <div class="input-group">
          <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
          <span class="md-line"></span>
        </div>
        <div class="row m-t-30">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign Up Now</button>
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

@section('script')
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      const alert = (title, message, icon) => {
        swal(title, message, icon);
      }

      let otpSubmit = 0;
      $('#sendOtpBtn').click(function(e){
        e.preventDefault();
        if(otpSubmit == 0){
          otpSubmit = 1;
          const btnElement = $('#sendOtpBtn');
          const btnVal = btnElement.text();
          btnElement.html('<i class="ti-reload rotate-refresh"></i>');
          const phone = $('#phone').val();
          //console.log(btnVal, phone);
          if(phone == ''){
            alert('Phone Number', 'Phone number cannot be empty.', 'warning');
            return false;
          }
          $.ajax({
            method: 'POST',
            url: '{{ route('signup-otp') }}',
            data: {
              'phone': phone
            },
            success: function(response){
              let message = '';
              if(response.errors !== undefined){
                errorsKeys.forEach( (key) => {
                  message = message + errors[key][0] + '\n';
                });
                otpSubmit = 0;
              }
              else if(response.error !== undefined){
                message = response.error;
                otpSubmit = 0;
              }
              else if(response.message !== undefined){
                message = response.message;
                let timer = 60;
                $('#countdown').show();
                const downloadTimer = setInterval(function(){
                  $('#countdown span').text(timer);
                  if(timer <= 0){
                    otpSubmit = 0;
                    $('#countdown').hide();
                    clearInterval(downloadTimer);
                  }
                  timer--;
                }, 1000);
              }
              btnElement.html(btnVal);
              alert(response.title, message, response.alert);
            },
            error: function(error){
              console.error(error);
            }
          });
        }
        else{
          swal('', 'Please wait for 60 seconds before pressing Send OTP again.');
        }
      });
    });
  </script>
@endsection
