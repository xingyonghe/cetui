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
    <div class="container marTB_15">
        <div class="width_1140">
            <div class="c_route">
                当前位置：
                <a href="{{ route('ads.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('ads.center.index') }}"><span>个人中心</span></a> >
                <span class="on">修改密码</span>
            </div>
            <div class="c_box">
                <form role="form" class="data-form" action="{{ route('ads.center.reset') }}" method="post">
                    {{ csrf_field() }}
                    <div class="c_tggl_box">
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">原始密码：</div>
                            <div class="c_tggl_right">
                                <input type="password" class="width_396" id="password-old" name="password-old" placeholder="请输入旧密码"/>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">新的密码：</div>
                            <div class="c_tggl_right">
                                <input type="password" class="width_396" id="password"  name="password" placeholder="请输入新密码"/>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">确认新密码：</div>
                            <div class="c_tggl_right">
                                <input type="password" class="width_396" id="password-confirm"  type="password" name="password_confirmation" placeholder="确认新密码"/>
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