@extends('layouts.master')

@section('title')
  Payments
@endsection

@section('theme-style')
  <!-- Data Table Css -->
  <link rel="stylesheet" type="text/css"
    href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
  {{-- @aware(['applicationStatus' => request('status')]) --}}

  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-money bg-c-orenge"></i>
          <div class="d-inline">
            <h4>Payments</h4>
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
            <li class="breadcrumb-item"><a href="#!">Payments</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    @if( in_array(Auth::user()->user_type, ['ADMIN', 'STAFF', 'AGENT']) )
    <div class="card">
      <div class="card-header">
        <h5>All Payments</h5>
        <span></span>
      </div>
      <div class="card-block">
        <div class="dt-responsive table-responsive">
          <table id="dataTable" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>Payment Date</th>
                <th>Payment ID</th>
                <th>Tenant Name</th>
                <th>Payment Amount</th>
                <th>Payment Channel</th>
                <th>Invoice Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($paymentStr as $payment)
                <tr>
                  <td>{{ $payment->payment_date }}</td>
                  <td>{{ $payment->payment_ref }}</td>
                  <td>{{ $payment->tenant_name }}</td>
                  <td>{{ $payment->payment_amount }}</td>
                  <td>{{ $payment->payment_channel }}</td>
                  <td>{{ $payment->invoice_type }}</td>
                  <td><a href="{{ route('invoice-view', ['id' => $payment->invoice_code]) }}" class="btn btn-sm btn-primary" target="_blank">INVOICE</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @else
    <div class="card">
      <div class="card-header">
        <h5>All Invoices</h5>
        <span></span>
      </div>
      <div class="card-block">
        <div class="dt-responsive table-responsive">
          <table id="dataTable" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>Payment Date</th>
                <th>Payment ID</th>
                <th>Payment Amount</th>
                <th>Payment Channel</th>
                <th>Invoice Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($paymentStr as $payment)
                <tr>
                  <td>{{ $payment->payment_date }}</td>
                  <td>{{ $payment->payment_ref }}</td>
                  <td>{{ $payment->payment_amount }}</td>
                  <td>{{ $payment->payment_channel }}</td>
                  <td>{{ $payment->invoice_type }}</td>
                  <td><a href="{{ route('invoice-view', ['id' => $payment->invoice_code]) }}" class="btn btn-sm btn-primary" target="_blank">INVOICE</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
  </div>
@endsection

@section('theme-script')
  <!-- data-table js -->
  <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/pages/data-table/js/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/pages/data-table/js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/pages/data-table/js/vfs_fonts.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
@endsection

@section('own-script')
  <script>
    $('#dataTable').DataTable({
        order: [[0, 'desc']],
    });
    /* $('#dt-server-processing').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "dt-json-data/scripts/server-processing.php",
      "columns": [{
          "data": "first_name"
        },
        {
          "data": "last_name"
        },
        {
          "data": "position"
        },
        {
          "data": "office"
        },
        {
          "data": "start_date"
        },
        {
          "data": "salary"
        }
      ]
    }); */
  </script>
@endsection
