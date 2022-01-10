<div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
{{--        {{ config('app.name', 'Laravel') }}--}}
        {{ __('Home') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        @auth()
        <div class="navbar-nav mr-auto">
            @role('admin')
                @include('roles.admin')
            @endrole
            @unlessrole('player|coach|admin|referee')
            @include('roles.user')
            @endrole
            @role('player')
            @include('roles.player')
            @endrole
            @role('coach')
            @include('roles.coach')
            @endrole
            @role('referee')
            @include('roles.referee')
            @endrole
        </div>
        @endauth()
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item card-button">
                        <a class="nav-link btn-secondary text-white rounded" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item card-button">
                        <a class="nav-link btn-secondary text-white rounded" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown card-button">
                    <a type="button" class="btn btn-secondary" href="{{route('notifications.index')}}">
                        {{__('Notifications')}}
                        @if($navbarNotifications > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{$navbarNotifications}}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item dropdown card-button">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle btn-secondary text-white rounded" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</div>

