{{-- <li class="">
  <a href="{{ route('tenant-list') }}">
    <span class="pcoded-micon"><i class="ti-home"></i><b>T</b></span>
    <span class="pcoded-mtext" data-i18n="nav.navigate.main">Tenants</span>
    <span class="pcoded-mcaret"></span>
  </a>
</li> --}}
<li class="pcoded-hasmenu">
  <a href="javascript:void(0)">
    <span class="pcoded-micon"><i class="ti-layout"></i><b>A</b></span>
    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Applications</span>
    <span class="pcoded-mcaret"></span>
  </a>
  <ul class="pcoded-submenu">
    <li class=" ">
      <a href="{{ route('application-list', ['status' => 'ALL']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext" data-i18n="nav.page_layout.bottom-menu">All</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class=" ">
      <a href="{{ route('application-list', ['status' => 'UNDER_VERIFICATION']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext" data-i18n="nav.page_layout.box-layout">Under Verification</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class=" ">
      <a href="{{ route('application-list', ['status' => 'APPROVED']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext" data-i18n="nav.page_layout.box-layout">Approved</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
  </ul>
</li>
<li class="pcoded-hasmenu">
  <a href="javascript:void(0)">
    <span class="pcoded-micon"><i class="ti-layout"></i><b>L</b></span>
    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Loans</span>
    <span class="pcoded-mcaret"></span>
  </a>
  <ul class="pcoded-submenu">
    <li class=" ">
      <a href="{{ route('loan-list', ['status' => 'ALL']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext" data-i18n="nav.page_layout.bottom-menu">All</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class=" ">
      <a href="{{ route('loan-list', ['status' => 'OPENED']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext" data-i18n="nav.page_layout.box-layout">Opened</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
  </ul>
</li>
<li class="">
  <a href="{{ route('invoice-list') }}">
    <span class="pcoded-micon"><i class="ti-user"></i><b>I</b></span>
    <span class="pcoded-mtext" data-i18n="nav.navigate.main">Invoices</span>
    <span class="pcoded-mcaret"></span>
  </a>
</li>
