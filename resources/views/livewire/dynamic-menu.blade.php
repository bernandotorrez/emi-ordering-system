
@foreach($dataParentMenu as $key => $parentMenu)

@if(isset($dataParentMenu[0]->childsMenu[0]->subChildsMenu[0]->subSubChildsMenu[0]))
<li class="menu single-menu {{ (request()->segment(1) == $parentMenu->prefix) ? 'active' : '' }}">
    <a href="#{{Str::slug($parentMenu->nama_parent_menu, '-')}}" data-toggle="collapse" aria-expanded="false"
        class="dropdown-toggle autodroprown">
        <div class="">
            @if($parentMenu->icon)
            <i class="{{$parentMenu->icon}}" style="font-size: 20px"></i> &nbsp;
            @endif
            <span>{{$parentMenu->nama_parent_menu}}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-chevron-down">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </a>
    <ul class="collapse submenu list-unstyled" id="{{Str::slug($parentMenu->nama_parent_menu, '-')}}"
        data-parent="#topAccordion">
  
        @foreach($parentMenu->childsMenu as $keyChild => $childMenu)

        <li class="sub-sub-submenu-list">
            <a href="#{{Str::slug($childMenu->nama_child_menu, '-')}}" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle">
                @if($childMenu->icon)
                <i class="{{$childMenu->icon}}" style="font-size: 20px"></i>
                @endif
                {{$childMenu->nama_child_menu}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
            <ul class="collapse list-unstyled sub-submenu" id="{{Str::slug($childMenu->nama_child_menu, '-')}}"
                data-parent="#{{Str::slug($childMenu->nama_child_menu, '-')}}">

                @foreach($childMenu->subChildsMenu as $keySubChildMenu => $subChildMenu)

                <li class="sub-sub-sub-submenu-list">
                    <a href="#{{Str::slug($subChildMenu->nama_sub_child_menu, '-')}}" data-toggle="collapse"
                        aria-expanded="false" class="dropdown-toggle">
                        @if($subChildMenu->icon)
                        <i class="{{$subChildMenu->icon}}" style="font-size: 20px"></i>
                        @endif
                        {{$subChildMenu->nama_sub_child_menu}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                    <ul class="collapse list-unstyled sub-sub-submenu"
                        id="{{Str::slug($subChildMenu->nama_sub_child_menu, '-')}}"
                        data-parent="#{{Str::slug($subChildMenu->nama_sub_child_menu, '-')}}">

                        @foreach($subChildMenu->subSubChildsMenu as $keySubSubChildMenu => $subSubChildMenu)
                        <li class="text-wrap {{ (request()->is($subSubChildMenu->url)) ? 'active' : '' }}"
                            style="overflow: hidden;">
                            <a href="{{ url($subSubChildMenu->url) }}">
                                @if($subSubChildMenu->icon)
                                <i class="{{$subSubChildMenu->icon}}" style="font-size: 20px"></i> &nbsp;
                                @endif
                                {{$subSubChildMenu->nama_sub_sub_child_menu}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</li>
@elseif(isset($dataParentMenu[0]->childsMenu[0]->subChildsMenu[0]))
<li class="menu single-menu {{ (request()->segment(1) == $parentMenu->prefix) ? 'active' : '' }}">
    <a href="#{{Str::slug($parentMenu->nama_parent_menu, '-')}}" data-toggle="collapse" aria-expanded="false"
        class="dropdown-toggle autodroprown">
        <div class="">
            @if($parentMenu->icon)
            <i class="{{$parentMenu->icon}}" style="font-size: 20px"></i> &nbsp;
            @endif
            <span>{{$parentMenu->nama_parent_menu}}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-chevron-down">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </a>
    <ul class="collapse submenu list-unstyled" id="{{Str::slug($parentMenu->nama_parent_menu, '-')}}"
        data-parent="#topAccordion">

        @foreach($parentMenu->childsMenu as $keyChild => $childMenu)

        <li class="sub-sub-submenu-list">
            <a href="#{{Str::slug($childMenu->nama_child_menu, '-')}}" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle">
                @if($childMenu->icon)
                <i class="{{$childMenu->icon}}" style="font-size: 20px"></i>
                @endif
                {{$childMenu->nama_child_menu}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
            <ul class="collapse list-unstyled sub-submenu" id="{{Str::slug($childMenu->nama_child_menu, '-')}}"
                data-parent="#{{Str::slug($childMenu->nama_child_menu, '-')}}">

                @foreach($childMenu->subChildsMenu as $keySubChildMenu => $subChildMenu)

                <li class="menu single-menu {{ Request::is($subChildMenu->url) ? 'active' : '' }}">
                    <a href="{{ url($subChildMenu->url) }}">
                        <div class="">
                            <i class="{{$subChildMenu->icon}} {{ Request::is($subChildMenu->url) ? 'icon-active' : '' }}"
                                style="font-size: 20px"></i>
                            &nbsp;
                            <span>{{$subChildMenu->nama_sub_child_menu}}</span>
                        </div>
                    </a>
                </li>

                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</li>
@elseif(isset($dataParentMenu[0]->childsMenu[0]))
<li class="menu single-menu {{ (request()->segment(1) == $parentMenu->prefix) ? 'active' : '' }}">
    <a href="#{{Str::slug($parentMenu->nama_parent_menu, '-')}}" data-toggle="collapse" aria-expanded="false"
        class="dropdown-toggle autodroprown">
        <div class="">
            @if($parentMenu->icon)
            <i class="{{$parentMenu->icon}}" style="font-size: 20px"></i> &nbsp;
            @endif
            <span>{{$parentMenu->nama_parent_menu}}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-chevron-down">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </a>
    <ul class="collapse submenu list-unstyled" id="{{Str::slug($parentMenu->nama_parent_menu, '-')}}"
        data-parent="#topAccordion">
        @foreach($parentMenu->childsMenu as $keyChild => $childMenu)

        <li class="menu single-menu {{ Request::is($childMenu->url) ? 'active' : '' }}">
            <a href="{{ url($childMenu->url) }}">
                <div class="">
                    @if($childMenu->icon)
                    <i class="{{$childMenu->icon}} {{ Request::is($childMenu->url) ? 'icon-active' : '' }}"
                        style="font-size: 20px"></i>
                    &nbsp;
                    @endif
                    <span>{{$childMenu->nama_child_menu}}</span>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</li>

@elseif(isset($dataParentMenu[0]))
<li class="menu single-menu {{ Request::is($parentMenu->url) ? 'active' : '' }}">
    <a href="{{ url($parentMenu->url) }}">
        <div class="">
            @if($parentMenu->icon)
            <i class="{{$parentMenu->icon}} {{ Request::is($parentMenu->url) ? 'icon-active' : '' }}"
                style="font-size: 20px"></i>
            &nbsp;
            @endif
            <span>{{$parentMenu->nama_parent_menu}}</span>
        </div>
    </a>
</li>
@endif
@endforeach
