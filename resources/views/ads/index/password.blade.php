@extends('member.layouts.base')
@section('style')
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('member.index.password') }}");
        })
    </script>
@endsection
@section('body')
    <!--container start-->
    <div class="container">
        <div class="row">
            @include('member.layouts.nav')
            <div class="col-lg-10 col-sm-10">
                <h5 class="member-title">修改密码</h5>
                <div class="contact-form">
                    <form role="form" class=" data-form" action="{{ route('member.index.reset') }}" metho="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">旧密码： </label>
                            <input id="password-old" class="form-control" type="password" name="password-old" placeholder="请输入旧密码" value=""/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">新密码： </label>
                            <input id="password" class="form-control" type="password" name="password" placeholder="请输入新密码" value=""/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">确认新密码： </label>
                            <input id="password-confirm" class="form-control" type="password" name="password_confirmation" placeholder="确认新密码" value=""/>
                        </div>
                        <div class="form-group" style="padding-left: 150px">
                            <button class="btn btn-danger ajax-post" type="submit" >提 交</button>
                            <button class="btn btn-danger" onclick="javascript:history.back(-1);return false;" >返 回</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--container end-->
@endsection