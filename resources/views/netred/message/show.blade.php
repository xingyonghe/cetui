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
        <div class="weizhi">当前位置：<a href="{{ route('netred.index.index') }}">首页</a> >
            <a href="{{ route('netred.message.index') }}">信息中心</a> >
            <a>消息详情</a></div>
        <div class="wen">
            <div class="wen_content">
                <h1>{{ $info['title'] }}</h1>
                <h6>{{ $info['created_at']->format('Y-m-d') }}</h6>
                <div class="duanl">
                    {!! $info['content'] !!}
                </div>
            </div>
        </div>
    </div>
    <div class="qingchu"></div>
@endsection