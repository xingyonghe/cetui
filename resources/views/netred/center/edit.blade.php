@extends('netred.layouts.base')
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
    <div class="container marTB_15">
        <div class="width_1140">
            <div class="c_route">
                当前位置：
                <a href="{{ route('netred.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('netred.center.index') }}"><span class="on">基本资料</span></a>
            </div>
            <div class="c_box">
                <form role="form" class="data-form" action="{{ route('netred.center.update') }}" metho="post">
                    {{ csrf_field() }}
                    <div class="c_tggl_box">
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">用户名：</div>
                            <div class="c_tggl_right">
                                <input type="text" class="width_396" disabled value="{{ $user->username }}" />
                                @if($user->is_auth)已认证@else未认证@endif
                            </div>

                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">联系人：</div>
                            <div class="c_tggl_right">
                                <input type="text" class="width_396" name="nickname" id="nickname" value="{{ $user->nickname }}"/>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">微信：</div>
                            <div class="c_tggl_right">
                                <input type="text" class="width_396" name="weixin"  id="weixin"  value="{{ $user->weixin }}"/>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">QQ：</div>
                            <div class="c_tggl_right">
                                <input type="text" class="width_396" name="qq" id="qq" value="{{ $user->qq }}"/>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">邮箱：</div>
                            <div class="c_tggl_right">
                                <input type="text" class="width_396" name="email" id="email" value="{{ $user->email }}" />
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left"></div>
                            <div class="c_tggl_right">
                                <button class="width_424 ajax-post" >修改并保存</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
