<header class="site-header mo-left header fullwidth" style="height: 83.4px;">
  <style>
    a{text-decoration: none;}
  </style>
    <!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix">
                <div class="containers clearfix" style="padding: 0 50px;">
                    <!-- website logo -->
                    <div class="logo-header mostion">
                      <a class="navbar-brand" href="{{ url('/') }}" style="color: #222;">
                          <img src="{{ asset('images/logo2_outline.svg') }}" alt="">
                      </a>
                    </div>
                    <!-- nav toggle button -->
                    <!-- nav toggle button -->
                    <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                      <span></span>
                      <span></span>
                      <span></span>
                    </button>
                    <!-- extra nav -->
                    @guest
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <a href="{{ route('login') }}"><i class="fa fa-upload"></i> Upload</a>
                                <a href="{{ route('register') }}" title="Join as a pro" class="site-button"><i class="fa fa-lock"></i> Join as a pro </a>
                            </div>
                        </div>
                        <!-- main nav -->
                        <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                            <ul class="nav navbar-nav">
                              <li> <a href="discover.html" style="text-decoration: none;">Discover</a> </li>
                              <li><a href="{{ route('login') }}" style="text-decoration: none;">Sign In</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('new-user') }}"  style="text-decoration: none;">Register</a>
                            </li>
                        @endif
                          </ul>
                      </div>
                    @else

                      @if(Auth::user()->account_type == "professional")
                      <div class="extra-nav" style="padding: 0;">
                          <div class="extra-cell header-nav">
                            <ul class="nav navbar-nav">
                              <li><a href="javascript:void(0);" data-toggle="modal" data-target="#uploadPhoto"><i class="fa fa-upload"></i> Upload</a></li>
                              <li>
                                <a href="/react/">{{Auth::user()->first_name}} <i class="fa fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                  <li><a class="dez-page" href="{{ route('home') }}">{{ __('Profile') }} <i class="fa fa-user float-right" aria-hidden="true"></i></a></li>
                                  <li><a class="dez-page" href="{{ route('dashboard') }}">{{ __('Dashboard') }} <i class="fa fa-bar-chart float-right" aria-hidden="true"></i></a></li>
                                  <li><a class="dez-page" href="{{ route('settings.index') }}">{{ __('Settings') }} <i class="fa fa-cogs float-right" aria-hidden="true"></i></a></li>
                                  <li>
                                    <a style="text-decoration: none;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out float-right" aria-hidden="true"></i>
                                        {{ __('Logout') }}
                                    </a>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                          </div>
                      </div>
                      @else
                      <div class="extra-nav" style="padding: 0;">
                          <div class="extra-cell header-nav">
                            <ul class="nav navbar-nav">
                              <li>
                                <a href="/react/">{{Auth::user()->first_name}} <i class="fa fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                  <li><a class="dez-page" href="{{ route('home') }}">{{ __('Profile') }} <i class="fa fa-user float-right" aria-hidden="true"></i></a></li>
                                  <li><a class="dez-page" href="{{ route('new-booking.index') }}">{{ __('New Booking') }} <i class="fa fa-user float-right" aria-hidden="true"></i></a></li>
                                  <li><a class="dez-page" href="{{ route('settings.index') }}">{{ __('Settings') }} <i class="fa fa-cogs float-right" aria-hidden="true"></i></a></li>
                                  <li>
                                    <a style="text-decoration: none;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out float-right" aria-hidden="true"></i>
                                        {{ __('Logout') }}
                                    </a>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                          </div>
                      </div>
                      @endif
                    @endguest
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
<!-- Modal -->
<div class="modal fade modal-bx-info editor" id="uploadPhoto" tabindex="-1" role="dialog" aria-labelledby="uploadPhoto" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UploadNewPhoto">Upload New Photo.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="saveForm" enctype="multipart/form-data">
            @csrf
            @method('GET')
            <div class="col-md-12">
                <div class="form-group">
                  <input type="file" name="picture[]" class="dropify" data-height="250" data-allowed-file-extensions="jpg jpeg png gig" multiple/>
                </div>
                <div class="form-group">
                  <label for="category">Select a package.</label>
                  <select class="form-control" name="category">
                    <option value="pet">Pet</option>
                    <option value="birthday">Birthday</option>
                  </select>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="site-button" data-dismiss="modal">Cancel</button>
        <button type="button" class="site-button"  id="saveImage">Upload Photo</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->
