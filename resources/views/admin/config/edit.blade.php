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
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    @if(isset($info))编辑@else新增@endif配置
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form method="post" action="{{ route('admin.config.update') }}" class="cmxform form-horizontal form-datas">
                            {{ csrf_field() }}
                            @if(isset($info))
                                <input  type="hidden" name="id" value="{{$info['id']}}"/>
                            @endif
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">配置标题</label>
                                <div class="input-group m-bot15 col-lg-10">
                                    <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                    <input class="form-control" placeholder="用于后台显示的配置标题" name="title" type="text" value="{{$info['title'] ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">配置标识</label>
                                <div class="input-group m-bot15 col-lg-10">
                                    <span class="input-group-addon"><i class="icon-tag"></i></span>
                                    <input  class="form-control" id="icon" placeholder="只能使用大写英文且不能重复" type="text" name="name" value="{{ $info['name'] ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">配置类型</label>
                                <div class="col-lg-10">
                                    {!! select('type', $config_type, $info->type ?? 0, ['class' => 'form-control m-bot15']) !!}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">配置分组</label>
                                <div class="col-lg-10">
                                    {!! select('group', $config_group, $info->group ?? 0, ['class' => 'form-control m-bot15']) !!}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">所属模块</label>
                                <div class="col-lg-10">
                                    {!! select('module', $config_module, $info->module ?? '', ['class' => 'form-control m-bot15']) !!}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">配置值</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control " rows="6"  placeholder="配置值" type="text" name="value" />{{$info->value ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">配置项</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control " rows="6" placeholder="如果是枚举型 需要配置该项" type="text" name="extra" />{{$info->extra ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">配置说明</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control " rows="6" placeholder="配置备注说明" type="text" name="remark" />{{$info->remark ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-danger ajax-post" type="submit" style="margin:0px 25px">保存</button>
                                    <button class="btn btn-default" type="button" onclick="javascript:history.back(-1);return false;">返回</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop