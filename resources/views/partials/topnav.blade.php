<nav class="navbar header-navbar pcoded-header">
  <div class="navbar-wrapper">
    <div class="navbar-logo">
      <a class="mobile-menu" id="mobile-collapse" href="#!">
        <i class="ti-menu"></i>
      </a>
      <a class="mobile-search morphsearch-search" href="#">
        <i class="ti-search"></i>
      </a>
      <a href="index.html">
        <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="{{ env('WEBSITE_TITLE') }} Logo" style="width: 175px;" />
      </a>
      <a class="mobile-options">
        <i class="ti-more"></i>
      </a>
    </div>

    <div class="navbar-container container-fluid">
      <ul class="nav-left">
        <li>
          <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
          </div>
        </li>
        {{-- <li>
          <a class="main-search morphsearch-search" href="#">
            <!-- themify icon -->
            <i class="ti-search"></i>
          </a>
        </li> --}}
        {{-- <li>
          <a href="#!" onclick="javascript:toggleFullScreen()">
            <i class="ti-fullscreen"></i>
          </a>
        </li> --}}
        {{-- <li class="mega-menu-top">
          <a href="#">
            Mega
            <i class="ti-angle-down"></i>
          </a>
          <ul class="show-notification row">
            <li class="col-sm-3">
              <h6 class="mega-menu-title">Popular Links</h6>
              <ul class="mega-menu-links">
                <li><a href="form-elements-component.html">Form Elements</a></li>
                <li><a href="button.html">Buttons</a></li>
                <li><a href="map-google.html">Maps</a></li>
                <li><a href="user-card.html">Contact Cards</a></li>
                <li><a href="user-profile.html">User Information</a></li>
                <li><a href="auth-lock-screen.html">Lock Screen</a></li>
              </ul>
            </li>
            <li class="col-sm-3">
              <h6 class="mega-menu-title">Mailbox</h6>
              <ul class="mega-mailbox">
                <li>
                  <a href="#" class="media">
                    <div class="media-left">
                      <i class="ti-folder"></i>
                    </div>
                    <div class="media-body">
                      <h5>Data Backup</h5>
                      <small class="text-muted">Store your data</small>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#" class="media">
                    <div class="media-left">
                      <i class="ti-headphone-alt"></i>
                    </div>
                    <div class="media-body">
                      <h5>Support</h5>
                      <small class="text-muted">24-hour support</small>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#" class="media">
                    <div class="media-left">
                      <i class="ti-dropbox"></i>
                    </div>
                    <div class="media-body">
                      <h5>Drop-box</h5>
                      <small class="text-muted">Store large amount of data in one-box
                        only
                      </small>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#" class="media">
                    <div class="media-left">
                      <i class="ti-location-pin"></i>
                    </div>
                    <div class="media-body">
                      <h5>Location</h5>
                      <small class="text-muted">Find Your Location with ease of
                        use</small>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="col-sm-3">
              <h6 class="mega-menu-title">Gallery</h6>
              <div class="row m-b-20">
                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="{{ asset('assets/images/avatar-2.jpg ') }}"
                    alt="Gallery-1">
                </div>
                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="{{ asset('assets/images/avatar-3.jpg ') }}"
                    alt="Gallery-2">
                </div>
                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="{{ asset('assets/images/avatar-4.jpg ') }}"
                    alt="Gallery-3">
                </div>
              </div>
              <div class="row m-b-20">
                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="{{ asset('assets/images/avatar-3.jpg ') }}"
                    alt="Gallery-4">
                </div>
                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="{{ asset('assets/images/avatar-4.jpg ') }}"
                    alt="Gallery-5">
                </div>
                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="{{ asset('assets/images/avatar-2.jpg ') }}"
                    alt="Gallery-6">
                </div>
              </div>
              <button class="btn btn-primary btn-sm btn-block">Browse Gallery</button>
            </li>
            <li class="col-sm-3">
              <h6 class="mega-menu-title">Contact Us</h6>
              <div class="mega-menu-contact">
                <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Name</label>
                  <div class="col-9">
                    <input class="form-control" type="text" placeholder="Artisanal kale"
                      id="example-text-input">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="example-search-input" class="col-3 col-form-label">Email</label>
                  <div class="col-9">
                    <input class="form-control" type="email" placeholder="Enter your E-mail Id"
                      id="example-search-input1">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="example-search-input" class="col-3 col-form-label">Contact</label>
                  <div class="col-9">
                    <input class="form-control" type="number" placeholder="+91-9898989898"
                      id="example-search-input">
                  </div>
                </div>
                <div class="form-group row"> <label for="exampleTextarea"
                    class="col-3 col-form-label">Message</label>
                  <div class="col-9">
                    <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-12 text-right"> <button class="btn btn-primary">Submit</button> </div>
                </div>
              </div>
            </li>
          </ul>
        </li> --}}
      </ul>
      {{-- <ul class="nav-right">
        <li class="header-notification lng-dropdown">
          <a href="#" id="dropdown-active-item">
            <img src="{{ asset('assets/images/flags/ENGLISH.jpg ') }}" alt=""> English
          </a>
          <ul class="show-notification">
            <li>
              <a href="#" data-lng="en">
                <img src="{{ asset('assets/images/flags/ENGLISH.jpg ') }}" alt=""> English
              </a>
            </li>
            <li>
              <a href="#" data-lng="es">
                <img src="{{ asset('assets/images/flags/SPAIN.jpg ') }}" alt=""> Spanish
              </a>
            </li>
            <li>
              <a href="#" data-lng="pt">
                <img src="{{ asset('assets/images/flags/PORTO.jpg ') }}" alt=""> Portuguese
              </a>
            </li>
            <li>
              <a href="#" data-lng="fr">
                <img src="{{ asset('assets/images/flags/FRANCE.jpg ') }}" alt=""> French
              </a>
            </li>
          </ul>
        </li>
        <li class="header-notification">
          <a href="#!">
            <i class="ti-bell"></i>
            <span class="badge bg-c-pink"></span>
          </a>
          <ul class="show-notification">
            <li>
              <h6>Notifications</h6>
              <label class="label label-danger">New</label>
            </li>
            <li>
              <div class="media">
                <img class="d-flex align-self-center img-radius" src="{{ asset('assets/images/avatar-4.jpg ') }}"
                  alt="Generic placeholder image">
                <div class="media-body">
                  <h5 class="notification-user">John Doe</h5>
                  <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                    elit.</p>
                  <span class="notification-time">30 minutes ago</span>
                </div>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="d-flex align-self-center img-radius" src="{{ asset('assets/images/avatar-3.jpg ') }}"
                  alt="Generic placeholder image">
                <div class="media-body">
                  <h5 class="notification-user">Joseph William</h5>
                  <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                    elit.</p>
                  <span class="notification-time">30 minutes ago</span>
                </div>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="d-flex align-self-center img-radius" src="{{ asset('assets/images/avatar-4.jpg ') }}"
                  alt="Generic placeholder image">
                <div class="media-body">
                  <h5 class="notification-user">Sara Soudein</h5>
                  <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                    elit.</p>
                  <span class="notification-time">30 minutes ago</span>
                </div>
              </div>
            </li>
          </ul>
        </li>
        <li class="header-notification">
          <a href="#!" class="displayChatbox">
            <i class="ti-comments"></i>
            <span class="badge bg-c-green"></span>
          </a>
        </li>
        <li class="user-profile header-notification">
          <a href="#!">
            <img src="{{ asset('assets/images/avatar-4.jpg ') }}" class="img-radius" alt="User-Profile-Image">
            <span>{{ Auth::user()->email }}</span>
            <i class="ti-angle-down"></i>
          </a>
          <ul class="show-notification profile-notification">
            <li>
              <a href="{{ route('settings') }}">
                <i class="ti-settings"></i> Settings
              </a>
            </li>
            <li>
              <a href="user-profile.html">
                <i class="ti-user"></i> Profile
              </a>
            </li>
            <li>
              <a href="email-inbox.html">
                <i class="ti-email"></i> My Messages
              </a>
            </li>
            <li>
              <a href="auth-lock-screen.html">
                <i class="ti-lock"></i> Lock Screen
              </a>
            </li>
            <li>
              <a href="{{ route('logout') }}">
                <i class="ti-layout-sidebar-left"></i> Logout
              </a>
            </li>
          </ul>
        </li>
      </ul> --}}
      <!-- search -->
      <div id="morphsearch" class="morphsearch">
        <form class="morphsearch-form">
          <input class="morphsearch-input" type="search" placeholder="Search..." />
          <button class="morphsearch-submit" type="submit">Search</button>
        </form>
        <div class="morphsearch-content">
          <div class="dummy-column">
            <h2>People</h2>
            <a class="dummy-media-object img-radius" href="#!">
              <img src="{{ asset('assets/images/avatar-4.jpg ') }}" class="img-radius" alt="Sara Soueidan" />
              <h3>Sara Soueidan</h3>
            </a>
            <a class="dummy-media-object img-radius" href="#!">
              <img src="{{ asset('assets/images/avatar-2.jpg ') }}" class="img-radius" alt="Shaun Dona" />
              <h3>Shaun Dona</h3>
            </a>
          </div>
          <div class="dummy-column">
            <h2>Popular</h2>
            <a class="dummy-media-object img-radius" href="#!">
              <img src="{{ asset('assets/images/avatar-3.jpg ') }}" class="img-radius" alt="PagePreloadingEffect" />
              <h3>Page Preloading Effect</h3>
            </a>
            <a class="dummy-media-object img-radius" href="#!">
              <img src="{{ asset('assets/images/avatar-4.jpg ') }}" class="img-radius" alt="DraggableDualViewSlideshow" />
              <h3>Draggable Dual-View Slideshow</h3>
            </a>
          </div>
          <div class="dummy-column">
            <h2>Recent</h2>
            <a class="dummy-media-object img-radius" href="#!">
              <img src="{{ asset('assets/images/avatar-2.jpg ') }}" class="img-radius" alt="TooltipStylesInspiration" />
              <h3>Tooltip Styles Inspiration</h3>
            </a>
            <a class="dummy-media-object img-radius" href="#!">
              <img src="{{ asset('assets/images/avatar-3.jpg ') }}" class="img-radius" alt="NotificationStyles" />
              <h3>Notification Styles Inspiration</h3>
            </a>
          </div>
        </div>
        <!-- /morphsearch-content -->
        <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
      </div>
      <!-- search end -->
    </div>
  </div>
