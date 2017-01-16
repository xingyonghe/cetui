<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.netred.update') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">网红艺名</label>
                            <div class="input-group m-bot15 col-lg-10">
                                {{--<span class="input-group-addon"><i class="icon-pencil"></i></span>--}}
                                <input class="form-control"  readonly type="text" value="{{$info['stage_name']}}">
                                <input class="form-control"  name="netred_id" type="hidden" value="{{$info['id']}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">推荐位置</label>
                            <div class="col-lg-10" style="text-align: left">
                                <label class="">
                                    <input type="checkbox" name="position[]" @if(in_array(1,$p_info)) checked @endif value="1"> 首页
                                </label>
                                <label class="">
                                    <input type="checkbox" name="position[]" @if(in_array(2,$p_info)) checked @endif value="2"> 列表页
                                </label>
                                <label class="">
                                    <input type="checkbox" name="position[]" @if(in_array(3,$p_info)) checked @endif value="3"> 详情页
                                </label>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
