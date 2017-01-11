@extends('admin.layouts.base')
@section('styles')
@stop
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.config.index') }}");
        })
    </script>
@stop
@section('body')
    <section class="panel">
        <header class="panel-heading">
            网站配置
        </header>
        <div class="panel-body">
            <div class="adv-table editable-table ">
                <div class="clearfix">
                    <div class="btn-group">
                        <a href="{{ route('admin.config.create') }}" class="btn btn-primary">
                            新增 <i class="fa icon-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <form method="get" action="{{ route('admin.config.index') }}" class="cmxform form-horizontal">
                        <div class="col-lg-3 search_button">
                            <button class="btn btn-primary" type="submit"><i class="fa  icon-zoom-in"></i>搜索</button>
                        </div>
                        <div class="col-lg-3 search_filter">
                            配置名称：<input type="text" name="name" aria-controls="sample_1" value="{{ $params['name'] }}" class="form-controls">
                        </div>
                        <div class="col-lg-3 search_filter">
                            配置标题：<input type="text" name="title" aria-controls="sample_1" value="{{ $params['title'] }}" class="form-controls">
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                    <tr>
                        <th style="width:8px;">
                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                        <th>ID</th>
                        <th class="hidden-phone">名称</th>
                        <th class="hidden-phone">标题</th>
                        <th class="hidden-phone">分组</th>
                        <th class="hidden-phone">模块</th>
                        <th class="hidden-phone">类型</th>
                        <th class="hidden-phone">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lists as $data)
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="{{ $data->id }}"/></td>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td class="hidden-phone">{{ $data->title }}</td>
                            <td class="hidden-phone">{{ $data->group_text }}</td>
                            <td class="hidden-phone">{{ $data->module_text }}</td>
                            <td class="center hidden-phone">{{ $data->type_text }}</td>
                            <td class="hidden-phone">
                                <a class="btn btn-primary btn-xs" href="{{ route('admin.config.edit',[$data->id]) }}"><i class="icon-pencil"></i> 修改</a>
                                <a class="btn btn-danger btn-xs ajax-confirm destroy" href="{{ route('admin.config.destroy',[$data->id]) }}"><i class="icon-trash "></i> 删除</a>
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
                            {!! $lists->appends($params)->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop