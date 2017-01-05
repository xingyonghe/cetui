@extends('home.layouts.base')
@section('style')
@endsection
@section('script')
<script type="text/javascript">
    $(function(){

    });
</script>
@endsection
@section('body')
<!--S顶部-->
<div class="datu3">
    @include('home.layouts.head')
    <div class="dazi">
        <h1><span>最佳的网红直播自媒体赚钱平台</span></h1>
        <h2><span>利用自身人气获取高额报酬</span></h2>
        <div class="an"><a href="{{ route('home.register.rednet') }}"><img src="/assets/home/images/an2.png"/></a></div>
    </div>
</div>
<div class="main">
    <div class="juzhong">
        <div class="biaoti">免费加入我们，你将享受以下权益！</div>
        <div class="fenkai">
            <div class="tg">
                <div class="tubiao"><img src="/assets/home/images/biao8.png" /></div>
                <h3>丰富的广告投放需求</h3>
                <div class="wenzi">
                    只要你拥有一定数量的粉丝，只要你的直播<br/>有新意，那么我们就能为你提供稳定的广告<br/>投放任务。让你直播赚钱的同时多上一份广<br/>告收益！
                </div>
            </div>
            <div class="tg">
                <div class="tubiao"><img src="/assets/home/images/biao9.png"/></div>
                <h3>平台担保，收益稳定</h3>
                <div class="wenzi">
                    每位加入的网红主播均可享受到平台对广告<br/>佣金的担保。只要按照指定要求完成广告投<br/>放，任务结束后佣金立马进入你的口袋！
                </div>
            </div>
            <div class="tg2">
                <div class="tubiao"><img src="/assets/home/images/biao10.png" /></div>
                <h3>强大的后台数据支持</h3>
                <div class="wenzi">
                    本平台拥有强大的数据整合能力，能为每位网<br/>红主播提供最合适你的广告类型！
                </div>
            </div>
            <div class="qingchu"></div>
        </div>

    </div>
</div>
@endsection
