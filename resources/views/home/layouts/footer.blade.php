<div class="di">
    <div class="zil">
        <ul>
            @foreach($channels as $channel)
                <li>
                    <a href="{{ route($channel['url']) }}">
                        {{ $channel['title'] }}
                    </a>
                </li>
            @endforeach
            <li><a href="{{ route('home.about.index') }}">关于我们</a></li>
        </ul>
    </div>
    <div class="zi">
        沪ICP备11037975号-2Copyright2016www.wanghong1.com策推互动AllRightsReserved.
    </div>

</div>