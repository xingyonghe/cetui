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
                <a href="{{ route('ads.center.payword') }}"><span class="on">支付密码</span></a>
            </div>
            <div class="c_center">
                <form role="form" class="data-form" action="{{ route('ads.center.post') }}" method="post">
                    {{ csrf_field() }}
                    @if(auth()->user()->payword)
                        <div class="jbxx">
                            <div class="c_center_line">
                                <div class="c_center_left">原始支付密码：</div>
                                <div class="c_center_right">
                                    <input type="password" class="width_396" id="payword-old" name="payword-old" placeholder="请输入原始支付密码"/>
                                </div>
                            </div>

                            <div class="c_center_line">
                                <div class="c_center_left">新的支付密码：</div>
                                <div class="c_center_right">
                                    <input type="password" class="width_396" id="payword"  name="payword" placeholder="请输入新的支付密码"/>
                                </div>
                            </div>

                            <div class="c_center_line">
                                <div class="c_center_left">确认新支付密码：</div>
                                <div class="c_center_right">
                                    <input type="password" class="width_396" id="payword-confirm"  type="password" name="payword_confirmation" placeholder="确认新支付密码"/>
                                </div>
                            </div>

                            <div class="c_center_line">
                                <div class="c_center_right">
                                    <button class="ajax-post" >修改并保存</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="jbxx">
                            <br/> <br/> <br/>
                            您还没有设置支付密码，为了您的资金安全，赶紧现在设置吧！
                            <div class="c_center_line">
                                <div class="c_center_left">设置支付密码：</div>
                                <div class="c_center_right">
                                    <input type="password" class="width_396" id="payword" name="payword" placeholder="请输入支付密码"/>
                                </div>
                            </div>
                            <div class="c_center_line">
                                <div class="c_center_left">确认支付密码：</div>
                                <div class="c_center_right">
                                    <input type="password" class="width_396" id="payword-confirm" name="payword_confirmation" placeholder="确认支付密码"/>
                                </div>
                            </div>
                            <div class="c_center_line">
                                <div class="c_center_right">
                                    <button class="ajax-post" >设置并保存</button>
                                </div>
                            </div>
                        </div>
                    @endif

                </form>
            </div>

        </div>
    </div>
@endsection