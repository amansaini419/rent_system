@extends('layouts.master')

@section('title')
  View Tenant
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
  @aware(['applicationStatus' => request('status')])
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-user-alt-2 bg-c-orenge"></i>
          <div class="d-inline">
            <h4>View Tenant</h4>
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
              {{-- <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table user-table m-0">
                    <tbody>
                      <tr>
                        <th>Tenant ID</th>
                        <td>1</td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div> --}}
              <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table user-table m-0">
                    <tbody>
                      <tr>
                        <th>Tenant Name</th>
                        <td>{{ $tenantName }}</td>
                      </tr>
                      <tr>
                        <th>Tenant Email</th>
                        <td>{{ $tenant->email }}</td>
                      </tr>
                      <tr>
                        <th>Tenant Phone No.</th>
                        <td>{{ $tenant->phone_number }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="sub-title d-block border-0">Applications</h5>
          </div>
          <div class="card-block">
            <div class="dt-responsive table-responsive">
              <table id="dataTable" class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th>Application ID</th>
                    <th>Application Type</th>
                    <th>Application Status</th>
                    {{-- <th>Initial Deposit</th> --}}
                    <th>Staff Assigned</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($applications as $application)
                  <tr>
                    <td>{{ $application->application_code }}</td>
                    <td>{{ $application->application_type }}</td>
                    <td>{{ $application->application_status }}</td>
                    {{-- <td>{{ $application->initial_deposit }}</td> --}}
                    <td>{{ $application->subadmin_id }}</td>
                    <td><a href="{{ route('application-view', ['id' => $application->application_code]) }}" class="btn btn-sm btn-primary" target="_blank">VIEW</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="sub-title d-block border-0">Loans</h5>
          </div>
          <div class="card-block">
            <div class="dt-responsive table-responsive">
              <table id="dataTable" class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th>Status</th>
                    <th>Loan ID</th>
                    <th>Starting Date</th>
                    <th>Loan Amount</th>
                    <th>Interest Rate</th>
                    <th>Monthly Payment</th>
                    <th>Total Installment</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($loans as $loan)
                  <tr>
                    <td>{{ $loan->loan_status }}</td>
                    <td>{{ $loan->loan_code }}</td>
                    <td>{{ $loan->starting_date }}</td>
                    <td>{{ $loan->loan_amount }}</td>
                    <td>{{ $loan->interest_rate }}</td>
                    <td>{{ $loan->monthly_payment }}</td>
                    <td>{{ $loan->loan_period * 12 }}</td>
                    <td><a href="{{ route('loan-view', ['id' => $loan->loan_code]) }}" class="btn btn-sm btn-primary" target="_blank">VIEW</a></td>
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
      $('#monthlyPlanTable tbody').empty();

      const startingDate = $('#startingDate').val();
      //console.log(dateFormat(startingDate));
      const loanAmount = $('#loanAmount').val();
      const interestRate = $('#interestRate').val();
      const loanPeriod = $('#loanPeriod').val();
      const initialDeposit = $('#initialDepositCell').text();
      const balanceAmount = loanAmount - initialDeposit;

      const monthlyInterest = interestRate / 12 / 100;
      const totalInstallments = loanPeriod * 12;
      const adj = Math.pow((1 + monthlyInterest), totalInstallments);

      const monthlyPayment = calculateMonthlyPayment(balanceAmount, monthlyInterest, totalInstallments);
      const totalLoanCost = monthlyPayment * totalInstallments;
      const totalInterest = totalLoanCost - balanceAmount;

      $('#monthlyPaymentCell').text(currencyFormat(monthlyPayment));
      $('#totalInstallmentCell').text(totalInstallments);
      $('#totalInterestCell').text(currencyFormat(totalInterest));
      $('#totalLoanCostCell').text(currencyFormat(totalLoanCost));

      let beginningBalance = balanceAmount;
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
        //console.log(i, beginningBalance, monthlyPayment, monthlyPrincipalAmt, monthlyInterestAmt, endingBalance);
        beginningBalance = endingBalance;
      }
    });

    /*
    Add new page for monthly plan, loan
    */
  </script>
@endsection
