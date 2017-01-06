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
    <div class="inner_c">
        <div class="mingxi">
            <div class="ziys">订单类型：全部订单</div>
            <div class="queryding">
                <table width="100%" border="0">
                    <tbody>
                    <tr>
                        <td width="20%" align="right">订单ID：</td>
                        <td width="30%"><input type="text" name="textfield" id="textfield" class="date" /></td>
                        <td width="15%" align="right">时间：</td>
                        <td width="30%"><input type="text" name="textfield2" id="textfield2" class="date"/></td>
                        <td width="5%">一</td>
                        <td width="19%"><input type="text" name="textfield3" id="textfield3"  class="date" /></td>
                        <td width="19%"><input type="" name="button" id="button" class="search"/></td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div class="qingchu"></div>
        </div>
        <div class="jilu">共计：0个订单</div>
        <div class="xijie">
            <table width="100%" border="0" cellspacing="0">
                <tbody>
                <tr class="biaoti">
                    <td>订单ID</td>
                    <td>资源类型</td>
                    <td>账号名称</td>
                    <td>活动名称</td>
                    <td>开始时间-结束时间</td>
                    <td>价格</td>
                    <td>订单状态</td>
                    <td>提交审核</td>
                </tr>
                <tr>
                    <td  class="xiangqingmo">001</td>
                    <td  class="xiangqingmo">直播</td>
                    <td class="xiangqingmo">admin</td>
                    <td class="xiangqingmo">梦幻西游手游推广</td>
                    <td class="xiangqingmo">2016.11.25-2016.12.30</td>
                    <td class="xiangqingmo"><span class="no">10000</span></td>
                    <td class="xiangqingmo">进行中</td>
                    <td class="xiangqingmo"><a href="#">提交</a></td>
                </tr>
                <tr>
                    <td class="xiangqing">001</td>
                    <td class="xiangqing">短视频</td>
                    <td class="xiangqing">admin</td>
                    <td class="xiangqing">梦幻西游手游推广</td>
                    <td class="xiangqing">2016.11.25-2016.12.30</td>
                    <td class="xiangqing"><span class="no">10000</span></td>
                    <td class="xiangqing">已完成</td>
                    <td class="xiangqing"><span class="no"><a  href="#">提交</a></span></td>
                </tr>
                <tr>
                    <td class="xiangqing">0015</td>
                    <td class="xiangqing">直播</td>
                    <td class="xiangqing">admin</td>
                    <td class="xiangqing">梦幻西游手游推广</td>
                    <td class="xiangqing">2016.11.25-2016.12.30</td>
                    <td class="xiangqing"><span class="no">10000</span></td>
                    <td class="xiangqing">已完成</td>
                    <td class="xiangqing"><a href="#">提交</a></td>
                </tr>
                </tbody>
            </table>


        </div>
        <div class="qingchu"></div>
        <div id="showpage" class="cpage"> <a class="cur" href="#" >1</a><a href="#" >2</a><a href="#">3</a><span>…</span><a href="#">18</a><a href="#">&gt;</a> </div>
        <div class="qingchu"></div></div>
@endsection
