<li class="{{ ( in_array(Route::currentRouteName(), ['application-list', 'application-register']) ) ? 'active pcoded-trigger' : '' }}">
  <a href="{{ route('application-list') }}">
    <span class="pcoded-micon"><i class="ti-files"></i><b>D</b></span>
    <span class="pcoded-mtext" data-i18n="nav.navigate.main">Applications</span>
    <span class="pcoded-mcaret"></span>
  </a>
</li>
<li class="{{ ( in_array(Route::currentRouteName(), ['loan-list', 'loan-view']) ) ? 'active pcoded-trigger' : '' }}">
  <a href="{{ route('loan-list') }}">
    <span class="pcoded-micon"><i class="icofont icofont-briefcase-alt-1"></i><b>L</b></span>
    <span class="pcoded-mtext" data-i18n="nav.navigate.main">Loans</span>
    <span class="pcoded-mcaret"></span>
  </a>
</li>
<li class="{{ ( in_array(Route::currentRouteName(), ['invoice-list', 'invoice-view']) ) ? 'active pcoded-trigger' : '' }}">
  <a href="{{ route('invoice-list') }}">
    <span class="pcoded-micon"><i class="icofont icofont-bill"></i><b>I</b></span>
    <span class="pcoded-mtext" data-i18n="nav.navigate.main">Invoices</span>
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
    <li class="{{ (Route::currentRouteName() === 'payment-list' && request()->segment(3) === 'INITIAL_DEPOSIT') ? 'active' : '' }}">
      <a href="{{ route('payment-list', ['type' => 'INITIAL_DEPOSIT']) }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Initial Deposit</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
    <li class="{{ (Route::currentRouteName() === 'payment-outstanding') ? 'active' : '' }}">
      <a href="{{ route('payment-outstanding') }}">
        <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
        <span class="pcoded-mtext">Outstanding</span>
        <span class="pcoded-mcaret"></span>
      </a>
    </li>
  </ul>
</li>
