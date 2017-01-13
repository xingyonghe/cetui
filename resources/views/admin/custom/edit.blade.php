<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.custom.update') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                    <input  type="hidden" name="id" value="{{ $info->id }}"/>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">用户名</label>
                        <div class="input-group m-bot15 col-lg-10">
                            <span class="input-group-addon"><i class="icon-pencil"></i></span>
                            <input class="form-control" placeholder="客服用户账号" disabled type="text"  value="{{ $info->username }}" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">昵称</label>
                        <div class="input-group m-bot15 col-lg-10">
                            <span class="input-group-addon"><i class="icon-pencil"></i></span>
                            <input class="form-control" placeholder="客服用户账号昵称" name="nickname" value="{{ $info->nickname }}" type="text" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">QQ</label>
                        <div class="input-group m-bot15 col-lg-10">
                            <span class="input-group-addon"><i class="icon-pencil"></i></span>
                            <input class="form-control" placeholder="客服用户QQ账号" name="qq" type="text" value="{{ $info->qq }}" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">分类</label>
                        <div class="col-lg-10">
                            <select class="form-control m-bot15" name="type">
                                @foreach($admin_type as $type_id=>$type_name)
                                    <option value="{{ $type_id }}" @if($info->type==$type_id) selected @endif>{{ $type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">用户组</label>
                        <div class="col-lg-10">
                            <input  type="hidden" name="role_id" value="0"/>
                            <select class="form-control m-bot15" name="role_id">
                                <option value="0">请选择</option>
                                @foreach($groups as $key=>$group)
                                    <option @if($info->role_id==$key) selected @endif value="{{ $key }}">{{ $group }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">状态</label>
                        <div class="col-lg-10 radios has-js">
                            <label class="label_radio @if($info->status==1) r_on @endif" for="radio-01">
                                <input name="status" id="radio-01" value="1" type="radio" @if($info->status==1) checked @endif /> 正常
                            </label>
                            <label class="label_radio @if($info->status==0) r_on @endif" for="radio-02">
                                <input name="status" id="radio-02" value="0" type="radio" @if($info->status==0) checked @endif/> 禁用
                            </label>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>