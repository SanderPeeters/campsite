<nav class="navbar navbar-static-top uppercase">
  <div class="container">
    <div class="navbar-header">

      <!-- Collapsed Hamburger -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- Branding Image -->
      <a class="navbar-brand" href="{{ url('/') }}" target="_self">
        <img src="assets/img/logo/Campsite_logo_white.png" alt="Logo from Campsite">
      </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        <li class="{{ Route::is('search-campsite') ? 'active' : '' }}"><a href="{{ route('search-campsite') }}" target="_self">{{trans('campsite.searchcampsite')}}</a></li>
        <li class="{{ Route::is('offer-campsite') ? 'active' : '' }}"><a href="{{ route('offer-campsite') }}" target="_self">{{ trans('campsite.offercampsite') }}</a></li>
        @if (Auth::guest())
          <li><a href="{{ route('login') }}" target="_self">Login</a></li>
          <li class=""><a href="{{ route('register') }}" target="_self">Register</a></li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        @endif
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{ app()->getLocale() }} <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu">
            @foreach (config('translatable.locales') as $lang => $language)
              @if ($lang != app()->getLocale())
                <li>
                  <a href="{{ route('lang.switch', $lang) }}" target="_self">
                    {{ $lang }}
                  </a>
                </li>
              @endif
            @endforeach
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
