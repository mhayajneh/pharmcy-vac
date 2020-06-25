<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <!--<li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                      <i class="fe fe-users"></i> Users
                    </a>
                  </li>-->

                </ul>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                      <i class="fe fe-home"></i> Home
                    </a>
                  </li>
                    @if(isset(\Auth::user()->type) && \Auth::user()->type == '1')
                    <li class="nav-item">
                        <a href="{{ route('admin.view', 1) }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                            <i class="fe fe-home"></i> Dashboard
                        </a>
                    </li>

                        <li class="nav-item">
                            <a href="{{ route('adminpharmacylist') }}" class="nav-link {{ Request::is('donations*') ? 'active' : '' }}">
                                <i class="fe fe-dollar-sign"></i> Pharmacies
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('adminuserlist') }}" class="nav-link {{ Request::is('donations*') ? 'active' : '' }}">
                                <i class="fe fe-dollar-sign"></i> Users
                            </a>
                        </li>

                    @endif

                  <li class="nav-item">
                      @if(isset(\Auth::user()->type) && \Auth::user()->type == '2')
                          <a href="{{ route('pharmacy.view',\Auth::user()->id ) }}" class="nav-link {{ Request::is('states*') ? 'active' : '' }}">
                              <i class="fe fe-globe"></i> Dashboard
                          </a>
                      @elseif(isset(\Auth::user()->type) && \Auth::user()->type == '3')
                          <a href="{{ route('trainee.view', \Auth::user()->id) }}" class="nav-link {{ Request::is('states*') ? 'active' : '' }}">
                              <i class="fe fe-globe"></i> Dashboard
                          </a>
                      @endif

                  </li>

                </ul>
              </div>
            </div>
          </div>
        </div>

        @if(false)
<nav class="navbar navbar-expand-md navbar-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pages
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('states.index') }}">States</a>
                <a class="dropdown-item" href="#">Donations</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('users.index') }}">User Management</a>
                <a class="dropdown-item" href="#">Site Settings</a>
              </div>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  <li class="nav-item">
                      @if (Route::has('register'))
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      @endif
                  </li>
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
      </div>
  </div>
</nav>
@endif
