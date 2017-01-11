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
                <a href="{{ route('netred.message.index') }}"><span>信息中心</span></a> >
                <a href="{{ route('netred.message.show',[$info['id']]) }}"><span class="on">详情</span></a>
            </div>
            <div class="c_box">
                <div class="c_message_box">
                    <h3>{{ $info['title'] }}</h3>
                    <span>{{ $info['created_at']->format('Y-m-d') }}</span>
                    <p>{!! $info['content'] !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection