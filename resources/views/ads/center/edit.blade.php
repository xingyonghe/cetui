@extends('ads.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('.ajax-post').click(function(){
                var that = $(this);
                formAjaxPost($('.data-form'),that);
                return false;
            });
        })
    </script>
@endsection
@section('body')
    <div class="container">
        <div class="width_1140">
            <div class="c_route">
                当前位置：
                <a href="{{ route('ads.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('ads.center.index') }}"><span>个人中心</span></a> >
                <span class="on">基本资料</span>
            </div>
            <div class="c_center">
                <form role="form" class="data-form" action="{{ route('ads.center.update') }}" metho="post">
                    {{ csrf_field() }}
                    <div class="jbxx">
                        <div class="c_center_line">
                            <div class="c_center_left">用户名：</div>
                            <div class="c_center_right">
                                <input type="text" class="width_396" disabled value="{{ $user->username }}" />
                                @if($user->is_auth)已认证@else未认证@endif
                            </div>

                        </div>

                        <div class="c_center_line">
                            <div class="c_center_left">公司名称：</div>
                            <div class="c_center_right">
                                <input type="text" class="width_396" name="nickname" id="nickname" value="{{ $user->nickname }}"/>
                            </div>
                        </div>

                        <div class="c_center_line">
                            <div class="c_center_left">微信：</div>
                            <div class="c_center_right">
                                <input type="text" class="width_396" name="weixin"  id="weixin"  value="{{ $user->weixin }}"/>
                            </div>
                        </div>

                        <div class="c_center_line">
                            <div class="c_center_left">QQ：</div>
                            <div class="c_center_right">
                                <input type="text" class="width_396" name="qq" id="qq" value="{{ $user->qq }}"/>
                            </div>
                        </div>

                        <div class="c_center_line">
                            <div class="c_center_left">邮箱：</div>
                            <div class="c_center_right">
                                <input type="text" class="width_396" name="email" id="email" value="{{ $user->email }}" />
                            </div>
                        </div>

                        <div class="c_center_line">
                            <div class="c_center_right">
                                <button class="ajax-post" >修改并保存</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
