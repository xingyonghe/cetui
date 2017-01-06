@extends('netred.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){

        })
    </script>
@endsection
@section('body')
    <div class="baifen">
        <div class="inner_nr">
            <div class="account">
                <div class="zhang"> 账户余额：<span class="hong">{{ auth()->user()->balance }}元</span></div>
                <div class="withdrawal"><a href="{{ route('netred.account.cash') }}">立即提现</a></div>
                <div class="add"><a href="{{ route('netred.account.create') }}">添加账户</a></div>
                <div class="add"><a href="{{ route('netred.account.account') }}">账户管理</a></div>
                <div class="qingchu"></div>
            </div>
            <div class="mingxi">
                <div class="ziys">提现明细</div>
                <div class="query">
                    <table width="100%" border="0">
                        <tbody>
                        <tr>
                            <td width="20%" align="right">日期查询：</td>
                            <td width="30%"><input type="text" name="textfield" id="textfield" class="date" /></td>
                            <td width="3%">一</td>
                            <td width="30%"><input type="text" name="textfield2" id="textfield2" class="date"/></td>
                            <td width="19%"><input type="" name="button" id="button" class="search"/></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="qingchu"></div>
            </div>



            <div class="jilu">
                共计：2 条记录
            </div>
            <div class="xijie">
                <table width="100%" border="0" cellspacing="0">
                    <tbody>
                    <tr class="biaoti">
                        <td>流水号</td>
                        <td>提现时间</td>
                        <td>提现金额</td>
                        <td>收款方式</td>
                        <td>收款账户</td>
                        <td>提现状态</td>
                    </tr>
                    <tr>
                        <td  class="xiangqingmo">12561256</td>
                        <td  class="xiangqingmo">2016.11.28</td>
                        <td class="xiangqingmo">1000</td>
                        <td class="xiangqingmo">支付宝</td>
                        <td class="xiangqingmo">5452225255425842159</td>
                        <td class="xiangqingmo"><span class="no">待支付</span></td>
                    </tr>
                    <tr>
                        <td class="xiangqing">12561256001</td>
                        <td class="xiangqing">2016.11.28</td>
                        <td class="xiangqing">100000</td>
                        <td class="xiangqing">支付宝</td>
                        <td class="xiangqing">2045222525</td>
                        <td class="xiangqing">已支付</td>
                    </tr>
                    <tr>
                        <td class="xiangqing">01256015</td>
                        <td class="xiangqing">2016.11.28</td>
                        <td class="xiangqing">1000</td>
                        <td class="xiangqing">支付宝</td>
                        <td class="xiangqing">45222525</td>
                        <td class="xiangqing">已支付</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
