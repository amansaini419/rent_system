@extends('layouts.master')

@section('title')
  View Loan
@endsection

@section('theme-style')
  <!-- Date-Dropper css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
@endsection

@section('own-style')
  <style>
    .table.loan-table td,
    .table.loan-table th {
      width: 50%;
    }

    .dd-w,
    .sp-container {
      z-index: 100000000010 !important;
    }
  </style>
@endsection

@section('content')
  @aware(['loanStatus' => request('status')])

  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-briefcase-alt-1 bg-c-orenge"></i>
          <div class="d-inline">
            <h4>View Loan</h4>
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
            <li class="breadcrumb-item"><a href="{{ route('loan-list', ['status' => $loanStatus]) }}">Loan</a></li>
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
                  <table class="table loan-table m-0">
                    @if (in_array(Auth::user()->user_type, ['ADMIN', 'STAFF', 'AGENT']))
                    <tr>
                      <th>Tenant Name</th>
                      <td>{{ $loan->tenant_name }}</td>
                    </tr>
                    @endif
                    <tr>
                      <th>Loan ID</th>
                      <td>{{ $loan->loan_code }}</td>
                    </tr>
                    <tr>
                      <th>Starting Date</th>
                      <td>{{ $loan->starting_date }}</td>
                    </tr>
                    <tr>
                      <th>Rent Amount</th>
                      <td>{{ $loan->loan_amount }}</td>
                    </tr>
                    <tr>
                      <th>Annual Interest</th>
                      <td>{{ $loan->interest_rate }}</td>
                    </tr>
                    <tr>
                      <th>Period</th>
                      <td>{{ $loan->total_installment }} months</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table loan-table m-0">
                    <tr>
                      <th>Monthly Payment</th>
                      <td>{{ $loan->monthly_payment }}</td>
                    </tr>
                    <tr>
                      <th>Number of Payments</th>
                      <td>{{ $loan->total_installment }}</td>
                    </tr>
                    <tr>
                      <th>First Month Deposit</th>
                      <td>{{ $loan->monthly_payment }}</td>
                    </tr>
                    <tr>
                      <th>Security Deposit (Refundable)</th>
                      <td>{{ $loan->monthly_payment }}</td>
                    </tr>
                    <tr>
                      <th>Initial Payment before Move-in</th>
                      <td>{{ $loan->initial_payment }}</td>
                    </tr>
                    <tr>
                      <th>Total Interest</th>
                      <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($loanCalculation->totalInterest) !!}</td>
                    </tr>
                    <tr>
                      <th>Total Cost of Rent</th>
                      <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($loanCalculation->totalLoanCost) !!}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="card">
          <div class="card-header">
            <h5 class="sub-title d-block border-0">Payment</h5>
            <p>
              <button type="button" class="btn btn-sm btn-primary text-uppercase initial-deposit-modal"data-toggle="modal" data-target="#depositModal">Pay Initial Deposit</button>
            </p>
          </div>
          <div class="card-block">
            <div class="view-info">
              <div class="row">
                <div class="col-lg-12">
                  <div class="general-info">
                    <div class="table-responsive">
                      <table class="table" id="monthlyPlanTable">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Payment Status</th>
                            <th>Payment</th>
                            <th>Penalty</th>
                            <th>Due Date</th>
                            <th>Payment Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($monthlyPlanStr as $monthlyPlan)
                            <tr>
                              <td>{{ $monthlyPlan->sn }}</td>
                              <td>{{ $monthlyPlan->payment_status }}</td>
                              <td>{{ $monthlyPlan->payment }}</td>
                              <td>{{ $monthlyPlan->penalty }}</td>
                              <td>{{ $monthlyPlan->due_date }}</td>
                              <td>
                                @if($monthlyPlan->payment_date == null)
                                <button type="button" class="btn btn-sm btn-link px-0 text-uppercase payment-modal-btn" data-toggle="modal" data-target="#paymentModal" data-payment="{{ $monthlyPlan->paymentAmount }}" data-penalty="{{ $monthlyPlan->penaltyAmount }}" data-total="{{ $monthlyPlan->paymentAmount + $monthlyPlan->penaltyAmount }}" data-id="{{ md5($monthlyPlan->id) }}">Pay</button>
                                @else
                                {{ $monthlyPlan->payment_date }}
                                @endif
                              </td>
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
        <div class="card">
          <div class="card-header">
            <h5 class="sub-title d-block border-0">Monthly Plan</h5>
          </div>
          <div class="card-block">
            <div class="view-info">
              <div class="row">
                <div class="col-lg-12">
                  <div class="general-info">
                    <div class="table-responsive">
                      <table class="table" id="monthlyPlanTable">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Due Date</th>
                            <th>Beginning Balance</th>
                            <th>Payment</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Ending Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($monthlyPlanStr as $monthlyPlan)
                            <tr>
                              <td>{{ $monthlyPlan->sn }}</td>
                              <td>{{ $monthlyPlan->due_date }}</td>
                              <td>{{ $monthlyPlan->beginning_balance }}</td>
                              <td>{{ $monthlyPlan->payment }}</td>
                              <td>{{ $monthlyPlan->principal }}</td>
                              <td>{{ $monthlyPlan->interest }}</td>
                              <td>{{ $monthlyPlan->ending_balance }}</td>
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
        </div> --}}
      
        <div class="card">
          <div class="card-header">
            <h5 class="sub-title d-block border-0">Payment</h5>
            {{-- <p>
              <button type="button" class="btn btn-sm btn-primary text-uppercase initial-deposit-modal"data-toggle="modal" data-target="#depositModal">Accept Initial Deposit</button>
            </p> --}}
          </div>
          <div class="card-block">
            <div class="view-info">
              <div class="row">
                <div class="col-lg-12">
                  <div class="general-info">
                    <div class="table-responsive">
                      <table class="table" id="monthlyPlanTable">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Payment Status</th>
                            <th>Payment</th>
                            <th>Penalty</th>
                            <th>Due Date</th>
                            <th>Payment Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($monthlyPlanStr as $monthlyPlan)
                            <tr>
                              <td>{{ $monthlyPlan->sn }}</td>
                              <td>{{ $monthlyPlan->payment_status }}</td>
                              <td>{{ $monthlyPlan->paymentAmount }}</td>
                              <td>{{ $monthlyPlan->penaltyAmount }}</td>
                              <td>{{ $monthlyPlan->due_date }}</td>
                              <td>
                                @if($monthlyPlan->payment_date == null)
                                  @if(Auth::user()->user_type == "TENANT")
                                    <button type="button" class="btn btn-sm btn-link px-0 text-uppercase payment-modal-btn" data-toggle="modal" data-target="#paymentModal" data-payment="{{ $monthlyPlan->paymentAmount }}" data-penalty="{{ $monthlyPlan->penaltyAmount }}" data-total="{{ $monthlyPlan->totalAmountDb }}" data-id="{{ md5($monthlyPlan->id) }}">Pay</button>
                                  @elseif (in_array(Auth::user()->user_type, ['ADMIN', 'STAFF', 'AGENT']))
                                    <button type="button" class="btn btn-sm btn-link px-0 text-uppercase payment-modal-btn" data-toggle="modal" data-target="#offlinePaymentModal" data-payment="{{ $monthlyPlan->paymentAmountDb }}" data-penalty="{{ $monthlyPlan->penaltyAmountDb }}" data-total="{{ $monthlyPlan->totalAmountDb }}" data-id="{{ md5($monthlyPlan->id) }}">Offline Payment</button>
                                  @endif
                                @else
                                  {{ $monthlyPlan->payment_date }}
                                @endif
                              </td>
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
        <div class="card">
          <div class="card-header">
            <h5 class="sub-title d-block border-0">Monthly Plan</h5>
          </div>
          <div class="card-block">
            <div class="view-info">
              <div class="row">
                <div class="col-lg-12">
                  <div class="general-info">
                    <div class="table-responsive">
                      <table class="table" id="monthlyPlanTable">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Due Date</th>
                            <th>Beginning Balance</th>
                            <th>Payment</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Ending Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($monthlyPlanStr as $monthlyPlan)
                            <tr>
                              <td>{{ $monthlyPlan->sn }}</td>
                              <td>{{ $monthlyPlan->due_date }}</td>
                              <td>{{ $monthlyPlan->beginning_balance }}</td>
                              <td>{{ $monthlyPlan->payment }}</td>
                              <td>{{ $monthlyPlan->principal }}</td>
                              <td>{{ $monthlyPlan->interest }}</td>
                              <td>{{ $monthlyPlan->ending_balance }}</td>
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
  {{-- <div class="modal fade" id="depositModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Initial Deposit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('application-initialDeposit') }}">
            @csrf
            <div class="form-group">
              <label for="depositAmount">Loan ID</label>
              <input type="text" name="loanId" id="loanId" class="form-control" value="{{ $loan->loan_code }}" readonly>
            </div>
            <div class="form-group">
              <label for="depositAmount">How much initial deposit you want to do?</label>
              <input type="text" name="depositAmount" id="depositAmount" class="form-control" value="{{ $loan->initial_deposit }}" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success waves-effect waves-light text-uppercase">Deposit</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> --}}
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

    $('.payment-modal-btn').click(function(){
      $('#monthlyId').val($(this).attr('data-id'));
      $('#paymentAmount').val($(this).attr('data-payment'));
      $('#penaltyAmount').val($(this).attr('data-penalty'));
      $('#totalAmount').val($(this).attr('data-total'));
    });
  </script>
@endsection
