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
          <i class="icofont icofont-file-alt bg-c-orenge"></i>
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
                      <td>{{ $tenantName }}</td>
                    </tr>
                    @endif
                    <tr>
                      <th>Loan ID</th>
                      <td>{{ $loan->loan_code }}</td>
                    </tr>
                    <tr>
                      <th>Starting Date</th>
                      <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatDate($loan->starting_date) !!}</td>
                    </tr>
                    <tr>
                      <th>Required Amount</th>
                      <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($loan->loan_amount) !!}</td>
                    </tr>
                    <tr>
                      <th>Loan Amount</th>
                      <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($loan->loan_amount - $initialDeposit) !!}</td>
                    </tr>
                    <tr>
                      <th>Inital Deposit</th>
                      <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($initialDeposit) !!}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table loan-table m-0">
                    <tr>
                      <th>Interest rate</th>
                      <td>{{ $loan->interest_rate }}%</td>
                    </tr>
                    <tr>
                      <th>Monthly Payment</th>
                      <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($loan->monthly_payment) !!}</td>
                    </tr>
                    <tr>
                      <th>Number of Payments</th>
                      <td>{{ $loan->loan_period * 12 }}</td>
                    </tr>
                    <tr>
                      <th>Total Interest</th>
                      <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($loanCalculation->totalInterest) !!}</td>
                    </tr>
                    <tr>
                      <th>Total Cost of Loan</th>
                      <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($loanCalculation->totalLoanCost) !!}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        @if(Auth::user()->user_type == "TENANT")
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
                              <th>Payment Status</th>
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
                                <td><button type="button" class="btn btn-sm btn-link px-0 text-uppercase" data-toggle="modal" data-target="#paymentModal">Pay</button></td>
                                <td>{{ $monthlyPlan->due_date }}</td>
                                <td>{{ $monthlyPlan->beginning_balance }}</td>
                                <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($monthlyPlan->payment) !!}</td>
                                <td>{{ $monthlyPlan->principal }}</td>
                                <td>{{ $monthlyPlan->interest }}</td>
                                <td>{{ $monthlyPlan->ending_balance }}</td>
                              </tr>
                            @endforeach
                            {{-- <tr>
                              <td>1</td>
                              <td>Paid</td>
                              <td>15-Jun-23</td>
                              <td>10000.00</td>
                              <td>945.60</td>
                              <td>745.60</td>
                              <td>200.00</td>
                              <td>9254.40</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>
                                Amount Due<br>
                                <button type="button" class="btn btn-sm btn-link px-0 text-uppercase" data-toggle="modal"
                                  data-target="#paymentModal">Pay</button>
                              </td>
                              <td>15-Jul-23</td>
                              <td>9254.40</td>
                              <td>945.60</td>
                              <td>760.51</td>
                              <td>185.09</td>
                              <td>8493.90</td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>
                                Pending<br>
                                <button type="button" class="btn btn-sm btn-link px-0 text-uppercase" data-toggle="modal"
                                  data-target="#paymentModal">Pay</button>
                              </td>
                              <td>15-Aug-23</td>
                              <td>8493.90</td>
                              <td>945.60</td>
                              <td>775.72</td>
                              <td>169.88</td>
                              <td>7718.18</td>
                            </tr> --}}
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        {{-- <div class="tab-header card">
          <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#monthlyPlanTab" role="tab">Monthly Plan</a>
              <div class="slide"></div>
            </li>
          </ul>
        </div> --}}
        {{-- <div class="tab-content">
          <div class="tab-pane active" id="monthlyPlanTab" role="tabpanel"> --}}
      @elseif (in_array(Auth::user()->user_type, ['ADMIN', 'STAFF', 'AGENT']))
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
                            <th>Payment Status</th>
                            <th>Payment Date</th>
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
                              <td><button type="button" class="btn btn-sm btn-link px-0 text-uppercase" data-toggle="modal" data-target="#offlinePaymentModal">Offline Payment</button></td>
                              <td>{{ $monthlyPlan->due_date }}</td>
                              <td>{{ $monthlyPlan->beginning_balance }}</td>
                              <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatCurrencyView($monthlyPlan->payment) !!}</td>
                              <td>{{ $monthlyPlan->principal }}</td>
                              <td>{{ $monthlyPlan->interest }}</td>
                              <td>{{ $monthlyPlan->ending_balance }}</td>
                            </tr>
                          @endforeach
                          {{-- <tr>
                            <td>1</td>
                            <td>Paid</td>
                            <td>15-Jun-23</td>
                            <td>10000.00</td>
                            <td>945.60</td>
                            <td>745.60</td>
                            <td>200.00</td>
                            <td>9254.40</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>
                              Amount Due<br>
                              <button type="button" class="btn btn-sm btn-link px-0 text-uppercase" data-toggle="modal"
                                data-target="#offlinePaymentModal">Offline Payment</button>
                            </td>
                            <td>15-Jul-23</td>
                            <td>9254.40</td>
                            <td>945.60</td>
                            <td>760.51</td>
                            <td>185.09</td>
                            <td>8493.90</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>
                              Pending<br>
                              <button type="button" class="btn btn-sm btn-link px-0 text-uppercase" data-toggle="modal"
                                data-target="#offlinePaymentModal">Offline Payment</button>
                            </td>
                            <td>15-Aug-23</td>
                            <td>8493.90</td>
                            <td>945.60</td>
                            <td>775.72</td>
                            <td>169.88</td>
                            <td>7718.18</td>
                          </tr> --}}
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
        {{-- </div>
        </div> --}}
      </div>
    </div>
  </div>

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
          <form>
            <div class="form-group">
              <label for="offlineAmount">Payment Amount</label>
              <input type="text" name="offlineAmount" id="offlineAmount" class="form-control">
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-success waves-effect waves-light text-uppercase">Accept
                Payment</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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
          <form>
            <div class="form-group">
              <label for="paymentAmount">Payment Amount</label>
              <input type="text" name="paymentAmount" id="paymentAmount" class="form-control">
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-success waves-effect waves-light text-uppercase">Pay</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('theme-script')
  <script type="text/javascript" src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
