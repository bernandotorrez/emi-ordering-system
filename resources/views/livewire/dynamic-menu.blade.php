
@foreach($dataParentMenu as $key => $parentMenu)
@if(count($parentMenu->childsMenu) == 0)
<li class="menu single-menu {{ Request::is($parentMenu->url) ? 'active' : '' }}">
    <a href="{{ url($parentMenu->url) }}">
        <div class="">
            <i class="{{ $parentMenu->icon }} {{ Request::is($parentMenu->url) ? 'icon-active' : '' }}"
                style="font-size: 20px"></i> &nbsp;
            <span>{{ $parentMenu->nama_parent_menu }}</span>
        </div>
    </a>
</li>
@else

<li class="menu single-menu {{ (request()->segment(1) == $parentMenu->url) ? 'active' : '' }}">
    <a href="#starter-kit" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
        <div class="">
            <i class="{{ $parentMenu->icon }} {{ request()->segment(1) == $parentMenu->url ? 'icon-active' : '' }}"
                style="font-size: 20px"></i> &nbsp;
            <span>{{ $parentMenu->nama_parent_menu }}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-chevron-down">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </a>
    <ul class="collapse submenu list-unstyled" id="starter-kit" data-parent="#topAccordion">
        @foreach($parentMenu->childsMenu as $key => $childMenu)
        <li class="single-menu {{ Request::is($childMenu->url) ? 'active' : '' }}">
            <a href="{{ url($childMenu->url) }}">
                <div class="">
                    <i class="{{ $childMenu->icon }} {{ Request::is($childMenu->url) ? 'icon-active' : '' }}"
                        style="font-size: 20px"></i> &nbsp;
                    <span>{{ $childMenu->nama_child_menu }}</span>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</li>


@endif
@endforeach
