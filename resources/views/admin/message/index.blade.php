@extends('admin.layouts.base')
@section('styles')
@stop
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.message.index') }}");
        })
    </script>
@stop
@section('body')
    <section class="panel">
        <header class="panel-heading">
            系统消息
        </header>
        <div class="panel-body">
            <div class="adv-table editable-table ">
                <div class="clearfix">
                    <div class="btn-group">
                        <a href="javascript:void(0)" url="{{ route('admin.message.add') }}" class="btn btn-primary ajax-update">
                            发送 <i class="icon-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="space15"></div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                    <tr>
                        <th style="width:8px;">
                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                        <th>收件人</th>
                        <th>标题</th>
                        <th class="hidden-phone">内容</th>
                        <th class="hidden-phone">分类</th>
                        <th class="hidden-phone">发送时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lists as $data)
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="{{ $data->id }}"/></td>
                            <td>{{ get_user($data->userid) }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{!! $data->content  !!}</td>
                            <td>@if($data['category'] == 1)系统消息@elseif($data['group'] == 2)系统公告@endif</td>
                            <td class="hidden-phone">{{ $data->created_at->format('Y-m-d') }}</td>
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