@endsection

@section('own-script')
  <script>
    $(".date-dropper").dateDropper({
      dropWidth: 200,
      dropPrimaryColor: "#1abc9c",
      dropBorder: "1px solid #1abc9c"
    });


    /* P = Principal Amount
    R = Interest per annum
    r = monthly interest rate ( R / 12 / 100 )
    n = tenure/total installments (in months)
    adj = (1 + r) ^ n

    EMI = P * r * adj / (adj - 1) */



    $('#generateBtn').click((e) => {
      e.preventDefault();

      const startingDate = $('#startingDate').val();
      //console.log(dateFormat(startingDate));
      const loanAmount = $('#loanAmount').val();
      const interestRate = $('#interestRate').val();
      const loanPeriod = $('#loanPeriod').val();

      const monthlyInterest = interestRate / 12 / 100;
      const totalInstallments = loanPeriod * 12;
      const adj = Math.pow((1 + monthlyInterest), totalInstallments);

      const monthlyPayment = calculateMonthlyPayment(loanAmount, monthlyInterest, totalInstallments);
      const totalLoanCost = monthlyPayment * totalInstallments;
      const totalInterest = totalLoanCost - loanAmount;

      $('#monthlyPaymentCell').text(currencyFormat(monthlyPayment));
      $('#totalInstallmentCell').text(totalInstallments);
      $('#totalInterestCell').text(currencyFormat(totalInterest));
      $('#totalLoanCostCell').text(currencyFormat(totalLoanCost));

      let beginningBalance = loanAmount;
      for (let i = 1; i <= totalInstallments; i++) {
        moment(startingDate).add(i, 'months');
        const monthlyInterestAmt = calculateSI(beginningBalance, interestRate, loanPeriod / 12);
        const monthlyPrincipalAmt = monthlyPayment - monthlyInterestAmt;
        let endingBalance = beginningBalance - monthlyPrincipalAmt;
        const tableRow = '\
                  <tr>\
                    <td>' + i + '</td>\
                    <td>' + dateFormat(moment(startingDate).add(i, 'months')) + '</td>\
                    <td>' + currencyFormat(beginningBalance) + '</td>\
                    <td>' + currencyFormat(monthlyPayment) + '</td>\
                    <td>' + currencyFormat(monthlyPrincipalAmt) + '</td>\
                    <td>' + currencyFormat(monthlyInterestAmt) + '</td>\
                    <td>' + currencyFormat(endingBalance > 0 ? endingBalance : 0) + '</td>\
                  </tr>\
                ';
        $('#monthlyPlanTable tbody').append(tableRow);
        console.log(i, beginningBalance, monthlyPayment, monthlyPrincipalAmt, monthlyInterestAmt, endingBalance);
        beginningBalance = endingBalance;
      }
    });

    /*
    Add new page for monthly plan, loan
    */
  </script>
@endsection
