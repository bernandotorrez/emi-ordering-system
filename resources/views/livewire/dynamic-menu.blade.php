@foreach($dataParentMenu as $parentMenu)
<li class="menu single-menu {{ Request::is($parentMenu->url) ? 'active' : '' }}">
    <a href="{{ url($parentMenu->url) }}">
        <div class="">
            <i class="fas fa-info-circle {{ Request::is($parentMenu->url) ? 'icon-active' : '' }}"
                style="font-size: 20px"></i> &nbsp;
            <span>{{ $parentMenu->nama_parent_menu }}</span>
        </div>
    </a>
</li>
@endforeach
