@extends('netred.auth.base')
@section('scripts')
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
                if (data.status==-1){
                    $(that).removeClass('disabled').prop('disabled',false);
                    alertTips(data.info,data.id);
                }else{
                    $(that).removeClass('disabled').prop('disabled',false);
                    window.location = data.url;
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
        <div class="juzhongxia">
            <div class="zhonjian">
                <div class="tubg"> <img src="/home/images/tupian.jpg" width="478"; height="446"/></div>
                <div class="shuru">
                    <form class="form-horizontal data-form" method="POST" action="{{ route('netred.login.post') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <table width="100%" border="0" cellspacing="10">
                            <tbody>
                            <tr>
                                <td align="center"><div class="cur on"><a href="javascript:void(0)">网红登录</a></div></td>
                                <td align="center"><div class="cur" ><a href="{{ route('netred.register.form') }}">网红注册</a></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <p class="inp_login">
                                        <input class="dengkuang" id="username" type="text" name="username" autocomplete="off" autofocus placeholder="请输入手机号"/>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <p class="inp_reg">
                                        <input class="dengkuang" id="password" type="password" name="password" autocomplete="off" placeholder="密码"/>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="wang">
                                    <a href="{{ route('home.password.mobile') }}">忘记密码？</a>&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" name="submit" id="submit" value="确定登录" class="tijiaoan ajax-login" />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="qingchu"></div>
            </div>
        </div>
    </div>
@endsection
