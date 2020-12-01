<div class="topbar-nav header navbar" role="banner">
    <nav id="topbar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ url()->route('home.index') }}"">
                    <img src=" assets/img/90x90.jpg" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="/home" class="nav-link"> <h6>EMI Ordering System</h6> </a>
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
                <a href="#parent-menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                    <div class="">
                        <i class="fas fa-car {{ request()->segment(1) == 'admin' ? 'icon-active' : '' }}"
                            style="font-size: 20px"></i> &nbsp;
                        <span>Sales</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-down">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="parent-menu" data-parent="#topAccordion">
                    <!-- Child -->
                    <li class="sub-sub-submenu-list">
                        <a href="#child-menu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"> Sales Order <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="child-menu" data-parent="#parent-menu">

                            <!-- Subchild -->
                            <li class="sub-sub-sub-submenu-list">
                                <a href="#sub-child" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle"> ATPM <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> </a>
                                <ul class="collapse list-unstyled sub-sub-submenu" id="sub-child" data-parent="#child-menu">

                                    <!-- Sub Sub Child -->
                                    <li>
                                        <a href="{{ url('home') }}"> Approval & Allocated ATPM</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Subchild -->
                            <li class="sub-sub-sub-submenu-list">
                                <a href="#sub-child1" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle"> Dealer <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> </a>
                                <ul class="collapse list-unstyled sub-sub-submenu" id="sub-child1" data-parent="#child-menu">

                                    <!-- Sub Sub Child -->
                                    <li>
                                        <a href="javascript:void(0);"> Fix Order </a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0);"> Additional Order </a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0);"> History Order </a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0);"> Approval Dealer Principle </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Subchild -->
                            <li class="sub-sub-sub-submenu-list">
                                <a href="#sub-child2" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle"> Report <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> </a>
                                <ul class="collapse list-unstyled sub-sub-submenu" id="sub-child2" data-parent="#child-menu">

                                    <!-- Sub Sub Child -->
                                    <li>
                                        <a href="javascript:void(0);"> Report Order </a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0);"> Report Order Analyst </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <!-- Child -->
                    <li class="sub-sub-submenu-list">
                        <a href="#child-menu1" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"> Master Data <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="child-menu1" data-parent="#parent-menu1">

                            <!-- Subchild -->
                            <li class="sub-sub-sub-submenu-list">
                                <a href="#sub-child1" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle"> ATPM <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> </a>
                                <ul class="collapse list-unstyled sub-sub-submenu" id="sub-child1" data-parent="#child-menu1">

                                    <!-- Sub Sub Child -->
                                    <li>
                                        <a href="{{ url('home') }}"> Vehicle Model </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Subchild -->
                            <li class="sub-sub-sub-submenu-list">
                                <a href="#sub-child11" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle"> Dealer <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> </a>
                                <ul class="collapse list-unstyled sub-sub-submenu" id="sub-child11" data-parent="#child-menu1">

                                    <!-- Sub Sub Child -->
                                    <li>
                                        <a href="javascript:void(0);"> Create Sales </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>


            @if(session()->get('level_access') == 1)
            <li class="menu single-menu {{ (request()->segment(1) == 'admin') ? 'active' : '' }}">
                <a href="#admin" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
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
                <ul class="collapse submenu list-unstyled" id="admin" data-parent="#topAccordion">

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

                    <li class="{{ (request()->is('admin/sub-child-menu')) ? 'active' : '' }}">
                        <a href="{{ route('sub-child-menu.index') }}"> Sub Child Menu </a>
                    </li>

                </ul>
            </li>
            @endif
        </ul>
    </nav>
</div>
