<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.bank.update') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        @if(isset($info))
                            <input  type="hidden" name="id" value="{{$info['id']}}"/>
                        @endif
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">名称</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                <input class="form-control" placeholder="账户类型名称" name="name" type="text" value="{{$info['name'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">排序</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-sort-by-order"></i></span>
                                <input  class="form-control" placeholder="账户显示的顺序"  type="text" name="sort" value="{{$info['sort'] ?? ''}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>