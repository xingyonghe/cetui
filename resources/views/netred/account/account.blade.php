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
    <div class="container">
        <div class="width_1140">
            <div class="c_route">
                当前位置：
                <a href="{{ route('netred.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('netred.account.index') }}"><span>账户中心</span></a> >
                <a href="{{ route('netred.account.account') }}"><span class="on">账户管理</span></a>
            </div>
            <div class="c_box" >
                <div class="c_box1" style="padding: 10px 0;text-align: right">
                    <span><a href="{{ route('netred.account.create') }}">添加账户</a></span>
                </div>
            </div>
            <div class="c_box">
                <div class="c_box3">
                    <table cellpadding="0" cellspacing="0">
                        <thead class="bgColor_f9f9f9">
                        <td>ID</td>
                        <td>账户类型</td>
                        <td>账号</td>
                        <td>开户姓名</td>
                        <td>开户行</td>
                        <td>添加时间</td>
                        <td>操作</td>
                        </thead>
                        <tbody>
                        @foreach($lists as $key=>$item)
                            <tr>
                                <td class="xiangqing">{{ $item['id'] }}</td>
                                <td class="xiangqing">{{ $bank[$item['bank_id']] }}</td>
                                <td class="xiangqing">{{ $item['account'] }}</td>
                                <td class="xiangqing">{{ $item['username'] }}</td>
                                <td class="xiangqing">{{ $item['deposit'] }}</td>
                                <td class="xiangqing">{{ $item['created_at']->format('Y-m-d') }}</td>
                                <td class="xiangqing">
                                    <a href="{{ route('netred.account.edit',[$item['id']]) }}">编辑</a>|
                                    <a href="javascript:void(0)" class="ajax-confirm destroy" url="{{ route('netred.account.destroy',[$item['id']]) }}">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
