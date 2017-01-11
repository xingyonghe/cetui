@extends('ads.layouts.base')
@section('styles')
@endsection
@section('body')
    <div class="container marTB_15">
        <div class="width_1140">
            <p class="payCenter">支付详情</p>

            <div class="c_pay_box1 marTB_25">
                <div class="c_pay_row">
                    <div class="c_pay_left">
                        本次共计需要支付推广费：
                        <span><i>{{ $log['money'] }}</i> 元</span>
                    </div>
                    <div class="c_pay_right c_tggl_right">支付流水账号：<span><i>{{ $log['order_id'] }}</i></span>
                    </div>
                    <div style="clear: both"></div>
                    <div class="c_pay_left c_tggl_right">
                        @if($log['money'] > auth()->user()->balance)
                        {!! radio('ads','type',['1'=>'余额支付'],'',['disabled'=>'disabled']) !!}
                        <input name="payword" type="password" class="width_114" disabled  placeholder="请输入支付密码">
                        @else
                        {!! radio('ads','type',['1'=>'余额支付'],1) !!}
                        <input name="payword" type="password" class="width_114"  placeholder="请输入支付密码">
                        @endif
                        <button class="qrzf">确定支付</button>
                    </div>
                    <div class="c_pay_right">
                        您的账户余额为：
                        <span>￥ <i>{{ auth()->user()->balance }}</i></span>
                        @if($log['money'] > auth()->user()->balance) 您的余额不足！ @endif
                    </div>
                    <div style="clear: both"></div>
                    <div class="c_pay_left c_tggl_right">
                        @if($log['money'] > auth()->user()->balance)
                            {!! radio('ads','type',['2'=>'支付宝'],2) !!}
                        @else
                            {!! radio('ads','type',['2'=>'支付宝']) !!}
                        @endif

                        <button class="ljcz" url="{{ route('api.task.pay',[$log['order_id']]) }}">立即支付</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('.ljcz').click(function(){
                var type = $('input[name="type"]:checked').val();
                if(type == 2){
                    var target = $(this).attr('url');
                    if(target){
                        window.location = target;
                    }
                }
            });
        })
    </script>
@endsection
