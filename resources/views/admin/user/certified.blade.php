@extends('admin.layouts.base')
@section('styles')
@stop
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.certified.index') }}");
            $('.vcard_image').click(function(){
                var path = $(this).attr('src');
                layer.open({
                    type: 1,
                    title: false,
                    closeBtn: 0,
                    area: '516px',
                    skin: 'layui-layer-nobg', //没有背景色
                    shadeClose: true,
                    content:'<img src="'+path+'">'
                });
            });
        })
    </script>
@stop
@section('body')
    <section class="panel">
        <header class="panel-heading">
            认证资料审核
        </header>
        <div class="panel-body">
            <div class="adv-table editable-table ">
                {{--<div class="clearfix">--}}
                {{--<div class="btn-group">--}}
                {{--<a href="{{ route('admin.config.create') }}" class="btn btn-primary">--}}
                {{--新增 <i class="fa icon-plus"></i>--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                {{--<form method="get" action="{{ route('admin.config.index') }}" class="cmxform form-horizontal">--}}
                {{--<div class="col-lg-3 search_button">--}}
                {{--<button class="btn btn-primary" type="submit"><i class="fa  icon-zoom-in"></i>搜索</button>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 search_filter">--}}
                {{--配置名称：<input type="text" name="name" aria-controls="sample_1" value="{{ $params['name'] }}" class="form-controls">--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 search_filter">--}}
                {{--配置标题：<input type="text" name="title" aria-controls="sample_1" value="{{ $params['title'] }}" class="form-controls">--}}
                {{--</div>--}}
                {{--</form>--}}
                {{--</div>--}}
                <div class="space15"></div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                    <tr>
                        <th style="width:8px;">
                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                        <th class="hidden-phone">用户</th>
                        <th class="hidden-phone">真实姓名</th>
                        <th class="hidden-phone">身份证号码</th>
                        <th class="hidden-phone">身份证正面</th>
                        <th class="hidden-phone">身份证反面</th>
                        <th class="hidden-phone">提交时间</th>
                        <th class="hidden-phone">状态</th>
                        <th class="hidden-phone">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lists as $data)
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="{{ $data->id }}"/></td>
                            <td>{{ get_user($data->userid) }}</td>
                            <td>{{ $data->truename }}</td>
                            <td>{{ $data->vcard }}</td>
                            <td class="hidden-phone">
                                <img src="{{ $data->vcard_face }}" class="vcard_image" alt="点击预览" title="点击预览" width="auto" height="30" style="cursor: pointer">
                            </td>
                            <td class="hidden-phone">
                                <img src="{{ $data->vcard_con }}" class="vcard_image" alt="点击预览" title="点击预览" width="auto"  height="30" style="cursor: pointer">
                            </td>
                            <td class="center hidden-phone">{{ $data->created_at->format('Y-m-d') }}</td>
                            <td class="center hidden-phone">{!! $data->status_text !!}</td>
                            <td class="hidden-phone">
                                @if($data['status'] == 2)
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.certified.agreement',[$data->userid]) }}"><i class="icon-pencil"></i> 通过</a>
                                    <a class="btn btn-danger btn-xs" href="{{ route('admin.certified.refuse',[$data->userid]) }}"><i class="icon-trash"></i> 拒绝</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dataTables_info">共 {{ $lists->total() }} 条记录</div>
                    </div>
                    <div class="col-lg-6">
                        <div style="float: right">
                            {!! $lists->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop