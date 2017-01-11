<div class="header">
    <div class="width_1140">
        <div class="header_box">
            <span>欢迎您！</span>
            <span>用户名：{{ auth()->user()->username }}</span>
            |&nbsp;<a href="{{ route('ads.login.logout') }}">退出登录</a>
        </div>
    </div>
</div>
<div class="logoBox">
    <div class="width_1140">
        <div class="logo_info">
            <small class="logo"></small>
            <span>
                    专属客服QQ
                    <a href="{{ get_custom_qq(auth()->user()->custom_id) }}"><small class="service_qq"></small></a>
                </span>
        </div>
    </div>
</div>
<div class="menuBox">
    <div class="width_1140">
        <ul class="menu">
            @foreach($topnav as $key=>$nav)
                <li @if(isset($navkey) && $navkey == $key) class="on" @endif>
                    <a href="{{ route($nav['url']) }}">{{ $nav['name'] }}</a>
                    @if($nav['child'])
                        <ul class="one">
                            @foreach($nav['child'] as $k=>$child)
                            <li><a href="{{ route($child['url']) }}">{{ $child['name'] }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>