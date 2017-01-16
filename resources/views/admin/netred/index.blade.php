@extends('admin.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.netred.index') }}");
        })
    </script>
@endsection
@section('body')
    <section class="panel">
        <header class="panel-heading">
            会员网红
        </header>
        <div class="panel-body">
            <div class="adv-table editable-table ">
                {{--<div class="clearfix">--}}
                {{--<div class="btn-group">--}}
                {{--<a href="javascript:void(0)" url="{{ route('admin.netred.import') }}" class="btn btn-primary ajax-import">--}}
                {{--通过 <i class="icon-ok-sign"></i>--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--<div class="btn-group">--}}
                {{--<a href="javascript:void(0)" url="{{ route('admin.netred.import') }}" class="btn btn-primary ajax-import">--}}
                {{--拒绝 <i class="icon-exclamation-sign"></i>--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="row">
                    <form method="get" action="{{ route('admin.netred.index') }}" class="cmxform form-horizontal">
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
                        <th class="hidden-phone">用户</th>
                        <th class="hidden-phone">头像</th>
                        <th class="hidden-phone">艺名</th>
                        <th class="hidden-phone">性别</th>
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
                            <td>{{ get_user($data->userid) }}</td>
                            <td><img src="{{ $data->avatar }}" width="auto" height="20"></td>
                            <td>{{ $data->stage_name }}</td>
                            <th class="hidden-phone">@if($data->sex ==1) 男 @else 女 @endif</th>
                            <td class="hidden-phone">{{ get_platform_filed($data['platform_id']) }}</td>
                            <td class="hidden-phone">{{ $data->created_at->format('Y-m-d') }}</td>
                            <td class="hidden-phone">
                                <a class="btn btn-primary btn-xs" href="{{ route('admin.netred.show',[$data->id]) }}">
                                    <i class="icon-check-sign"></i> 详情
                                </a>
                                @if($data->status == 1)
                                    <a class="btn btn-primary btn-xs ajax-update" href="javascript:void(0)" url="{{ route('admin.netred.position',[$data->id]) }}">
                                        <i class="icon-check-sign"></i> 推荐
                                    </a>
                                @endif
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