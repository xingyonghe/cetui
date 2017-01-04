<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.channel.update') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        @if(isset($info))
                            <input  type="hidden" name="id" value="{{$info['id']}}"/>
                        @endif
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">标题</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                <input class="form-control" placeholder="用于前台显示的导航标题" name="title" type="text" value="{{$info['title'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">排序</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-sort-by-order"></i></span>
                                <input  class="form-control" placeholder="导航显示的顺序"  type="text" name="sort" value="{{$info['sort'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">链接</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-link"></i></span>
                                <input  class="form-control" placeholder="导航菜单url链接" type="text" name="url" value="{{$info['url'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">状态</label>
                            <div class="col-lg-10 radios has-js">
                                {!! radio('admin','hide',[0=>'显示',1=>'隐藏'],$info->hide ?? 0) !!}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">新窗口打开</label>
                            <div class="col-lg-10 radios has-js">
                                {!! radio('admin','target',[0=>'否',1=>'是'],$info->target ?? 0) !!}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">备注说明</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                <input class="form-control" placeholder="额外的导航备注说明" name="remark" type="text" value="{{$info['remark'] ?? ''}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>