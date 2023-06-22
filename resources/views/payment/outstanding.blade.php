@extends('layouts.master')

@section('title')
  Outstanding Payments
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
            <h4>Outstanding Payments</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="page-header-breadcrumb">
          <ul class="breadcrumb-title">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="icofont icofont-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('payment-list') }}">Payments</a></li>
            <li class="breadcrumb-item"><a href="#!">Outstanding</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    @if( in_array(Auth::user()->user_type, ['ADMIN', 'STAFF', 'AGENT']) )
    <div class="card">
      {{-- <div class="card-header">
        <h5>Outstanding Payments</h5>
        <span></span>
      </div> --}}
      <div class="card-block">
        <div class="dt-responsive table-responsive">
          <table id="dataTable" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Account Type</th>
                <th>Due Date</th>
                <th>Days Over</th>
                <th>Penalty</th>
                <th>New Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($outstandingRentStr as $payment)
                <tr>
                  <td>{{ $payment->tenant_name }}</td>
                  <td>{{ $payment->account_type }}</td>
                  <td>{{ $payment->due_date }}</td>
                  <td>{{ $payment->days_over }}</td>
                  <td>{{ $payment->penalty }}</td>
                  <td>{{ $payment->total_amount }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-link px-0 text-uppercase payment-modal-btn" data-toggle="modal" data-target="#offlinePaymentModal" data-payment="{{ $payment->payment_amount_db }}" data-penalty="{{ $payment->penalty_amount_db }}" data-total="{{ $payment->total_amount_db }}" data-id="{{ md5($payment->id) }}">Offline Payment</button>
                  </td>
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
                <th>Account Type</th>
                <th>Due Date</th>
                <th>Days Over</th>
                <th>Penalty</th>
                <th>New Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($outstandingRentStr as $payment)
                <tr>
                  <td>{{ $payment->account_type }}</td>
                  <td>{{ $payment->due_date }}</td>
                  <td>{{ $payment->days_over }}</td>
                  <td>{{ $payment->penalty }}</td>
                  <td>{{ $payment->total_amount }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-link px-0 text-uppercase payment-modal-btn" data-toggle="modal" data-target="#paymentModal" data-payment="{{ $payment->payment_amount_db }}" data-penalty="{{ $payment->penalty_amount_db }}" data-total="{{ $payment->total_amount_db }}" data-id="{{ md5($payment->id) }}">Pay</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
  </div>
  @if (in_array(Auth::user()->user_type, ['ADMIN', 'STAFF', 'AGENT']))
  <div class="modal fade" id="offlinePaymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Offline Payment</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('loan-offlinePayment') }}">
            @csrf
            <div class="form-group">
              <label for="paymentAmount">Payment Amount</label>
              <input type="text" name="paymentAmount" id="paymentAmount" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="penaltyAmount">Penalty Amount</label>
              <input type="text" name="penaltyAmount" id="penaltyAmount" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="totalAmount">Total Amount</label>
              <input type="text" name="totalAmount" id="totalAmount" class="form-control" readonly>
              <input type="hidden" name="monthlyId" id="monthlyId">
            </div>
            <div class="form-group">
              <label for="paymentChannel">Payment Channel</label>
              <select name="paymentChannel" id="paymentChannel" class="form-control">
                <option value="MOMO">MOMO</option>
                <option value="CASH">CASH</option>
                <option value="CARD">CARD</option>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success waves-effect waves-light text-uppercase">Accept Payment</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @elseif (Auth::user()->user_type == 'TENANT')
  <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Payment</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('loan-payment') }}">
            @csrf
            <div class="form-group">
              <label for="paymentAmount">Payment Amount</label>
              <input type="text" name="paymentAmount" id="paymentAmount" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="penaltyAmount">Penalty Amount</label>
              <input type="text" name="penaltyAmount" id="penaltyAmount" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="totalAmount">Total Amount</label>
              <input type="text" name="totalAmount" id="totalAmount" class="form-control" readonly>
              <input type="hidden" name="monthlyId" id="monthlyId">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success waves-effect waves-light text-uppercase">Pay</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
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
    @if(session('success') === true)
      @if(session('message'))
        swal('{{ session('title') }}', '{{ session('message') }}', '{{ session('alert') }}');
      @endif
    @elseif (session('success') === false)
      @if(session('error'))
        swal('{{ session('title') }}', '{{ session('error') }}', '{{ session('alert') }}');
      @elseif (session('errors'))
        swal('{{ session('title') }}', '{{ session('errors') }}', '{{ session('alert') }}');
      @endif
    @endif

    $('#dataTable').DataTable({
        order: [[0, 'desc']],
    });

    $('.payment-modal-btn').click(function(){
      $('#monthlyId').val($(this).attr('data-id'));
      $('#paymentAmount').val($(this).attr('data-payment'));
      $('#penaltyAmount').val($(this).attr('data-penalty'));
      $('#totalAmount').val($(this).attr('data-total'));
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
