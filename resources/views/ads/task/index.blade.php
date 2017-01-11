@extends('ads.layouts.base')
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
            <p class="c_tgglMark">
                <span><a href="{{ route('ads.task.create') }}" style="color: #ffffff">发布推广活动</a></span>
                <span>共计 {{ $lists->total() }} 个活动</span>
            </p>
            <div class="c_box">
                <div class="c_zylb_box3 c_tggl_tr">
                    <table cellpadding="0" cellspacing="0">
                        <thead class="bgColor_f9f9f9">
                        <th>活动ID</th>
                        <th>活动名称</th>
                        <th>投放类型</th>
                        <th>截止时间</th>
                        <th>投放时间</th>
                        <th>预算</th>
                        <th>需求人数</th>
                        <th>投标数量</th>
                        <th>发布日期</th>
                        <th>状态</th>
                        <th>操作</th>
                        </thead>
                        <tbody>
                        @if($lists->total())
                            @foreach($lists as $data)
                                <tr>
                                    <td>
                                        {{ $data->id }}
                                        <span class="left_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                                    </td>
                                    <td>{{ str_limit($data->title, 35) }}</td>
                                    <td>@if($data->type == 1)直播@else短视频@endif</td>
                                    <td class="style_a">
                                        {{ $data->dead_time->format('Y-m-d') }}
                                    </td>
                                    <td class="style_a">
                                        {{ $data->start_time->format('Y-m-d') }} -- {{ $data->end_time->format('Y-m-d') }}
                                    </td>
                                    <td>{{ $data->money }}元</td>
                                    <td>{{ $data->num }}名</td>
                                    <td class="style_a">
                                        0个
                                    </td>
                                    <td>{{ $data->created_at->format('Y-m-d') }}</td>
                                    <td class="style_a">
                                        {!! $data->status_text !!}
                                    </td>
                                    <td>

                                        @if($data->status == 6)
                                            <a class="" href="{{ route('ads.task.show',[$data->id]) }}">详情</a>
                                            <a class="ajax-confirm destroy" href="javascript:void(0)" url="{{ route('ads.task.destroy',[$data->id]) }}">删除</a>
                                        @endif
                                        @if($data->status == 1)<!-- 待支付 -->
                                            <a class="" href="{{ route('ads.task.show',[$data->id]) }}">详情</a>
                                            <a href="{{ route('ads.task.pay',[$data->id]) }}">支付</a>
                                        @endif
                                        @if($data->status == 2)<!-- 进行中 -->
                                            <a href="{{ route('ads.task.pay',[$data->id]) }}">选标</a>
                                            <a href="{{ route('ads.task.pay',[$data->id]) }}">追加经费</a>
                                        @endif
                                        @if($data->status == 3)<!-- 待审核 -->
                                            <a class="" href="{{ route('ads.task.show',[$data->id]) }}">详情</a>
                                        @endif
                                        @if($data->status == 4)<!-- 未通过 -->
                                            <a href="{{ route('ads.task.edit',[$data->id]) }}">编辑</a>
                                        @endif
                                        <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">
                                    抱歉，您还没有任何活动信息
                                    <span class="right_bgFFF"></span>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div id="showpage" class="cpage">
                        {{--{!! $lists->render() !!}--}}
                    </div>
                </div>
            </div>
            <div style="height: 200px;"></div><!-- 只是为了撑页面，可以删除 -->
        </div>
    </div>
@endsection
