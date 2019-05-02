<!DOCTYPE html>
<html>
<head>
  <title>Library - @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bulma.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome/all.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
  @yield('style')
</head>
<body class="container">
  <div class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">
    </div>
  </div>
  <div class="fab has-text-white">
    <i class="fa fa-arrow-up fa-lg"></i>
  </div>
  <main class="hero is-fullheight">
    <header class="hero-head navbar is-fixed-top is-transparent">
      <div class="navbar-brand">
        <a class="navbar-item" href="{{ url('/') }}">
          <img class="lib-logo" src="{{ asset('library-logo.png') }}">
        </a>
        <div class="navbar-burger burger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="navbar-menu">
        @if (!Auth::guest())
          <div class="navbar-start">
            <a class="navbar-item" href="{{ url('/') }}">
              <span class="icon">
                <i class="fa fa-home"></i>
              </span>
              <span>Dashboard</span>
            </a>
            <a class="navbar-item" href="{{ url('/notifications') }}">
              <span class="icon">
                <i class="fa fa-bell"></i>
              </span>
              <span>
                Notification
                <span id="notificationsNumber"></span>
              </span>
            </a>
            <a class="navbar-item" href="{{ url('/books') }}">
              <span class="icon">
                <i class="fa fa-book"></i>
              </span>
              <span>Books</span>
            </a>
            @if (Auth::user()->is_admin == 1)
              <a class="navbar-item" href="{{ url('/users') }}">
                <span class="icon">
                  <i class="fa fa-users"></i>
                </span>
                <span>Users</span>
              </a>
              <a class="navbar-item" href="{{ url('/transactions') }}">
                <span class="icon">
                  <i class="fa fa-list"></i>
                </span>
                <span>Transactions</span>
              </a>
            @endif
          </div>
        @endif
        <div class="navbar-end">
          @if (Auth::guest())
            <a class="navbar-item nav-item-button" href="{{ url('/login') }}">
              <span class="button is-link is-outlined is-rounded nav-button">Login</span>
            </a>
            <a class="navbar-item nav-item-button" href="{{ url('/register') }}">
              <span class="button is-primary is-rounded nav-button">Register</span>
            </a>
          @else
            <a class="navbar-item">
              <span class="icon">
                <i class="fa fa-calendar-alt"></i>
              </span>
              <span>
                {{\Carbon\Carbon::now('Asia/Jakarta')->format('D, d M Y')}}
              </span>
            </a>
            <div class="navbar-item has-dropdown is-hoverable user-menu">
              <a class="navbar-item">
                <span class="icon">
                  <i class="fa fa-user"></i>
                </span>
                <span>{{ Auth::user()->name }}</span>
                <span class="icon">
                  <i class="fa fa-caret-down"></i>
                </span>
              </a>
              <div class="navbar-dropdown">
                <a class="navbar-item">
                  <span class="icon">
                    <i class="fa fa-cog"></i>
                  </span>
                  <span class="navbar-link is-arrowless">Settings</span>
                </a>
                <a class="navbar-item" href="{{ url('/api/logout') }}">
                  <span class="icon">
                    <i class="fa fa-sign-out-alt"></i>
                  </span>
                  <span class="navbar-link is-arrowless">Logout</span>
                </a>
              </div>
            </div>
          @endif
        </div>
      </div>
    </header>

    <content class="hero-body">
      @yield('content')
    </content>

    <footer class="hero-footer has-text-centered is-size-6">
      Bonavita Library System &copy; 2019
    </footer>
  </main>

  <script async type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
  <script async type="text/javascript" src="{{ asset('js/req.js') }}"></script>
  <script async type="text/javascript" src="{{ asset('js/helper.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
  @yield('script')
</body>
</html>