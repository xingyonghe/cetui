@extends('home.layouts.base')
@section('styles')
    <link rel="stylesheet" href="/home/css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/home/css/style.css" type="text/css" media="screen" />
@endsection
@section('scripts')
    <script type="text/javascript" src="/home/js/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="/home/js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#slider').nivoSlider();
        });
    </script>
@endsection
@section('body')
<!--S顶部-->
<div class="datu2">
    @include('home.layouts.head')
</div>
<div class="main">
    <div class="juzhong">
        <div class="biaoti">精品网红资源展示</div>
    </div>

    <div id="wrapper">
        <div id="slider-wrapper">
            <div id="slider" class="nivoSlider">
                <a href="#" target="_blank"><img src="/home/images/andong1.jpg"alt="" /></a>
                <a href="#" target="_blank"><img src="/home/images/andong1.jpg" alt="" /></a>
                <a href="#" target="_blank"><img src="/home/images/andong1.jpg" alt="" /></a>
            </div>
        </div>
    </div>
</div>
<div class="kehu">
    <div class="juzhong">
        <div class="biaoti">我们的客户</div>
        <h5>基于专业的大数据分析，为广告主量身打造最为高效的推广方案，因此，以下客户选择了我们！</h5>
    </div>
    <div class="wangzhan">
        <div class="qitawangzhan">
            <a href="#"><img src="/home/images/jd.jpg"/></a>
            <a href="#"><img src="/home/images/1haodian.jpg"/></a>
            <a href="#"><img src="/home/images/ls.jpg"/></a>
            <a href="#"><img src="/home/images/taobao.jpg"/></a>
            <a href="#"><img src="/home/images/snyg.jpg"/></a>
        </div>
        <div class="qitawangzhan">
            <a href="#"><img src="/home/images/wph.jpg"/></a>
            <a href="#"><img src="/home/images/jmyp.jpg"/></a>
            <a href="#"><img src="/home/images/haier.jpg"/></a>
            <a href="#"><img src="/home/images/mi.jpg"/></a>
            <a href="#"><img src="/home/images/cqly.jpg"/></a>
        </div>
        <div class="qingchu"></div>
    </div>

    <div class="qingchu"></div>
</div>
@endsection
