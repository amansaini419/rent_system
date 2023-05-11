@extends('layouts.master')

@section('title')
  Registration Form
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
            <li class="breadcrumb-item"><a href="#!">Registration Form</a></li>
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
                    <form class="wizard-form" id="registrationForm" action="#">
                      <h3>{{ __('application.tab1') }}</h3>
                      <section>
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
                                <input id="firstName" name="firstName" type="text" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="otherNames" class="block">{{ __('application.other_names')  }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="otherNames" name="otherNames" type="text" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="surname" class="block">{{ __('application.surname')  }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="surname" name="surname" type="text" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="gender" class="block">{{ __('application.gender')  }}</label>
                              </div>
                              <div class="col-sm-12">
                                <select id="gender" name="gender" class="form-control">
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                                  <option value="others">Others</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="dateOfBirth" class="block">{{ __('application.dob') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="dateOfBirth" name="dateOfBirth" class="form-control date-dropper"
                                  type="text" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="maritalStatus" class="block">{{ __('application.marital_status') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <select id="maritalStatus" name="maritalStatus" class="form-control">
                                  <option value="single">Single</option>
                                  <option value="married">Married</option>
                                  <option value="divorced">Divorced</option>
                                  <option value="widowed">Widowed</option>
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
                                <label for="currentLocation" class="block">{{ __('application.current_location')  }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="currentLocation" name="currentLocation" type="text"
                                  class="form-control">
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="whatsappNumber" class="block">{{ __('application.whatsapp_number') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="whatsappNumber" name="whatsappNumber" type="text" class="form-control">
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="socialMediaHandles" class="block">{{ __('application.social_media_handles')  }}</label>
                              </div>
                              <div class="col-sm-12">
                                <textarea id="socialMediaHandles" rows="5" name="socialMediaHandles" class="form-control"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h4 class="mt-5 sub-title">{{ __('application.employment_heading')  }}</h4>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="employmentStatus" class="block">{{ __('application.employment_status') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="employmentStatus" name="employmentStatus" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="companyName" class="block">{{ __('application.company_name')  }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="companyName" name="companyName" type="text" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="monthlyNetIncome" class="block">{{ __('application.monthly_net_income')  }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="monthlyNetIncome" name="monthlyNetIncome" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="outstandingLoan" class="block">{{ __('application.outstanding_loan') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <select id="outstandingLoan" name="outstandingLoan" class="form-control">
                                  <option value="no">No</option>
                                  <option value="yes">Yes</option>
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
                                <label for="emergencyContactName" class="block">{{ __('application.emergency_fullname') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="emergencyContactName" name="emergencyContactName" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="emergencyContactRelation" class="block">{{ __('application.emergency_relation') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="emergencyContactRelation" name="emergencyContactRelation" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="emergencyContactNumber" class="block">{{ __('application.emergency_number') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="emergencyContactNumber" name="emergencyContactNumber" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="emergencyContactLocation" class="block">{{ __('application.emergency_location') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="emergencyContactLocation" name="emergencyContactLocation" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                      <h3>{{ __('application.tab2') }}</h3>
                      <section>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="currentAccommodationStatus" class="block">{{ __('application.currenct_accommodation_status') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="currentAccommodationStatus" name="currentAccommodationStatus" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="propertyLocation" class="block">{{ __('application.property_location') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="propertyLocation" name="propertyLocation" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="propertyType" class="block">{{ __('application.property_type') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="propertyType" name="propertyType" type="text" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="monthlyRent" class="block">{{ __('application.monthly_rent') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="monthlyRent" name="monthlyRent" type="text" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="totalRentYears" class="block">{{ __('application.rent_years') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="totalRentYears" name="totalRentYears" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="expectedMoveinDate" class="block">{{ __('application.expected_movein_date') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="expectedMoveinDate" name="expectedMoveinDate"
                                  class="form-control date-dropper" type="text" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="totalPaybackMonths" class="block">{{ __('application.payback_months') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="totalPaybackMonths" name="totalPaybackMonths" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="totalPaybackMonths" class="block">&nbsp;</label>
                              </div>
                              <div class="col-sm-12">
                                <button class="btn btn-round btn-block btn-sm btn-inverse text-center">PAY REGISTRATION
                                  FEES</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                      <h3>{{ __('application.tab3') }}</h3>
                      <section>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="passportPicture" class="block">{{ __('application.upload_profile_picture') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="passportPicture" name="passportPicture" type="file"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="ghanaCard" class="block">{{ __('application.ghana_card') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="ghanaCard" name="ghanaCard" type="text" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="ghanaCardFile" class="block">{{ __('application.upload_ghana_card') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="ghanaCardFile" name="ghanaCardFile" type="file" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="bankStatementFile" class="block">{{ __('application.upload_bank_statement') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="bankStatementFile" name="bankStatementFile" type="file" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="employmentLetterFile" class="block">{{ __('application.upload_employment_letter') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="employmentLetterFile" name="employmentLetterFile" type="file" class="form-control" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                      <h3>{{ __('application.tab4') }}</h3>
                      <section>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="landlordName" class="block">{{ __('application.landlord_name') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="landlordName" name="landlordName" type="text" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="landlordNumber" class="block">{{ __('application.landlord_number') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="landlordNumber" name="landlordNumber" type="text"
                                  class="form-control" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="landlordAddress" class="block">{{ __('application.landlord_address') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <textarea id="landlordAddress" name="landlordAddress" type="text" class="form-control" rows="5"></textarea>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="landlordEmail" class="block">{{ __('application.landlord_email') }}</label>
                              </div>
                              <div class="col-sm-12">
                                <input id="landlordEmail" name="landlordEmail" type="text" class="form-control" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    </form>
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
@endsection

@section('own-script')
  <script>
    $(document).ready(function() {
      const stepChanged = (event, currentIndex, newIndex = 0) => {
        event.preventDefault();
        console.log(currentIndex, newIndex);

        if (currentIndex == 0 && newIndex == 1) {

        } else if (currentIndex == 1 && newIndex == 2) {

        } else if (currentIndex == 2 && newIndex == 3) {

        } else if (currentIndex == 3 && newIndex == 0) {

        }
        return true;
      }

      const startIndex = 0;

      // For registration form wizard
      $("#registrationForm").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true,
        //loadingTemplate: '<h2><i class="fa fa-spin fa-spinner"></i></h2>',
        //saveState: true,
        startIndex: startIndex,
        onStepChanging: stepChanged,
        /* onStepChanged: function (event, currentIndex, priorIndex) {
          console.log
        }, */
        onFinishing: stepChanged,
      });

      // For date picker
      $(".date-dropper").dateDropper({
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c"
      });
    });
  </script>
@endsection
