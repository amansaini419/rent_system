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
          <i class="icofont icofont-file-alt bg-c-orenge"></i>
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
            <p>(ONLY FOR ADMINS)</p>
            <div class="row">
              <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table user-table m-0">
                    <tbody>
                      <tr>
                        <th>Tenant ID</th>
                        <td>1</td>
                      </tr>
                      <tr>
                        <th>Tenant Name</th>
                        <td>Abc Xyz</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table user-table m-0">
                    <tbody>
                      <tr>
                        <th>Tenant Email</th>
                        <td>abc@xyz</td>
                      </tr>
                      <tr>
                        <th>Tenant Phone No.</th>
                        <td>5435435</td>
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
                    <th>Initial Deposit</th>
                    <th>Staff Assigned</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>GHYGDSHABDH</td>
                    <td>RENEW</td>
                    <td>PENDING</td>
                    <td>0</td>
                    <td>None</td>
                    <td>
                      <a href="{{ route('application-view', ['status' => 'PENDING', 'id' => 1]) }}"
                        class="btn btn-sm btn-primary">VIEW</a>
                    </td>
                  </tr>
                  <tr>
                    <td>GHYGDSHABDH</td>
                    <td>NEW</td>
                    <td>LOAN_CLOSED</td>
                    <td>0</td>
                    <td>Staff 1</td>
                    <td>
                      <a href="{{ route('application-view', ['status' => 'LOAN_CLOSED', 'id' => 1]) }}"
                        class="btn btn-sm btn-primary">VIEW</a>
                    </td>
                  </tr>
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
                  <tr>
                    <td>ABCDGIH</td>
                    <td>16-Jun-2023</td>
                    <td>10,000</td>
                    <td>24%</td>
                    <td>640</td>
                    <td>12</td>
                    <td>
                      <a href="{{ route('loan-view', ['status' => '$loanStatus', 'id' => 1]) }}"
                        class="btn btn-sm btn-primary">VIEW</a>
                    </td>
                  </tr>
                  <tr>
                    <td>DSHDVBH</td>
                    <td>16-Jun-2023</td>
                    <td>10,000</td>
                    <td>24%</td>
                    <td>640</td>
                    <td>12</td>
                    <td>
                      <a href="{{ route('loan-view', ['status' => '$loanStatus', 'id' => 2]) }}"
                        class="btn btn-sm btn-primary">VIEW</a>
                    </td>
                  </tr>
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
