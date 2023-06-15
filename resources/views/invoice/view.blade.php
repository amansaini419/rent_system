@extends('layouts.master')

@section('title')
  View Application
@endsection

@section('theme-style')
  <!-- Date-Dropper css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
@endsection

@section('own-style')
  <style>
    .table.payment-table td,
    .table.payment-table th {
      width: 50%;
    }

    .dd-w,
    .sp-container {
      z-index: 100000000010 !important;
    }
  </style>
@endsection

@section('content')
  {{-- @aware(['applicationStatus' => request('status')]) --}}
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-file-alt bg-c-orenge"></i>
          <div class="d-inline">
            <h4>View Invoice</h4>
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
            <li class="breadcrumb-item"><a
                href="{{ route('invoice-list') }}">Invoice</a></li>
            <li class="breadcrumb-item"><a href="#!">View</a></li>
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
              <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table payment-table m-0">
                    <tbody>
                      <tr>
                        <th>Invoice ID</th>
                        <td>{{ $invoice->invoice_code }}</td>
                      </tr>
                      <tr>
                        <th>Invoice Date</th>
                        <td>{{ $invoice->invoice_date }}</td>
                      </tr>
                      <tr>
                        <th>Invoice Amount</th>
                        <td>{{ $invoice->invoice_amount }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table payment-table m-0">
                    <tbody>
                      <tr>
                        <th>Invoice Type</th>
                        <td>{{ $invoice->invoice_type }}</td>
                      </tr>
                      <tr>
                        <th>Invoice Status</th>
                        <td>{{ $invoice->invoice_status }}</td>
                      </tr>
                      @if (Auth::user()->user_type != "TENANT")
                      <tr>
                        <th>Tenant Name</th>
                        <td>{{ $invoice->tenant_name }}</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="sub-title d-block border-0">Payments</h5>
          </div>
          <div class="card-block">
            <div class="view-info">
              <div class="row">
                <div class="col-lg-12">
                  <div class="general-info">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="table-responsive">
                          <table class="table m-0">
                            <thead>
                              <tr>
                                <th>Payment Date</th>
                                <th>Payment Id</th>
                                <th>Payment Amount</th>
                                <th>Payment Channel</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($payments as $payment)
                              <tr>
                                <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatDate($payment->created_at) !!}</td>
                                <td>{{ $payment->payment_ref }}</td>
                                <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($payment->payment_amount) !!}</td>
                                <td>{{ $payment->payment_channel }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection