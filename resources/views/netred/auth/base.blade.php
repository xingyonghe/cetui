<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <link rel="shortcut icon" href="{{ asset('home/images/logo.png') }}">
    <link href="{{ asset('home/css.css') }}" rel="stylesheet" type="text/css"/>
    <script type='text/javascript' src='{{ asset('home/js/jquery-1.7.2.min.js') }}'></script>
    @yield('styles')
    <script type=text/javascript>
        function displaySubMenu(li) {
            var subMenu = li.getElementsByTagName("div")[0];
            subMenu.style.display = "block";
        }

        function hideSubMenu(li) {
            var subMenu = li.getElementsByTagName("div")[0];
            subMenu.style.display = "none";
        }
    </script>
</head>
<body>
@yield('body')
@include('netred.auth.footer')
<!-- layer插件 -->
<script type="text/javascript" src="{{ asset('static/layer/layer.js') }}"></script>
<!-- 自定义js -->
<script type='text/javascript' src='{{ asset('home/js/public.js') }}'></script>
@yield('scripts')
</body>
</html>