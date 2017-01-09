<div class="zhong">
    <div class="fr"> 欢迎您！ 用户名：{{ auth()->user()->username }}&nbsp; | <a href="{{ route('netred.login.logout') }}">退出登录</a></div>
</div>
<div class="inner_c">
    <div class="header_top">
        <div class="fl">
            <a href="{{ route('home.index.index') }}"><img src="{{ asset('member/netred/images/logo.png') }}" width="151"; height="55"/></a>
        </div>
        <div class="kefuqq fr"><p>专属客服QQ<a href="{{ get_custom_qq(auth()->user()->custom_id) }}"><img src="{{ asset('member/netred/images/qq.png') }}"/></a></p></div>
    </div>
</div>
<!--S导航条-->
<div class="nav_bg">
    <div class="nav">
        <ul>
            @foreach($topnav as $key=>$nav)
                <li @if(isset($navkey) && $navkey == $key) class="cur" @endif>
                    <a href="{{ route($nav['url']) }}">
                        {{ $nav['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!--E导航条-->
