<div class="ding">
    <div class="juzhong">
        <div class="logo">
            <a href="{{ route('home.index.index') }}">
                <img src="{{ asset('home/images/logo.png') }}" width="151"; height="55"/>
            </a>
        </div>
        <div class="topnav">
            <ul>
                @foreach($channels as $channel)
                    <li class="bigh @if(isset($channel_id) && $channel['id'] == $channel_id) xz @endif">
                        <a href="{{ route($channel['url']) }}" @if($channel['target']) target="_blank" @endif>
                            {{ $channel['title'] }}
                        </a>
                    </li>
                @endforeach
                @if (auth()->guest())
                    <li  class="bigh2"  onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)"><a href="javascript:void(0)">登录/注册</a>
                        <div class="xwgkdh" >
                            <div id="wanghong"><a href="{{ route('netred.login.form') }}">网红</a></div>
                            <div id="huaxian"><a href="{{ route('ads.login.form') }}">广告主</a></div>
                        </div>
                    </li>
                @else
                    <li  class="bigh2"  onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)"><a href="javascript:void(0)">{{ auth()->user()->nickname }}</a>
                        <div class="xwgkdh" >
                            @if(auth()->user()->type == 1)
                                <div id="wanghong"><a href="{{ route('netred.index.index') }}">个人中心</a></div>
                            @else
                                <div id="wanghong"><a href="{{ route('ads.index.index') }}">个人中心</a></div>
                            @endif
                            <div id="huaxian"><a href="{{ route('netred.login.logout') }}">退出</a></div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
        <div class="phone"><img src="{{ asset('home/images/phone.png') }}" width="20"; height="22"/><span>400-888-666</span></div>
    </div>
</div>

