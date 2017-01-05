@extends('home.layouts.base')
@section('script')
    <script type="text/javascript">
        $(function(){
            //发送短信验证码
            $('#get-code').click(function(){
                var target = "{{ route('api.sendsms') }}";
                var mobile = $('#username').val();
                if(!mobile){
                    alertTips('请输入你要验证的手机号码','username');
                    return false;
                }
                if (!/^1[34578]{1}\d{9}$/.test(mobile)){
                    alertTips('手机号码格式错误','username');
                    return false;
                }
                var resend = "{{$resend}}";
                var codeIntVal = resend-1;
                var timename='';
                var that = this;
                var _token = "{{csrf_token()}}";
                var query = {'mobile':mobile,'_token':_token};
                $.post(target,query,function(data){
                    if (data.status==1) {
                        $(that).val("重新获取("+resend+")");
                        $(that).attr("disabled", true);
                        timename = setInterval(function(){
                            $(that).val("重新获取(" + codeIntVal + ")");
                            codeIntVal--;
                            if (codeIntVal < 0) {
                                codeIntVal = resend-1;
                                $(that).val("获取短信验证码");
                                $(that).removeAttr("disabled");
                                clearInterval(timename);
                            }
                        }, "1000");
                    }else{
                        alertTips(data.info,'username');
                    }
                },'json');
                return false;
            });

            //验证验证码
            $('#code').blur(function(){
                var that = this;
                var code = $(this).val();
                var target = "{{ route('api.verifysms') }}";
                var mobile = $('#username').val();
                if(!code && mobile){
                    alertTips('请输入验证码','code');
                    return false;
                }
                if(mobile && !$(this).hasClass('disabled')){
                    var _token = "{{csrf_token()}}";
                    var query = {'mobile':mobile,'code':code,'_token':_token};
                    $.post(target,query,function(data){
                        if (data.status==1) {
                            $(that).addClass('disabled');
                            alertTips(data.info,'code');
                        }else{
                            alertTips(data.info,'code');
                        }
                    },'json');
                }
            });

            //ajax post请求
            $('body').on('click','.ajax-register',function(){
                var form,that,target,query;
                form = $('.data-form');
                target = form.get(0).action;
                that = this;
                query = form.serialize();
                var username = $('#username').val();
                var code = $('#code').val();
                var captcha = $('#captcha').val();
                var email = $('#email').val();
                var nickname = $('#nickname').val();
                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();
                var protocol = $("input[name='protocol']:checked").val();
                if(!username){
                    alertTips('请填写你要注册的手机号码','username');return false;
                }
                if(!code){
                    alertTips('请填写动态手机验证码','code');return false;
                }
                if(!captcha){
                    alertTips('请填写验证码','captcha');return false;
                }
                if(!email){
                    alertTips('请填写邮箱账号','email');return false;
                }
                if(!nickname){
                    alertTips('请填写公司或者个人名称','nickname');return false;
                }
                if(!password){
                    alertTips('请输入密码','password');return false;
                }
                if(!password_confirmation){
                    alertTips('请输入确认密码','password_confirmation');return false;
                }
                if(!protocol){
                    alertTips('您还没有阅读并同意条款《策推中国用户协议》','protocol');return false;
                }
                $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
                $.post(target,query).success(function(data){
                    if (data.status==1){
                        $(that).removeClass('disabled').prop('disabled',false);
                        var endtime = 5;
                        var _title = endtime+'秒后即将跳转';
                        layer.open({
                            type    : 1,
                            skin    : 'layer-ext-admin',
                            title   :  _title,
                            area    : ['450px','120px'],
                            closeBtn: 0,
                            shade   : false,
                            content : data.info,
                        });
                        timename = setInterval(function(){
                            endtime--;
                            if (endtime < 1) {
                                console.log(endtime);
                                clearInterval(timename);
                                window.location = data.url;
                                return false;
                            }
                            layer.title(endtime+'秒后即将跳转');
                        }, "1000");
                    }else{
                        $(that).removeClass('disabled').prop('disabled',false);
                        if(data.id){
                            alertTips(data.info,data.id);
                        }else{
                            layer.msg(data.info);
                        }
                    }
                });
                return false;
            });

            //刷新验证码
            $('.captcha').click(function(){
                var target = "{{ route('api.captcha') }}";
                var that = this;
                $.post(target,function(data){
                    $(that).attr('src',data);
                })
            });
        })
    </script>
@endsection
@section('body')
    <div class="beij">
        @include('home.layouts.head')
    </div>
    <div class="main">
        <div class="zhucezhong">
            <form class="form-horizontal data-form" action="{{ route('home.register.post') }}" method="POST" >
                {{ csrf_field() }}
                <input name="type" type="hidden" value="2">
                <div class="zhuce">
                    <h3>广告主注册</h3>
                    <div class="shurukuang">
                        <span>*</span><input name="username" id="username" autofocus autocomplete="off" class="zit" type="text" placeholder="请输入手机号"/>
                    </div>
                    <div class="shurukuang">
                        <span>*</span>
                        <input class="zit" name="code" maxlength="6" id="code" autocomplete="off" style="width: 300px" type="text" placeholder="请输入动态验证码"/>
                        <input type="button" name="code" id="get-code" value="获取短信验证码" style="border: none;width: 121px;background-color:#ff6476;color: #fff">
                    </div>
                    <div class="shurukuang2">
                        <span>*</span>
                        <div class="fenkuang">
                            <input class="zit"  maxlength="4"  type="text" id="captcha" name="captcha" placeholder="请输入验证码"/>
                            <img src="{{ captcha_src() }}" class="captcha" title="点击刷新验证码" alt="点击刷新验证码" style="cursor: pointer"/>
                        </div>
                    </div>
                    <div class="shurukuang">
                        <span>*</span>
                        <input class="zit" type="text" name="email" id="email" autocomplete="off" placeholder="请输入邮箱"/>
                    </div>
                    <div class="shurukuang">
                        <span>*</span><input class="zit" type="text" name="nickname" id="nickname" autocomplete="off" placeholder="请输入公司名称/个人姓名"/>
                    </div>
                    <div class="shurukuang">
                        <span>*</span><input class="zit" type="password" name="password" id="password" autocomplete="off" placeholder="请输入密码"/>
                    </div>
                    <div class="shurukuang">
                        <span>*</span><input class="zit" type="password" name="password_confirmation" id="password_confirmation" autocomplete="off" placeholder="请确认密码"/>
                    </div>
                    <div class="gouxuan">
                        <input class="ziti" type="checkbox" name="protocol" id="protocol" value="1" id="accept-terms">
                        <label for="accept-terms"><span>阅读并同意条款<a href="###">《策推中国用户协议》</a></span></label>
                    </div>
                    <div class="quren2">
                        <input class="tijiao ajax-register" id="tijiao" type="button"  style="background-color:#ff6476" value="确认注册"/>
                    </div>
                    <div class="qingchu"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
