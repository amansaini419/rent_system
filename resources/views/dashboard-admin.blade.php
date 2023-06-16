@section('content')
  <div class="page-body">
    <div class="row">
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-pie-chart bg-c-blue card1-icon"></i>
            <span class="text-c-blue f-w-600">Week's Applications</span>
            <h4>678</h4>
            <div>
              <a href="{{ route('application-list') }}" class="f-right m-t-10">Read More >>></a>
            </div>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-ui-home bg-c-pink card1-icon"></i>
            <span class="text-c-pink f-w-600">Month's Applications</span>
            <h4>1,678</h4>
            <div>
              <a href="{{ route('application-list') }}" class="f-right m-t-10">Read More >>></a>
            </div>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-warning-alt bg-c-green card1-icon"></i>
            <span class="text-c-green f-w-600">Quarter's Applications</span>
            <h4>4,600</h4>
            <div>
              <a href="{{ route('application-list') }}" class="f-right m-t-10">Read More >>></a>
            </div>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-social-twitter bg-c-yellow card1-icon"></i>
            <span class="text-c-yellow f-w-600">Year's Applications</span>
            <h4>8,678</h4>
            <div>
              <a href="{{ route('application-list') }}" class="f-right m-t-10">Read More >>></a>
            </div>
          </div>
        </div>
      </div>
      <!-- card1 end -->
    </div>

    <div class="row">
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-pie-chart bg-c-blue card1-icon"></i>
            <span class="text-c-blue f-w-600">Year's Registration Fees</span>
            <h4>GHs 2,500</h4>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-ui-home bg-c-pink card1-icon"></i>
            <span class="text-c-pink f-w-600">Year's Rent Disbursement</span>
            <h4>GHs 83,000</h4>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-warning-alt bg-c-green card1-icon"></i>
            <span class="text-c-green f-w-600">Year's Re-payments</span>
            <h4>GHs 123,000</h4>
          </div>
        </div>
      </div>
      <!-- card1 end -->
      <!-- card1 start -->
      <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
          <div class="card-block-small">
            <i class="icofont icofont-social-twitter bg-c-yellow card1-icon"></i>
            <span class="text-c-yellow f-w-600">Year's Approved Applications</span>
            <h4>5,678</h4>
          </div>
        </div>
      </div>
      <!-- card1 end -->
    </div>

    <div class="row">
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Approved vs Pending vs Rejected</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div id="applicationStatusPieChart" class="project-overview-chart" style="height:250px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Approved: Gender Chart</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div id="genderPieChart" class="project-overview-chart" style="height:250px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview">
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
                      <th>55</th>
                    </tr>
                    <tr>
                      <td>Paid Rent</td>
                      <th>15</th>
                    </tr>
                    <tr>
                      <td>Outstanding Rent</td>
                      <th>40</th>
                    </tr>
                    <tr>
                      <td>Zero Payment</td>
                      <th>25</th>
                    </tr>
                    <tr>
                      <td>Partial Payment</td>
                      <th>15</th>
                    </tr>
                  </table>
                  <div>
                    <a href="{{ route('application-list') }}" class="f-right m-t-10">Read More >>></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview">
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
                    <li><a href="{{ route('application-list') }}" class="f-left m-t-10">New Registration</a></li>
                    <li><a href="{{ route('application-list') }}" class="f-left m-t-10">Review Registration</a></li>
                    <li><a href="{{ route('application-list') }}" class="f-left m-t-10">Accept Payment</a></li>
                    <li><a href="{{ route('application-list') }}" class="f-left m-t-10">Payment List</a></li>
                    <li><a href="{{ route('application-list') }}" class="f-left m-t-10">Applicant List</a></li>
                    <li><a href="{{ route('application-list') }}" class="f-left m-t-10">Reports</a></li>
                    <li><a href="{{ route('application-list') }}" class="f-left m-t-10">Check Outstanding</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-xl-9">
        <div class="card card-overview">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Last 50 Registrations</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div class="table-responsive" style="height:250px;">
                    <table class="table table-bordered m-0">
                      <tr>
                        <th>Full Name</th>
                        <th>Date Registerred</th>
                        <th>Status</th>
                        <th>Account Type</th>
                        <th>Link</th>
                      </tr>
                      <tr>
                        <td>Mr. Yaw Julius</td>
                        <td>02-Mar-2023</td>
                        <td>Pending</td>
                        <td>2-bedroom</td>
                        <td><a href="#">View</a></td>
                      </tr>
                      <tr>
                        <td>Mr. Yaw Julius</td>
                        <td>02-Mar-2023</td>
                        <td>Rejected</td>
                        <td>Single</td>
                        <td><a href="#">View</a></td>
                      </tr>
                    </table>
                  </div>
                  <div>
                    <a href="{{ route('application-list') }}" class="m-t-10 btn btn-primary btn-sm">View More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Approved vs Pending vs Rejected<br>Last 50</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div id="applicationStatusLast50PieChart" class="project-overview-chart" style="height:250px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-xl-9">
        <div class="card card-overview">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Last 50 Rent Payments</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div class="table-responsive" style="height:250px;">
                    <table class="table table-bordered m-0">
                      <tr>
                        <th>Full Name</th>
                        <th>Date Paid</th>
                        <th>Channel</th>
                        <th>Amount Paid</th>
                        <th>Link</th>
                      </tr>
                      <tr>
                        <td>Mr. Yaw Julius</td>
                        <td>02-Mar-2023</td>
                        <td>MoMo</td>
                        <td>GHs 1,800</td>
                        <td><a href="#">View</a></td>
                      </tr>
                      <tr>
                        <td>Mr. Yaw Julius</td>
                        <td>02-Mar-2023</td>
                        <td>Cash</td>
                        <td>GHs 1,500</td>
                        <td><a href="#">View</a></td>
                      </tr>
                    </table>
                  </div>
                  <div>
                    <a href="{{ route('application-list') }}" class="m-t-10 btn btn-primary btn-sm">View More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="card card-overview">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Payment Channel<br>MoMo vs Cash vs Card</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div id="paymentChannelPieChart" class="project-overview-chart" style="height:250px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-xl-12">
        <div class="card card-overview">
          <div class="card-header">
            <div class="card-header-left">
              <h5>Last 50 Outstanding Rent Payments</h5>
            </div>
          </div>
          <div class="card-block">
            <div class="m-b-50">
              <div class="row justify-content-md-center">
                <div class="col-sm-12">
                  <div class="table-responsive" style="height:250px;">
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
                      <tr>
                        <td>Mr. Yaw Julius</td>
                        <td>2-Bedroom</td>
                        <td>01-Mar-2023</td>
                        <td>4</td>
                        <td>YES</td>
                        <td>GHs 1,800</td>
                        <td><a href="#">View</a></td>
                      </tr>
                      <tr>
                        <td>Miss Lady Mends</td>
                        <td>Single Room</td>
                        <td>01-Mar-2023</td>
                        <td>10</td>
                        <td>YES</td>
                        <td>GHs 1,500</td>
                        <td><a href="#">View</a></td>
                      </tr>
                    </table>
                  </div>
                  <div>
                    <a href="{{ route('application-list') }}" class="m-t-10 btn btn-primary btn-sm">View More</a>
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

