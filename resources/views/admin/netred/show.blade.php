@extends('admin.layouts.base')
@section('styles')
    <style type="text/css">
        .inbox-small-cells{
            width: 120px;
        }
        .view-message{
            width: 200px;
        }
    </style>
@endsection
@section('body')
    <div class="mail-box">
        <aside class="lg-side">
            <div class="inbox-head">
                <img src="{{ $info['avatar']}}" width="auto" height="100"/>
                <h3>{{ $info['stage_name'] }}</h3>
            </div>
            <div class="inbox-body">
                <table class="table table-inbox table-hover">
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 所属平台：</td>
                        <td class="view-message">{{ get_platform_filed($info['platform_id']) }}</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 性别：</td>
                        <td class="view-message">@if($info['sex'] == 1) 男 @else 女 @endif</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 类别：</td>
                        <td class="view-message">@if($info['type'] == 1) 直播 @else 短视频 @endif</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 粉丝量：</td>
                        <td class="view-message">{{ $info['fans'] }}</td>
                    </tr>

                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 地区：</td>
                        <td class="view-message">{{ $info['area'] }}</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 平均观看人数：</td>
                        <td class="view-message">{{ $info['average_num'] }}</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 最高观看人数：</td>
                        <td class="view-message">{{ $info['max_num'] }}</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 平台ID：</td>
                        <td class="view-message">{{ $info['form_id'] }}</td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 参考报价：</td>
                        <td class="view-message">{{ $info['money'] }}元</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 价格有效期：</td>
                        <td class="view-message">{{ $info['term_time']->format('Y-m-d') }}</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 发布时间：</td>
                        <td class="view-message">{{ $info['created_at']->format('Y-m-d H:i') }}</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 最近修改时间：</td>
                        <td class="view-message">{{ $info['updated_at']->format('Y-m-d H:i') }}</td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 风格：</td>
                        <td class="view-message" colspan="7">
                            @foreach($styles as $key=>$style)
                                @if(isset($info['style']) && (in_array('style_'.$key,$info['style'])))
                                    <span class="label label-info">{{ $style }}</span>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 广告类型：</td>
                        <td class="view-message" colspan="7">
                            @foreach($categorys as $category)
                                <span class="label label-warning">{{ $category['name'] }}:</span>
                                @if(isset($category['_child']))
                                    @foreach($category['_child'] as $key=>$cate)
                                        @if(isset($info['catids']) && (in_array('catid_'.$cate['id'],$info['catids'])))
                                            <span class="label label-info">{{ $cate['name'] }}</span>
                                        @endif
                                    @endforeach
                                @endif
                                <br/><br/>
                            @endforeach
                        </td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 广告形式：</td>
                        <td class="view-message" colspan="7">
                            @foreach($adforms as $key=>$adform)
                                @if(isset($info['form']) && (in_array('form_'.$key,$info['form'])))
                                    <span class="label label-info">{{ $adform }}</span>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 接单备注：</td>
                        <td class="view-message" colspan="7">{{ $info['note'] }}</td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 资源优惠：</td>
                        <td class="view-message" colspan="7">{{ $info['advantage'] }}</td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 案例介绍：</td>
                        <td class="view-message" colspan="7">{{ $info['introduce'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    @if($info['status'] == 2)
                        <button class="btn btn-success verify" data-ids="{{ $info['id'] }}" url="{{ route('admin.netred.verify') }}"  style="margin:0px 25px">通过</button>
                        <button class="btn btn-danger refuse" data-ids="{{ $info['id'] }}" url="{{ route('admin.netred.refuse') }}"  style="margin:0px 25px">拒绝</button>
                    @endif
                    <button class="btn btn-default" type="button" onclick="javascript:history.back(-1);return false;">返回</button>
                </div>
            </div>
            <br/> <br/>
        </aside>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            @if($info['status'] == 2 || $info['status'] == 3)
            highlight_subnav("{{ route('admin.netred.check') }}");
            @endif
            @if($info['status'] == 1)
            highlight_subnav("{{ route('admin.netred.index') }}");
            @endif

            $('.btn').click(function(){
                var target = $(this).attr('url');
                var ids = $(this).attr('data-ids');
                //通过
                if($(this).hasClass('verify')){
                    var query = {'_token' : "{{ csrf_token() }}",'ids':ids};
                    $.post(target,query,function(datas){
                        if(datas.status == -1){
                            updateAlert(datas.info);
                        }else{
                            updateAlert(datas.info + ' 页面即将自动跳转~','alert-success',datas.url);
                        }
                    },'json');
                }
                //拒绝
                if($(this).hasClass('refuse')){
                    layer.open({
                        type    : 1,
                        skin    : 'layer-ext-admin',
                        closeBtn: 1,
                        title   : '拒绝理由',
                        area    : ['650px'],
                        btn     : ['确定', '取消'],
                        shade   : false,
                        content : '<div><div style="float: left;width: 50%"><textarea placeholder="请填写拒绝理由" class="form-control reason" name="reason" rows="10"></textarea></div>' +
                        '<div style="float: left;padding: 5px 10px;"> ' +
                        '<div class="checkboxes">' +
                        '<label class="label_check"> <input name="reason[]" value="理由1" type="checkbox" /> 理由1. </label> ' +
                        '<label class="label_check"> <input name="reason[]" value="理由2" type="checkbox" /> 理由2. </label> ' +
                        '<label class="label_check"> <input name="reason[]" value="理由3" type="checkbox" /> 理由3.</label> ' +
                        '</div></div></div>',
                        yes    :function(index){
                            var reason = $('.reason').val();
                            var reasons = [];
                            $.each($("input[name='reason[]']"), function() {
                                if($(this).is(':checked')){
                                    reasons.push($(this).val());
                                }
                            });
                            var query = {'_token' : "{{ csrf_token() }}",'ids':ids,'reason':reason,'reasons':reasons};
                            $.post(target,query,function(datas){
                                if(datas.status == -1){
                                    updateAlert(datas.info);
                                }else{
                                    updateAlert(datas.info + ' 页面即将自动跳转~','alert-success',datas.url);
                                }
                            },'json');
                        }
                    });
                }
            });



        })
    </script>
@stop