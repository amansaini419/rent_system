<nav class="pcoded-navbar">
  <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
  <div class="pcoded-inner-navbar main-menu">
    <ul class="pcoded-item pcoded-left-item">
      <li class="{{ (Route::currentRouteName() === 'dashboard') ? 'active pcoded-trigger' : '' }}">
        <a href="{{ route('dashboard') }}">
          <span class="pcoded-micon"><i class="icofont icofont-dashboard-web"></i><b>D</b></span>
          <span class="pcoded-mtext" data-i18n="nav.navigate.main">Dashboard</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      @if(Auth::user()->user_type == "TENANT")
        @include('partials.tenant')
      @elseif (Auth::user()->user_type == "ADMIN")
        @include('partials.admin')
      @elseif (Auth::user()->user_type == "STAFF" || Auth::user()->user_type == "AGENT")
        @include('partials.staff')
      @endif
      <li class="">
        <a href="{{ route('logout') }}">
          <span class="pcoded-micon"><i class="icofont icofont-logout"></i><b>L</b></span>
          <span class="pcoded-mtext" data-i18n="nav.navigate.main">Log Out</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
    </ul>
  </div>
</nav>
