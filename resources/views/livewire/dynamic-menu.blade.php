

@foreach($dataMenuUserGroup as $keyUserGroup => $userGroup)
    @php
        $dataParentMenu = \App\Models\ParentMenu::where(['status' => '1', 'id_parent_menu' => $userGroup->id_parent_menu])->get()
    @endphp
    @foreach($dataParentMenu as $key => $parentMenu)
    <li class="menu single-menu {{ (request()->segment(1) == $parentMenu->prefix) ? 'active' : '' }}">
        <a href="#{{Str::slug($parentMenu->nama_parent_menu, '-')}}" data-toggle="collapse" aria-expanded="false"
            class="dropdown-toggle autodroprown">
            <div class="">
                <i class="{{$parentMenu->icon}}" style="font-size: 20px"></i> &nbsp;
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
            @php
            $dataChildMenu = \App\Models\ChildMenu::where(['status' => '1', 'id_child_menu' => $userGroup->id_child_menu])->get()
            @endphp
            @foreach($dataChildMenu as $keyChild => $childMenu)

            <li class="sub-sub-submenu-list">
                <a href="#{{Str::slug($childMenu->nama_child_menu, '-')}}" data-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle">
                    <i class="{{$childMenu->icon}}" style="font-size: 20px"></i> 
                    {{$childMenu->nama_child_menu}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg> 
                </a>
                <ul class="collapse list-unstyled sub-submenu" id="{{Str::slug($childMenu->nama_child_menu, '-')}}"
                    data-parent="#{{Str::slug($childMenu->nama_child_menu, '-')}}">
                 
                    @php
                        $dataSubChildMenu = \App\Models\SubChildMenu::where(['status' => '1', 'id_sub_child_menu' => $userGroup->id_sub_child_menu])->get()
                    @endphp

                    @foreach($dataSubChildMenu as $keySubChildMenu => $subChildMenu)

                    <li class="sub-sub-sub-submenu-list">
                        <a href="#{{Str::slug($subChildMenu->nama_sub_child_menu, '-')}}" data-toggle="collapse"
                            aria-expanded="false" class="dropdown-toggle">
                            <i class="{{$subChildMenu->icon}}" style="font-size: 20px"></i>
                            {{$subChildMenu->nama_sub_child_menu}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> 
                        </a>
                        <ul class="collapse list-unstyled sub-sub-submenu"
                            id="{{Str::slug($subChildMenu->nama_sub_child_menu, '-')}}" 
                            data-parent="#{{Str::slug($subChildMenu->nama_sub_child_menu, '-')}}">

                            @php
                                $dataSubSubChildMenu = \App\Models\SubSubChildMenu::where(['status' => '1', 'id_sub_sub_child_menu' => $userGroup->id_sub_sub_child_menu])->get()
                            @endphp

                            @foreach($dataSubSubChildMenu as $keySubSubChildMenu => $subSubChildMenu)
                            <li class="text-wrap {{ (request()->is($subSubChildMenu->url)) ? 'active' : '' }}"
                                style="overflow: hidden;">
                                <a href="{{ url($subSubChildMenu->url) }}">
                                <i class="{{$subChildMenu->icon}}" style="font-size: 20px"></i> &nbsp;
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
    @endforeach

@endforeach


