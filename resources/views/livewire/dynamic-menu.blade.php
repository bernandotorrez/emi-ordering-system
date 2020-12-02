@foreach($dataParentMenu as $key => $parentMenu)
<li class="menu single-menu {{ (request()->segment(1) == $parentMenu->prefix) ? 'active' : '' }}">
    <a href="#{{$parentMenu->url}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
        <div class="">
            <i class="fas fa-car"
                style="font-size: 20px"></i> &nbsp;
            <span>{{$parentMenu->nama_parent_menu}}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-chevron-down">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </a>
    <ul class="collapse submenu list-unstyled" id="{{$parentMenu->url}}" data-parent="#topAccordion">
        @foreach($parentMenu->childsMenu as $keyChild => $childMenu)
  
        <li class="sub-sub-submenu-list">
            <a href="#{{$childMenu->url}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
                {{$childMenu->nama_child_menu}} <svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg> </a>
            <ul class="collapse list-unstyled sub-submenu" id="{{$childMenu->url}}" data-parent="#{{$parentMenu->url}}">
                @foreach($childMenu->subChildsMenu as $keySubChild => $subChildMenu)
                
                <li class="sub-sub-sub-submenu-list">
                    <a href="#{{$subChildMenu->url}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
                    {{$subChildMenu->nama_sub_child_menu}} <svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg> </a>
                    <ul class="collapse list-unstyled sub-sub-submenu" id="{{$subChildMenu->url}}" data-parent="#{{$childMenu->url}}">

                        <!-- Sub Sub Child menu -->
                        @foreach($subChildMenu->subSubChildsMenu as $keySubSubChild => $subSubChildMenu)
                        <li class="text-wrap {{ (request()->is($subSubChildMenu->url)) ? 'active' : '' }}" style="overflow: hidden;">
                            <a href="{{ url($subSubChildMenu->url) }}"> {{$subSubChildMenu->nama_sub_sub_child_menu}}</a>
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
@endforeach
