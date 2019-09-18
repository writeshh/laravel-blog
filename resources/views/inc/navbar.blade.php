<!-- Start Navbar Area -->

<header class="header trans_400">
    <div class="header_content d-flex flex-row align-items-center justify-content-start trans_400">
        <div class="logo"> <img src="{{asset('img/logo.png')}}" alt="">   </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-2">
                    <nav class="main_nav">
                        <ul class="d-flex flex-row align-items-center justify-content-start">
                            <li class="active"><a href="/">Home</a></li>
                            <li><a href="/about">About us</a></li>
                            <li><a href="/blog">Blog</a></li>
                            <li><a href="/contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="header_right d-flex flex-row align-items-center justify-content-start">

        <!-- Header Links -->
        <div class="header_links">
            <ul class="d-flex flex-row align-items-center justify-content-start">
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
                    <!-- Account -->
                    <div class="phone d-flex flex-row align-items-center justify-content-start">
                        <i class="fas fa-user"></i>
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                <a class="dropdown-item" href="/posts">My Posts</a>
                                <a class="dropdown-item" href="/tags">My Tags</a>
                                <a class="dropdown-item" href="/categories">My Categories</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </ul>
        </div>

        <!-- Hamburger -->
        <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
    </div>
</div>
</header>

<!-- Menu -->

<div class="menu trans_500">
    <div class="menu_content d-flex flex-column align-items-center justify-content-center">
        <div class="menu_nav trans_500">
            <ul class="text-center">
                <li><a href="/">Home</a></li>
                <li><a href="/about">About us</a></li>
                <li><a href="/blog">News</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>
        <div class="phone menu_phone d-flex flex-row align-items-center justify-content-start">
            <i class="fas fa-user"></i>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/dashboard">Dashboard</a>
                <a class="dropdown-item" href="/posts">My Posts</a>
                <a class="dropdown-item" href="/tags">My Tags</a>
                <a class="dropdown-item" href="/categories">My Categories</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Navbar Area -->
