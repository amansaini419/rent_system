<li class="">
  <a href="{{ route('tenant-list') }}">
    <span class="pcoded-micon"><i class="ti-home"></i><b>T</b></span>
    <span class="pcoded-mtext">Tenants</span>
    <span class="pcoded-mcaret"></span>
  </a>
</li>
<li class="pcoded-hasmenu {{ (Route::currentRouteName() === 'application-list') ? 'active pcoded-trigger' : '' }}">
  <a href="javascript:void(0)">
    <span class="pcoded-micon"><i class="ti-layout"></i><b>A</b></span>
    <span class="pcoded-mtext">Applications</span>
    <span class="pcoded-mcaret"></span>
  </a>
  <ul class="pcoded-submenu">
    <li class="{{ (Route::currentRouteName() === 'application-list' && request()->segment(3) == '') ? 'active' : '' }}">
      <a href="{{ route('application-list') }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">All</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'application-list' && request()->segment(3) === 'PENDING') ? 'active' : '' }}">
      <a href="{{ route('application-list', ['status' => 'PENDING']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Pending</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'application-list' && request()->segment(3) === 'UNDER_VERIFICATION') ? 'active' : '' }}">
      <a href="{{ route('application-list', ['status' => 'UNDER_VERIFICATION']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Under Verification</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'application-list' && request()->segment(3) === 'VERIFIED') ? 'active' : '' }}">
      <a href="{{ route('application-list', ['status' => 'VERIFIED']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Verified</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'application-list' && request()->segment(3) === 'APPROVED') ? 'active' : '' }}">
      <a href="{{ route('application-list', ['status' => 'APPROVED']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Approved</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'application-list' && request()->segment(3) === 'REJECTED') ? 'active' : '' }}">
      <a href="{{ route('application-list', ['status' => 'REJECTED']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Rejected</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
  </ul>
</li>
<li class="pcoded-hasmenu">
  <a href="javascript:void(0)">
    <span class="pcoded-micon"><i class="ti-layout"></i><b>L</b></span>
    <span class="pcoded-mtext">Loans</span>
    <span class="pcoded-mcaret"></span>
  </a>
  <ul class="pcoded-submenu">
    <li class=" ">
      <a href="{{ route('loan-list', ['status' => 'ALL']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">All</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class=" ">
      <a href="{{ route('loan-list', ['status' => 'OPENED']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Opened</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
  </ul>
</li>
<li class="">
  <a href="{{ route('invoice-list') }}">
    <span class="pcoded-micon"><i class="ti-user"></i><b>I</b></span>
    <span class="pcoded-mtext">Invoices</span>
    <span class="pcoded-mcaret"></span>
  </a>
</li>
<li class="">
  <a href="{{ route('admin-list') }}">
    <span class="pcoded-micon"><i class="ti-user"></i><b>A</b></span>
    <span class="pcoded-mtext">Admins</span>
    <span class="pcoded-mcaret"></span>
  </a>
</li>
<li class="">
  <a href="{{ route('settings') }}">
    <span class="pcoded-micon"><i class="ti-user"></i><b>I</b></span>
    <span class="pcoded-mtext">Settings</span>
    <span class="pcoded-mcaret"></span>
  </a>
</li>
{{-- Sub Admin, Users, Notifications, Chat, Change Password, Log Out --}}
