@extends('ads.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('.ajax-pay').click(function(){
                var type = $("input[name='type']:checked").val();
                var payword = $("input[name='payword']").val();
                var target = "{{ route('ads.order.balance') }}";
                var order = "{{ $order['order_sn'] }}";
                if(type == 1){
                    if(!payword){
                        alertTips('请输入支付密码','payword');return false;
                    }
                    var query = {'order':order,'payword':payword,'_token' : "{{ csrf_token() }}"};
                    $.post(target,query).success(function(data){
                        if (data.status==-1){
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
                            layer.open({
                                type    : 1,
                                skin    : 'layer-ext-member',
                                title   :  '消息提醒',
                                area    : ['450px','120px'],
                                closeBtn: 0,
                                shade   : false,
                                content : data.info,
                                time    : 3000,
                                yes     : function(){
                                    window.location = data.url;
                                },
                                end     : function(){
                                    window.location = data.url;
                                }
                            });

                        }
                    });
                }
                return false;
            });
        })
    </script>
@endsection

@section('body')
    <div class="container marTB_15">
        <div class="width_1140">
            <p class="payCenter">支付详情</p>

            <div class="c_pay_box1 marTB_25">
                <div class="c_pay_row">
                    <div class="c_pay_left">
                        本次共计需要支付推广费：
                        <span><i>{{ $order['money'] }}</i> 元</span>
                    </div>
                    <div class="c_pay_right c_tggl_right">订单账号：<span><i>{{ $order['order_sn'] }}</i></span>
                    </div>
                    <div style="clear: both"></div>
                    <div class="c_pay_left c_tggl_right">
                        @if($order['money'] > auth()->user()->balance)
                        {!! radio('ads','type',['1'=>'余额支付'],'',['disabled'=>'disabled']) !!}
                        <input name="payword" type="password" class="width_114" disabled  placeholder="请输入支付密码">
                        @else
                        {!! radio('ads','type',['1'=>'余额支付'],1) !!}
                        <input name="payword" type="password" id="payword" class="width_114"  placeholder="请输入支付密码">
                            <div style="position: absolute;margin-left: 30px;padding: 5px 0">
                                @if(empty(auth()->user()->payword))
                                    您还没有设置支付密码，<a href="{{ route('ads.center.payword') }}" style="color: #ff595f">立即设置</a>
                                @else
                                    忘记支付密码，<a href="{{ route('ads.center.payword') }}" style="color: #ff595f">前去修改</a>
                                @endif
                                @endif
                            </div>
                        <button class="qrzf ajax-pay" style="margin-left: 110px">确定支付</button>
                    </div>
                    <div class="c_pay_right">
                        您的账户余额为：
                        <span>￥ <i>{{ auth()->user()->balance }}</i></span>
                        @if($order['money'] > auth()->user()->balance) 您的余额不足！ @endif
                    </div>
                    <div style="clear: both"></div>
                    <div class="c_pay_left c_tggl_right">
                        @if($order['money'] > auth()->user()->balance)
                            {!! radio('ads','type',['2'=>'支付宝'],2) !!}
                        @else
                            {!! radio('ads','type',['2'=>'支付宝']) !!}
                        @endif

                        <button class="ljcz" url="{{ route('api.order.pay',[$order['order_sn']]) }}">立即支付</button>
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
