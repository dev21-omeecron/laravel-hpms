@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}" data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="{{ url('/') }}">
          <span class="brand-logo">
            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
              <!-- Logo SVG code remains the same -->
            </svg>
          </span>
          <h2 class="brand-text mb-0">Vuexy</h2>
        </a>
      </li>
    </ul>
  </div>
  @else
  <nav class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating' ? 'container-xxl' : '' }}">
    @endif
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
          <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link nav-link-style">
              <i class="ficon" data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i>
            </a>
          </li>
        </ul>
      </div>

      <ul class="nav navbar-nav align-items-center ms-auto">
        <!-- Language Dropdown -->
        <li class="nav-item dropdown dropdown-language">
          <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
            <i class="flag-icon flag-icon-us"></i>
            <span class="selected-language">English</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
            <a class="dropdown-item" href="{{ url('lang/en') }}" data-language="en">
              <i class="flag-icon flag-icon-us"></i> English
            </a>
            <a class="dropdown-item" href="{{ url('lang/fr') }}" data-language="fr">
              <i class="flag-icon flag-icon-fr"></i> French
            </a>
            <a class="dropdown-item" href="{{ url('lang/de') }}" data-language="de">
              <i class="flag-icon flag-icon-de"></i> German
            </a>
            <a class="dropdown-item" href="{{ url('lang/pt') }}" data-language="pt">
              <i class="flag-icon flag-icon-pt"></i> Portuguese
            </a>
          </div>
        </li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown dropdown-user">
          <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true">
            <div class="user-nav d-sm-flex d-none">
              <div class="user-name">
                <span>Welcome, <br>
                  @if(Auth::guard('admin')->check())
                  {{ Auth::guard('admin')->user()->username }}
                  @elseif(Auth::guard('doctor')->check())
                  Dr. {{ Auth::guard('doctor')->user()->docname }}
                  @elseif(Auth::guard('patient')->check())
                  {{ Auth::guard('patient')->user()->username }}
                  @endif
                </span>
              </div>
              <span class="user-status">
                <!-- @if(Auth::guard('admin')->check())
                Admin
                @elseif(Auth::guard('doctor')->check())
                Doctor
                @elseif(Auth::guard('patient')->check())
                Patient
                @endif -->
              </span>
            </div>
            <span class="avatar">
              <img class="round" src="{{ optional(Auth::user())->profile_photo_url ?: asset('images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40" onerror="this.onerror=null;this.src='{{ asset('images/portrait/small/avatar-s-11.jpg') }}';">
              <span class="avatar-status-online"></span>
            </span>


          </a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0)' }}">
              <i class="me-50" data-feather="user"></i> Profile
            </a>
            <a class="dropdown-item" href="#">
              <i class="me-50" data-feather="settings"></i> Settings
            </a>
            @if (Auth::check())
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="me-50" data-feather="power"></i> Logout
            </a>
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
              @csrf
            </form>
            @else
            <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
              <i class="me-50" data-feather="log-in"></i> Login
            </a>
            @endif
          </div>
        </li>
      </ul>
    </div>
  </nav>