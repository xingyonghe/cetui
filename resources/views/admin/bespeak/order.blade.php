<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.bespeak.post') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        <input name="task_id" type="hidden" value="{{$info['id'] ?? ''}}">
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">订单价格</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                <input class="form-control" name="money" type="text" value="{{$info['money'] ?? ''}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>