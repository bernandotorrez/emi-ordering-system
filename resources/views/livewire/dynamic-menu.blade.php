@foreach($dataMenuUserGroup as $key => $menuUserGroup)
@php
$dataParentMenu = \App\Models\ParentMenu::where('id_parent_menu', $menuUserGroup->id_parent_menu)->get()
@endphp

@foreach($dataParentMenu as $key => $parentMenu)
<li class="">
    <a href="#"> {{$parentMenu->nama_parent_menu}} </a>
</li>
@endforeach

@endforeach
