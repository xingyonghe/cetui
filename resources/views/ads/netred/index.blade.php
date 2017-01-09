@extends('ads.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        function checkboxClick(that){
            if( $(that).hasClass("checked_on") ){
                $(that).removeClass("checked_on");
            }else{
                $(that).addClass("checked_on");
            }
        }
    </script>
@endsection
@section('body')
    <div class="container">
        <div class="width_1140">
            <div class="c_box">
                <div class="c_zylb_box1">
                    <p class="c_zylb_p">
                        <b>入驻平台：</b>
                        <label class="on">不限</label>
                        <label>快手</label>
                        <label>秒拍</label>
                        <label>微拍</label>
                        <label>爱拍</label>
                        <label>小咖秀</label>
                        <label>小影</label>
                        <label>其他</label>
                    </p>

                    <p class="c_zylb_p">
                        <b>风格类型：</b>
                        <label>不限</label>
                        <span class="spanWidth_70">
                            <span>明星/名人</span>
                            <span>段子手</span>
                            <span>娱乐搞笑</span>
                            <span>时尚搭配</span>
                            <span>美容美妆</span>
                            <span>游戏/动漫</span>
                            <span>影视/音乐</span>
                            <span>体育/健身</span>
                            <span>美食</span>
                            <span>户外/旅行</span>
                            <span>母婴/育儿</span>
                            <span>汽车</span>
                            <span>摄影</span>
                            <span>金融/理财</span>
                            <span>教育</span>
                            <span>其他</span>
                        </span>
                    </p>

                    <p class="c_zylb_p">
                        <b>参考报价：</b>
                        <label class="on">不限</label>
                        <span class="spanWidth_90">
                            <span class="on">5000以下</span>
                            <span>5000元--1万元</span>
                            <span>1万元--3万元</span>
                            <span>3万元--5万元</span>
                            <span>5万元--10万元</span>
                            <span>10万元以上</span>
                        </span>
                    </p>

                    <p class="c_zylb_p">
                        <b>粉丝量级：</b>
                        <label class="on">不限</label>
                        <span class="spanWidth_90">
                            <span>5000以下</span>
                            <span>5000--1万</span>
                            <span>1万--3万</span>
                            <span>3万--5万</span>
                            <span>5万--10万</span>
                            <span>10万以上</span>
                        </span>
                    </p>

                    <p class="c_zylb_p">
                        <b>地&nbsp;&nbsp;域：</b>
                        <label class="on">不限</label>
                    </p>
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
                                        <small class="face"></small>
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
                                        <p><label class="ckbj">{{ $item['money'] }}万</label></p>
                                    </td>
                                    <td>
                                        <label class="gwc on">加入购物车</label>
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
        </div>
    </div>
@endsection
