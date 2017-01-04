@extends('admin.layouts.base')
@section('style')
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.star.recycle') }}");
        })
    </script>
@endsection
@section('body')
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    资源管理
                </header>
                <div class="panel-body">
                    <div class="clearfix">
                        {{--<div class="btn-group">--}}
                            {{--<a href="javascript:void(0)" url="{{ route('admin.star.create') }}" class="btn btn-primary ajax-update">--}}
                                {{--新增 <i class="fa icon-plus"></i>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        <div class="btn-group pull-right">
                            {!! Form::open(['url' => route('admin.star.index'),'method'=>'get']) !!}
                            <div class="dataTables_filter">
                                <button class="btn btn-primary" type="submit"><i class="fa  icon-zoom-in"></i>搜索</button>
                            </div>
                            <div class="dataTables_filter">
                                艺名：<input type="text" name="title" aria-controls="sample_1" value="{{ $params['stage_name'] }}" class="form-controls">
                            </div>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
                <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <table class="table table-striped border-top" id="sample_1">
                        <thead>
                        <tr>
                            <th style="width:8px;">
                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                            <th>ID</th>
                            <th class="hidden-phone">头像</th>
                            <th class="hidden-phone">艺名</th>
                            <th class="hidden-phone">用户</th>
                            <th class="hidden-phone">性别</th>
                            <th class="hidden-phone">分类</th>
                            <th class="hidden-phone">平台</th>
                            <th class="hidden-phone">添加时间</th>
                            <th class="hidden-phone">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $data)
                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="{{ $data->id }}"/></td>
                                <td>{{ $data->id }}</td>
                                <td><img src="{{ $data->avatar }}" width="auto" height="20"></td>
                                <td>{{ $data->stage_name }}</td>
                                <td>{{ $data->userid }}</td>
                                <td>@if($data->sex == 1)男@else女@endif</td>
                                <td>@if($data->type == 1)直播@else短视频@endif</td>
                                <td class="hidden-phone">{{ $data->platform }}</td>
                                <td class="hidden-phone">{{ $data->created_at->format('Y-m-d') }}</td>
                                <td class="hidden-phone">
                                    <a class="btn btn-primary btn-xs ajax-update" href="javascript:void(0)" url="{{ route('admin.star.edit',[$data->id]) }}"><i class="icon-pencil"></i> 修改</a>
                                    <a class="btn btn-danger btn-xs ajax-confirm destroy" href="{{ route('admin.star.destroy',[$data->id]) }}"><i class="icon-trash "></i> 删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="sample_1_info">共 {{ $lists->total() }} 条记录</div>
                        </div>
                        <div class="col-sm-6" style="text-align: right;position: relative;top:-25px;height: 39px">
                            {!! $lists->appends($params)->render() !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- page end-->
@endsection