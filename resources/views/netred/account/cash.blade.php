@extends('netred.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('.ajax-post').click(function(){
                var money = $('#money').val();
                var balance = "{{ auth()->user()->balance }}";

                if(!money){
                    alertTips('请填写你要提现的金额','money');return false;
                }
                if(!isMoney(money)){
                    alertTips('提现的金额格式错误','money');return false;
                }
                if(parseFloat(money) > parseFloat(balance)){
                    alertTips('抱歉，你的余额不足','money');return false;
                }

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
                <a href="{{ route('netred.account.index') }}"><span>账户中心</span></a> >
                <a href="{{ route('netred.account.cash') }}"><span class="on">提现申请</span></a>

            </div>
            <div class="c_box">
                <div class="c_box1">
                    <span>账户余额：<i>{{ auth()->user()->balance }} <em>元</em></i></span>
                </div>
            </div>
            <div class="c_box">
                <form role="form" class="data-form" action="{{ route('netred.account.post') }}" method="post">
                    {{ csrf_field() }}
                    @if(isset($info))
                        <input  type="hidden" name="id" value="{{ $info->id }}"/>
                    @endif
                    <div class="c_tggl_box">

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>提现金额：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="money" id="money" class="width_424" placeholder="请填写您要提现的金额"/>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>银行账户：
                            </div>
                            <div class="c_tggl_right">
                                {!! select('account_id',$my_bank,'',['class'=>'width_276','id'=>'account_id']) !!}
                                @if(empty($my_bank[0])) ?您还没有提现账户，<a href="{{ route('netred.account.create') }}" style="color: #ff595f">添加账户</a> @endif
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>支付密码：
                            </div>
                            <div class="c_tggl_right">
                                <input type="password" name="payword" id="payword" placeholder="请输入支付密码"  class="width_424"/>
                                @if(empty(auth()->user()->payword))?您还没有设置支付密码，<a href="{{ route('netred.center.payword') }}" style="color: #ff595f">立即设置</a>
                                @else
                                    ?忘记支付密码，<a href="{{ route('netred.center.payword') }}" style="color: #ff595f">前去修改</a>
                                @endif
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left"></div>
                            <div class="c_tggl_right">
                                <button class="width_424 ajax-post">提现申请</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