</nav>

<!-- Sidebar chat start -->
<div id="sidebar" class="users p-chat-user showChat">
  <div class="had-container">
    <div class="card card_main p-fixed users-main">
      <div class="user-box">
        <div class="card-block">
          <div class="right-icon-control">
            <input type="text" class="form-control  search-text" placeholder="Search Friend"
              id="search-friends">
            <div class="form-icon">
              <i class="icofont icofont-search"></i>
            </div>
          </div>
        </div>
        <div class="main-friend-list">
          <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe"
            data-toggle="tooltip" data-placement="left" title="Josephin Doe">
            <a class="media-left" href="#!">
              <img class="media-object img-radius img-radius" src="{{ asset('assets/images/avatar-3.jpg ') }}"
                alt="Generic placeholder image ">
              <div class="live-status bg-success"></div>
            </a>
            <div class="media-body">
              <div class="f-13 chat-header">Josephin Doe</div>
            </div>
          </div>
          <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe"
            data-toggle="tooltip" data-placement="left" title="Lary Doe">
            <a class="media-left" href="#!">
              <img class="media-object img-radius" src="{{ asset('assets/images/avatar-2.jpg ') }}"
                alt="Generic placeholder image">
              <div class="live-status bg-success"></div>
            </a>
            <div class="media-body">
              <div class="f-13 chat-header">Lary Doe</div>
            </div>
          </div>
          <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice"
            data-toggle="tooltip" data-placement="left" title="Alice">
            <a class="media-left" href="#!">
              <img class="media-object img-radius" src="{{ asset('assets/images/avatar-4.jpg ') }}"
                alt="Generic placeholder image">
              <div class="live-status bg-success"></div>
            </a>
            <div class="media-body">
              <div class="f-13 chat-header">Alice</div>
            </div>
          </div>
          <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia"
            data-toggle="tooltip" data-placement="left" title="Alia">
            <a class="media-left" href="#!">
              <img class="media-object img-radius" src="{{ asset('assets/images/avatar-3.jpg ') }}"
                alt="Generic placeholder image">
              <div class="live-status bg-success"></div>
            </a>
            <div class="media-body">
              <div class="f-13 chat-header">Alia</div>
            </div>
          </div>
          <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen"
            data-toggle="tooltip" data-placement="left" title="Suzen">
            <a class="media-left" href="#!">
              <img class="media-object img-radius" src="{{ asset('assets/images/avatar-2.jpg ') }}"
                alt="Generic placeholder image">
              <div class="live-status bg-success"></div>
            </a>
            <div class="media-body">
              <div class="f-13 chat-header">Suzen</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Sidebar inner chat start-->
