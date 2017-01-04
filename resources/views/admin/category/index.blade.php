@extends('admin.layouts.base')
@section('style')
    <style type="text/css">
        .tree {
            /*min-height:20px;*/
            padding:19px;
            /*margin-bottom:20px;*/
            /*background-color:#fbfbfb;*/
            /*border:1px solid #999;*/
            /*-webkit-border-radius:4px;*/
            /*-moz-border-radius:4px;*/
            /*border-radius:4px;*/
            /*-webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);*/
            /*-moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);*/
            /*box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)*/
        }
        .tree li {

            list-style-type:none;
            margin:0;
            padding:10px 0px 0px 5px;
            position:relative
        }
        .tree li::before, .tree li::after {
            content:'';
            left:14px;
            position:absolute;
            right:auto
        }
        .tree li::before {
            border-left:1px solid #999;
            bottom:50px;
            height:100%;
            top:0;
            width:1px
        }
        .tree li::after {
            border-top:1px solid #999;
            height:20px;
            top:25px;
            width:25px
        }
        .tree li span {
            -moz-border-radius:5px;
            -webkit-border-radius:5px;
            border:1px solid #999;
            border-radius:5px;
            display:inline-block;
            padding:3px 8px;
            text-decoration:none
        }
        .tree li.parent_li>span {
            cursor:pointer
        }
        .tree>ul>li::before, .tree>ul>li::after {
            border:0
        }
        .tree li:last-child::before {
            height:25px
        }
        .tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
            background:#eee;
            border:1px solid #94a0b4;
            color:#000
        }
    </style>
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route($model.'.category.index') }}");
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
                }
                e.stopPropagation();
            });
        })
    </script>
@stop
@section('body')
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    分类管理
                </header>
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a href="javascript:void(0)" url="{{ route($model.'.category.create') }}" class="btn btn-primary ajax-update">
                                新增 <i class="fa icon-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="tree " style="border-top: 1px solid #ddd;">
                        <ul>
                            @foreach($lists as $item)
                                <li>
                                    <span><i class="icon-minus-sign"></i> {{ $item['name'] }}</span>
                                    <div style="float: right;padding-right: 40%">
                                        <a class="btn btn-primary btn-xs ajax-update" href="javascript:void(0)" url="{{ route($model.'.category.edit',[$item['id']]) }}"><i class="icon-pencil"></i> 修改</a>
                                        <a class="btn btn-danger btn-xs ajax-confirm destroy" href="javascript:void(0)" url="{{ route($model.'.category.destroy',[$item['id']]) }}"><i class="icon-trash "></i> 删除</a>
                                    </div>
                                    @if(isset($item['_child']))
                                        <ul>
                                            @foreach($item['_child'] as $i)
                                                <li>
                                                    <span style="margin-left: 34px"><i class="icon-minus-sign"></i> {{ $i['name'] }}</span>
                                                    <div style="float: right;padding-right: 40.1%">
                                                        <a class="btn btn-primary btn-xs ajax-update" href="javascript:void(0)" url="{{ route($model.'.category.edit',[$i['id']]) }}"><i class="icon-pencil"></i> 修改</a>
                                                        <a class="btn btn-danger btn-xs ajax-confirm destroy" href="javascript:void(0)" url="{{ route($model.'.category.destroy',[$i['id']]) }}"><i class="icon-trash "></i> 删除</a>
                                                    </div>
                                                    @if(isset($i['_child']))
                                                        <ul>
                                                            @foreach($i['_child'] as $v)
                                                                <li style="margin-left: 34px">
                                                                    <span style="margin-left: 34px"><i class="icon-minus-sign"></i> {{ $v['name'] }}</span>
                                                                    <div style="float: right;padding-right: 41.1%">
                                                                        <a class="btn btn-primary btn-xs ajax-update" href="javascript:void(0)" url="{{ route($model.'.category.edit',[$v['id']]) }}"><i class="icon-pencil"></i> 修改</a>
                                                                        <a class="btn btn-danger btn-xs ajax-confirm destroy" href="javascript:void(0)" url="{{ route($model.'.category.destroy',[$v['id']]) }}"><i class="icon-trash "></i> 删除</a>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- page end-->
@stop