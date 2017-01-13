<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.group.update') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        <input  type="hidden" name="id" value="{{ $info->id ?? 0 }}"/>
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">部门名称</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                <input class="form-control" placeholder="部门名称" name="title" type="text" value="{{$info['title'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">描述</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                <input class="form-control " placeholder="部门简单描述"  type="text" name="description" value="{{ $info->description ?? '' }}"/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">是否启用</label>
                            <div class="col-lg-10 radios has-js">
                                {!! radio('admin','status',[1=>'启用',0=>'禁用'],$info->status ?? 1)!!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>