<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <link rel="shortcut icon" href="{{ asset('home/images/logo.png') }}">
    <link href="{{ asset('member/netred/css/style.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
@include('netred.layouts.head')
@yield('body')
@include('netred.layouts.footer')
<script type="text/javascript" src="{{ asset('member/js/jquery-1.8.3.min.js') }}"></script>
<!-- 自定义验证规则 -->
<script type="text/javascript" src="{{ asset('static/js/validator.js') }}"></script>
<!-- layer插件 -->
<script type="text/javascript" src="{{ asset('static/layer/layer.js') }}"></script>
<!-- 自定义js -->
<script type="text/javascript" src="{{ asset('member/js/common.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $('.menu li').hover(function(){
            $(this).children('ul').show();
            $(this).focus().addClass('focusa')
        },function(){
            $(this).children('ul').hide();
            $(this).focus().removeClass('focusa')
        });
    });
</script>
@yield('scripts')
</body>