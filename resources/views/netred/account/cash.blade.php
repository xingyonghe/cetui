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
    <div class="inner_c">
        <div class="weizhi">当前位置：
            <a href="{{ route('netred.index.index') }}">首页</a> >
            <a href="{{ route('netred.account.index') }}">财务中心</a> >
            <a><span>提现申请</span></a>
        </div>
        <div class="dingdan">
            <div class="fl">
                <div class="zhang"> 账户余额：<span class="hong">{{ auth()->user()->balance }}元</span></div>
            </div>
            <div class="fr">
                <ul>
                    <li class="tianjia">
                        还没有提现账户？<a class="adj" href="{{ route('netred.account.create') }}">添加账户</a>
                    </li>
                </ul>
            </div>
            <div class="qingchu"></div>
        </div>
        <div class="biao2ti">
            <form role="form" class="data-form" action="{{ route('netred.account.post') }}" method="post">
                {{ csrf_field() }}
                <table width="100%" border="0" cellspacing="10">
                    <tbody>
                    <tr>
                        <td width="20%" align="right"><span class="hong">*</span>提现金额：</td>
                        <td align="left">
                            <input type="text" name="money" id="money" class="textkuangnr"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>银行账户：</td>
                        <td align="left">
                            {!! select('bank_id',$my_bank,'',['class'=>'textkuangnr']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>动态码：</td>
                        <td align="left">
                            <input type="text" name="code" id="code" class="textkuangnr"/>
                            <input type="button" value="发送动态验证码" class="adj"/>
                            认证手机号：{{ substr_replace(auth()->user()->username,'****',3,4) }}
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="left">
                            <input type="submit"  value="提现申请" class="suban ajax-post"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <div class="qingchu"></div>
@endsection
