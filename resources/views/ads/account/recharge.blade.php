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
                <a href="{{ route('ads.account.index') }}"><span>财务中心</span></a> >
                <span class="on">充值中心</span>
            </div>
            <div class="c_box">
                <form role="form" class=" data-form" action="{{ route('ads.account.charging') }}" method="post">
                    {{ csrf_field() }}
                    <div class="c_cz_box1">
                        <p>提示：目前本平台仅支持支付宝在线充值，零手续费，实时到账，如需要申请发票，请联系在线客服处理！</p>
                        <div class="c_cz_style">
                            <small class="icon_zhifubao"></small>
                        </div>
                        <div class="c_cz_line">
                            <span>充值金额：</span>
                            <input type="text" name="money" value="" id="money"/>
                        </div>
                        <div class="c_cz_line">
                            <button class="ajax-post">现在开始充值</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
