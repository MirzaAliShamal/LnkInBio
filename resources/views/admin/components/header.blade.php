<!-- LOGO -->
<div class="topbar-left text-center text-lg-left">
    <a href="" class="logo">
        <span>
            <img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
        </span>
        <span>
            <img src="{{ asset('admin/assets/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light">
            <img src="{{ asset('admin/assets/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark">
        </span>
    </a>
</div>
<!--end logo-->
<!-- Navbar -->
<nav class="navbar-custom">
    <ul class="list-unstyled topbar-nav float-right mb-0">
        <li class="dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('admin/default.png') }}" alt="profile-user" class="rounded-circle" />
                <span class="ml-1 nav-user-name hidden-sm">{{ 'Sabir' }} <i class="mdi mdi-chevron-down"></i> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i> Profile</a>
                <div class="dropdown-divider mb-0"></div>
                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off text-muted mr-2"></i> Logout</a>
            </div>
        </li>
        <li class="menu-item">
            <!-- Mobile menu toggle-->
            <a class="navbar-toggle nav-link" id="mobileToggle">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a><!-- End mobile menu toggle-->
        </li> <!--end menu item-->
    </ul><!--end topbar-nav-->
</nav>
<!-- end navbar-->
