@extends('layouts.master')

@section('title')
  View Application
@endsection

@section('own-style')
<style>
  .table td, .table th{
    width: 50%;
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
            <li class="breadcrumb-item"><a href="{{ route('application-all') }}">Application</a></li>
            <li class="breadcrumb-item"><a href="#!">View</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="row">
      <div class="col-lg-12">
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
                              <table class="table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.first_name') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.other_names')  }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.surname')  }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.gender')  }}</th>
                                    <td>Female</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.dob') }}</th>
                                    <td>October 25th, 1990</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.marital_status') }}</th>
                                    <td>Single</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.current_location')  }}</th>
                                    <td>Ghana</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.whatsapp_number') }}</th>
                                    <td><a href="#!">4567891</a></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.social_media_handles')  }}</th>
                                    <td>@xyz</td>
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
                <h5 class="sub-title d-block border-0">{{ __('application.employment_heading')  }}</h5>
              </div>
              <div class="card-block">
                <div class="view-info">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="general-info">
                        <div class="row">
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.employment_status') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.company_name')  }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.monthly_net_income')  }}</th>
                                    <td>Single</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.outstanding_loan') }}</th>
                                    <td>Ghana</td>
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
                              <table class="table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.emergency_fullname') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.emergency_relation') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.emergency_number') }}</th>
                                    <td>Single</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.emergency_location') }}</th>
                                    <td>Ghana</td>
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
                              <table class="table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.currenct_accommodation_status') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.property_location') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.property_type') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.monthly_rent') }}</th>
                                    <td>Female</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.rent_years') }}</th>
                                    <td>Single</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.expected_movein_date') }}</th>
                                    <td>Ghana</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.payback_months') }}</th>
                                    <td><a href="#!">4567891</a></td>
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
                              <table class="table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.upload_profile_picture') }}</th>
                                    <td><a href="!#">FILE</a></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.ghana_card') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.upload_ghana_card') }}</th>
                                    <td><a href="!#">FILE</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-lg-12 col-xl-6">
                            <div class="table-responsive">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.upload_bank_statement') }}</th>
                                    <td><a href="!#">FILE</a></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.upload_employment_letter') }}</th>
                                    <td><a href="!#">FILE</a></td>
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
                              <table class="table m-0">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ __('application.landlord_name') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.landlord_number') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.landlord_address') }}</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ __('application.landlord_email') }}</th>
                                    <td>Female</td>
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
@endsection
