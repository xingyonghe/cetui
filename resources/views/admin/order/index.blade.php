@extends('admin.layouts.base')
@section('styles')
@stop
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.order.index') }}");
        })
    </script>
@stop
@section('body')
    <section class="panel">
        <header class="panel-heading">
            订单管理
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
                    <form method="get" action="{{ route('admin.order.index') }}" class="cmxform form-horizontal">
                        <div class="col-lg-3 search_button">
                            <button class="btn btn-primary" type="submit"><i class="fa  icon-zoom-in"></i>搜索</button>
                        </div>
                        {{--<div class="col-lg-3 search_filter">--}}
                            {{--配置名称：<input type="text" name="name" aria-controls="sample_1" value="{{ $params['name'] }}" class="form-controls">--}}
                        {{--</div>--}}
                        <div class="col-lg-3 search_filter">
                            订单号：<input type="text" name="order_sn" aria-controls="sample_1" value="{{ $params['order_sn'] }}" class="form-controls">
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                    <tr>
                        <th style="width:8px;">
                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                        <th>ID</th>
                        <th class="hidden-phone">广告主</th>
                        <th class="hidden-phone">会员</th>
                        <th class="hidden-phone">网红艺名</th>
                        <th class="hidden-phone">订单金额</th>
                        <th class="hidden-phone">订单日期</th>
                        <th class="hidden-phone">支付日期</th>
                        <th class="hidden-phone">订单状态</th>
                        <th class="hidden-phone">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lists as $data)
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="{{ $data->id }}"/></td>
                            <td>{{ $data->order_sn }}</td>
                            <td>{{ get_user($data->buy_user_id) }}</td>
                            <td class="hidden-phone">{{ get_user($data->sell_user_id) }}</td>
                            <td class="hidden-phone">{{ get_netred($data->shop_id) }}</td>
                            <td class="hidden-phone">{{ $data->money }}</td>
                            <td class="hidden-phone">{{ $data->created_at->format('Y-m-d') }}</td>
                            <td class="hidden-phone">@if($data->pay_at) {{ $data->pay_at->format('Y-m-d') }}@endif</td>
                            <td class="center hidden-phone">{!! $data->status_text !!}</td>
                            <td class="hidden-phone">
                                @if($data->status == 4)
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.order.agreement',[$data->order_sn]) }}"><i class="icon-pencil"></i> 完成</a>
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.order.failed',[$data->order_sn]) }}"><i class="icon-pencil"></i> 失败</a>
                                @endif
                                <a class="btn btn-danger btn-xs" href="{{ route('admin.order.show',[$data->order_sn]) }}"><i class="icon-trash "></i> 详情</a>
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