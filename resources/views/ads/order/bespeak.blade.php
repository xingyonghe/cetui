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
    <div class="container">
        <div class="width_1140">
            <div class="c_route">
                当前位置：
                <a href="{{ route('ads.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('ads.order.bespeak') }}"><span class="on">我的预约</span></a>
            </div>
            <br/> <br/>
            <p class="c_mark">共计：{{ $lists->total() }} 个预约</p>
            <div class="c_box">
                <div class="c_box3">
                    <table cellpadding="0" cellspacing="0">
                        <thead class="bgColor_f9f9f9">
                            <th>网红艺名</th>
                            <th>推广预算</th>
                            <th>预约时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                        @if($lists->total())
                            @foreach($lists as $key=>$item)
                                <tr>
                                    <td>
                                        {{ get_netred($item['netred_id']) }}
                                        <span class="left_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                                    </td>
                                    <td>{{ $item['money'] }}元</td>
                                    <td>{{ $item['created_at']->format('Y-m-d') }}</td>
                                    <td>{!! $item['status_text'] !!}</td>
                                    <td>
                                        @if($item['order_sn'])
                                            <a href="">查看订单</a>
                                        @endif
                                        <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">暂无预约信息</td>
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
