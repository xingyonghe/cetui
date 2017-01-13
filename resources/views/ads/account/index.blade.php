@extends('ads.layouts.base')
@section('styles')
    <link href="{{ asset('static/datetimepicker/datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{ asset('static/datetimepicker/jquery.datetimepicker.full.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $.datetimepicker.setLocale('ch');
            $('#start_time').datetimepicker({
                format:"Y-m-d",      //格式化日期
                todayButton:false,    //关闭选择今天按钮
//                minDate:true,
                timepicker:false,    //关闭时间选项
            });
            $('#end_time').datetimepicker({
                format:"Y-m-d",      //格式化日期
                todayButton:false,    //关闭选择今天按钮
//                minDate:true,
                timepicker:false,    //关闭时间选项
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
                <span class="on">我的账户</span>
            </div>
            <div class="c_box">
                <div class="c_box1">
                    <span>账户余额：<i>{{ auth()->user()->balance }} <em>元</em></i></span>
                    <a href="{{ route('ads.account.recharge') }}">立即充值</a>
                </div>
            </div>
            <div class="c_box bgColor_f9f9f9">
                <div class="c_box2">
                    <span class="font_eryh">充值明细</span>
                    <div class="c_box2Right">
                        <form class="form-horizontal" action="{{ route('ads.account.index') }}" method="get" >
                            日期查询：
                            <input type="text" name="start_time" value="{{ $params['start_time'] }}" id="start_time"/>
                            <span> - </span>
                            <input type="text" name="end_time" value="{{ $params['end_time'] }}" id="end_time"/>
                            <button type="submit" class="search"></button>
                        </form>
                    </div>
                </div>
            </div>
            <p class="c_mark">共计：{{ $lists->total() }} 条记录</p>
            <div class="c_box">
                <div class="c_box3">
                    <table cellpadding="0" cellspacing="0">
                        <thead class="bgColor_f9f9f9">
                        <th>流水号</th>
                        <th>充值时间</th>
                        <th>充值金额</th>
                        <th>充值方式</th>
                        <th>备注</th>
                        <th>状态</th>
                        </thead>
                        <tbody>
                        @if($lists->total())
                            @foreach($lists as $key=>$item)
                                <tr>
                                    <td>
                                        {{ $item['order_id'] }}
                                        <span class="left_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                                    </td>
                                    <td>{{ $item['created_at']->format('Y-m-d') }}</td>
                                    <td>{{ $item['money'] }}元</td>
                                    <td>支付宝</td>
                                    <td>{!! $item['mark'] !!}</td>
                                    <td>
                                        @if($item['status'] == 0) 未支付 @endif
                                        @if($item['status'] == 1) 成功 @endif
                                        <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">暂无充值记录</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagging">
                {!! $lists->appends($params)->render() !!}
            </div>
        </div>
    </div>
@endsection
