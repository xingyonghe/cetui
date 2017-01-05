@extends('home.layouts.base')
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
                    alertTips('请输入登录账号','username');return false;
                }
                if(!password){
                    alertTips('请输入登录密码','password');return false;
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
    <div class="beij">
        @include('home.layouts.head')
    </div>
    <div class="main">
        <div class="juzhong">
            <div class="zhonjian">
                <div class="tubg">
                    <img src="{{ asset('assets/home/images/tupian.jpg') }}" width="478"; height="446"/></div>
                <div class="shuru">
                    <div class="main_nav">
                        <ul>
                            <li><a class="cd-signin" href="javascript:void(0)">广告主登录</a></li>
                            <li><a class="cd-signup" href="{{ route('home.register.ads') }}">广告主注册</a></li>
                        </ul>
                    </div>
                    <div class="biaodan">
                        <div class="denglu">
                            <form class="form-horizontal data-form" method="POST" action="{{ route('home.login.post') }}">
                                {{ csrf_field() }}
                                <input name="type" type="hidden" value="2">
                                <div class="text1">
                                    <input class="zit" id="username" type="text" name="username" autocomplete="off" autofocus placeholder="请输入手机号或邮箱"/>
                                </div>
                                <div class="text2">
                                    <input class="zit" id="password" type="password" name="password" autocomplete="off" placeholder="密码"/>
                                </div>
                                <div class="wang">
                                    <a href="{{ route('home.password.reset') }}">忘记密码？</a>
                                </div>
                                <div class="quren">
                                    <input class="tijiao ajax-login" id="tijiao" type="button" style="background-color:#ff6476" value="确认登录"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="qingchu"></div>
            </div>
        </div>

    </div>
@endsection
