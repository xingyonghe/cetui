@extends('netred.layouts.base')
@section('style')
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){

        })
    </script>
@endsection
@section('body')
    <div class="container">
        <div class="width_1140">
            <div class="c_box bgColor_f9f9f9">
                <div class="c_box2">
                    <form role="form"  action="{{ route('netred.star.index') }}" metho="get">
                        <span>账户状态：</span>
                        <select class="duoxuan" name="status">
                            <option value="">请选择</option>
                            <option value="1" @if($params['status'] == 1) selected @endif>正常</option>
                            <option value="2" @if($params['status'] == 2) selected @endif>待审核</option>
                            <option value="3" @if($params['status'] == 3) selected @endif>未通过</option>
                        </select>

                        <span>账户类别：</span>
                        <select class="duoxuan" name="type">
                            <option value="">请选择</option>
                            <option value="1" @if($params['type'] == 1) selected @endif>直播</option>
                            <option value="2" @if($params['type'] == 2) selected @endif>短视频</option>
                        </select>

                        <div class="c_box2Right marRight_20">
                            艺人名称：
                            <input type="text" />
                            <button class="search"></button>
                        </div>
                    </form>
                </div>
            </div>
            <p class="c_mark">共计：{{ $lists->total() }} 个资源</p>
            <div class="c_box">
                <div class="c_box3">
                    <table cellpadding="0" cellspacing="0">
                        <thead class="bgColor_f9f9f9">
                        <tr>
                            <th>艺人名称</th>
                            <th>类型</th>
                            <th>入驻平台</th>
                            <th>粉丝数</th>
                            <th>参考报价</th>
                            <th>添加时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($lists->total())
                            @foreach($lists as $key=>$item)
                                <tr>
                                    <td>{{ $item['stage_name'] }}</td>
                                    <td>@if($item['type'] == 1)直播@else短视频@endif</td>
                                    <td>{{ get_platform_filed($item['platform_id']) }}</td>
                                    <td>{{ $item['fans'] }}</td>
                                    <td>
                                        {{ $item['money'] }}元
                                    </td>
                                    <td>{{ $item['created_at']->format('Y-m-d') }}</td>
                                    <td>{!! $item['status_text'] !!}</td>
                                    <td>
                                        @if($item['status'] == 1 || $item['status'] == 3)
                                            <a href="{{ route('netred.star.edit',[$item['id']]) }}">编辑</a>|
                                            <a class="ajax-confirm destroy" href="{{ route('netred.star.destroy',[$item['id']]) }}">删除</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr colspan="8">
                                暂无资源
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div  class="pagging">
                {!! $lists->appends($params)->render() !!}
            </div>
        </div>
    </div>
@endsection
