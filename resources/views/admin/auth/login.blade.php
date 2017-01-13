<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>策推互动后台管理系统</title>
    <link href="{{ asset('back/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('back/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('back/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('back/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <script src="{{ asset('static/js/jquery-1.8.3.min.js') }}"></script>
    <script src="{{ asset('static/layer/layer.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('body').on('click','.btn-login',function(){
                var form  = $('.form-datas');
                var url   = form.get(0).action;
                var query = form.serialize();
                var that  = this;
                $.post(url,query,function(datas){
                    if(datas.status == -1){
                        layer.tips(datas.info, $('#'+datas.id) , {
                            tips: [3, '#41cac0'] //配置颜色
                        });
                    }else{
                        setTimeout(function(){
                            location.href = datas.url;
                        },1500);
                    }
                },'json');
                return false;
            });
        })
    </script>
</head>

<body class="login-body">

<div class="container" style="margin-top: 150px">
    <form class="form-signin form-datas" method="post" action="{{ route('admin.login.post') }}">
        {{ csrf_field() }}
        <h2 class="form-signin-heading">策推互动后台管理系统</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="请输入管理员账号" name="username" id="username">
            <input type="password" class="form-control" placeholder="请输入密码" name="password" id="password">
            <button class="btn btn-lg btn-login btn-block" autocomplete="off">登 录</button>
        </div>
    </form>

</div>
</body>
</html>
