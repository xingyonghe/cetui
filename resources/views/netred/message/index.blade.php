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
            <div class="c_route">
                当前位置：
                <a href="{{ route('netred.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('netred.message.index') }}"><span class="on">信息中心</span></a>
            </div>
            <div class="c_box">
                <div class="c_box3">
                    <table cellpadding="0" cellspacing="0">
                        <thead class="bgColor_f9f9f9">
                        <th width="80">类型</th>
                        <th style="text-align: center;">信息标题</th>
                        <th>状态</th>
                        <th width="150">时间</th>
                        </thead>
                        <tbody>
                        @if($lists->total())
                            @foreach($lists as $key=>$item)
                                <tr>
                                    <td>
                                        @if($item['category'] == 1)系统消息@else系统公告@endif
                                        <span class="left_bgFFF"></span>
                                    </td>
                                    <td style="text-align: left; padding-left: 50px;"><a href="{{ route('netred.message.show',[$item['id']]) }}"  title="点击查看详情" alt="点击查看详情">{{ $item['title'] }}</a></td>
                                    <td>@if($item['status'] == -1)已删除
                                        @elseif($item['status'] == 1)未读
                                        @elseif($item['status'] == 2)已读
                                        @endif</td>
                                    <td>{{ $item['created_at']->format('Y-m-d') }}
                                        <span class="right_bgFFF"></span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td  colspan="4">暂无消息</td>
                                <span class="right_bgFFF"></span>
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
