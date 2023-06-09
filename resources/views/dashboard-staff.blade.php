@section('content')
  <div class="page-body">
    <div class="row">
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-files bg-c-blue card1-icon"></i>
            <span class="text-c-blue f-w-600">Today's Applications</span>
            <h4>{{ $weeksApplication }}</h4>
            <div>
              <a href="{{ route('application-list') }}" class="f-right m-t-10 text-primary">Read More >>></a>
            </div>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-files bg-c-pink card1-icon"></i>
            <span class="text-c-pink f-w-600">Week's Applications</span>
            <h4>{{ $weeksApplication }}</h4>
            <div>
              <a href="{{ route('application-list') }}" class="f-right m-t-10 text-primary">Read More >>></a>
            </div>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-files bg-c-green card1-icon"></i>
            <span class="text-c-green f-w-600">Month's Applications</span>
            <h4>{{ $monthsApplication }}</h4>
            <div>
              <a href="{{ route('application-list') }}" class="f-right m-t-10 text-primary">Read More >>></a>
            </div>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-files bg-c-yellow card1-icon"></i>
            <span class="text-c-yellow f-w-600">Year's Applications</span>
            <h4>{{ $yearsApplication }}</h4>
            <div>
              <a href="{{ route('application-list') }}" class="f-right m-t-10 text-primary">Read More >>></a>
            </div>
          </div>
        </div>
      </div>
      <!-- card1 end -->
    </div>

    <div class="row">
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview card-dash">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Approved vs Pending vs Rejected</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div id="applicationStatusPieChart" class="project-overview-chart" style="height: 300px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview card-dash">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Approved: Gender Chart</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div id="genderPieChart" class="project-overview-chart" style="height: 300px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview card-dash">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Current Month</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <table class="table table-bordered m-0">
                    <tr>
                      <td>Total Rents</td>
                      <th>{{ $monthRentPayment->total }}</th>
                    </tr>
                    <tr>
                      <td>Paid Rent</td>
                      <th>{{ $monthRentPayment->paid }}</th>
                    </tr>
                    <tr>
                      <td>Outstanding Rent</td>
                      <th>{{ $monthRentPayment->outstanding }}</th>
                    </tr>
                    <tr>
                      <td>Zero Payment</td>
                      <th>{{ $monthRentPayment->zero }}</th>
                    </tr>
                    <tr>
                      <td>Partial Payment</td>
                      <th>{{ $monthRentPayment->partial }}</th>
                    </tr>
                  </table>
                  <div>
                    <a href="{{ route('application-list') }}" class="f-right m-t-10 text-primary">Read More >>></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview card-dash">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Shortcuts</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row">
                <div class="col-sm-12">
                  <ul class="nav flex-column">
                    <li><a href="{{ route('application-list', ['status' => 'UNDER_VERIFICATION']) }}" class="f-left m-t-10 text-primary"><i class="icofont icofont-thin-right"></i> New Registration</a></li>
                    <li><a href="{{ route('application-list', ['status' => 'APPROVED']) }}" class="f-left m-t-10 text-primary"><i class="icofont icofont-thin-right"></i> Review Registration</a></li>
                    <li><a href="{{ route('payment-outstanding') }}" class="f-left m-t-10 text-primary"><i class="icofont icofont-thin-right"></i> Accept Payment</a></li>
                    <li><a href="{{ route('payment-list') }}" class="f-left m-t-10 text-primary"><i class="icofont icofont-thin-right"></i> Payment List</a></li>
                    <li><a href="{{ route('tenant-list') }}" class="f-left m-t-10 text-primary"><i class="icofont icofont-thin-right"></i> Tenant List</a></li>
                    <li><a href="{{ route('payment-outstanding') }}" class="f-left m-t-10 text-primary"><i class="icofont icofont-thin-right"></i> Check Outstanding</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-xl-9">
      <div class="card card-overview card-dash">
        <div class="card-header">
          <div class="card-header-left">
            <h5>Last 50 Rent Payments</h5>
          </div>
        </div>
        <div class="card-block">
          <div class="m-b-50">
            <div class="row justify-content-md-center">
              <div class="col-sm-12">
                <div class="table-responsive" style="height: 300px;">
                  <table class="table table-bordered m-0">
                    <tr>
                      <th>Full Name</th>
                      <th>Date Paid</th>
                      <th>Channel</th>
                      <th>Amount Paid</th>
                      <th>Link</th>
                    </tr>
                    @foreach ($last50RentPayment as $payment)
                      <tr>
                        <td>{{ $payment->tenant_name }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->payment_channel }}</td>
                        <td>{{ $payment->payment_amount }}</td>
                        <td><a href="#">View</a></td>
                      </tr>
                    @endforeach
                  </table>
                </div>
                <div>
                  <a href="{{ route('payment-list', ['type' => 'RENT']) }}" class="m-t-10 btn btn-primary btn-sm">View More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-3">
      <div class="card card-overview card-dash">
        <div class="card-header">
          <div class="card-header-left">
            <h5>Payment Channel<br>MoMo vs Cash vs Card</h5>
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

  <div class="row">
    <div class="col-md-12 col-xl-12">
      <div class="card card-overview card-dash">
        <div class="card-header">
          <div class="card-header-left">
            <h5>Last 50 Outstanding Rent Payments</h5>
          </div>
        </div>
        <div class="card-block">
          <div class="m-b-50">
            <div class="row justify-content-md-center">
              <div class="col-sm-12">
                <div class="table-responsive" style="height: 300px;">
                  <table class="table table-bordered m-0">
                    <tr>
                      <th>Full Name</th>
                      <th>Account Type</th>
                      <th>Due Date</th>
                      <th>Days Over</th>
                      <th>Penalty</th>
                      <th>New Amount</th>
                      <th>Link</th>
                    </tr>
                    @foreach ($last50OutstandingPayment as $payment)
                      <tr>
                        <td>{{ $payment->tenant_name }}</td>
                        <td>{{ $payment->account_type }}</td>
                        <td>{{ $payment->due_date }}</td>
                        <td>{{ $payment->days_over }}</td>
                        <td>{{ $payment->penalty }}</td>
                        <td>{{ $payment->total_amount }}</td>
                        <td><a href="#">View</a></td>
                      </tr>
                    @endforeach
                  </table>
                </div>
                <div>
                  <a href="{{ route('payment-outstanding') }}" class="m-t-10 btn btn-primary btn-sm">View More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('own-script')
  <script>
    const applicationStatusPieChart = AmCharts.makeChart("applicationStatusPieChart", {
      "type": "pie",
      "hideCredits": true,
      "theme": "light",
      "dataProvider": [{
        "name": "Approved",
        "color": '#93be52',
        "value": {{ $applicationStatusPieChart->approved }}
      }, {
        "name": "Rejected",
        "color": '#Fb5959',
        "value": {{ $applicationStatusPieChart->rejected }}
      }, {
        "name": "Pending",
        "color": '#FFB64D',
        "value": {{ $applicationStatusPieChart->pending }}
      }],
      "legend": {
        "useGraphSettings": false
      },
      "valueField": "value",
      "titleField": "name",
      "labelsEnabled": false,
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

    const genderPieChart = AmCharts.makeChart("genderPieChart", {
      "type": "pie",
      "hideCredits": true,
      "theme": "light",
      "dataProvider": [{
        "name": "Male",
        "color": '#4680ff',
        "value": {{ $genderPieChart->male }}
      }, {
        "name": "Female",
        "color": '#ef67a4',
        "value": {{ $genderPieChart->female }}
      }],
      "legend": {
        "useGraphSettings": false
      },
      "valueField": "value",
      "titleField": "name",
      "labelsEnabled": false,
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

    /* const applicationStatusLast50PieChart = AmCharts.makeChart("applicationStatusLast50PieChart", {
      "type": "pie",
      "hideCredits": true,
      "theme": "light",
      "dataProvider": [{
        "country": "Approved",
        "color": '#93be52',
        "value": {{ $applicationStatusLast50PieChart->approved }}
      }, {
        "country": "Rejected",
        "color": '#Fb5959',
        "value": {{ $applicationStatusLast50PieChart->rejected }}
      }, {
        "country": "Pending",
        "color": '#FFB64D',
        "value": {{ $applicationStatusLast50PieChart->pending }}
      }],
      "legend": {
        "useGraphSettings": false
      },
      "valueField": "value",
      "titleField": "country",
      "labelsEnabled": false,
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
    }); */

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
      "labelsEnabled": false,
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