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
    .table.application-table td,
    .table.application-table th {
      width: 50%;
    }

    .dd-w,
    .sp-container {
      z-index: 100000000010 !important;
    }

    .document-img-block{
      display: block;
      width: 100%;
      height: 200px;
    }
    .document-img-block img{
      height: 100%;
      object-fit: contain;
    }
    .after-generate{
      display: none;
    }
  </style>
@endsection

@section('content')
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-file-alt bg-c-orenge"></i>
          <div class="d-inline">
            <h4>View Application</h4>
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
            <li class="breadcrumb-item"><a href="{{ route('application-list') }}">Application</a></li>
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
                  <table class="table table-bordered application-table m-0">
                    <tbody>
                      <tr>
                        <th>Application ID</th>
                        <td>{{ $application->application_code }}</td>
                      </tr>
                      <tr>
                        <th>Application Type</th>
                        <td>{{ $application->application_type }}</td>
                      </tr>
                      <tr>
                        <th>Initial Deposit</th>
                        <td>{{ $application->initial_deposit }}</td>
                      </tr>
                      <tr>
                        <th>Application Status</th>
                        <td>{{ $application->application_status }}</td>
                      </tr>
                      <tr>
                        <th>Staff Assigned</th>
                        <td>{{ $application->subadmin_id }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="table-responsive">
                  <table class="table table-bordered application-table m-0">
                    <tbody>
                      <tr>
                        <th>Tenant Email</th>
                        <td>{{ $tenant->email }}</td>
                      </tr>
                      <tr>
                        <th>Tenant Phone Number</th>
                        <td>{{ $tenant->phone_number }}</td>
                      </tr>
                      <tr>
                        <th>Staff Remark</th>
                        <td style="white-space: break-spaces;">{{ $application->application_remark }}</td>
                      </tr>
                      <tr>
                        <th>Admin Remark</th>
                        <td style="white-space: break-spaces;">{{ $application->admin_remark }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-lg-12">
                @if (Auth::user()->user_type == "ADMIN")
                  @if ($application->application_status == "PENDING")
                    <button type="button" class="btn btn-sm btn-success waves-effect md-trigger text-uppercase" data-toggle="modal" data-target="#assignApplicationModal">assign staff</button>
                  @elseif ($application->application_status == "VERIFIED")
                    <button type="button" class="btn btn-sm btn-danger waves-effect md-trigger text-uppercase" data-toggle="modal" data-target="#rejectApplicationModal">reject application</button>
                    <button type="button" class="btn btn-sm btn-success waves-effect md-trigger text-uppercase" data-toggle="modal" data-target="#approveApplicationModal">approve application</button>
                  @endif
                @elseif ( (Auth::user()->user_type == "STAFF" || Auth::user()->user_type == "AGENT") && $application->application_status == "UNDER_VERIFICATION" )
                  <button type="button" class="btn btn-sm btn-success waves-effect md-trigger text-uppercase" data-toggle="modal" data-target="#reviewApplicationModal">send for approval</button>
                @endif
                
                @if ($application->application_status == "APPROVED")
                  <button type="button" class="btn btn-sm btn-success waves-effect md-trigger text-uppercase monthly-plan-modal-btn" data-toggle="modal" data-target="#monthlyPlanModal">monthly plan</button>
                @endif
                <a href="{{ route('application-register', ['id' => $application->application_code]) }}" class="btn btn-sm btn-primary waves-effect md-trigger text-uppercase">update application</a>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-header card">
          <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#appData" role="tab">{{ __('application.tab1') }}</a>
              <div class="slide"></div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#accData" role="tab">{{ __('application.tab2') }}</a>
              <div class="slide"></div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#docData" role="tab">{{ __('application.tab3') }}</a>
              <div class="slide"></div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#landData" role="tab">{{ __('application.tab4') }}</a>
              <div class="slide"></div>
            </li>
          </ul>
        </div>
        <div class="tab-content">
          <div class="tab-pane active" id="appData" role="tabpanel">
            <div class="card">
              <div class="card-header">
                <h5 class="sub-title d-block border-0">{{ __('application.personal_heading') }}</h5>
              </div>
              <div class="card-block">
                <div class="view-info">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="general-info">
                        <div class="row">
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered application-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.first_name') }}</th>
                                    <td>{{ $applicationData->first_name }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.other_names') }}</th>
                                    <td>{{ $applicationData->others_name }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.surname') }}</th>
                                    <td>{{ $applicationData->surname }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.gender') }}</th>
                                    <td>{{ $applicationData->gender }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.dob') }}</th>
                                    <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatDate($applicationData->date_of_birth) !!}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered application-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.marital_status') }}</th>
                                    <td>{{ $applicationData->marital_status }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.current_location') }}</th>
                                    <td>{{ $applicationData->current_location }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.whatsapp_number') }}</th>
                                    <td>{{ $applicationData->whatsapp_number }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.social_media_handles') }}</th>
                                    <td>{{ $applicationData->social_media_handles }}</td>
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
            <div class="card">
              <div class="card-header">
                <h5 class="sub-title d-block border-0">{{ __('application.employment_heading') }}</h5>
              </div>
              <div class="card-block">
                <div class="view-info">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="general-info">
                        <div class="row">
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered application-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.employment_status') }}</th>
                                    <td>{{ $applicationData->employment_status }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.company_name') }}</th>
                                    <td>{{ $applicationData->company_name }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered application-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.monthly_net_income') }}</th>
                                    <td>{{ $applicationData->monthly_net_income }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.outstanding_loan') }}</th>
                                    <td>{{ $applicationData->outstanding_loan }}</td>
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
            <div class="card">
              <div class="card-header">
                <h5 class="sub-title d-block border-0">{{ __('application.emergency_heading') }}</h5>
              </div>
              <div class="card-block">
                <div class="view-info">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="general-info">
                        <div class="row">
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered application-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.emergency_fullname') }}</th>
                                    <td>{{ $applicationData->emergency_contact_name }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.emergency_relation') }}</th>
                                    <td>{{ $applicationData->emergency_contact_relation }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered application-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.emergency_number') }}</th>
                                    <td>{{ $applicationData->emergency_contact_number }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.emergency_location') }}</th>
                                    <td>{{ $applicationData->emergency_contact_location }}</td>
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
          <div class="tab-pane" id="accData" role="tabpanel">
            <div class="card">
              <div class="card-header">
                <h5 class="sub-title d-block border-0">&nbsp;</h5>
              </div>
              <div class="card-block">
                <div class="view-info">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="general-info">
                        <div class="row">
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered application-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.currenct_accommodation_status') }}</th>
                                    <td>{{ $accomodationData->current_accommodation_status }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.property_location') }}</th>
                                    <td>{{ $accomodationData->property_location }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.property_type') }}</th>
                                    <td>{{ $accomodationData->property_type }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.monthly_rent') }}</th>
                                    <td>{{ $accomodationData->monthly_rent }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered application-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.rent_years') }}</th>
                                    <td>{{ $accomodationData->total_rent_years }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.expected_movein_date') }}</th>
                                    <td>{!! app('App\Http\Controllers\Common\FunctionController')->formatDate($accomodationData->expected_movein_date) !!}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.payback_months') }}</th>
                                    <td>{{ $accomodationData->total_payback_months }}</td>
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
          <div class="tab-pane" id="docData" role="tabpanel">
            <div class="card">
              <div class="card-header">
                <h5 class="sub-title d-block border-0">&nbsp;</h5>
              </div>
              <div class="card-block">
                <div class="view-info">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="general-info">
                        <div class="row">
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered document-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.upload_profile_picture') }}</th>
                                  </tr>
                                  <tr>
                                    <td class="border-0">
                                      @if ($documentData->passport_picture_path != NULL)
                                      <a href="{{ url($documentData->passport_picture_path) }}" target="_blank" class="document-img-block">
                                        <img src="{{ url($documentData->passport_picture_path) }}" alt="">
                                      </a>
                                      @else
                                      NOT UPLOADED
                                      @endif
                                    </td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.upload_ghana_card') }}</th>
                                  </tr>
                                  <tr>
                                    <td class="border-0">
                                      @if ($documentData->ghana_card_path != NULL)
                                      <a href="{{ url($documentData->ghana_card_path) }}" target="_blank" class="document-img-block">
                                        <img src="{{ url($documentData->ghana_card_path) }}" alt="">
                                      </a>
                                      @else
                                      NOT UPLOADED
                                      @endif
                                    </td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.ghana_card') }}</th>
                                  </tr>
                                  <tr>
                                    <td>{{ $documentData->ghana_card }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered document-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.upload_bank_statement') }}</th>
                                  </tr>
                                  <tr>
                                    <td class="border-0">
                                      @if ($documentData->statement_path != NULL)
                                      <a href="{{ url($documentData->statement_path) }}" target="_blank" class="document-img-block">
                                        <img src="{{ url($documentData->statement_path) }}" alt="">
                                      </a>
                                      @else
                                      NOT UPLOADED
                                      @endif
                                    </td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.upload_employment_letter') }}</th>
                                  </tr>
                                  <tr>
                                    <td class="border-0">
                                      @if ($documentData->employment_letter_path != NULL)
                                      <a href="{{ url($documentData->employment_letter_path) }}" target="_blank" class="document-img-block">
                                        <img src="{{ url($documentData->employment_letter_path) }}" alt="">
                                      </a>
                                      @else
                                      NOT UPLOADED
                                      @endif
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
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="landData" role="tabpanel">
            <div class="card">
              <div class="card-header">
                <h5 class="sub-title d-block border-0">&nbsp;</h5>
              </div>
              <div class="card-block">
                <div class="view-info">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="general-info">
                        <div class="row">
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table table-bordered application-table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.landlord_name') }}</th>
                                    <td>{{ $landlordData->landlord_name }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.landlord_number') }}</th>
                                    <td>{{ $landlordData->landlord_number }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.landlord_address') }}</th>
                                    <td>{{ $landlordData->landlord_address }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.landlord_email') }}</th>
                                    <td>{{ $landlordData->landlord_email }}</td>
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
    </div>
  </div>
  @if (Auth::user()->user_type == "ADMIN")
    @if ($application->application_status == "PENDING")
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
              <form method="POST" action="{{ route('application-assignStaff') }}">
                @csrf
                <div class="form-group">
                  <label>Select Staff</label>
                  <select class="form-control" name="staffId">
                    @foreach ($allStaff as $staff)
                      <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <input type="hidden" name="applicationId" value="{{ $application->id }}">
                  <button type="submit" class="btn btn-success waves-effect waves-light text-uppercase">Assign</button>
                  <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @elseif ($application->application_status == "VERIFIED")
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
              <form method="POST" action="{{ route('application-reject') }}">
                @csrf
                <div class="form-group">
                  <label>Admin Remark</label>
                  <textarea class="form-control" rows="6" name="adminRemark"></textarea>
                  <input type="hidden" value="{{ $application->id }}" name="applicationId">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-danger waves-effect waves-light text-uppercase">Reject</button>
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
              <form method="POST" action="{{ route('application-approve') }}">
                @csrf
                <div class="form-group">
                  <label>Admin Remark</label>
                  <textarea class="form-control" rows="6" name="adminRemark"></textarea>
                  <input type="hidden" value="{{ $application->id }}" name="applicationId">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success waves-effect waves-light text-uppercase">Approved</button>
                  <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endif
  @elseif ( (Auth::user()->user_type == "STAFF" || Auth::user()->user_type == "AGENT") && $application->application_status == "UNDER_VERIFICATION" )
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
            <form method="POST" action="{{ route('application-sendForApproval') }}">
              @csrf
              <div class="form-group">
                <label>Remark</label>
                <textarea class="form-control" rows="6" name="applicationRemark" required></textarea>
                <input type="hidden" value="{{ $application->id }}" name="applicationId">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success waves-effect waves-light text-uppercase">Send for
                  approval</button>
                <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endif

  @if ($application->application_status == "APPROVED")
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
            <form method="POST" action={{ route('application-loan') }}>
              @csrf
              <div class="row">
                <div class="col-md-6">
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
                      <option value="0.5">6 Months</option>
                      <option value="1">1 year</option>
                      <option value="2">2 years</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="button" id="generateBtn" class="btn btn-success waves-effect waves-light text-uppercase">generate</button>
                    <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="monthlyPayment">Monthly Payment</label>
                    <input type="text" name="monthlyPayment" id="monthlyPayment" class="form-control" readonly value="0">
                  </div>
                  <div class="form-group">
                    <label for="totalInstallment">Number of Payments</label>
                    <input type="text" name="totalInstallment" id="totalInstallment" class="form-control" readonly value="0">
                  </div>
                  <div class="form-group">
                    <label for="initialDeposit">Initital Deposit</label>
                    <input type="text" name="initialDeposit" id="initialDeposit" class="form-control" readonly value="{{ $application->initial_deposit }}">
                  </div>
                  <div class="form-group">
                    <label for="totalInterest">Total Interest</label>
                    <input type="text" name="totalInterest" id="totalInterest" class="form-control" readonly value="0">
                  </div>
                  <div class="form-group">
                    <label for="totalLoanCost">Total Cost of Loan</label>
                    <input type="text" name="totalLoanCost" id="totalLoanCost" class="form-control" readonly value="0">
                  </div>
                </div>
              </div>
              <hr class="after-generate" />
              <div class="table-responsive after-generate">
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
              <div class="form-group after-generate">
                <input type="hidden" name="applicationId" value="{{ $application->id }}">
                <button type="submit" id="createLoanBtn" class="btn btn-success waves-effect waves-light text-uppercase">create loan</button>
                <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection

@section('theme-script')
  <script type="text/javascript" src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
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

    $(".date-dropper").dateDropper({
      dropWidth: 200,
      dropPrimaryColor: "#1abc9c",
      dropBorder: "1px solid #1abc9c",
      format: "Y/m/d"
    });

    $('.monthly-plan-modal-btn').click(function(){
      $('.after-generate').hide();
    })


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
      const initialDeposit = $('#initialDeposit').val();
      const balanceAmount = loanAmount - initialDeposit;

      const monthlyInterest = interestRate / 12 / 100;
      const totalInstallments = loanPeriod * 12;
      //const adj = Math.pow((1 + monthlyInterest), totalInstallments);

      const monthlyPayment = calculateMonthlyPayment(balanceAmount, monthlyInterest, totalInstallments);
      const totalLoanCost = monthlyPayment * totalInstallments;
      const totalInterest = totalLoanCost - balanceAmount;

      $('#monthlyPayment').val(currencyFormat(monthlyPayment));
      $('#totalInstallment').val(totalInstallments);
      $('#totalInterest').val(currencyFormat(totalInterest));
      $('#totalLoanCost').val(currencyFormat(totalLoanCost));

      let beginningBalance = balanceAmount;
      $('.after-generate').show();
      for (let i = 1; i <= totalInstallments; i++) {
        moment(startingDate).add(i, 'months');
        const monthlyInterestAmt = calculateSI(beginningBalance, interestRate, 1 / 12);
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
  </script>
@endsection
