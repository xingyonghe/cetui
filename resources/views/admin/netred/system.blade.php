@extends('admin.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.netred.system') }}");
        })
    </script>
@endsection
@section('body')
    <section class="panel">
        <header class="panel-heading">
            系统网红
        </header>
        <div class="panel-body">
            <div class="adv-table editable-table ">
                <div class="clearfix">
                    <div class="btn-group">
                        <a href="javascript:void(0)" url="{{ route('admin.netred.create') }}" class="btn btn-primary ajax-update">
                            新增 <i class="icon-plus"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a href="javascript:void(0)" url="{{ route('admin.netred.import') }}" class="btn btn-primary">
                            导入 <i class="icon-signin"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <form method="post" action="{{ route('admin.netred.system') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        <div class="col-lg-3 search_button">
                            <button class="btn btn-primary" type="submit"><i class="fa  icon-zoom-in"></i>搜索</button>
                        </div>
                        <div class="col-lg-3 search_filter">
                            艺名：<input type="text" name="stage_name" aria-controls="sample_1" value="{{ $params['stage_name'] }}" class="form-controls">
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
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
                            <td class="hidden-phone">{{ get_platform_filed($data['platform']) }}</td>
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
                    <div class="col-lg-6">
                        <div class="dataTables_info" id="editable-sample_info">共 {{ $lists->total() }} 条记录</div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dataTables_paginate paging_bootstrap pagination">
                            {!! $lists->appends($params)->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection