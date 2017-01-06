@extends('member.layouts.base')
@section('style')
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            highlight_subnav("{{ route('member.account.index') }}");
        })
    </script>
@endsection
@section('body')
    <!--container start-->
    <div class="container">
        <div class="row">
            @include('member.layouts.nav')
            <div class="col-lg-10 col-sm-10">
                <h5 class="member-title">账户充值</h5>
                <div class="contact-form">
                    <form role="form" class=" data-form" action="{{ route('member.account.charging') }}" method="post">
                        {{ csrf_field() }}
                        <br/><br/>
                        <div class="form-group">
                            <label class="control-label">充值金额：</label>
                            <input type="text" name="money" value="" id="money" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >平台选择：<i id="payment"></i></label>
                            <input type="radio" name="payment" value="alipay"/>支付宝
                        </div>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
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
