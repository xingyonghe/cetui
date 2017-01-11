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
                <img src="{{ $info['logo']}}" width="auto" height="100"/>
                <h3>{{ $info['title'] }}</h3>
            </div>
            <div class="inbox-body">
                <table class="table table-inbox table-hover">
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 广告主：</td>
                        <td class="view-message">{{ get_user($info['userid']) }}</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 广告类型：</td>
                        <td class="view-message">{{ $shape_arr[$info['shape']] }}</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 投放类型：</td>
                        <td class="view-message">@if($info['type'] == 1)直播@else短视频@endif</td>
                        <td class="inbox-small-cells"></td>
                        <td class="view-message"></td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 推广预算：</td>
                        <td class="view-message">{{ $info['money'] }}元</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 投放周期：</td>
                        <td class="view-message">{{ $info['start_time']->format('Y-m-d') }} -- {{ $info['end_time']->format('Y-m-d') }}</td>
                        <td class="inbox-small-cells"><i class="icon-star"></i> 发布时间：</td>
                        <td class="view-message">{{ $info['created_at']->format('Y-m-d H:i') }}</td>
                        <td class="inbox-small-cells"></td>
                        <td class="view-message"></td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 网红要求：</td>
                        <td class="view-message" colspan="7">{{ $info['demand'] }}</td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="icon-star"></i> 活动要求：</td>
                        <td class="view-message" colspan="7">{{ $info['notes'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    @if($info['status'] == 3)
                        <button class="btn btn-success verify" data-ids="{{ $info['id'] }}" url="{{ route('admin.task.verify') }}"  style="margin:0px 25px">通过</button>
                        <button class="btn btn-danger refuse" data-ids="{{ $info['id'] }}" url="{{ route('admin.task.refuse') }}"  style="margin:0px 25px">拒绝</button>
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
            @if($info['status'] == 4 || $info['status'] == 3)
            highlight_subnav("{{ route('admin.task.check') }}");
            @elseif($info['status'] == -1)
            highlight_subnav("{{ route('admin.task.recycle') }}");
            @else
            highlight_subnav("{{ route('admin.task.index') }}");
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