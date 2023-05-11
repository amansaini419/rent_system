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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
  <!-- Required Fremwork -->
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/css/bootstrap.min.css') }}">
  <!-- themify-icons line icon -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
  <!-- ico font -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">
  <!-- Style.css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">


</head>

<body class="fix-menu">
  <!-- Pre-loader start -->
  @include("partials.loader")
  <!-- Pre-loader end -->

  <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">

          @yield('content')

        </div>
      </div>
    </div>
  </section>

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
  <!-- i18next.min.js -->
  <script type="text/javascript" src="{{ asset('bower_components/i18next/js/i18next.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}">
  </script>
  <script type="text/javascript"
    src="{{ asset('bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}">
  </script>
  <script type="text/javascript" src="{{ asset('bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/common-pages.js') }}"></script>
</body>

</html>
