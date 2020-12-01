<div class="topbar-nav header navbar" role="banner">
    <nav id="topbar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ url()->route('home.index') }}"">
                    <img src=" assets/img/90x90.jpg" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="/home" class="nav-link"> CORK </a>
            </li>
        </ul>

        <ul class="list-unstyled menu-categories" id="topAccordion">

            <li class="menu single-menu {{ Request::is('home') ? 'active' : '' }}">
                <a href="{{ url()->route('home.index') }}">
                    <div class="">
                        <i class="fas fa-home {{ Request::is('home') ? 'icon-active' : '' }}"
                            style="font-size: 20px"></i> &nbsp;
                        <span>Home</span>
                    </div>
                </a>
            </li>

            <li class="menu single-menu {{ Request::is('about') ? 'active' : '' }}">
                <a href="{{ url()->route('about.index') }}">
                    <div class="">
                        <i class="fas fa-info-circle {{ Request::is('about') ? 'icon-active' : '' }}"
                            style="font-size: 20px"></i> &nbsp;
                        <span>About</span>
                    </div>
                </a>
            </li>

            @livewire('dynamic-menu')
            <!-- Parent -->
            <li class="menu single-menu">
                <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-box">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span>Sales</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-down">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="menu2" data-parent="#topAccordion">
                    <!-- Child -->
                    <li class="sub-sub-submenu-list">
                        <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"> Sales Order <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu">

                            <!-- Subchild -->
                            <li class="sub-sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle"> ATPM <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> </a>
                                <ul class="collapse list-unstyled sub-sub-submenu" id="sub-sub-sub-category" data-parent="#menu">

                                    <!-- Sub Sub Child -->
                                    <li>
                                        <a href="javascript:void(0);"> Approval & Allocated </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Subchild -->
                            <li class="sub-sub-sub-submenu-list">
                                <a href="#sub-sub-category" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle"> Dealer <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> </a>
                                <ul class="collapse list-unstyled sub-sub-submenu" id="sub-sub-sub-category" data-parent="#menu">

                                    <!-- Sub Sub Child -->
                                    <li>
                                        <a href="javascript:void(0);"> Fix Order </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>

            @if(session()->get('level_access') == 1)
            <li class="menu single-menu {{ (request()->segment(1) == 'admin') ? 'active' : '' }}">
                <a href="#starter-kit" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                    <div class="">
                        <i class="fas fa-plus-circle {{ request()->segment(1) == 'admin' ? 'icon-active' : '' }}"
                            style="font-size: 20px"></i> &nbsp;
                        <span>Admin</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-down">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="starter-kit" data-parent="#topAccordion">

                    <li class="{{ (request()->is('admin/user')) ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}"> User </a>
                    </li>

                    <li class="{{ (request()->is('admin/user-group')) ? 'active' : '' }}">
                        <a href="{{ route('user-group.index') }}"> User Group </a>
                    </li>

                    <li class="{{ (request()->is('admin/parent-menu')) ? 'active' : '' }}">
                        <a href="{{ route('parent-menu.index') }}"> Parent Menu </a>
                    </li>

                    <li class="{{ (request()->is('admin/child-menu')) ? 'active' : '' }}">
                        <a href="{{ route('child-menu.index') }}"> Child Menu </a>
                    </li>

                </ul>
            </li>
            @endif
        </ul>
    </nav>
</div>
