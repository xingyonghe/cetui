@extends('admin.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.adform.index') }}");
        })
    </script>
@endsection
@section('body')
    <section class="panel">
        <header class="panel-heading">
            广告形式
        </header>
        <div class="panel-body">
            <div class="adv-table editable-table">
                <div class="clearfix">
                    <div class="btn-group">
                        <a href="javascript:void(0)" url="{{ route('admin.adform.create') }}" class="btn btn-primary ajax-update">
                            新增 <i class="fa icon-plus"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a href="javascript:void(0)" url="{{ route('admin.adform.sort') }}" class="btn btn-primary ajax-sort">
                            排序 <i class="fa icon-resize-vertical"></i>
                        </a>
                    </div>
                </div>
                <div class="space15"></div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                    <tr>
                        <th style="width:8px;">
                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                        <th>ID</th>
                        <th class="hidden-phone">名称</th>
                        <th class="hidden-phone">分类</th>
                        <th class="hidden-phone">说明</th>
                        <th class="hidden-phone">排序</th>
                        <th class="hidden-phone">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lists as $data)
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="{{ $data['id'] }}"/></td>
                            <td>{{ $data['id'] }}</td>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $category[$data['category']] }}</td>
                            <td class="hidden-phone">{{ $data['explain'] }}</td>
                            <td class="hidden-phone">{{ $data['sort'] }}</td>
                            <td class="hidden-phone">
                                <a class="btn btn-primary btn-xs ajax-update" href="javascript:void(0)" url="{{ route('admin.adform.edit',[$data['id']]) }}"><i class="icon-pencil"></i> 修改</a>
                                <a class="btn btn-danger btn-xs ajax-confirm destroy" href="{{ route('admin.adform.destroy',[$data['id']]) }}"><i class="icon-trash "></i> 删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection