@extends('layouts.master')

@section('title')
  Settings
@endsection

@section('content')
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-file-alt bg-c-orenge"></i>
          <div class="d-inline">
            <h4>Settings</h4>
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
            <li class="breadcrumb-item"><a href="#!">Settings</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="card">
      <div class="card-header">
        <h5>Update Settings</h5>
      </div>
      <div class="card-block">
        <form>
          <div class="form-group form-row">
            <div class="col-md-6">
              <label for="registrationFees">Registration Fees</label>
              <input type="text" name="registrationFees" id="registrationFees" class="form-control">
            </div>
          </div>
          <hr />
          <div class="form-group form-row">
            <div class="col-md-6">
              <label for="registrationFees">First Penalty (in days)</label>
              <input type="text" name="registrationFees" id="registrationFees" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="registrationFees">First Penalty (in %)</label>
              <input type="text" name="registrationFees" id="registrationFees" class="form-control">
            </div>
          </div>
          <div class="form-group form-row">
            <div class="col-md-6">
              <label for="registrationFees">Second Penalty (in days)</label>
              <input type="text" name="registrationFees" id="registrationFees" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="registrationFees">Second Penalty (in %)</label>
              <input type="text" name="registrationFees" id="registrationFees" class="form-control">
            </div>
          </div>
          <hr />
          <div class="form-group">
            <button type="button" class="btn btn-primary text-uppercase">update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
