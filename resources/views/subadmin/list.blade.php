@extends('layouts.master')

@section('title')
  Subadmins
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
  @aware(['applicationStatus' => request('status')])

  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-file-alt bg-c-orenge"></i>
          <div class="d-inline">
            <h4>Subadmins</h4>
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
            <li class="breadcrumb-item"><a href="#!">Subadmins</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="card">
      <div class="card-header">
        <h5>Admins List <a href="{{ route('subadmin-new') }}" class="btn btn-primary btn-sm ml-4 text-uppercase"><i class="ti-plus"></i></a></h5>
      </div>
      <div class="card-block">
        <div class="dt-responsive table-responsive">
          <table id="dataTable" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Admin Email</th>
                <th>Admin Name</th>
                <th>Admin Type</th>
                <th>Admin Phone No.</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($subadminStr as $subadmin)
                <tr>
                  <td>{{ $subadmin->sn }}</td>
                  <td>{{ $subadmin->email }}</td>
                  <td>{{ $subadmin->name }}</td>
                  <td>{{ $subadmin->user_type }}</td>
                  <td>{{ $subadmin->phone_number }}</td>
                  <td>
                    <a href="{{ route('subadmin-view', ['id' => $subadmin->id]) }}" class="btn btn-sm btn-primary">VIEW</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="newSubadmin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Subadmin</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('subadmin-new') }}">
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
