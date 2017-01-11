@extends('ads.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){
            //筛选
            $('.paddLR_20 span').click(function(){
                var data_id = $(this).attr('data-id');
                var _first = $(this).siblings('span:first');
                var _parent = $(this).parent('.paddLR_20');
                if(_parent.hasClass('multiselect')){
                    if(data_id == 0){
                        $(this).siblings('span').removeClass('on');
                        _parent.find('input:gt(0)').each(function(){
                            if($(this).is(':checked')){
                                $(this).prop('checked',false);
                            }
                        })
                        $(this).addClass('on').find('input').prop('checked',true);
                    }else{
                        if($(this).hasClass('on')){
                            $(this).removeClass('on').find('input').prop('checked',false);
                            //不等于0的都没选中，不限选中
                            var _check = 0;
                            $(this).siblings('span').each(function(){
                                if($(this).hasClass('on')){
                                    _check = 0;return false;
                                }else{
                                    _check = 1;
                                }
                            })
                            if(_check){
                                _first.addClass('on').find('input').prop('checked',true);
                            }
                        }else{
                            if(_first.hasClass('on')){
                                _first.removeClass('on').find('input').prop('checked',false);
                            }
                            $(this).addClass('on').find('input').prop('checked',true);
                        }
                    }
                }else{
                    if(data_id == 0){
                        $(this).siblings('span').removeClass('on');
                        _parent.find('input:gt(0)').each(function(){
                            if($(this).is(':checked')){
                                $(this).prop('checked',false);
                            }
                        })
                        $(this).addClass('on').find('input').prop('checked',true);
                    }else{
                        if($(this).hasClass('on')){
                            $(this).removeClass('on').find('input').prop('checked',false);
                            if(!_first.hasClass('on')){
                                _first.addClass('on').find('input').prop('checked',true);
                            }
                        }else{
                            $(this).siblings('span').removeClass('on');
                            $(this).addClass('on').find('input').prop('checked',true);
                        }
                    }
                }
                $('#video-form').submit();
            });


        })
    </script>
@endsection
@section('body')
    <div class="container">
        <div class="width_1140">
            <div class="c_route">
                当前位置：
                <a href="{{ route('ads.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('ads.netred.video') }}"><span class="on">短视频资源列表</span></a>
            </div>
            <div class="c_box">
                <div class="c_zylb_box1">
                    <form id="video-form"  action="{{ route('ads.netred.video') }}" metho="get">
                    <p class="c_zylb_p">
                        <b>入驻平台：</b>
                        <span class="paddLR_20 multiselect">
                            @php($params['platform'] = explode(',',$params['platform']))
                            @foreach($platforms as $key=>$platform)
                                <span data-id="{{ $key }}" @if(in_array($key,$params['platform'])) class="platform on" @else class="platform" @endif>
                                    {{ $platform }}
                                    <input type="checkbox" @if($key > 0) name="platform[]" @endif value="{{ $key }}" @if(in_array($key,$params['platform'])) checked="checked" @endif>
                                </span>
                            @endforeach
                        </span>
                    </p>

                    <p class="c_zylb_p">
                        <b>风格类型：</b>
                        <span class="paddLR_20 multiselect">
                            @php($params['style'] = explode(',',$params['style']))
                            @foreach($styles as $key=>$style)
                                <span data-id="{{ $key }}" @if(in_array($key,$params['style'])) class="style on" @else class="style" @endif>
                                    {{ $style }}
                                    <input type="checkbox" @if($key > 0) name="style[]" @endif value="{{ $key }}" @if(in_array($key,$params['style'])) checked="checked" @endif>
                                </span>
                            @endforeach
                        </span>
                    </p>

                    <p class="c_zylb_p">
                        <b>参考报价：</b>
                        <span class="paddLR_20">
                            @foreach($moneys as $key=>$money)
                                <span data-id="{{ $key }}" @if($key == $params['money']) class="money on" @else class="money" @endif>
                                    {{ $money }}
                                    <input type="radio" @if($key > 0) name="money" @endif value="{{ $key }}" @if($key == $params['money']) checked="checked" @endif>
                                </span>
                            @endforeach
                        </span>
                    </p>

                    <p class="c_zylb_p">
                        <b>粉丝量级：</b>
                        <span class="paddLR_20">
                             @foreach($fans as $key=>$fan)
                                <span data-id="{{ $key }}" @if($key == $params['fan']) class="fan on" @else class="fan" @endif>
                                    {{ $fan }}
                                    <input type="radio" @if($key > 0) name="fan" @endif value="{{ $key }}" @if($key == $params['fan']) checked="checked" @endif>
                                </span>
                            @endforeach
                        </span>
                    </p>

                    <p class="c_zylb_p">
                        <b>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;域：</b>
                        <span class="paddLR_20 multiselect">
                            @php($params['region'] = explode(',',$params['region']))
                            @foreach($regions as $key=>$region)
                                <span data-id="{{ $key }}" @if(in_array($key,$params['region'])) class="region on" @else class="region" @endif>
                                    {{ $region }}
                                    <input type="checkbox" @if($key > 0) name="region[]" @endif value="{{ $key }}" @if(in_array($key,$params['region'])) checked="checked" @endif>
                                </span>
                            @endforeach
                        </span>

                    </p>
                    </form>
                </div>
            </div>
            <p class="c_mark">共计{{ $lists->total() }}个资源</p>
            <div class="c_box">
                <div class="c_zylb_box3">
                    <table cellpadding="0" cellspacing="0">
                        <thead class="bgColor_f9f9f9">
                        <th width="70">选择</th>
                        <th>艺人</th>
                        <th>适合ta的广告形式</th>
                        <th>风格类型</th>
                        <th>平台</th>
                        <th>平台ID</th>
                        <th>粉丝数</th>
                        <th>参考报价</th>
                        <th>加入购物车</th>
                        </thead>
                        <tbody>
                        @if($lists->total())
                            @foreach($lists as $key=>$item)
                                <tr>
                                    <td><i class="checkbox_style" onclick="checkboxClick(this);"></i></td>
                                    <td>
                                        <small class="face"><img src="{{ $item['avatar'] }}" width="70" height="70"></small>
                                        <em>{{ $item['stage_name'] }}</em>
                                    </td>
                                    <td>
                                        @foreach($adforms as $key=>$adform)
                                            @if(isset($item['form']) && (in_array('form_'.$key,$item['form'])))
                                                <p><b>{{ $adform }}</b></p>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="tdStyle" style="text-align: left;">
                                        @foreach($styles as $key=>$style)
                                            @if(isset($item['style']) && (in_array('style_'.$key,$item['style'])))
                                                <b>{{ $style }}</b>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <img src="{{ get_platform_filed($item['platform_id'],'icon') }}" width="auto" height="30">
                                    </td>
                                    <td>{{ $item['form_id'] }}</td>
                                    <td>{{ $item['fans'] }}</td>
                                    <td width="130">
                                        <p><label class="ckbj">{{ $item['money'] }}元</label></p>
                                    </td>
                                    <td>
                                        <label class="gwc on"><a class="ajax-bespeak" href="javascript:void(0)" url="{{ route('ads.netred.bespeak',[$item['id']]) }}">立即预约</a></label>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">暂无资源</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagging">
                {!! $lists->appends($params)->render() !!}
            </div>
        </div>
    </div>
@endsection
