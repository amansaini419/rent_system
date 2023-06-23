<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <title></title>
  <meta name="viewport" content="width=device-width" />
  <!-- Favicon icon -->
  <link rel="icon" href="../email-templates/img/favicon.ico" type="image/x-icon">
  <style type="text/css">
    @media only screen and (max-width: 550px),
    screen and (max-device-width: 550px) {
      body[yahoo] .buttonwrapper {
        background-color: transparent !important;
      }

      body[yahoo] .button {
        padding: 0 !important;
      }

      body[yahoo] .button a {
        background-color: #9b59b6;
        padding: 15px 25px !important;
      }
    }

    @media only screen and (min-device-width: 601px) {
      .content {
        width: 600px !important;
      }

      .col387 {
        width: 387px !important;
      }
    }
  </style>
</head>

<body bgcolor="#34495E" style="margin: 0; padding: 0;" yahoo="fix">
  <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
  <div style="background: #34495E; margin-top: 30px; margin-bottom: 30px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
      <tr>
        <td align="center" bgcolor="#0073AA"
          style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
          <img src="{{ asset('images/logo.png') }}" alt="{{ env('WEBSITE_TITLE') }} Logo" width="200" style="display:block;" />
        </td>
      </tr>

      @yield('body')

      <tr>
        <td align="center" bgcolor="#dddddd"
          style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
          <b>Company Inc.</b><br />985 Example St. &bull; Suite A1S2 &bull; San Francisco, CA 12458 USA
        </td>
      </tr>
      <tr>
        <td style="padding: 15px 10px 15px 10px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td align="center" width="100%" style="color: #fff; font-family: Arial, sans-serif; font-size: 12px;">
                {{ date('Y') }} &copy; <a href="{{ route('home') }}" style="color: #0073AA;">{{ env('WEBSITE_TITLE') }}</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
  </div>
</body>

</html>
