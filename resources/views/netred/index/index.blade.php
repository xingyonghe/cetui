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
    <div class="container marTB_15">
        <div class="width_1140">
            <div class="c_index_box">
                <div class="index_left">
                    <h3 class="index_title">会员中心</h3>
                    <div class="index_part1">
                        <span>
                            <p>最新活动</p>
                            <i>8</i>
                        </span>
                        <span>
                            <p>邀请我参加的活动</p>
                            <i>2</i>
                        </span>
                        <span>
                            <p>进行中的活动</p>
                            <i>4</i>
                        </span>
                        <span>
                            <p>已完成活动</p>
                            <i>4</i>
                        </span>
                    </div>
                    <div class="index_part2">
                        <span class="part2_left">您的评分：：<i>5.9</i>  &nbsp;&nbsp;&nbsp;&nbsp;账户余额：<i>{{ auth()->user()->balance }} <em>元</em></i></span>
                        <span class="part2_right">
                            <a href="{{ route('netred.account.cash') }}">立即提现</a>
                        </span>
                    </div>

                </div>
                <div class="index_right">
                    <h3 class="index_title">消息中心</h3>
                    <ul>
                        @if($messages)
                            @foreach($messages as $message)
                                <li><a href="{{ route('netred.message.show',[$message['id']]) }}">【@if($message['category'] == 1)系统消息@endif @if($message['category'] == 2)系统公告@endif】
                                        {{ $message['title'] }}
                                        @if($message['status'] == 1)
                                            <small>未读</small>
                                        @endif
                                        <span style="padding-left: 25px">{{ $message['created_at']->format('Y-m-d') }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <div class="c_index_box1">
                <h3 class="index_title">接单操作流程
                    <span>提示：您可以自由发布广告活动让网红来竞标您的广告，也可以再资源列表内选择满意的网红直接进行合作！</span>
                </h3>
                <div class="index_box1">
                    <span class="spsan_bg">
                        <h5>第一步</h5>
                        <p>点击派单大厅，进去挑选适合自己的广告任务！</p>
                    </span>
                    <span class="spsan_bg">
                        <h5>第二步</h5>
                        <p>选择完成任务后，提交自己的方案和优势介绍！</p>
                    </span>
                    <span class="spsan_bg">
                        <h5>第三步</h5>
                        <p>等待广告主审核，审核通过后即可开始推广！</p>
                    </span>
                    <span>
                        <h5>第四步</h5>
                        <p>投放结束，提交投放效果，等待平台派发佣金！</p>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
