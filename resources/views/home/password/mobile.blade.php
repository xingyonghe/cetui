@extends('home.layouts.base')
@section('styles')
@endsection
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
            var query = {'mobile':mobile,'_token':_token,'category':2};//category 2 重置密码
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


        $('body').on('click','.ajax-reset',function(){
            var form,that,target,query;
            form = $('.data-form');
            target = form.get(0).action;
            that = this;
            query = form.serialize();
            $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
            $.post(target,query).success(function(data){
                if (data.status == -1){
                    $(that).removeClass('disabled').prop('disabled',false);
                    if(data.id){
                        alertTips(data.info,data.id);
                    }else{
                        layer.open({
                            type    : 1,
                            skin    : 'layer-ext-member',
                            title   :  '消息提醒',
                            area    : ['450px','120px'],
                            closeBtn: 0,
                            shade   : false,
                            content : data.info,
                            time    : 3000,
                        });
                    }

                }else{
                    $(that).removeClass('disabled').prop('disabled',false);
                    layer.open({
                        type    : 1,
                        skin    : 'layer-ext-member',
                        title   :  '消息提醒',
                        area    : ['450px','120px'],
                        closeBtn: 0,
                        shade   : false,
                        content : data.info,
                        time    : 3000,
                        end     :function(){
                            window.location = data.url;
                        }
                    });
                }
            });
            return false;
        });
    });
</script>
@endsection
@section('body')
<!--S顶部-->
<div class="beij">
    @include('home.layouts.head')
</div>
<div class="main">
    <div class="zhz">
        <div class="zhaohui">
            <div class="zhmm">找回密码</div>
            <div class="zhmima">
                <div class="phonezhhxz" ><a href="{{ route('home.password.mobile') }}" >手机找回密码</a></div>
                <div class="emailzhh"><a href="{{ route('home.password.email') }}">邮箱找回密码</a></div>
            </div>
            <form class="form-horizontal data-form" action="{{ route('home.password.post') }}" method="POST" >
                {{ csrf_field() }}
                <div class="zhk">
                    <span>*</span><input class="zit" name="username"  id="username" type="text" placeholder="请输入手机号" />
                </div>
                <div class="zhk2">
                    <span>*</span>
                    <div class="zhf">
                        <input class="zit" maxlength="6" name="code"  id="code" type="text" style="width: 272px" placeholder="请输入验证码" >
                        <div class="dianh">
                            <input type="button" id="get-code" style="color: #ff6476;background: #ffffff;width: 131px;position: relative;" value="获取验证码">
                        </div>
                    </div>
                </div>
                <div class="zhk">
                    <span>*</span><input class="zit" name="password"  id="password" type="password" placeholder="输入密码" />
                </div>
                <div class="zhk">
                    <span>*</span><input class="zit" name="password_confirmation"  id="password_confirmation" type="password"  placeholder="请再次输入您的密码"/>
                </div>
                <div class="quren3">
                    <input class="tijiao ajax-reset" type="submit" style="background-color:#ff6476" value="确认注册"/>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
