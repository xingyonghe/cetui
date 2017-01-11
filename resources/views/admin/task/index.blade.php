@extends('admin.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.task.index') }}");
        })
    </script>
@endsection
@section('body')
    <section class="panel">
        <header class="panel-heading">
            推广活动
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
                    <form method="get" action="{{ route('admin.task.index') }}" class="cmxform form-horizontal">
                        <div class="col-lg-3 search_button">
                            <button class="btn btn-primary" type="submit"><i class="fa  icon-zoom-in"></i>搜索</button>
                        </div>
                        <div class="col-lg-3 search_filter">
                            活动名称：<input type="text" name="title" aria-controls="sample_1" value="{{ $params['title'] }}" class="form-controls">
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                    <tr>
                        <th style="width:8px;">
                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                        <th>ID</th>
                        <th class="hidden-phone">活动名称</th>
                        <th class="hidden-phone">投放类型</th>
                        <th class="hidden-phone">截止时间</th>
                        <th class="hidden-phone">投放时间</th>
                        <th class="hidden-phone">预算</th>
                        <th class="hidden-phone">需求人数</th>
                        <th class="hidden-phone">发布日期</th>
                        <th class="hidden-phone">状态</th>
                        <th class="hidden-phone">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lists as $data)
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="{{ $data->id }}"/></td>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->title }}</td>
                            <td>@if($data->type == 1)直播@else短视频@endif</td>
                            <td class="hidden-phone">{{ $data->dead_time->format('Y-m-d') }}</td>
                            <td class="hidden-phone">{{ $data->start_time->format('Y-m-d') }} -- {{ $data->end_time->format('Y-m-d') }}</td>
                            <td>{{ $data->money }}元</td>
                            <td>{{ $data->num }}人</td>
                            <td class="hidden-phone">{{ $data->created_at->format('Y-m-d') }}</td>
                            <td class="hidden-phone">{!! $data->status_text !!}</td>
                            <td class="hidden-phone">
                                <a class="btn btn-primary btn-xs" href="{{ route('admin.task.show',[$data->id]) }}">
                                    <i class="icon-check-sign"></i> 详情
                                </a>
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