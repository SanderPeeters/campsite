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
        <li class="{{ Route::is('search-campsite') ? 'active' : '' }}"><a href="{{ route('search-campsite') }}" target="_self">{{trans('navigation.campsite-search')}}</a></li>
        <li class="{{ Route::is('offer-campsite') ? 'active' : '' }}"><a href="{{ route('offer-campsite') }}" target="_self">{{ ( Auth::check() && Auth::user()->campsite ) ? trans('navigation.campsite-offer.has-campsites') : trans('navigation.campsite-offer.no-campsites') }}</a></li>
        @if (Auth::guest())
          <li><a href="{{ route('login') }}" target="_self">{{ trans('navigation.login') }}</a></li>
          <li class=""><a href="{{ route('register') }}" target="_self">{{ trans('navigation.register') }}</a></li>
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
        @else
          <li>
            <a href="{{ route('my-profile') }}" target="_self">{{ trans('navigation.my-profile') }}</a>
          </li>
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
          <li>
            <a href="{{ url('/logout') }}" target="_self"
               onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
