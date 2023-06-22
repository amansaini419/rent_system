@extends('layouts.master')

@section('title')
  View Subadmin
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
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-user-alt-4 bg-c-orenge"></i>
          <div class="d-inline">
            <h4>View Subadmin</h4>
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
            <li class="breadcrumb-item"><a href="{{ route('subadmin-list') }}">Subadmin</a></li>
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
                  <table class="table user-table m-0">
                    <tbody>
                      <tr>
                        <th>Admin Name</th>
                        <td>{{ $subadmin->name }}</td>
                      </tr>
                      <tr>
                        <th>Admin Type</th>
                        <td>{{ $subadmin->user_type }}</td>
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
                        <th>Admin Email</th>
                        <td>{{ $subadmin->email }}</td>
                      </tr>
                      <tr>
                        <th>Admin Phone No.</th>
                        <td>{{ $subadmin->phone_number }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="card">
          <div class="card-header">
            <h5 class="sub-title d-block border-0">All tenants</h5>
          </div>
          <div class="card-block">
            <div class="dt-responsive table-responsive">
              <table id="dataTable" class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th>Tenant ID</th>
                    <th>Tenant Email</th>
                    <th>Tenant Name</th>
                    <th>Tenant Phone No.</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Abc Xyz</td>
                    <td>dsd</td>
                    <td>7657657</td>
                    <td>
                      <a href="{{ route('tenant-view', ['id' => 1]) }}" class="btn btn-sm btn-primary">VIEW</a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Abc Xyz</td>
                    <td>dsd</td>
                    <td>765889956</td>
                    <td>
                      <a href="{{ route('tenant-view', ['id' => 2]) }}" class="btn btn-sm btn-primary">VIEW</a>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Abc Xyz</td>
                    <td>dsd</td>
                    <td>586568789</td>
                    <td>
                      <a href="{{ route('tenant-view', ['id' => 3]) }}" class="btn btn-sm btn-primary">VIEW</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> --}}
        <div class="card">
          <div class="card-header">
            <h5 class="sub-title d-block border-0">All Applications</h5>
          </div>
          <div class="card-block">
            <div class="dt-responsive table-responsive">
              <table id="dataTable" class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th>Application ID</th>
                    <th>Tenant Name</th>
                    <th>Application Type</th>
                    <th>Application Status</th>
                    <th>Initial Deposit</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($applications as $application)
                    <tr>
                      <td>{{ $application->application_code }}</td>
                      <td>{{ $application->tenant_name }}</td>
                      <td>{{ $application->application_type }}</td>
                      <td>{{ $application->application_status }}</td>
                      <td>{{ $application->initial_deposit }}</td>
                      <td><a href="{{ route('application-view', ['id' => $application->application_code]) }}" class="btn btn-sm btn-primary" target="_blank">VIEW</a></td>
                    </tr>
                  @endforeach
                  {{-- <tr>
                    <td>GHYGDSHABDH</td>
                    <td>RENEW</td>
                    <td>PENDING</td>
                    <td>0</td>
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
                    <td>
                      <a href="{{ route('application-view', ['status' => 'LOAN_CLOSED', 'id' => 1]) }}"
                        class="btn btn-sm btn-primary">VIEW</a>
                    </td>
                  </tr> --}}
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
                    <th>Tenant Name</th>
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
                      <td>{{ $loan->loan_code }}</td>
                      <td>{{ $loan->tenant_name }}</td>
                      <td>{{ $loan->starting_date }}</td>
                      <td>{{ $loan->loan_amount }}</td>
                      <td>{{ $loan->interest_rate }}</td>
                      <td>{{ $loan->monthly_payment }}</td>
                      <td>{{ $loan->total_installment }}</td>
                      <td><a href="{{ route('loan-view', ['id' => $loan->loan_code]) }}" class="btn btn-sm btn-primary" target="_blank">VIEW</a></td>
                    </tr>
                  @endforeach
                  {{-- <tr>
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
                  </tr> --}}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection