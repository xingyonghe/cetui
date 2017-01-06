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
    <div class="baifen">
        <div class="inner_nr">
            <div class="weizhi">当前位置：
                <a href="{{ route('netred.index.index') }}">首页</a> >
                <a href="{{ route('netred.account.index') }}">财务中心</a> >
                <a><span>账户管理</span></a>
            </div>
            <div class="dingdan">
                <div class="fl">
                </div>
                <div class="fr">
                    <ul>
                        <li class="tianjia">
                            <a class="adj" href="{{ route('netred.account.create') }}">添加账户</a>
                        </li>
                    </ul>
                </div>
                <div class="qingchu"></div>
            </div>
            <div class="xijie">
                <table width="100%" border="0" cellspacing="0">
                    <tbody>
                    <tr class="biaoti">
                        <td>ID</td>
                        <td>账户类型</td>
                        <td>账号</td>
                        <td>开户姓名</td>
                        <td>开户行</td>
                        <td>添加时间</td>
                        <td>操作</td>
                    </tr>
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
@endsection
