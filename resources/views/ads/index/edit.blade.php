@extends('member.layouts.base')
@section('style')
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            highlight_subnav("{{ route('member.index.index') }}");
        })
    </script>
@endsection
@section('body')
    <!--container start-->
    <div class="container">
        <div class="row">
            @include('member.layouts.nav')
            <div class="col-lg-10 col-sm-10">
                <h5 class="member-title">修改资料</h5>
                <div class="contact-form">
                    <form role="form" class=" data-form" action="{{ route('member.index.update') }}" metho="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">认证手机：</label>
                            {{ $user->username }}
                            @if($user->is_auth)已认证@else未认证@endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">联系人：</label>
                            <input type="text" name="nickname" id="nickname" value="{{ $user->nickname }}" class="form-control"/>
                        </div>
                        @if($user->type == 2)
                            <div class="form-group">
                                <label class="control-label">公司名称：</label>
                                <input type="text" name="company" id="company" value="{{ $user->company }}" class="form-control"/>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label">QQ号码：</label>
                            <input type="text" name="qq" id="qq" value="{{ $user->qq }}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">微信账号：</label>
                            <input type="text" name="weixin"  value="{{ $user->weixin }}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label  class="control-label">E-mail：</label>
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control"/>
                        </div>
                        <div class="form-group" style="padding-left: 150px">
                            <button class="btn btn-danger ajax-post" type="submit">提 交</button>
                            <button class="btn btn-danger" onclick="javascript:history.back(-1);return false;" >返 回</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--container end-->
@endsection
