<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="{{ route('dashboard') }}">
                    <img src="{{ asset('public/images/logo/logo.png') }}" alt="logo" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="{{ ( request()->is('/') ) ? 'active' : '' }}" ><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashbaord</a></li>
                <li class="{{ ( request()->is('deal') ) ? 'active' : '' }}" ><a href="{{ route('deal') }}"><i class="fa fa-thumbs-up"></i>Deal</a></li>
                <li class="{{ ( request()->is('campaign') ) ? 'active' : '' }}"><a href="{{ route('campaign') }}"><i class="fa fa-volume-up"></i>Campaign</a></li>
                <li><a href="{{ route('nopage') }}"><i class="fa fa-wrench"></i>Ad Operation</a></li>
                <li><a href="{{ route('nopage') }}"><i class="fa fa-user"></i>Advertiser Profile</a></li>
                <li><a href="{{ route('nopage') }}"><i class="fa fa-file"></i>Reports</a></li>
                <li><a href="{{ route('nopage') }}"><i class="fa fa-sitemap"></i>Administration</a></li>
            </ul>
        </div>
    </nav>
</header>