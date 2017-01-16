<!-- 头部 start -->
<div class="ding">
    <div class="juzhong">
        <div class="logo">
            <a href="{{ route('home.index.index') }}">
                <img src="/home/images/logo.png"  width="151"; height="55"/>
            </a>
        </div>
        <div class="phone">
            <img src="/home/images/phone.png"/>
            400-888-666
        </div>
        <div class="topnav">
            <ul class="topmenu">
                @foreach($channels as $channel)
                    <li class="@if(isset($channel_id) && $channel['id'] == $channel_id) on @endif">
                        <a href="{{ route($channel['url']) }}" @if($channel['target']) target="_blank" @endif>
                            {{ $channel['title'] }}
                        </a>
                    </li>
                @endforeach

                @if (auth()->guest())
                    <li><a href="javascript:void(0)">登录/注册</a>
                        <ul class="one">
                            <li><a href="{{ route('netred.login.form') }}">网红</a></li>
                            <li><a href="{{ route('ads.login.form') }}">广告主</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="javascript:void(0)">{{ auth()->user()->nickname }}</a>
                        <ul class="one">
                            @if(auth()->user()->type == 1)
                                <li><a href="{{ route('netred.index.index') }}">个人中心</a></li>
                                <li><a href="{{ route('netred.login.logout') }}">退出</a></li>
                            @else
                                <li><a href="{{ route('ads.index.index') }}">个人中心</a></li>
                                <li><a href="{{ route('ads.login.logout') }}">退出</a></li>
                            @endif
                        </ul>
                @endif
            </ul>
        </div>

    </div>
</div>
<!-- 头部 end -->

