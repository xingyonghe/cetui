@extends('netred.layouts.base')
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{  asset('static/raty/demo/css/application.css') }}">
    <link href="{{ asset('static/datetimepicker/datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{ asset('static/raty/lib/jquery.raty.min.js') }}"></script>
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
            $('#star').raty();
            $('body').on('click','.ajax-score',function(){
                var score = $(this).attr('data-score');
                $('#star').raty({ score: score });
                var star = $('.star').html();
                layer.open({
                    type    : 1,
                    skin    : 'layer-ext-member',
                    title   : '消息提醒',
                    area    : ['600px'],
                    closeBtn: 1,
                    shade   : false,
                    content : star,
                });

            })
        })
    </script>
@endsection
@section('body')
    <div class="container">
        <div class="width_1140">
            <div class="c_box bgColor_f9f9f9">
                <div class="c_box2">
                    <span>订单类型：预约订单</span>
                    <div class="c_box2Right">
                        时间：
                        <input type="text" name="start_time" id="start_time"/>
                        <span> - </span>
                        <input type="text" name="start_time" id="end_time"/>
                        <button class="search"></button>
                    </div>
                    <div class="c_box2Right marRight_20">
                        订单ID：
                        <input type="text" />
                    </div>
                </div>
            </div>
            <p class="c_mark">共计：{{ $lists->total() }} 个订单</p>
            <div class="c_box">
                <div class="c_box3">
                    <table cellpadding="0" cellspacing="0">
                        <thead class="bgColor_f9f9f9">
                        <th>订单ID</th>
                        <th>广告主</th>
                        <th>网红名称</th>
                        <th>订单金额</th>
                        <th>订单日期</th>
                        <th>支付日期</th>
                        <th>订单状态</th>
                        <th>操作</th>
                        </thead>
                        <tbody>
                        @if($lists->total())
                            @foreach($lists as $key=>$item)
                                <tr>
                                    <td>
                                        {{ $item['order_sn'] }}
                                        <span class="left_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                                    </td>
                                    <td>{{ get_user($item['buy_user_id'],'nickname') }}</td>
                                    <td>{{ get_netred($item['shop_id']) }}</td>
                                    <td>{{ $item['money'] }}元</td>
                                    <td>{{ $item['created_at']->format('Y-m-d') }}</td>
                                    <td>@if($item['pay_at']) {{ $item['pay_at']->format('Y-m-d') }} @endif</td>
                                    <td>{!! $item['status_text'] !!}</td>
                                    <td>
                                        <a href="">订单详情</a>
                                        @if($item['status'] == 2)
                                            |<a href="javascript:void(0)" class="ajax-upload" url="{{ route('netred.order.upload',[$item['order_sn']]) }}">上传凭证</a>
                                        @endif
                                        @if($item['status'] == 6)
                                            |<a href="javascript:void(0)" class="ajax-score" data-score="{{ $item['score'] }}">查看评价</a>
                                        @endif
                                        <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">暂无预约订单信息</td>
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
    <div style="text-align: left;padding-left:100px;display: none" class="star">
        <div id="star" style="padding: 10px 20px"></div>
    </div>
@endsection
