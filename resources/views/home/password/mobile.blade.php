@extends('home.layouts.base')
@section('style')
@endsection
@section('script')
<script type="text/javascript">
    $(function(){

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
            <div class="zhk">
                <span>*</span><input class="zit" type="text" placeholder="请输入手机号" />
            </div>
            <div class="zhk2">
                <span>*</span>
                <div class="zhf">
                    <input class="zit" type="text" placeholder="请输入验证码" >
                    <div class="dianh"><span><a href="#">90秒后重新发送</a></span></div>
                </div>
            </div>
            <div class="zhk">
                <span>*</span><input class="zit" type="password" placeholder="输入密码" />
            </div>
            <div class="zhk">
                <span>*</span><input class="zit" type="password"  placeholder="请再次输入您的密码"/>
            </div>
            <div class="quren3">
                <input class="tijiao" id="tijiao3" type="submit" style="background-color:#ff6476" value="确认注册"/>
            </div>
        </div>
    </div>
</div>
@endsection
