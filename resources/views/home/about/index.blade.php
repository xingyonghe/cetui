@extends('home.layouts.base')
@section('styles')
@endsection
@section('scripts')
<script type="text/javascript">
    $(function(){

    });
</script>
@endsection
@section('body')
<!--S顶部-->
<div class="datu5">
    @include('home.layouts.head')
</div>
<div class="main">
    <div class="duanluo">
        <div class="tou">关于我们</div>
        <div class="duan">策推中国，基于丰富的网红资源以及专业的运营团队，致力于打造中国直播广告领导品牌，精准化的营销手段，助力您轻松获取客户青睐！</div>
        <div class="tou">我们的优势</div>
        <div class="duan">策推中国汇聚各类型知名网红资源数万名，涉及二十余家直播视频平台，并且利用大数据分析系统对网红信息进行细化分类处理，包括主播风格、观众属性、实时粉丝数、观众人数峰值、平均观众、直播平率等，将每一个纳入数据库中的网红赋予“影响力评级”，该指数能让企业直观获知该网红的投放价值，便于企业在广告投放过程中获取最佳投放效果！</div>
        <div class="tou">发展方向</div>
        <div class="duan">策推中国，基于丰富的网红资源以及专业的运营团队，致力于打造中国直播广告领导品牌，精准化的营销手段，助力您轻松获取客户青睐！未来我们将不断优化对各类新兴网红主播资源的评级与推荐，使其快速获得企业的关注，让企业能有源源不断的新对象可供挑选，从而构成良性循环。</div>
        <div class="tou">公司大事件</div>
        <div class="duan"><p>2013年3月：公司DSP广告交易平台上线，整合大数据分析，形成完备的网络广告投放系统！！</p>
            <p>2014年5月：公司DSP广告平台日均广告展示突破30亿人次，移动端日展示10亿人次！</p>
            <p>2014年12月：公司与今日头条，腾讯，新浪，陌陌等国内一线媒体达成战略合作，为品牌客户提供更优质的媒体资源！</p>
            <p>2015年8月：公司开始组建网红自媒体营销团队，针对网红推广营销领域踏出了第一步！</p></div>
        <div class="duan">如今，策推中国作为公司旗下战略性的重要平台，正式上线运营！</div>
        <div class="tou">联系我们</div>
        <div class="duan">策推中国，基于丰富的网红资源以及专业的运营团队，致力于打造中国直播广告领导品牌，精准化的营销手段，助力您轻松获取客户青睐！</div>
        <div class="tou">关于我们</div>
        <div class="duan"><p>地址：重庆高新区石桥铺新锐地带13层</p>
            <p>咨询热线：400-086-7335</p>
            <p>在线客服：<a href="#"><img src="{{ asset('home/images/qq.png') }}"/></a>
                <a href="#"><img src="{{ asset('home/images/qq.png') }}"/></a>
                <a href="#"><img src="{{ asset('home/images/qq.png') }}"/></a></p>
        </div>
        <div class="qingchu"></div>
        <div class="ditu"><img src="{{ asset('home/images/ditu.png') }}"/></div>


    </div>


</div>
@endsection
