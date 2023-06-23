@section('content')
  <div class="page-body">
    <div class="row">
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-money bg-c-blue card1-icon"></i>
            <span class="text-c-blue f-w-600 text-uppercase">total to be paid</span>
            <h4>{{ $paymentDetails->total }}</h4>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-money bg-c-pink card1-icon"></i>
            <span class="text-c-pink f-w-600 text-uppercase">initial deposit</span>
            <h4>{{ $paymentDetails->deposit }}</h4>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-money bg-c-green card1-icon"></i>
            <span class="text-c-green f-w-600 text-uppercase">total payments</span>
            <h4>{{ $paymentDetails->payment }}</h4>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-money bg-c-yellow card1-icon"></i>
            <span class="text-c-yellow f-w-600 text-uppercase">outstanding</span>
            <h4>{{ $paymentDetails->outstanding }}</h4>
          </div>
        </div>
      </div>
      <!-- card1 end -->
    </div>

    <div class="row">
      <div class="col-md-6 col-xl-6">
        <div class="card card-overview card-dash">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Outstanding vs Paid</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div id="outstandingPaidPieChart" class="project-overview-chart" style="height: 300px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-6">
        <div class="card card-overview card-dash">
          <div class="card-header">
            <div class="card-header-left">
              <h5>My Payment Channels<br>MoMo vs Cash vs Card</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div id="paymentChannelPieChart" class="project-overview-chart" style="height: 300px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-xl-12">
      <div class="card card-overview card-dash">
        <div class="card-header">
          <div class="card-header-left">
            <h5>My Recent Payments</h5>
          </div>
        </div>
        <div class="card-block">
          <div class="m-b-50">
            <div class="row justify-content-md-center">
              <div class="col-sm-12">
                <div class="table-responsive" style="height: 300px;">
                  <table class="table table-bordered m-0">
                    <tr>
                      <th>Amount</th>
                      <th>Month</th>
                      <th>Due Date</th>
                      <th>Date Paid</th>
                      <th>Balance B/F</th>
                      <th>Note</th>
                      <th>Pay</th>
                    </tr>
                    @foreach ($paymentDetails->recentPaymentsStr as $payment)
                      <tr>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->month }}</td>
                        <td>{{ $payment->due_date }}</td>
                        <td>{{ $payment->date_paid }}</td>
                        <td>{{ $payment->balance_bf }}</td>
                        <td>{{ $payment->note }}</td>
                        <td>
                          @if($payment->pay != 'Paid')
                          <button type="button" class="btn btn-sm btn-link px-0 text-uppercase payment-modal-btn" data-toggle="modal" data-target="#paymentModal" data-payment="{{ $payment->paymentAmount }}" data-penalty="{{ $payment->penaltyAmount }}" data-total="{{ $payment->paymentAmount + $payment->penaltyAmount }}" data-id="{{ md5($payment->id) }}">Pay</button>
                          @else
                          {{ $payment->pay }}
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </table>
                </div>
                <div>
                  <a href="{{ route('loan-view', ['id' => $loan->loan_code]) }}" class="m-t-10 btn btn-primary btn-sm">View More</a>
                </div>
              </div>
            </div>
          </div>
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

    const outstandingPaidPieChart = AmCharts.makeChart("outstandingPaidPieChart", {
      "type": "pie",
      "hideCredits": true,
      "theme": "light",
      "dataProvider": [{
        "name": "Paid",
        "color": '#4680ff',
        "value": {{ $paymentDetails->payment_db }}
      }, {
        "name": "Outstanding",
        "color": '#ef67a4',
        "value": {{ $paymentDetails->outstanding_db }}
      }],
      "legend": {
        "useGraphSettings": false
      },
      "valueField": "value",
      "titleField": "name",
      "labelsEnabled": true,
      "autoMargins": false,
      "marginTop": 0,
      "marginBottom": 0,
      "marginLeft": 0,
      "marginRight": 0,
      "pullOutRadius": 0,
      "colorField": "color",
      "outlineAlpha": 0.9,
      "depth3D": 0,
      "balloonText": "[[title]]",
      "angle": 0,
    });

    const paymentChannelPieChart = AmCharts.makeChart("paymentChannelPieChart", {
      "type": "pie",
      "hideCredits": true,
      "theme": "light",
      "dataProvider": [{
        "name": "MoMo",
        "color": '#93be52',
        "value": {{ $paymentChannelPieChart->MOMO }}
      }, {
        "name": "Cash",
        "color": '#Fb5959',
        "value": {{ $paymentChannelPieChart->CASH }}
      }, {
        "name": "Card",
        "color": '#FFB64D',
        "value": {{ $paymentChannelPieChart->CARD }}
      }],
      "legend": {
        "useGraphSettings": false
      },
      "valueField": "value",
      "titleField": "name",
      "labelsEnabled": true,
      "autoMargins": false,
      "marginTop": 0,
      "marginBottom": 0,
      "marginLeft": 0,
      "marginRight": 0,
      "pullOutRadius": 0,
      "colorField": "color",
      "outlineAlpha": 0.9,
      "depth3D": 0,
      "balloonText": "[[title]]",
      "angle": 0,
    });
  </script>
@endsection