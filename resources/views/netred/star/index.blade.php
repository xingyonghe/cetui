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
    <div class="inner_c">
        <div class="dingdan">
            <div class="fl">
                <ul>
                    <form role="form"  action="{{ route('netred.star.index') }}" metho="get">
                    <li>
                        <span>账户类别：</span>
                        <select class="duoxuan" name="type">
                            <option value="">请选择</option>
                            <option value="1" @if($params['type'] == 1) selected @endif>直播</option>
                            <option value="2" @if($params['type'] == 2) selected @endif>短视频</option>
                        </select>
                    </li>
                    <li>
                        <span>账户状态：</span>
                        <select class="duoxuan" name="status">
                            <option value="">请选择</option>
                            <option value="1" @if($params['status'] == 1) selected @endif>正常</option>
                            <option value="2" @if($params['status'] == 2) selected @endif>待审核</option>
                            <option value="3" @if($params['status'] == 3) selected @endif>未通过</option>
                        </select>
                    </li>
                    <li><input class="yi" type="text" name="stage_name" value="{{ $params['stage_name'] ?? '' }}" placeholder="艺人名称"/></li>
                    <li><input class="so" type="submit" value=""/></li>
                    </form>
                </ul>
            </div>
            <div class="fr">
                <ul>
                    <li class="tianjia">
                        <a href="{{ route('netred.star.video') }}" class="adj">添加短视频</a>
                    </li>
                    <li class="tianjia">
                        <a href="{{ route('netred.star.live') }}" class="adj">添加直播</a>
                    </li>
                </ul>
            </div>
            <div class="qingchu"></div>
        </div>
        <div class="qingchu"></div>
        <div class="zhanghu"><p>共计：{{ $lists->total() }}个账户</p></div>
        <div class="zixun">
            <div class="biaoti">
                <table width="1136" >
                    <tr>
                        <td width="130">艺人名称</td>
                        <td width="130">类型</td>
                        <td width="110">入驻平台</td>
                        <td width="110">粉丝数</td>
                        <td width="150">参考报价</td>
                        <td width="150">价格有效期</td>
                        <td width="120">添加时间</td>
                        <td class="no" width="110">状态</td>
                        <td colspan="3"  width="130">操作</td>
                    </tr>
                </table>
            </div>
            @if($lists->total())
                @foreach($lists as $key=>$item)
                    <div @if($key<1) class="xiangqing" @else class="xiangqingmo" @endif>
                        <table width="1136">
                            <tr>
                                <td width="130">{{ $item['stage_name'] }}</td>
                                <td width="130">@if($item['type'] == 1)直播@else短视频@endif</td>
                                <td width="110">{{ get_platform_filed($item['platform_id']) }}</td>
                                <td width="110">{{ $item['fans'] }}</td>
                                <td class="no" width="150">
                                    {{ $item['money'] }}元
                                </td>
                                <td class="no" width="150">
                                    {{ $item['term_time']->format('Y-m-d') }}
                                </td>
                                <td class="no" width="120">{{ $item['created_at']->format('Y-m-d') }}</td>
                                <td class="no" width="110">{!! $item['status_text'] !!}</td>
                                <td class="lan" width="130">
                                    @if($item['status'] == 1 || $item['status'] == 3)
                                        <a href="{{ route('netred.star.edit',[$item['id']]) }}">编辑</a>|
                                        <a  class="ajax-confirm destroy" href="{{ route('netred.star.destroy',[$item['id']]) }}">删除</a>
                                    @endif
                                </td>

                            </tr>
                        </table>
                    </div>
                @endforeach
            @else
                <div class="xiangqing">
                    <table width="1136">
                        <tr>
                            <td width="130" colspan="9">
                                暂无资源
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        </div>
        <div id="showpage" class="cpage">
            {!! $lists->appends($params)->render() !!}
        </div>
    </div>
@endsection