@section('theme-script')
  <script src="{{ asset('assets/pages/widget/amchart/amcharts.js') }}"></script>
  <script src="{{ asset('assets/pages/widget/amchart/pie.js') }}"></script>
  {{-- <script type="text/javascript" src="{{ asset('assets/pages/widget/custom-widget1.js') }}"></script> --}}
@endsection

@section('own-script')
  <script>
    const applicationStatusPieChart = AmCharts.makeChart("applicationStatusPieChart", {
      "type": "pie",
      "hideCredits": true,
      "theme": "light",
      "dataProvider": [{
        "country": "Approved",
        "color": '#93be52',
        "value": 201
      }, {
        "country": "Rejected",
        "color": '#Fb5959',
        "value": 65
      }, {
        "country": "Pending",
        "color": '#FFB64D',
        "value": 39
      }],
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
    });

    const genderPieChart = AmCharts.makeChart("genderPieChart", {
      "type": "pie",
      "hideCredits": true,
      "theme": "light",
      "dataProvider": [{
        "country": "Male",
        "color": '#4680ff',
        "value": 201
      }, {
        "country": "Fenmale",
        "color": '#ef67a4',
        "value": 65
      }],
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
    });

    const applicationStatusLast50PieChart = AmCharts.makeChart("applicationStatusLast50PieChart", {
      "type": "pie",
      "hideCredits": true,
      "theme": "light",
      "dataProvider": [{
        "country": "Approved",
        "color": '#93be52',
        "value": 201
      }, {
        "country": "Rejected",
        "color": '#Fb5959',
        "value": 65
      }, {
        "country": "Pending",
        "color": '#FFB64D',
        "value": 39
      }],
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
    });

    const paymentChannelPieChart = AmCharts.makeChart("paymentChannelPieChart", {
      "type": "pie",
      "hideCredits": true,
      "theme": "light",
      "dataProvider": [{
        "country": "MoMo",
        "color": '#93be52',
        "value": 201
      }, {
        "country": "Cash",
        "color": '#Fb5959',
        "value": 65
      }, {
        "country": "Card",
        "color": '#FFB64D',
        "value": 39
      }],
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
    });
  </script>
@endsection