<div class="showChat_inner">
  <div class="media chat-inner-header">
    <a class="back_chatBox">
      <i class="icofont icofont-rounded-left"></i> Josephin Doe
    </a>
  </div>
  <div class="media chat-messages">
    <a class="media-left photo-table" href="#!">
      <img class="media-object img-radius img-radius m-t-5" src="{{ asset('assets/images/avatar-3.jpg ') }}"
        alt="Generic placeholder image">
    </a>
    <div class="media-body chat-menu-content">
      <div class="">
        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?
        </p>
        <p class="chat-time">8:20 a.m.</p>
      </div>
    </div>
  </div>
  <div class="media chat-messages">
    <div class="media-body chat-menu-reply">
      <div class="">
        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?
        </p>
        <p class="chat-time">8:20 a.m.</p>
      </div>
    </div>
    <div class="media-right photo-table">
      <a href="#!">
        <img class="media-object img-radius img-radius m-t-5" src="{{ asset('assets/images/avatar-4.jpg ') }}"
          alt="Generic placeholder image">
      </a>
    </div>
  </div>
  <div class="chat-reply-box p-b-20">
    <div class="right-icon-control">
      <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
      <div class="form-icon">
        <i class="icofont icofont-paper-plane"></i>
      </div>
    </div>
  </div>
</div>
<!-- Sidebar inner chat end-->