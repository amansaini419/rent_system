@extends('layouts.master')

@section('title')
  Loans List
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
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-file-alt bg-c-orenge"></i>
          <div class="d-inline">
            <h4>Loans</h4>
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
            <li class="breadcrumb-item"><a href="#!">Loans</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="card">
      <div class="card-header">
        <h5>All Loans (for admins)</h5>
        <span></span>
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
              <tr>
                <td>1</td>
                <td>Abc Xyz</td>
                <td>16-Jun-2023</td>
                <td>10,000</td>
                <td>24%</td>
                <td>640</td>
                <td>12</td>
                <td>
                  <a href="{{ route('loan-view', ['id' => 1]) }}" class="btn btn-sm btn-primary">VIEW</a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Abc Xyz</td>
                <td>16-Jun-2023</td>
                <td>10,000</td>
                <td>24%</td>
                <td>640</td>
                <td>12</td>
                <td>
                  <a href="{{ route('loan-view', ['id' => 2]) }}" class="btn btn-sm btn-primary">VIEW</a>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Abc Xyz</td>
                <td>16-Jun-2023</td>
                <td>10,000</td>
                <td>24%</td>
                <td>640</td>
                <td>12</td>
                <td>
                  <a href="{{ route('loan-view', ['id' => 3]) }}" class="btn btn-sm btn-primary">VIEW</a>
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td>Abc Xyz</td>
                <td>16-Jun-2023</td>
                <td>10,000</td>
                <td>24%</td>
                <td>640</td>
                <td>12</td>
                <td>
                  <a href="{{ route('loan-view', ['id' => 4]) }}" class="btn btn-sm btn-primary">VIEW</a>
                </td>
              </tr>
              <tr>
                <td>5</td>
                <td>Abc Xyz</td>
                <td>16-Jun-2023</td>
                <td>10,000</td>
                <td>24%</td>
                <td>640</td>
                <td>12</td>
                <td>
                  <a href="{{ route('loan-view', ['id' => 5]) }}" class="btn btn-sm btn-primary">VIEW</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h5>All Loans (for tenants)</h5>
        <span></span>
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
                  <a href="{{ route('loan-view', ['id' => 1]) }}" class="btn btn-sm btn-primary">VIEW</a>
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
                  <a href="{{ route('loan-view', ['id' => 2]) }}" class="btn btn-sm btn-primary">VIEW</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
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
    $('#dataTable').DataTable();
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
