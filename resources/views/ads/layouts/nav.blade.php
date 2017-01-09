<div class="col-lg-2 col-sm-2">
    <div class="date-wrap">
        @php($leftnav = $topnav[$navkey])
        <span class="date">{{ $leftnav['name'] }}</span>
        @foreach($leftnav['child'] as $nav)
            <span class="month"><a href="{{ route($nav['url']) }}">{{ $nav['name'] }}</a></span>
        @endforeach
    </div>
</div>