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
            <p>(FOR ALL)</p>
            <div class="row">
              <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table payment-table m-0">
                    <tbody>
                      <tr>
                        <th>Invoice ID</th>
                        <td>1</td>
                      </tr>
                      <tr>
                        <th>Tenant Name</th>
                        <td>Abc Xyz</td>
                      </tr>
                      <tr>
                        <th>Invoice Amount</th>
                        <td>RENEW</td>
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
                        <th>Invoice Date</th>
                        <td>PENDING</td>
                      </tr>
                      <tr>
                        <th>Invoice Type</th>
                        <td>None</td>
                      </tr>
                      <tr>
                        <th>Invoice Status</th>
                        <td></td>
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
                                <th>Payment Id</th>
                                <th>Payment Amount</th>
                                <th>Payment Ref</th>
                                <th>Payment Type</th>
                                <th>payment Date</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>200</td>
                                <td>dgsagv</td>
                                <td>PAYSTACK</td>
                                <td>12-May-2023</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>100</td>
                                <td>dgsagv</td>
                                <td>OFFLINE</td>
                                <td>11-May-2023</td>
                              </tr>
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

  <div class="modal fade" id="assignApplicationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Assign Application</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label>Select Staff</label>
              <select class="form-control">
                <option>Staff 1</option>
                <option>Staff 2</option>
                <option>Staff 3</option>
              </select>
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-success waves-effect waves-light text-uppercase">Assign</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="reviewApplicationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Review Application</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <button type="button" class="btn btn-success waves-effect waves-light text-uppercase">Send for
                approval</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="rejectApplicationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reject Application</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label>Remark</label>
              <textarea class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-danger waves-effect waves-light text-uppercase">Reject</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="approveApplicationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Approve Application</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <button type="button" class="btn btn-success waves-effect waves-light text-uppercase">Approved</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="monthlyPlanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width: 90%;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Monthly Plan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="startingDate">Starting Date</label>
              <input type="text" name="startingDate" id="startingDate" class="form-control date-dropper">
            </div>
            <div class="form-group">
              <label for="loanAmount">Loan Amount</label>
              <input type="text" name="loanAmount" id="loanAmount" class="form-control">
            </div>
            <div class="form-group">
              <label for="interestRate">Annual Interest Rate</label>
              <input type="text" name="interestRate" id="interestRate" class="form-control">
            </div>
            <div class="form-group">
              <label for="loanPeriod">Loan Period in years</label>
              <select name="loanPeriod" id="loanPeriod" class="form-control">
                <option value="1">1 year</option>
                <option value="2">2 years</option>
              </select>
            </div>
            <div class="form-group">
              <button type="button" id="generateBtn"
                class="btn btn-success waves-effect waves-light text-uppercase">generate</button>
              <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
            </div>
            <hr />
            <div class="table-responsive" style="max-width: 300px;">
              <table class="table table-bordered">
                <tr>
                  <th>Monthly Payment</th>
                  <td id="monthlyPaymentCell">0</td>
                </tr>
                <tr>
                  <th>Number of Payments</th>
                  <td id="totalInstallmentCell">0</td>
                </tr>
                <tr>
                  <th>Initital Deposit</th>
                  <td id="initialDepositCell">100.00</td>
                </tr>
                <tr>
                  <th>Total Interest</th>
                  <td id="totalInterestCell">0</td>
                </tr>
                <tr>
                  <th>Total Cost of Loan</th>
                  <td id="totalLoanCostCell">0</td>
                </tr>
              </table>
            </div>
            <div class="table-responsive">
              <table class="table" id="monthlyPlanTable">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Payment Date</th>
                    <th>Beginning Balance</th>
                    <th>Payment</th>
                    <th>Principal</th>
                    <th>Interest</th>
                    <th>Ending Balance</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <hr />
            <div class="form-group">
              <button type="button" id="createLoanBtn"
                class="btn btn-success waves-effect waves-light text-uppercase">create loan</button>
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
      $('#monthlyPlanTable tbody').empty();

      const startingDate =  $('#startingDate').val();
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
      for(let i=1; i<=totalInstallments; i++){
        moment(startingDate).add(i, 'months');
        const monthlyInterestAmt = calculateSI(beginningBalance, interestRate, loanPeriod/12);
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