@extends('layouts.master')

@section('title')
  Applications
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
  @aware(['applicationStatus' => 'all'])

  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-file-alt bg-c-orenge"></i>
          <div class="d-inline">
            <h4>Applications</h4>
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
            <li class="breadcrumb-item"><a href="#!">Applications</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    @if(Auth::user()->user_type == "TENANT")
      <div class="card">
        <div class="card-header">
          <h5>Reapply Application</h5>
        </div>
        <div class="card-block">
          <p>
            <button type="button" class="btn btn-sm btn-primary">NEW PLACE</button>
            <button type="button" class="btn btn-sm btn-primary">EXISTING PLACE</button>
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h5>All Applications</h5>
          <span></span>
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
                @foreach ($applicationStr as $application)
                  <tr>
                    <td>{{ $application->application_code }}</td>
                    <td>{{ $application->application_type }}</td>
                    <td>{{ $application->application_status }}</td>
                    <td>{{ $application->initial_deposit }}</td>
                    <td>{{ $application->subadmin_id }}</td>
                    <td><button type="button" class="btn btn-sm btn-primary text-uppercase initial-deposit-modal" data-applicationId="{{ $application->application_code }}" data-toggle="modal" data-target="#depositModal">Initial Deposit</button></td>
                  </tr>
                @endforeach
                {{-- <tr>
                  <td>GHYGDSHABDH</td>
                  <td>RENEW</td>
                  <td>PENDING</td>
                  <td>0</td>
                  <td>None</td>
                  <td>
                    <a href="{{ route('application-view', ['status' => $applicationStatus, 'id' => 1]) }}"
                      class="btn btn-sm btn-primary">VIEW</a>
                    <button type="button" class="btn btn-sm btn-primary text-uppercase" data-toggle="modal" data-target="#depositModal">Initial Deposit</button>
                  </td>
                </tr>
                <tr>
                  <td>GHYGDSHABDH</td>
                  <td>NEW</td>
                  <td>LOAN_CLOSED</td>
                  <td>0</td>
                  <td>Staff 1</td>
                  <td>
                    <a href="{{ route('application-view', ['status' => $applicationStatus, 'id' => 1]) }}"
                      class="btn btn-sm btn-primary">VIEW</a>
                  </td>
                </tr> --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @elseif (in_array(Auth::user()->user_type, ['ADMIN', 'STAFF', 'AGENT']))
      <div class="card">
        <div class="card-header">
          <h5>All Applications</h5>
          <span></span>
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
                  <th>Staff Assigned</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($applicationStr as $application)
                  <tr>
                    <td>{{ $application->application_code }}</td>
                    <td>{{ $application->tenant_name }}</td>
                    <td>{{ $application->application_type }}</td>
                    <td>{{ $application->application_status }}</td>
                    <td>{{ $application->initial_deposit }}</td>
                    <td>{{ $application->subadmin_id }}</td>
                    <td><a href="{{ route('application-view', ['id' => $application->application_code]) }}" class="btn btn-sm btn-primary" target="_blank">VIEW</a></td>
                  </tr>
                @endforeach
                {{-- <tr>
                  <td>1</td>
                  <td>Abc Xyz</td>
                  <td>RENEW</td>
                  <td>PENDING</td>
                  <td>100</td>
                  <td>None</td>
                  <td>
                    <a href="{{ route('application-view', ['status' => $applicationStatus, 'id' => 1]) }}"
                      class="btn btn-sm btn-primary">VIEW</button>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Abc Xyz</td>
                  <td>NEW</td>
                  <td>UNDER_REVIEW</td>
                  <td>0</td>
                  <td>Staff 1</td>
                  <td>
                    <a href="{{ route('application-view', ['status' => $applicationStatus, 'id' => 1]) }}"
                      class="btn btn-sm btn-primary">VIEW</button>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Abc Xyz</td>
                  <td>NEW</td>
                  <td>APPROVED</td>
                  <td>0</td>
                  <td>Staff 2</td>
                  <td>
                    <a href="{{ route('application-view', ['status' => $applicationStatus, 'id' => 1]) }}"
                      class="btn btn-sm btn-primary">VIEW</button>
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Abc Xyz</td>
                  <td>NEW</td>
                  <td>PENDING</td>
                  <td>0</td>
                  <td>None</td>
                  <td>
                    <a href="{{ route('application-view', ['status' => $applicationStatus, 'id' => 1]) }}"
                      class="btn btn-sm btn-primary">VIEW</button>
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Abc Xyz</td>
                  <td>NEW</td>
                  <td>INCOMPLETE</td>
                  <td>0</td>
                  <td>None</td>
                  <td>
                    <a href="{{ route('application-view', ['status' => $applicationStatus, 'id' => 1]) }}"
                      class="btn btn-sm btn-primary">VIEW</button>
                  </td>
                </tr> --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endif
  </div>

  <div class="modal fade" id="depositModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Initial Deposit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('application-initialDeposit') }}">
            @csrf
            <div class="form-group">
              <label for="depositAmount">Application ID</label>
              <input type="text" name="applicationId" id="applicationId" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="depositAmount">How much initial deposit you want to do?</label>
              <input type="text" name="depositAmount" id="depositAmount" class="form-control" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success waves-effect waves-light text-uppercase">Deposit</button>
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
    $(document).on('click', '.initial-deposit-modal', function(e){
      e.preventDefault();
      const applicationId = $(this).attr('data-applicationId');
      $('#applicationId').val(applicationId);
    });
    $('#dataTable').DataTable({
      "ordering": false
    });
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
