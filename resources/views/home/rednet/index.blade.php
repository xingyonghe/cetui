@extends('home.layouts.base')
@section('styles')
@endsection
@section('scripts')
<script type="text/javascript">
    $(function(){

    });
</script>
@endsection
@section('body')
<!--S顶部-->
<div class="datu4">
    @include('home.layouts.head')
</div>
<div class="hui">
    <div class="juzhongxia2">
        <div class="xie">
            @foreach($category as $key=>$item)
                <div class="zuo">
                    @if($key == 0)
                        <div class="tuiguang_wang">{{ $item['name'] }}</div>
                    @elseif($key == 1)
                        <div class="tuiguang_photo">{{ $item['name'] }}</div>
                    @elseif($key == 2)
                        <div class="tuiguang_game">{{ $item['name'] }}</div>
                    @elseif($key == 3)
                        <div class="tuiguang_zuanshi">{{ $item['name'] }}</div>
                    @endif
                    <div class="xiao">
                        @if(isset($item['_child']) && is_array($item['_child']))
                            @foreach($item['_child'] as $child)
                                <a href="#">{{ $child['name'] }}</a>
                            @endforeach
                        @endif

                    </div>
                </div>
                @if($key < 3)
                    <div class="fengexian"><img src="/home/images/xian.jpg"/></div>
                @endif
            @endforeach
            <div class="qingchu"></div>
        </div>
        <div class="pingtai">
            <ul>
                <li>网红平台:</li>
                <li><a href="#">全部</a></li>
                <li><a href="#">爱奇异</a></li>
                <li><a href="#">一直播</a></li>
                <li><a href="#">虎牙</a></li>
                <li><a href="#">斗鱼</a></li>
                <li><a href="#">映客</a></li>
                <li><a href="#">一起秀</a></li>
                <li><a href="#">花椒</a></li>
                <li><a href="#">美拍</a></li>
                <li><a href="#">秒拍</a></li>
                <li><a href="#">更多>></a></li>
            </ul>
            <div class="qingchu"></div>
        </div>
        <div class="liang">
            <ul>
                <li>粉丝量级：</li>
                <li><a href="#">1万以下</a></li>
                <li><a href="#">1—5万</a></li>
                <li><a href="#">5—10万</a></li>
                <li><a href="#">10—30万</a></li>
                <li><a href="#">30—50万</a></li>
                <li><a href="#">50—100万</a></li>
                <li><a href="#">100万以上</a></li>
            </ul>
            <div class="qingchu"></div>
        </div>
    </div>
    <div class="qingchu"></div>
</div>
<!--Emain-->
<div class="tiantupian">
    <div class="juzhongxia2">
        <div class="fenkai">
            @foreach($lists as $key=>$data)
                <div @if(($key+1)%4 == 0) class="tu2" @else class="tu" @endif >
                    <div class="tupian"><img src="{{ $data['avatar'] }}" width="261"; height="328"/></div>
                    <div class="order">
                        <div class="mingzi">{{ $data['stage_name'] }}</div>
                        <div class="tubiao">
                            <a href="#">
                                <img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69"; height="28"/>
                            </a>
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td width="36" rowspan="2">
                                    <img src="{{ get_platform_filed($data['platform'],'icon') }}" width="36"; height="36"/>
                                </td>
                            </tr>
                            <tr align="center">
                                <td>{{ $data['fans'] }}</td>
                                <td>{{ $data['average_num'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        <div class="qingchu"></div>
    </div>

    <div id="showpage">
        {!! $lists->render() !!}
    </div>
</div>
@endsection
