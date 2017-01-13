@extends('admin.layouts.base')
@section('styles')
@stop
@section('scripts')
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route('admin.custom.index') }}");
        })
    </script>
@stop
@section('body')
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    重置密码
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form method="post" action="{{ route('admin.custom.change') }}" class="cmxform form-horizontal form-datas">
                            {{ csrf_field() }}
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2" style="text-align: right">用户名：</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" placeholder="输入重置密码的账号" name="username" type="text" value="{{ old('username') }}" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2" style="text-align: right">新密码：</label>
                                <div class="col-lg-10">
                                    <input class="form-control " placeholder="用于后台登陆的新密码"  type="password" name="password" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2" style="text-align: right">确认密码：</label>
                                <div class="col-lg-10">
                                    <input class="form-control " placeholder="确认新密码" type="password" name="password_confirmation" />
                                </div>
                            </div>
                            <div class="form-group" style="padding:25px 0px;">
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
    <!-- page end-->
@stop