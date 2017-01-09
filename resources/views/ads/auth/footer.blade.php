<div class="di">
    <div class="zil">
        @foreach($channels as $channel)

            <a href="{{ route($channel['url']) }}">
                {{ $channel['title'] }}
            </a>

        @endforeach
        <a href="{{ route('home.about.index') }}">关于我们</a>
    </div>
    <div class="zi">
        沪ICP备11037975号-2Copyright2016www.wanghong1.com策推互动AllRightsReserved.
    </div>

</div>