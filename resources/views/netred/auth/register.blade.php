@extends('netred.auth.base')
@section('scripts')
    <script type="text/javascript">
        $(function(){
            //发送短信验证码  18582571224
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

            {{--//验证验证码--}}
            {{--$('#code').blur(function(){--}}
                {{--var that = this;--}}
                {{--var code = $(this).val();--}}
                {{--var target = "{{ route('api.verifysms') }}";--}}
                {{--var mobile = $('#username').val();--}}
                {{--if(!code && mobile){--}}
                    {{--alertTips('请输入验证码','code');--}}
                    {{--return false;--}}
                {{--}--}}
                {{--if(mobile && !$(this).hasClass('disabled')){--}}
                    {{--var _token = "{{csrf_token()}}";--}}
                    {{--var query = {'mobile':mobile,'code':code,'_token':_token};--}}
                    {{--$.post(target,query,function(data){--}}
                        {{--if (data.status==1) {--}}
                            {{--$(that).addClass('disabled');--}}
                            {{--alertTips(data.info,'code');--}}
                        {{--}else{--}}
                            {{--alertTips(data.info,'code');--}}
                        {{--}--}}
                    {{--},'json');--}}
                {{--}--}}
            {{--});--}}

            //ajax post请求
            $('body').on('click','.ajax-register',function(){
                var form,that,target,query;
                form = $('.data-form');
                target = form.get(0).action;
                that = this;
                query = form.serialize();
                var username = $('#username').val();
                var code = $('#code').val();
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
                if(!password){
                    alertTips('请输入密码','password');return false;
                }
                if(!password_confirmation){
                    alertTips('请输入确认密码','password_confirmation');return false;
                }
                if(!nickname){
                    alertTips('请输入联系人姓名','nickname');return false;
                }
                if(!qq){
                    alertTips('请输入QQ帐号','qq');return false;
                }
                if(!weixin){
                    alertTips('请输入微信帐号','weixin');return false;
                }
                if(!email){
                    alertTips('请填写邮箱账号','email');return false;
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
                            skin    : 'layer-ext-member',
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
        <div class="zhucezhong">
            <form class="form-horizontal data-form" action="{{ route('netred.register.post') }}" method="POST" >
                {{ csrf_field() }}
                <div class="zhuce">
                    <table width="465" border="0" cellspacing="10">
                        <tbody>
                        <tr>
                            <td colspan="3" class="biaotizi"><h5>网红注册</h5></td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">*</td>
                            <td colspan="2" align="left">
                                <input name="username" id="username" autofocus autocomplete="off" class="ankuan" type="text" placeholder="请输入手机号"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">*</td>
                            <td  align="left" colspan="2">
                                <div class="zhfkuang">
                                    <div class="sryzm">
                                        <input class="ankuanduan" name="code" maxlength="6" id="code" type="text" placeholder="请输入动态验证码"/>
                                    </div>
                                    <div class="xian"></div>
                                    <div class="djan">
                                        <input type="button" id="get-code" class="yanzheng" value="获取验证码">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">*</td>
                            <td colspan="2" align="left">
                                <input class="ankuan" type="password" name="password" id="password" autocomplete="off" placeholder="请输入密码"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">*</td>
                            <td colspan="2" align="left">
                                <input class="ankuan" type="password" name="password_confirmation" id="password_confirmation" autocomplete="off" placeholder="请确认密码"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">*</td>
                            <td colspan="2" align="left">
                                <input class="ankuan" type="text" name="nickname" id="nickname" autocomplete="off" placeholder="请输入联系人姓名"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">*</td>
                            <td colspan="2" align="left">
                                <input class="ankuan" type="text" name="qq" id="qq" autocomplete="off" placeholder="请输入QQ账号"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">*</td>
                            <td colspan="2" align="left">
                                <input class="ankuan" type="text" name="weixin" id="weixin" autocomplete="off" placeholder="请输入微信帐号"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">*</td>
                            <td colspan="2" align="left">
                                <input class="ankuan" type="text" name="email" id="email" autocomplete="off" placeholder="请输入邮箱"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">&nbsp;</td>
                            <td colspan="2" align="left" class="huise">
                                <label class="label_style">
                                    <input  type="checkbox" name="protocol" id="protocol" value="1">
                                    阅读并同意条款<a href="#">《策推中国用户协议》</a>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="30" align="right" class="fense">&nbsp;<input  type="hidden" name="type" value="1"></td>
                            <td colspan="3" align="center"><input type="button" name="button" id="button" value="确定注册"  class="hongan ajax-register" ></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection
