@extends('layouts.master')

@section('title')
  Application Registration Form
@endsection

@section('theme-style')
  <!--forms-wizard css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/jquery.steps/css/jquery.steps.css') }}">
  <!-- Date-Dropper css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
@endsection

@section('own-style')
  <style>
    .wizard>.content>.body {
      position: relative;
    }
    .displaynone{
      display: none;
    }
    .preview-container{
      margin-top: 10px;
      border: 3px solid black;
      height: 200px;
      width: 100%;
      margin-bottom: 20px;
    }
    .preview-container img{
      height: 100%;
      width: 100%;
      object-fit: contain;
    }
    .icons-alert::before {
      top: 10px;
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
            <h4>Registration Form</h4>
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
            <li class="breadcrumb-item"><a href="{{ route('application-list') }}">Application</a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Register</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>{{-- Form Basic Wizard --}}</h5>
            <span>Instructions of form filling</span>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-md-12">
                <div id="wizard">
                  <section>
                    <div class="wizard-form" id="registrationForm" action="#">
                      <h3>{{ __('application.tab1') }}</h3>
                      <section>
                        <form action="" id="applicationDataForm">
                          <input type="hidden" name="userDataId" value="{{ md5($userDataId) }}">
                          <div class="row">
                            <div class="col-md-12">
                              <h4 class="sub-title">{{ __('application.personal_heading') }}</h4>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="firstName" class="block">{{ __('application.first_name') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="firstName" name="firstName" type="text" class="form-control"
                                    value="{{ $applicationData->first_name }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="otherNames" class="block">{{ __('application.other_names') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="otherNames" name="otherNames" type="text" class="form-control"
                                    value="{{ $applicationData->other_names }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="surname" class="block">{{ __('application.surname') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="surname" name="surname" type="text" class="form-control"
                                    value="{{ $applicationData->surname }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="gender" class="block">{{ __('application.gender') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <select id="gender" name="gender" class="form-control">
                                    <option value="male" {{ $applicationData->gender == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female" {{ $applicationData->gender == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="others" {{ $applicationData->gender == 'others' ? 'selected' : '' }}>Others
                                    </option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="dateOfBirth" class="block">{{ __('application.dob') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="dateOfBirth" name="dateOfBirth" class="form-control date-dropper"
                                    type="text" value="{{ $applicationData->date_of_birth }}" />
                                  {{-- <input id="dateofBirth" name="dateOfBirth" type="hidden"> --}}
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="maritalStatus"
                                    class="block">{{ __('application.marital_status') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <select id="maritalStatus" name="maritalStatus" class="form-control">
                                    <option value="single"
                                      {{ $applicationData->marital_status == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married"
                                      {{ $applicationData->marital_status == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced"
                                      {{ $applicationData->marital_status == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed"
                                      {{ $applicationData->marital_status == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                  </select>
                                  {{-- <div class="form-radio">
                                    <div class="radio radiofill radio-inline">
                                      <label>
                                        <input type="radio" name="maritalStatus" value="single" checked="checked" />
                                        <i class="helper"></i>Single
                                      </label>
                                    </div>
                                    <div class="radio radiofill radio-inline">
                                      <label>
                                        <input type="radio" name="maritalStatus" value="married" />
                                        <i class="helper"></i>Married
                                      </label>
                                    </div>
                                    <div class="radio radiofill radio-inline">
                                      <label>
                                        <input type="radio" name="maritalStatus" value="divorced" />
                                        <i class="helper"></i>Divorced
                                      </label>
                                    </div>
                                    <div class="radio radiofill radio-inline">
                                      <label>
                                        <input type="radio" name="maritalStatus" value="widowed" />
                                        <i class="helper"></i>Widowed
                                      </label>
                                    </div>
                                  </div> --}}
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="currentLocation"
                                    class="block">{{ __('application.current_location') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="currentLocation" name="currentLocation" type="text"
                                    class="form-control" value="{{ $applicationData->current_location }}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="whatsappNumber"
                                    class="block">{{ __('application.whatsapp_number') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="whatsappNumber" name="whatsappNumber" type="text" class="form-control"
                                    value="{{ $applicationData->whatsapp_number }}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="socialMediaHandles"
                                    class="block">{{ __('application.social_media_handles') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <textarea id="socialMediaHandles" rows="5" name="socialMediaHandles" class="form-control">{{ $applicationData->social_media_handles }}</textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <h4 class="mt-5 sub-title">{{ __('application.employment_heading') }}</h4>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="employmentStatus"
                                    class="block">{{ __('application.employment_status') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <select id="employmentStatus" name="employmentStatus" class="form-control">
                                    <option value="Self Employed" {{ $applicationData->employment_status == 'Self Employed' ? 'selected' : '' }}>Self Employed</option>
                                    <option value="Government Employed" {{ $applicationData->employment_status == 'Government Employed' ? 'selected' : '' }}>Government Employed</option>
                                    <option value="Student" {{ $applicationData->employment_status == 'Student' ? 'selected' : '' }}>Student</option>
                                  </select>
                                  {{-- <input id="employmentStatus" name="employmentStatus" type="text"
                                    class="form-control" value="{{ $applicationData->employment_status }}" /> --}}
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="companyName" class="block">{{ __('application.company_name') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="companyName" name="companyName" type="text" class="form-control"
                                    value="{{ $applicationData->company_name }}" />
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="monthlyNetIncome"
                                    class="block">{{ __('application.monthly_net_income') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="monthlyNetIncome" name="monthlyNetIncome" type="text"
                                    class="form-control" value="{{ $applicationData->monthly_net_income }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="outstandingLoan"
                                    class="block">{{ __('application.outstanding_loan') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <select id="outstandingLoan" name="outstandingLoan" class="form-control">
                                    <option value="no"
                                      {{ $applicationData->outstanding_loan == 'no' ? 'selected' : '' }}>No</option>
                                    <option value="yes"
                                      {{ $applicationData->outstanding_loan == 'yes' ? 'selected' : '' }}>Yes</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <h4 class="mt-5 sub-title">{{ __('application.emergency_heading') }}</h4>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="emergencyContactName"
                                    class="block">{{ __('application.emergency_fullname') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="emergencyContactName" name="emergencyContactName" type="text"
                                    class="form-control" value="{{ $applicationData->emergency_contact_name }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="emergencyContactRelation"
                                    class="block">{{ __('application.emergency_relation') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="emergencyContactRelation" name="emergencyContactRelation" type="text"
                                    class="form-control" value="{{ $applicationData->emergency_contact_relation }}" />
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="emergencyContactNumber"
                                    class="block">{{ __('application.emergency_number') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="emergencyContactNumber" name="emergencyContactNumber" type="text"
                                    class="form-control" value="{{ $applicationData->emergency_contact_number }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="emergencyContactLocation"
                                    class="block">{{ __('application.emergency_location') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="emergencyContactLocation" name="emergencyContactLocation" type="text"
                                    class="form-control" value="{{ $applicationData->emergency_contact_location }}" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </section>
                      <h3>{{ __('application.tab2') }}</h3>
                      <section>
                        <form action="" id="accomodationDataForm">
                          <input type="hidden" name="userDataId" value="{{ md5($userDataId) }}">
                          <div class="row">
                            <div class="col-md-6">
                              {{-- <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="currentAccommodationStatus"
                                    class="block">{{ __('application.currenct_accommodation_status') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="currentAccommodationStatus" name="currentAccommodationStatus"
                                    type="text" class="form-control"
                                    value="{{ $accomodationData->current_accommodation_status }}" />
                                </div>
                              </div> --}}
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="propertyLocation"
                                    class="block">{{ __('application.property_location') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="propertyLocation" name="propertyLocation" type="text"
                                    class="form-control" value="{{ $accomodationData->property_location }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="propertyType"
                                    class="block">{{ __('application.property_type') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="propertyType" name="propertyType" type="text" class="form-control"
                                    value="{{ $accomodationData->property_type }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="monthlyRent" class="block">{{ __('application.monthly_rent') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="monthlyRent" name="monthlyRent" type="text" class="form-control"
                                    value="{{ $accomodationData->monthly_rent }}" />
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="totalRentYears" class="block">{{ __('application.rent_years') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="totalRentYears" name="totalRentYears" type="text" class="form-control"
                                    value="{{ $accomodationData->total_rent_years }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="expectedMoveinDate"
                                    class="block">{{ __('application.expected_movein_date') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="expectedMoveinDate" name="expectedMoveinDate"
                                    class="form-control date-dropper" type="text"
                                    value="{{ $accomodationData->expected_movein_date }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="totalPaybackMonths"
                                    class="block">{{ __('application.payback_months') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="totalPaybackMonths" name="totalPaybackMonths" type="text"
                                    class="form-control" value="{{ $accomodationData->total_payback_months }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="totalPaybackMonths" class="block">&nbsp;</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </section>
                      <h3>{{ __('application.tab3') }}</h3>
                      <section>
                        @if(!$fees)
                        <div class="alert alert-danger icons-alert">
                          <strong>NOTE:</strong> Pay registration fees, then upload your required documents documents.
                        </div>
                        <div class="text-center">
                          @if (Auth::user()->user_type != 'TENANT')
                          <form id="offlinePaymentForm" action="{{ route('application-offlinePayment') }}" method="POST" accept-charset="UTF-8" style="display: inline-block">
                            @csrf
                            <div class="form-group">
                              <input type="hidden" name="userDataId" value="{{ md5($userDataId) }}">
                              <button class="btn btn-round d-block mx-auto btn-inverse text-center" type="submit">ACCEPT OFFLINE</button>
                            </div>
                          </form>
                          @endif
                          <form id="paymentForm" action="{{ route('application-payment') }}" method="POST" accept-charset="UTF-8" style="display: inline-block">
                            @csrf
                            <div class="form-group">
                              <input type="hidden" name="userDataId" value="{{ md5($userDataId) }}">
                              <button class="btn btn-round d-block mx-auto btn-inverse text-center" type="submit">PAY REGISTRATION FEES</button>
                            </div>
                          </form>
                        </div>
                        @else
                        <form id="documentDataForm">
                          @csrf
                          <input type="hidden" name="userDataId" value="{{ md5($userDataId) }}">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="passportPictureFile" class="block">{{ __('application.upload_profile_picture') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="passportPictureFile" name="passportPictureFile" type="file" class="form-control display-file" accept="image/jpg,image/jpeg,image/png,application/pdf" style="display: none" />
                                  <label for="passportPictureFile" id="passportPictureFilePreview" class="preview-container">
                                    @if($documentData->passport_picture_path != NULL)
                                    <img src="{{ url($documentData->passport_picture_path) }}" class="img-fluid" alt=""><br>
                                    <a href="{{ url($documentData->passport_picture_path) }}" target="_blank">Click Here</a>
                                    @else
                                    <div class="text-center upload-btn" style="padding: 70px 0;">
                                      <span class="btn btn-inverse">UPLOAD</span>
                                    </div>
                                    <img src="" class="displaynone img-fluid" alt=""><br>
                                    <a href="#" class="displaynone" target="_blank">Click Here</a>
                                    @endif
                                  </label>
                                </div>
                              
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="ghanaCardFile"
                                    class="block">{{ __('application.upload_ghana_card') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="ghanaCardFile" name="ghanaCardFile" type="file" class="form-control display-file" accept="image/jpg,image/jpeg,image/png,application/pdf" style="display: none" />
                                  <label for="ghanaCardFile" id="ghanaCardFilePreview" class="preview-container">
                                    @if($documentData->ghana_card_path != NULL)
                                    <img src="{{ url($documentData->ghana_card_path) }}" class="img-fluid" alt=""><br>
                                    <a href="{{ url($documentData->ghana_card_path) }}" target="_blank">Click Here</a>
                                    @else
                                    <div class="text-center upload-btn" style="padding: 70px 0;">
                                      <span class="btn btn-inverse">UPLOAD</span>
                                    </div>
                                    <img src="" class="displaynone img-fluid" alt=""><br>
                                    <a href="#" class="displaynone" target="_blank">Click Here</a>
                                    @endif
                                  </label>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="ghanaCard" class="block">{{ __('application.ghana_card') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="ghanaCard" name="ghanaCard" type="text" class="form-control"
                                    value="{{ $documentData->ghana_card }}" />
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="bankStatementFile" class="block">{{ __('application.upload_bank_statement') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="bankStatementFile" name="bankStatementFile" type="file" class="form-control display-file" accept="image/jpg,image/jpeg,image/png,application/pdf" style="display: none" />
                                  <label for="bankStatementFile" id="bankStatementFilePreview" class="preview-container">
                                    @if($documentData->statement_path != NULL)
                                    <img src="{{ url($documentData->statement_path) }}" class="img-fluid" alt=""><br>
                                    <a href="{{ url($documentData->statement_path) }}" target="_blank">Click Here</a>
                                    @else
                                    <div class="text-center upload-btn" style="padding: 70px 0;">
                                      <span class="btn btn-inverse">UPLOAD</span>
                                    </div>
                                    <img src="" class="displaynone img-fluid" alt=""><br>
                                    <a href="#" class="displaynone" target="_blank">Click Here</a>
                                    @endif
                                  </label>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="employmentLetterFile"
                                    class="block">{{ __('application.upload_employment_letter') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="employmentLetterFile" name="employmentLetterFile" type="file" class="form-control display-file" accept="image/jpg,image/jpeg,image/png,application/pdf" style="display: none" />
                                  <label for="employmentLetterFile" id="employmentLetterFilePreview" class="preview-container">
                                    @if($documentData->employment_letter_path != NULL)
                                    <img src="{{ url($documentData->employment_letter_path) }}" class="img-fluid" alt=""><br>
                                    <a href="{{ url($documentData->employment_letter_path) }}" target="_blank">Click Here</a>
                                    @else
                                    <div class="text-center upload-btn" style="padding: 70px 0;">
                                      <span class="btn btn-inverse">UPLOAD</span>
                                    </div>
                                    <img src="" class="displaynone img-fluid" alt=""><br>
                                    <a href="#" class="displaynone" target="_blank">Click Here</a>
                                    @endif
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        @endif
                      </section>
                      <h3>{{ __('application.tab4') }}</h3>
                      <section>
                        <form action="" id="landlordDataForm">
                          <input type="hidden" name="userDataId" value="{{ md5($userDataId) }}">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="landlordName"
                                    class="block">{{ __('application.landlord_name') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="landlordName" name="landlordName" type="text" class="form-control"
                                    value="{{ $landlordData->landlord_name }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="landlordNumber"
                                    class="block">{{ __('application.landlord_number') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="landlordNumber" name="landlordNumber" type="text" class="form-control"
                                    value="{{ $landlordData->landlord_number }}" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="landlordAddress"
                                    class="block">{{ __('application.landlord_address') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <textarea id="landlordAddress" name="landlordAddress" type="text" class="form-control" rows="5"> {{ $landlordData->landlord_address }}</textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-12">
                                  <label for="landlordEmail"
                                    class="block">{{ __('application.landlord_email') }}</label>
                                </div>
                                <div class="col-sm-12">
                                  <input id="landlordEmail" name="landlordEmail" type="text" class="form-control"
                                    value="{{ $landlordData->landlord_email }}" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </section>
                    </div>
                  </section>
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
  <!--Forms - Wizard js-->
  <script src="{{ asset('bower_components/jquery.cookie/js/jquery.cookie.js') }}"></script>
  <script src="{{ asset('bower_components/jquery.steps/js/jquery.steps.js') }}"></script>
  <script src="{{ asset('bower_components/jquery-validation/js/jquery.validate.js') }}"></script>
  <script src="{{ asset('assets/pages/forms-wizard-validation/form-wizard.js') }}"></script>
  <!-- Validation js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
  <script type="text/javascript" src="{{ asset('assets/pages/form-validation/validate.js') }}"></script>
  <!-- Date-dropper js -->
  <script type="text/javascript" src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
  <script>
    const applicationDataUrl = '{{ route('applicationData-update') }}';
    const accomodationDataUrl = '{{ route('accomodationData-update') }}';
    const documentDataUrl = '{{ route('documentData-update') }}';
    const landlordDataUrl = '{{ route('landlordData-update') }}';
    const redirectUrl = '{{ route('application-edit', ['id' => $applicationCode]) }}';
    const fees = {{ $fees != null ? 1 : 0 }};
    const startIndex = parseInt('{{ $startIndex }}');
  </script>
  <script type="text/javascript" src="{{ asset('assets/js/application.js') }}"></script>
@endsection