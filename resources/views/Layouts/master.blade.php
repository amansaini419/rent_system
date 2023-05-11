<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title') | {{ env('WEBSITE_TITLE') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="#">
  <meta name="keywords"
    content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
  <meta name="author" content="#">
  <!-- Favicon icon -->
  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
  <!-- Required Fremwork -->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/css/bootstrap.min.css') }}">
  <!-- sweet alert framework -->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/sweetalert/css/sweetalert.css') }}">
  <!-- themify-icons line icon -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
  <!-- ico font -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">
  <!-- Menu-Search css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/menu-search/css/component.css') }}">
  <!-- Style.css -->
  @yield('theme-style')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/aman.css') }}">
  @yield('own-style')
</head>

<body>
  <!-- Pre-loader start -->
  @include('partials.loader')
  <!-- Pre-loader end -->
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

      @include('partials.topnav')

      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">

          @include('partials.sidenav')

          <div class="pcoded-content">
            <div class="pcoded-inner-content">
              <div class="main-body">
                <div class="page-wrapper">
                  @yield('content')
                </div>
                <div id="styleSelector"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Title</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Static Modal</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing lorem impus dolorsit.onsectetur adipiscing</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success waves-effect " data-dismiss="modal">Approve</button>
          <button type="button" class="btn btn-danger waves-effect waves-light ">Reject</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Required Jquery -->
  <script type="text/javascript" src="{{ asset('bower_components/jquery/js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/popper.js/js/popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
  <!-- jquery slimscroll js -->
  <script type="text/javascript" src="{{ asset('bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}">
  </script>
  <!-- modernizr js -->
  <script type="text/javascript" src="{{ asset('bower_components/modernizr/js/modernizr.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/modernizr/js/css-scrollbars.js') }}"></script>
  <!-- sweet alert js -->
  <script type="text/javascript" src="{{ asset('bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
  {{-- <script type="text/javascript" src="{{ asset('assets/js/modal.js') }}"></script> --}}
  <!-- sweet alert modal.js intialize js -->
  <!-- modalEffects js nifty modal window effects -->
  {{-- <script type="text/javascript" src="{{ asset('assets/js/modalEffects.js') }}"></script> --}}
  <script type="text/javascript" src="{{ asset('assets/js/classie.js') }}"></script>
  <!-- i18next.min.js -->
  <script type="text/javascript" src="{{ asset('bower_components/i18next/js/i18next.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}">
  </script>
  <script type="text/javascript"
    src="{{ asset('bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}">
  </script>
  <script type="text/javascript" src="{{ asset('bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
  <!-- Custom js -->
  <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
  <script src="{{ asset('assets/js/demo-12.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  @yield('theme-script')
  <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/aman.js') }}"></script>
  @yield('own-script')
</body>

</html>
