@extends('netred.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('.ajax-post').click(function(){
                var that = $(this);
                formAjaxPost($('.data-form'),that);
                return false;
            });
        })
    </script>
@endsection
@section('body')
    <div class="inner_c">
        <div class="weizhi">当前位置：
            <a href="{{ route('netred.index.index') }}">首页</a> >
            <a>信息中心</a></div>
        <div class="biao">
            <table width="100%" border="0" cellspacing="0">
                <tbody>
                <tr class="biaotou">
                    <td>类型</td>
                    <td>信息标题</td>
                    <td>状态</td>
                    <td>时间</td>
                </tr>
                @if($lists->total())
                    @foreach($lists as $key=>$item)
                        <tr>
                            <td  class="biaorongmo">@if($item['category'] == 1)系统消息@else系统公告@endif</td>
                            <td  class="biaorongmo"><a href="{{ route('netred.message.show',[$item['id']]) }}">{{ $item['title'] }}</a></td>
                            <td  class="biaorongmo">@if($item['status'] == -1)已删除
                                @elseif($item['status'] == 1)未读
                                @elseif($item['status'] == 2)已读
                                @endif</td>
                            <td class="biaorongmo">{{ $item['created_at']->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td  class="biaorongmo" colspan="3">暂无消息</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
