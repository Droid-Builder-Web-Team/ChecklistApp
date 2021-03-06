<nav class="navbar navbar-expand-md navbar-dark navbar-primary">
    <!-- Brand -->
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>

    <!-- Toggler/collapsible Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        {{-- <span class="navbar-toggler-icon"></span> --}}
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>


    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <span class="flex-spacer"></span>
        <ul class="navbar-nav">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('droids.index.index') }}">
                        Droid Mainframe
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('droid.user.index') }}">
                        My Droids
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                        {{ Auth::user()->uname() }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.users.profile', Auth::user()->id) }}">
                            Profile
                        </a>

                        {{-- <a class="dropdown-item"
                            href="{{ route('admin.users.notifications', Auth::user()->id) }}">
                            Notifications
                        </a> --}}

                        @can('is-admin')
                            <a class="dropdown-item" href="{{ route('admin.admin.dashboard') }}">
                                Admin Dashboard
                            </a>
                        @elsecan('is-designer')
                            <a class="dropdown-item" href="{{ route('designer.dashboard') }}">
                                Designer Dashboard
                            </a>
                        @endcan

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
</nav>
