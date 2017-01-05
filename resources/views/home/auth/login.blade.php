@extends('home.layouts.base')
@section('style')
    <style type="text/css">
        .form-signin-heading {
            margin: 0;
            padding: 20px 15px;
            text-align: center;
            background: #f77b6f;
            border-radius: 5px 5px 0 0;
            -webkit-border-radius: 5px 5px 0 0;
            color: #fff;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: 300;
            font-family: 'Open Sans', sans-serif;
        }
        .wrong{
            color: #a94442;
        }
    </style>
@endsection
@section('script')
<script type="text/javascript">
    $(function () {
        //ajax post请求
        $('body').on('click','.ajax-login',function(){
            var form,that,target,query;
            form = $('.data-form');
            target = form.get(0).action;
            that = this;
            query = form.serialize();
            var username = $('#username').val();
            var password = $('#password').val();
            if(!username){
                alertTips('请填写登陆账号','username');return false;
            }
            if(!password){
                alertTips('请填写登陆密码','password');return false;

            }
            $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
            $.post(target,query).success(function(data){
                if (data.status==1){
                    $(that).removeClass('disabled').prop('disabled',false);
                    window.location = data.url;
                }else{
                    $(that).removeClass('disabled').prop('disabled',false);
                    alertTips(data.info,data.id);
                }
            });
            return false;
        });
    })
</script>
@endsection
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="form-signin-heading">登 录</div>
                <div class="panel-body">
                    <form class="form-horizontal data-form" method="POST" action="{{ route('home.login.post') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
<<<<<<< HEAD
                            <label for="email" class="col-md-4 control-label">用户名：</label>
=======
                            <label  class="col-md-4 control-label">用户名：</label>
>>>>>>> 902e3fbc731b36e3c9d75047a9b96e779166b12b

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" autocomplete="off" autofocus>
                                <strong class="wrong" id="error-username"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">密码：</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="off">
                                <strong class="wrong" id="error-password"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" name="1"> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
<<<<<<< HEAD
                                <input type="button" class="btn btn-danger ajax-login" value="登 录">
=======
                                <input type="button" value="登 录" class="btn btn-danger ajax-login">

>>>>>>> 902e3fbc731b36e3c9d75047a9b96e779166b12b
                                <a class="btn btn-link" href="{{ route('home.password.reset') }}">
                                    忘记密码?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
