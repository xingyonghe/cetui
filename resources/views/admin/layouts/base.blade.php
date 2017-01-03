<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>策推互动管理系统</title>
    <link href="{{ asset('back/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/css/bootstrap-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('back/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/css/style-responsive.css') }}" rel="stylesheet" />
    @yield('styles')
</head>
<body>
<section id="container" class="">
    <!--页头+导航-->
    @include('admin.layouts.head')
    <!--左侧菜单-->
    @include('admin.layouts.menu')
    <section id="main-content">
        <section class="wrapper">
            <!--信息提示-->
            @include('admin.layouts.prompt')
            <!--内容主体-->
            @yield('body')
        </section>
    </section>
    <!--页脚-->
    @include('admin.layouts.footer')
</section>
<script type="text/javascript" src="{{ asset('static/js/jquery-1.8.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/js/jquery.scrollTo.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/js/jquery.nicescroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/js/respond.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/js/common-scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/layer/layer.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/js/common.js') }}"></script>
@yield('scripts')
</body>
</html>
