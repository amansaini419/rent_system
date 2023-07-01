@extends('layouts.master')

@section('title')
  New Tenant
@endsection

@section('theme-style')
  <!-- Date-Dropper css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
@endsection

@section('own-style')
  <style>
    .table.user-table td,
    .table.user-table th {
      width: 50%;
    }

    .dd-w,
    .sp-container {
      z-index: 100000000010 !important;
    }
  </style>
@endsection

@section('content')
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-user-alt-4 bg-c-orenge"></i>
          <div class="d-inline">
            <h4>New Tenant</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="page-header-breadcrumb">
          <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">
                <i class="icofont icofont-home"></i>
              </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('tenant-list') }}">Tenant</a></li>
            <li class="breadcrumb-item"><a href="#!">New</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-block">
            <div class="row">
              <div class="col-lg-6 col-md-8">
                <form method="POST" action="{{ route('tenant-register') }}">
                  @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="countryCode">Country Code</label>
                    <select class="form-control" id="countryCode" name="countryCode" required></select>
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success waves-effect waves-light text-uppercase">Submit</button>
                    <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('own-script')
<script>
  const countryCodes = setCountryCodes();
  countryCodes.then((countryCodeObj)=>{
    countryCodeObj.map( (obj) => {
      $('#countryCode').append('<option value="' + obj.dial_code + '" ' + (obj.name === "Ghana" ? "selected" : "") + '>' + obj.name + ' (' + obj.dial_code + ')</option>');
    });
  });
</script>
@endsection