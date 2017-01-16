@extends('home.layouts.base')
@section('styles')
@endsection
@section('scripts')
<script type="text/javascript">
    $(function(){
        var bespeak = $.parseJSON('{!! $bespeak !!}');
        console.log(bespeak);
        var token = "{{ csrf_token() }}";
        var target = "{{ route('home.rednet.bespeak') }}";
        $('body').on('click','.unlogin_b',function(){
            var netred_id = $(this).attr('data-netred-id');
            var bespeak_html = '<form role="form" class="form-datas" method="post">' +
                '<input name="_token" value="'+token+'" type="hidden">' +
                '<input name="netred_id" value="'+netred_id+'" type="hidden"><div class="bespeak"><table width="100%">' +
                '<tr><td class="bespeak_left">联系电话</td><td class="bespeak_right"><input type="text" id="mobile" name="mobile" placeholder="请输入正确的手机号码"></td></tr>';
                bespeak_html += '<tr><td class="bespeak_left">推广产品</td><td class="bespeak_right">';
                for(var i in bespeak){
                    bespeak_html += '<span><input type="checkbox" name="catids[]" value="catid_'+i+'">'+bespeak[i]+'</span>';
                }
                bespeak_html += '</td></tr>' +
                '<tr><td class="bespeak_left">推广预算</td><td class="bespeak_right"><input type="text" id="money" name="money" placeholder="请输入您的推广预算"></td></tr>' +
                '</table></div> </form>';
            layer.closeAll();
            layer.open({
                type    : 1,
                skin    : 'layer-ext-member',
                closeBtn: 1,
                title   : '预约网红',
                area    : ['650px','450px'],
                btn     : ['确定', '取消'],
                content : bespeak_html,
                yes     : function(index){
                    var mobile = $('#mobile').val();
                    if(!mobile){
                        $('#mobile').focus();return false;
                    }
                    if(!isMobile(mobile)){
                        $('#mobile').val('');
                        $('#mobile').focus();return false;
                    }
                    var form = $('.form-datas');
                    var query = form.serialize();
                    $.post(target,query,function(datas){
                        if(datas.status == -1){
                            $('#mobile').focus();return false;
                        }else{
                            layer.closeAll();
                            layer.open({
                                type    : 1,
                                skin    : 'layer-ext-member',
                                title   : '消息提醒',
                                area    : ['600px'],
                                closeBtn: 1,
                                btn     : ['确定', '取消'],
                                shade   : false,
                                content : datas.info,
                                time    : 3000,
                            });
                        }
                    });
                }
            });
            return false;
        })


        $('body').on('click','.login_b',function(){
            var netred_id = $(this).attr('data-netred-id');
            var bespeak_html = '<form role="form" class="form-datas" method="post">' +
                '<input name="_token" value="'+token+'" type="hidden">' +
                '<input name="netred_id" value="'+netred_id+'" type="hidden"><div class="bespeak"><table width="100%">';
            bespeak_html += '<tr><td class="bespeak_left">推广产品</td><td class="bespeak_right">';
            for(var i in bespeak){
                bespeak_html += '<span><input type="checkbox" name="catids[]" value="catid_'+i+'">'+bespeak[i]+'</span>';
            }
            bespeak_html += '</td></tr>' +
                '<tr><td class="bespeak_left">推广预算</td><td class="bespeak_right"><input type="text" id="money" name="money" placeholder="请输入您的推广预算"></td></tr>' +
                '</table></div> </form>';
            layer.closeAll();
            layer.open({
                type    : 1,
                skin    : 'layer-ext-member',
                closeBtn: 1,
                title   : '预约网红',
                area    : ['650px','450px'],
                btn     : ['确定', '取消'],
                content : bespeak_html,
                yes     : function(index){
                    var form = $('.form-datas');
                    var query = form.serialize();
                    $.post(target,query,function(datas){
                        if(datas.status == -1){
                            layer.msg(datas.info, {icon: 5});return false;
                        }else{
                            layer.closeAll();
                            layer.open({
                                type    : 1,
                                skin    : 'layer-ext-member',
                                title   : '消息提醒',
                                area    : ['600px'],
                                closeBtn: 1,
                                btn     : ['确定', '取消'],
                                shade   : false,
                                content : datas.info,
                                time    : 3000,
                            });
                        }
                    });
                }
            });
            return false;
        })
    });
</script>
@endsection
@section('body')
@include('home.layouts.head')
<div class="whtj_topBg"></div>
<div class="hui">
    <div class="juzhongxia2">
        <div class="xie paddTop_30">
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
                                <a @if($params['catid'] == $child['id']) style="font-weight: 700;font-size: 14px" @endif href="{{ route('home.rednet.index').'?catid='.$child['id'] }}">{{ $child['name'] }}</a>
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
                @foreach($platforms as $key=>$platform_val)
                <li><a @if($params['platform'] == $key) style="font-weight: 700;font-size: 14px" @endif href="{{ route('home.rednet.index').'?platform='.$key }}">{{ $platform_val }}</a></li>
                @endforeach
            </ul>
            <div class="qingchu"></div>
        </div>
        <div class="liang">
            <ul>
                <li>粉丝量级：</li>
                @foreach($fans as $key=>$fan_val)
                    <li><a @if($params['fan'] == $key) style="font-weight: 700;font-size: 14px" @endif href="{{ route('home.rednet.index').'?fan='.$key }}">{{ $fan_val }}</a></li>
                @endforeach
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
                            @if(auth()->guard()->check())
                                <a href="javascript:void(0)" @if(auth()->user()->type == 2) class="login_b" data-netred-id="{{ $data['id'] }}" @endif>
                                    <img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69"; height="28"/>
                                </a>
                            @else
                                <a href="javascript:void(0)" class="unlogin_b" data-netred-id="{{ $data['id'] }}">
                                    <img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69"; height="28"/>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td align="center">参考报价</td>
                                <td width="36" rowspan="2">
                                    <img src="{{ get_platform_filed($data['platform_id'],'icon') }}" width="36"; height="36"/>
                                </td>
                            </tr>
                            <tr align="center">
                                <td>{{ $data['fans'] }}</td>
                                <td>{{ $data['average_num'] }}</td>
                                <td>{{ $data['money'] }}元</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
            <div class="qingchu"></div>
        </div>

        <div class="pagging">
            {!! $lists->appends($params)->render() !!}
        </div>
    </div>
</div>
@endsection
