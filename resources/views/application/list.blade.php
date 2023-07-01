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
          <i class="icofont icofont-files bg-c-orenge"></i>
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
      @if ($latestApplicationStatus == "LOAN_CLOSED")
        <div class="card">
          <div class="card-header">
            <h5>Reapply Application</h5>
          </div>
          <div class="card-block">
            <form method="POST" action="{{ route('application-reapply') }}">
              @csrf
              <div class="form-group">
                <div class="form-radio">
                  <div class="radio radiofill radio-inline">
                    <label>
                        <input type="radio" name="applicationType" value="NEW" checked="checked">
                        <i class="helper"></i>New Place
                    </label>
                  </div>
                  <div class="radio radiofill radio-inline">
                    <label>
                        <input type="radio" name="applicationType" value="RENEW">
                        <i class="helper"></i>Existing Place
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary text-uppercase">submit</button>
              </div>
            </form>
          </div>
        </div>
      @endif
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
                  {{-- <th>Initial Deposit</th> --}}
                  <th>Staff Assigned</th>
                  {{-- <th>Action</th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($applicationStr as $application)
                  <tr>
                    <td>{{ $application->application_code }}</td>
                    <td>{{ $application->application_type }}</td>
                    <td>{{ $application->application_status }}</td>
                    {{-- <td>{{ $application->initial_deposit }}</td> --}}
                    <td>{{ $application->subadmin_id }}</td>
                    {{-- <td>
                      @if ($application->application_status == "PENDING")
                      <button type="button" class="btn btn-sm btn-primary text-uppercase initial-deposit-modal" data-applicationId="{{ $application->application_code }}" data-toggle="modal" data-target="#depositModal">Initial Deposit</button>
                      @endif
                    </td> --}}
                  </tr>
                @endforeach
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
                  {{-- <th>Initial Deposit</th> --}}
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
                    {{-- <td>{{ $application->initial_deposit }}</td> --}}
                    <td>{{ $application->subadmin_id }}</td>
                    <td>
                      <a href="{{ route('application-edit', ['id' => $application->application_code]) }}" class="btn btn-sm btn-primary">EDIT</a>
                      <a href="{{ route('application-view', ['id' => $application->application_code]) }}" class="btn btn-sm btn-primary" target="_blank">VIEW</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endif
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
