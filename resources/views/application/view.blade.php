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
              <a class="nav-link active" data-toggle="tab" href="#appData" role="tab">Application Data</a>
              <div class="slide"></div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#accData" role="tab">Accommodation Data</a>
              <div class="slide"></div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#docData" role="tab">Documents Verification</a>
              <div class="slide"></div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#landData" role="tab">Landlord Verification</a>
              <div class="slide"></div>
            </li>
          </ul>
        </div>
        <div class="tab-content">
          <div class="tab-pane active" id="appData" role="tabpanel">
            <div class="card">
              <div class="card-header">
                <h5 class="sub-title d-block border-0">Personal Information</h5>
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
                                    <th scope="row">First Name</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Other Names</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Surname</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Gender</th>
                                    <td>Female</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Date of Birth</th>
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
                                    <th scope="row">Marital Status</th>
                                    <td>Single</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Location</th>
                                    <td>Ghana</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Whatsapp Number</th>
                                    <td><a href="#!">4567891</a></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Social Media Handles</th>
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
                <h5 class="sub-title d-block border-0">Employment Information</h5>
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
                                    <th scope="row">Employment Status</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Name of Company</th>
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
                                    <th scope="row">Monthly New Income</th>
                                    <td>Single</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Any outstanding loan?</th>
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
                <h5 class="sub-title d-block border-0">Emergency Contact</h5>
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
                                    <th scope="row">Full Name</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Relation</th>
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
                                    <th scope="row">Contact</th>
                                    <td>Single</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Location</th>
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
                                    <th scope="row">Current Accommodation Status</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Property Location</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Type of Property</th>
                                    <td>Josephine Villa</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Gender</th>
                                    <td>Female</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Date of Birth</th>
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
                                    <th scope="row">Marital Status</th>
                                    <td>Single</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Location</th>
                                    <td>Ghana</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Whatsapp Number</th>
                                    <td><a href="#!">4567891</a></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Social Media Handles</th>
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
          </div>
          <div class="tab-pane" id="docData" role="tabpanel">
            <div class="row">
              <div class="col-xl-3">
                <!-- user contact card left side start -->
                <div class="card">
                  <div class="card-header contact-user">
                    <img class="img-radius img-40" src="assets/images/avatar-4.jpg" alt="contact-user">
                    <h5 class="m-l-10">John Doe</h5>
                  </div>
                  <div class="card-block">
                    <ul class="list-group list-contacts">
                      <li class="list-group-item active"><a href="#">All Contacts</a></li>
                      <li class="list-group-item"><a href="#">Recent Contacts</a></li>
                      <li class="list-group-item"><a href="#">Favourite Contacts</a></li>
                    </ul>
                  </div>
                  <div class="card-block groups-contact">
                    <h4>Groups</h4>
                    <ul class="list-group">
                      <li class="list-group-item justify-content-between">
                        Project
                        <span class="badge badge-primary badge-pill">30</span>
                      </li>
                      <li class="list-group-item justify-content-between">
                        Notes
                        <span class="badge badge-success badge-pill">20</span>
                      </li>
                      <li class="list-group-item justify-content-between">
                        Activity
                        <span class="badge badge-info badge-pill">100</span>
                      </li>
                      <li class="list-group-item justify-content-between">
                        Schedule
                        <span class="badge badge-danger badge-pill">50</span>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Contacts<span class="f-15"> (100)</span></h4>
                  </div>
                  <div class="card-block">
                    <div class="connection-list">
                      <a href="#"><img class="img-fluid img-radius"
                          src="assets/images/user-profile/follower/f-1.jpg" alt="f-1" data-toggle="tooltip"
                          data-placement="top" data-original-title="Airi Satou">
                      </a>
                      <a href="#"><img class="img-fluid img-radius"
                          src="assets/images/user-profile/follower/f-2.jpg" alt="f-2" data-toggle="tooltip"
                          data-placement="top" data-original-title="Angelica Ramos">
                      </a>
                      <a href="#"><img class="img-fluid img-radius"
                          src="assets/images/user-profile/follower/f-3.jpg" alt="f-3" data-toggle="tooltip"
                          data-placement="top" data-original-title="Ashton Cox">
                      </a>
                      <a href="#"><img class="img-fluid img-radius"
                          src="assets/images/user-profile/follower/f-4.jpg" alt="f-4" data-toggle="tooltip"
                          data-placement="top" data-original-title="Cara Stevens">
                      </a>
                      <a href="#"><img class="img-fluid img-radius"
                          src="assets/images/user-profile/follower/f-5.jpg" alt="f-5" data-toggle="tooltip"
                          data-placement="top" data-original-title="Garrett Winters">
                      </a>
                      <a href="#"><img class="img-fluid img-radius"
                          src="assets/images/user-profile/follower/f-1.jpg" alt="f-6" data-toggle="tooltip"
                          data-placement="top" data-original-title="Cedric Kelly">
                      </a>
                      <a href="#"><img class="img-fluid img-radius"
                          src="assets/images/user-profile/follower/f-3.jpg" alt="f-7" data-toggle="tooltip"
                          data-placement="top" data-original-title="Brielle Williamson">
                      </a>
                      <a href="#"><img class="img-fluid img-radius"
                          src="assets/images/user-profile/follower/f-5.jpg" alt="f-8" data-toggle="tooltip"
                          data-placement="top" data-original-title="Jena Gaines">
                      </a>
                    </div>
                  </div>
                </div>
                <!-- user contact card left side end -->
              </div>
              <div class="col-xl-9">
                <div class="row">
                  <div class="col-sm-12">
                    <!-- contact data table card start -->
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-header-text">Contacts</h5>
                      </div>
                      <div class="card-block contact-details">
                        <div class="data_table_main table-responsive dt-responsive">
                          <table id="simpletable" class="table  table-striped table-bordered nowrap">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobileno.</th>
                                <th>Favourite</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star-o" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star-o" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star-o" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star-o" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star-o" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"
                                      aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star-o" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star-o" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>abc123@gmail.com</td>
                                <td>9989988988</td>
                                <td><i class="fa fa-star" aria-hidden="true"></i></td>
                                <td class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                      class="fa fa-cog" aria-hidden="true"></i></button>
                                  <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-edit"></i>Edit</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-delete"></i>Delete</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye-alt"></i>View</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-tasks-alt"></i>Project</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-ui-note"></i>Notes</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-eye"></i>Activity</a>
                                    <a class="dropdown-item" href="#!"><i
                                        class="icofont icofont-badge"></i>Schedule</a>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobileno.</th>
                                <th>Favourite</th>
                                <th>Action</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <!-- contact data table card end -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="landData" role="tabpanel">
            <div class="card">
              <div class="card-header">
                <h5 class="card-header-text">Review</h5>
              </div>
              <div class="card-block">
                <ul class="media-list">
                  <li class="media">
                    <div class="media-left">
                      <a href="#">
                        <img class="media-object img-radius comment-img" src="assets/images/avatar-1.jpg"
                          alt="Generic placeholder image">
                      </a>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">Sortino media<span class="f-12 text-muted m-l-5">Just now</span></h6>
                      <div class="stars-example-css review-star">
                        <i class="icofont icofont-star"></i>
                        <i class="icofont icofont-star"></i>
                        <i class="icofont icofont-star"></i>
                        <i class="icofont icofont-star"></i>
                        <i class="icofont icofont-star"></i>
                      </div>
                      <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                        sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                      <div class="m-b-25">
                        <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!"
                            class="f-12">Edit</a> </span>
                      </div>
                      <hr>
                      <!-- Nested media object -->
                      <div class="media mt-2">
                        <a class="media-left" href="#">
                          <img class="media-object img-radius comment-img" src="assets/images/avatar-2.jpg"
                            alt="Generic placeholder image">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading">Larry heading <span class="f-12 text-muted m-l-5">Just now</span>
                          </h6>
                          <div class="stars-example-css review-star">
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                          </div>
                          <p class="m-b-0"> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                            ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                          </p>
                          <div class="m-b-25">
                            <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!"
                                class="f-12">Edit</a> </span>
                          </div>
                          <hr>
                          <!-- Nested media object -->
                          <div class="media mt-2">
                            <div class="media-left">
                              <a href="#">
                                <img class="media-object img-radius comment-img" src="assets/images/avatar-3.jpg"
                                  alt="Generic placeholder image">
                              </a>
                            </div>
                            <div class="media-body">
                              <h6 class="media-heading">Colleen Hurst <span class="f-12 text-muted m-l-5">Just
                                  now</span></h6>
                              <div class="stars-example-css review-star">
                                <i class="icofont icofont-star"></i>
                                <i class="icofont icofont-star"></i>
                                <i class="icofont icofont-star"></i>
                                <i class="icofont icofont-star"></i>
                                <i class="icofont icofont-star"></i>
                              </div>
                              <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                turpis.</p>
                              <div class="m-b-25">
                                <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!"
                                    class="f-12">Edit</a> </span>
                              </div>
                            </div>
                            <hr>
                          </div>
                        </div>
                      </div>
                      <!-- Nested media object -->
                      <div class="media mt-2">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object img-radius comment-img" src="assets/images/avatar-1.jpg"
                              alt="Generic placeholder image">
                          </a>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Cedric Kelly<span class="f-12 text-muted m-l-5">Just now</span>
                          </h6>
                          <div class="stars-example-css review-star">
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                          </div>
                          <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                            ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                          </p>
                          <div class="m-b-25">
                            <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!"
                                class="f-12">Edit</a> </span>
                          </div>
                          <hr>
                        </div>
                      </div>
                      <div class="media mt-2">
                        <a class="media-left" href="#">
                          <img class="media-object img-radius comment-img" src="assets/images/avatar-4.jpg"
                            alt="Generic placeholder image">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading">Larry heading <span class="f-12 text-muted m-l-5">Just now</span>
                          </h6>
                          <div class="stars-example-css review-star">
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                          </div>
                          <p class="m-b-0"> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                            ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                          </p>
                          <div class="m-b-25">
                            <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!"
                                class="f-12">Edit</a> </span>
                          </div>
                          <hr>
                          <!-- Nested media object -->
                          <div class="media mt-2">
                            <div class="media-left">
                              <a href="#">
                                <img class="media-object img-radius comment-img" src="assets/images/avatar-3.jpg"
                                  alt="Generic placeholder image">
                              </a>
                            </div>
                            <div class="media-body">
                              <h6 class="media-heading">Colleen Hurst <span class="f-12 text-muted m-l-5">Just
                                  now</span></h6>
                              <div class="stars-example-css review-star">
                                <i class="icofont icofont-star"></i>
                                <i class="icofont icofont-star"></i>
                                <i class="icofont icofont-star"></i>
                                <i class="icofont icofont-star"></i>
                                <i class="icofont icofont-star"></i>
                              </div>
                              <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                turpis.</p>
                              <div class="m-b-25">
                                <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!"
                                    class="f-12">Edit</a> </span>
                              </div>
                            </div>
                            <hr>
                          </div>
                        </div>
                      </div>
                      <div class="media mt-2">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object img-radius comment-img" src="assets/images/avatar-2.jpg"
                              alt="Generic placeholder image">
                          </a>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Mark Doe<span class="f-12 text-muted m-l-5">Just now</span></h6>
                          <div class="stars-example-css review-star">
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                            <i class="icofont icofont-star"></i>
                          </div>
                          <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                            ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                          </p>
                          <div class="m-b-25">
                            <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!"
                                class="f-12">Edit</a> </span>
                          </div>
                          <hr>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Right addon">
                  <span class="input-group-addon"><i class="icofont icofont-send-mail"></i></span>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
