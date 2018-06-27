<nav class="navbar page-header">
    <div class="container-fluid">
        <a class="navbar-brand font-lg" href="#">
            {{ config('app.name', 'Laravel') }}
        </a>

        <ul class="navbar-nav mr-auto">
            @admin(Auth::user())
                <li class="nav-item p-2">
                    <a class="nav-link" href="{{ route('home') }}">
                        Admin Dashboard
                    </a>
                </li>
            @endadmin
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item p-2">
                <a href="{{ route('about') }}">About</a>
            </li>
            <li class="nav-item p-2">
                <a href="{{ route('contact') }}">Contact</a>
            </li>
            <li class="nav-item dropdown ml-5">
                @auth
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('vendor/carbon-master/imgs/avatar-1.png') }}" class="avatar avatar-sm" alt="logo">
                        <span class="small ml-1 d-md-down-none">@auth{{ Auth::user()->name }}@endauth</span>
                    </a>
                @endauth

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">Account</div>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-user"></i> Profile
                    </a>

                    <div class="dropdown-header">Settings</div>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-bell"></i> Notifications
                    </a>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-wrench"></i> Settings
                    </a>

                    @guest
                        <li class="nav-item  border-2 border-solid border-indigo-light">
                            <a class="nav-link p-2" href="{{ route('login') }}">Login</a>
                        </li>
                    @else

                    <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" >

                        <i class="fa fa-sign-out"></i> Logout

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                    @endguest

                </div>
            </li>
        </ul>
    </div>
</nav>
