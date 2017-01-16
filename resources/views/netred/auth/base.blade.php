<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    {{--<link rel="shortcut icon" href="{{ asset('home/images/logo.png') }}">--}}
    <link href="{{ asset('home/css/css.css') }}" rel="stylesheet" type="text/css"/>
    <script type='text/javascript' src='{{ asset('home/js/jquery-1.7.2.min.js') }}'></script>
    @yield('styles')
    <script type=text/javascript>
        $(document).ready(function(){
            $('.topmenu li').hover(function(){
                $(this).children('ul').show();
            },function(){
                $(this).children('ul').hide();
            });
        });
    </script>
</head>
<body>
@yield('body')
@include('home.layouts.footer')
<!-- layer插件 -->
<script type="text/javascript" src="{{ asset('static/layer/layer.js') }}"></script>
<!-- 自定义js -->
<script type='text/javascript' src='{{ asset('home/js/public.js') }}'></script>
@yield('scripts')
</body>
</html>