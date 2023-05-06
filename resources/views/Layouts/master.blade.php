<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
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
  <!-- themify-icons line icon -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
  <!-- ico font -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">
  <!-- Menu-Search css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/menu-search/css/component.css') }}">
  <!-- Style.css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
  @yield('style')
</head>
<body>
  <!-- Pre-loader start -->
  @include("partials.loader")
  <!-- Pre-loader end -->
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

      @include("partials.topnav")

      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
          
          @include("partials.sidenav")
          
          <div class="pcoded-content">
            <div class="pcoded-inner-content">
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="page-body">
                    @yield('content')
                  </div>
                </div>
                <div id="styleSelector"></div>
              </div>
            </div>
          </div>
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
  <!-- am chart -->
  <script src="{{ asset('assets/pages/widget/amchart/amcharts.min.js') }}"></script>
  <script src="{{ asset('assets/pages/widget/amchart/serial.min.js') }}"></script>
  <!-- Chart js -->
  <script type="text/javascript" src="{{ asset('bower_components/chart.js/js/Chart.js') }}"></script>
  <!-- Todo js -->
  <script type="text/javascript" src="{{ asset('assets/pages/todo/todo.js') }}"></script>
  <!-- i18next.min.js -->
  <script type="text/javascript" src="{{ asset('bower_components/i18next/js/i18next.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}">
  </script>
  <script type="text/javascript"
    src="{{ asset('bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}">
  </script>
  <script type="text/javascript" src="{{ asset('bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
  <!-- Custom js -->
  {{-- <script type="text/javascript" src="{{ asset('assets/pages/dashboard/custom-dashboard.min.js') }}"></script> --}}
  <script type="text/javascript" src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
  <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
  <script src="{{ asset('assets/js/demo-12.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/script.min.js') }}"></script>
  @yield('script')
</body>

</html>
