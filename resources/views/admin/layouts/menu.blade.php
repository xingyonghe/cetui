<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            @if(isset($menus['child']))
                @foreach($menus['child'] as $key=>$menu)
                    <li class="sub-menu">
                        <a href="javascript:void(0);" class="">
                            <i class=""></i>
                            <span>{{ $key }}</span>
                        </a>
                        <ul class="sub">
                            @foreach($menu as $m)
                                <li>
                                    <a  href="{{ url($m['url']) }}">
                                        {{ $m['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endif
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
