@extends('netred.layouts.base')
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
                minDate:true,
                timepicker:false,    //关闭时间选项
            });
            $('#end_time').datetimepicker({
                format:"Y-m-d",      //格式化日期
                todayButton:false,    //关闭选择今天按钮
                minDate:true,
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
                <a href="{{ route('netred.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('netred.account.index') }}"><span class="on">财务中心</span></a>
            </div>
            <div class="c_box">
                <div class="c_box1">
                    <span>账户余额：<i>{{ auth()->user()->balance }} <em>元</em></i></span>
                    <a href="{{ route('netred.account.cash') }}">立即提现</a>
                    <a href="{{ route('netred.account.create') }}">添加账户</a>
                </div>
            </div>
            <div class="c_box bgColor_f9f9f9">
                <div class="c_box2">
                    <span class="font_eryh">提现记录</span>
                    <div class="c_box2Right">
                        <form class="form-horizontal" action="{{ route('netred.account.index') }}" method="get" >
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
                        <th>申请时间</th>
                        <th>提现金额</th>
                        <th>付款方式</th>
                        <th>付款账户</th>
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
                                    <td>{{ $item['account_type'] }}</td>
                                    <td>{{ $item['account'] }}</td>
                                    <td>
                                        {!! $item['status_text'] !!}
                                        <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">暂无提现申请记录</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagging">
                {!! $lists->render() !!}
            </div>
        </div>
    </div>
@endsection
