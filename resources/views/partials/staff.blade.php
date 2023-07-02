<li class="pcoded-hasmenu {{ ( in_array(Route::currentRouteName(), ['tenant-list', 'tenant-view', 'tenant-new']) ) ? 'active pcoded-trigger' : '' }}">
  <a href="javascript:void(0)">
    <span class="pcoded-micon"><i class="icofont icofont-users-alt-2"></i><b>T</b></span>
    <span class="pcoded-mtext">Tenants</span>
    <span class="pcoded-mcaret"></span>
  </a>
  <ul class="pcoded-submenu">
    <li class="{{ (Route::currentRouteName() === 'tenant-list') ? 'active' : '' }}">
      <a href="{{ route('tenant-list') }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">All</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'tenant-new') ? 'active' : '' }}">
      <a href="{{ route('tenant-new') }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">New</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
  </ul>
</li>
<li class="pcoded-hasmenu {{ ( in_array(Route::currentRouteName(), ['application-list', 'application-view']) ) ? 'active pcoded-trigger' : '' }}">
  <a href="javascript:void(0)">
    <span class="pcoded-micon"><i class="icofont icofont-files"></i><b>A</b></span>
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
    <li class="{{ (Route::currentRouteName() === 'application-list' && request()->segment(3) === 'UNDER_VERIFICATION') ? 'active' : '' }}">
      <a href="{{ route('application-list', ['status' => 'UNDER_VERIFICATION']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Under Verification</span>
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
  </ul>
</li>
<li class="pcoded-hasmenu {{ ( in_array(Route::currentRouteName(), ['loan-list', 'loan-view']) ) ? 'active pcoded-trigger' : '' }}">
  <a href="javascript:void(0)">
    <span class="pcoded-micon"><i class="icofont icofont-briefcase-alt-1"></i><b>L</b></span>
    <span class="pcoded-mtext">Loans</span>
    <span class="pcoded-mcaret"></span>
  </a>
  <ul class="pcoded-submenu">
    <li class="{{ (Route::currentRouteName() === 'loan-list' && request()->segment(3) == '') ? 'active' : '' }}">
      <a href="{{ route('loan-list') }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">All</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'loan-list' && request()->segment(3) === 'OPENED') ? 'active' : '' }}">
      <a href="{{ route('loan-list', ['status' => 'OPENED']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Opened</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
  </ul>
</li>
<li class="{{ ( in_array(Route::currentRouteName(), ['invoice-list', 'invoice-view']) ) ? 'active pcoded-trigger' : '' }}">
  <a href="{{ route('invoice-list') }}">
    <span class="pcoded-micon"><i class="icofont icofont-bill"></i><b>I</b></span>
    <span class="pcoded-mtext">Invoices</span>
    <span class="pcoded-mcaret"></span>
  </a>
</li>
<li class="pcoded-hasmenu {{ ( in_array(Route::currentRouteName(), ['payment-list', 'payment-outstanding', 'payment-accept']) ) ? 'active pcoded-trigger' : '' }}">
  <a href="javascript:void(0)">
    <span class="pcoded-micon"><i class="icofont icofont-money"></i><b>I</b></span>
    <span class="pcoded-mtext">Payments</span>
    <span class="pcoded-mcaret"></span>
  </a>
  <ul class="pcoded-submenu">
    <li class="{{ (Route::currentRouteName() === 'payment-list' && request()->segment(3) == '') ? 'active' : '' }}">
      <a href="{{ route('payment-list') }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">All</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'payment-list' && request()->segment(3) === 'RENT') ? 'active' : '' }}">
      <a href="{{ route('payment-list', ['type' => 'RENT']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Rent</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'payment-list' && request()->segment(3) === 'REGISTRATION') ? 'active' : '' }}">
      <a href="{{ route('payment-list', ['type' => 'REGISTRATION']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Registration</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    {{-- <li class="{{ (Route::currentRouteName() === 'payment-list' && request()->segment(3) === 'INITIAL_DEPOSIT') ? 'active' : '' }}">
      <a href="{{ route('payment-list', ['type' => 'INITIAL_DEPOSIT']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Initial Deposit</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li> --}}
    <li class="{{ (Route::currentRouteName() === 'payment-outstanding') ? 'active' : '' }}">
      <a href="{{ route('payment-outstanding') }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Outstanding</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
  </ul>
</li>
