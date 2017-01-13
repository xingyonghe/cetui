@extends('admin.layouts.base')
@section('styles')
    <style type="text/css">
        .b-child{
            margin-left: 3px;
            position: relative;
            bottom: 2px;
        }
        .b-title{
            font-size: 14px;
            font-weight: 700;
        }
    </style>
@stop
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.group.index') }}");
            //全选节点
            $('.rules_all').on('change',function(){
                $(this).closest('table').find('tbody').find('input').prop('checked',this.checked);
            });
            $('.rules_row').on('change',function(){
                $(this).closest('.check_row').find('.child_row').find('input').prop('checked',this.checked);
            });
            //设置选中
            var rules = [{!! $thisRules !!}];
            $('.auth_rules').each(function(){
                if( $.inArray( this.value,rules[0] )>-1 ){
                    $(this).prop('checked',true);
                }
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
                    用户组授权
                </header>
                <form method="post" action="{{ route('admin.group.write') }}" class="cmxform form-horizontal form-datas">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $groupId }}">
                    <div class="tab-pane in">
                        @foreach($nodeList as $node)
                            <table class="table table-inbox table-hover">
                                <tr class="unread">
                                    <td class="inbox-small-cells">
                                        <input type="checkbox" class="auth_rules rules_all" name="rules[]" value="{{ $mainRules[$node['name']] }}"><bb class="b-child b-title">{{ $node['title'] }}管理</bb>
                                    </td>
                                </tr>
                                <tbody>
                                @if(!empty($node['child']))
                                    @foreach($node['child'] as $child)
                                        <tr class="check_row">
                                            <td class="inbox-small-cells">
                                                <input type="checkbox" class="auth_rules rules_row" name="rules[]" value="{{ $childRules[$child['name']] }}"><bb class="b-child">{{ $child['title'] }}</bb>
                                                <dl style="clear: both"></dl>
                                                @if(!empty($child['operator']))
                                                    <dd class="child_row">
                                                        @foreach($child['operator'] as $op)
                                                            <label style="padding-left: 20px;float: left;">
                                                                <input type="checkbox" class="auth_rules" name="rules[]" value="{{ $childRules[$op['name']] }}"><bb class="b-child">{{ $op['title'] }}</bb>
                                                            </label>
                                                        @endforeach
                                                    </dd>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                    <div class="form-group" style="padding:25px 0px;">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-danger" type="submit" style="margin:0px 25px">保存</button>
                            <button class="btn btn-default" type="button" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <!-- page end-->
@stop