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
        <div class="zhongxin">
            <div class="member fl">
                <div class="member_tittle"><p>会员中心</p></div>
                <div class="active">
                    <table class="biaoge">
                        <tr>
                            <td width="150">最新活动</td>
                            <td width="230">邀请我参加的活动</td>
                            <td width="180">进行中的活动</td>
                            <td width="180">已完成活动</td>
                        </tr>
                        <tr>
                            <td width="150">5</td>
                            <td width="230">8</td>
                            <td width="180">2</td>
                            <td width="180">3</td>
                        </tr>
                    </table>
                </div>
                <div class="active">
                    <div class="balance fl">
                        您的评分：<span>5.9</span>
                    </div>
                    <div class="balance fl">
                        账户余额：<span>{{ auth()->user()->balance }}</span><b>元</b>
                    </div>
                    <div class="withdrawal fl"><a href="{{ route('netred.account.cash') }}">立即提现</a></div>
                </div>
            </div>
            <div class="message fr">
                <div class="message_tittle"><p>消息中心</p></div>
                <div class="xiaoxi">
                    <ul>
                        <li><a href="#">【公告】今晚服务器维护！<img src="/member/netred/images/weidu.png"/><span>2016-12-28</span></a></li>
                        <li><a href="#">【消息】任务已经审核！<span>2016-12-28</span></a></li>
                        <li><a href="#">【消息】费用已经支持完！<span>2016-12-28</span></a></li>
                        <li><a href="#">【公告】今晚服务器维护！<span>2016-12-28</span></a></li>
                        <li><a href="#">【消息】任务已经审核！<span>2016-12-28</span></a></li>
                        <li><a href="#">【消息】费用已经支持完！<span>2016-12-28</span></a></li>
                        <li><a href="#">【公告】今晚服务器维护！<span>2016-12-28</span></a></li>
                        <li><a href="#">【消息】任务已经审核！<span>2016-12-28</span></a></li>
                        <li><a href="#">【消息】费用已经支持完！<span>2016-12-28</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="qingchu"></div>
        <div class="process">
            <div class="process_tittle">
                <p>接单操作流程</p>
            </div>
            <div class="tu">
                <div class="buzhou fl">
                    <h6>第一步</h6>
                    <p>点击派单大厅，进去挑选适合<br/>
                       自己的广告任务！</p>
                </div>
                <div class="img fl"><img src="member/netred/images/jiantou.png"/></div>
                <div class="buzhou fl">
                    <h6>第一步</h6>
                    <p>点击派单大厅，进去挑选适合<br/>
                       自己的广告任务！</p>
                </div>
                <div class="img fl"><img src="member/netred/images/jiantou.png"/></div>
                <div class="buzhou fl">
                    <h6>第一步</h6>
                    <p>点击派单大厅，进去挑选适合<br/>
                       自己的广告任务！</p>
                </div>
                <div class="img fl"><img src="member/netred/images/jiantou.png"/></div>
                <div class="buzhou fl">
                    <h6>第一步</h6>
                    <p>点击派单大厅，进去挑选适合<br/>
                       自己的广告任务！</p>
                </div>
            </div>
        </div>
    </div>
@endsection
