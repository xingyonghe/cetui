<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.custom.add') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">用户名</label>
                        <div class="input-group m-bot15 col-lg-10">
                            <span class="input-group-addon"><i class="icon-pencil"></i></span>
                            <input class="form-control" placeholder="客服用户账号" name="username" type="text" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">昵称</label>
                        <div class="input-group m-bot15 col-lg-10">
                            <span class="input-group-addon"><i class="icon-pencil"></i></span>
                            <input class="form-control" placeholder="客服用户账号昵称" name="nickname" type="text" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">QQ</label>
                        <div class="input-group m-bot15 col-lg-10">
                            <span class="input-group-addon"><i class="icon-pencil"></i></span>
                            <input class="form-control" placeholder="客服用户QQ账号" name="qq" type="text" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">分类</label>
                        <div class="col-lg-10">
                            <select class="form-control m-bot15" name="type">
                                @foreach($admin_type as $type_id=>$type_name)
                                    <option value="{{ $type_id }}">{{ $type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">密码</label>
                        <div class="input-group m-bot15 col-lg-10">
                            <span class="input-group-addon"><i class="icon-pencil"></i></span>
                            <input class="form-control" placeholder="客服用户密码" name="password" type="password" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">确认密码</label>
                        <div class="input-group m-bot15 col-lg-10">
                            <span class="input-group-addon"><i class="icon-pencil"></i></span>
                            <input class="form-control" placeholder="客服用户密码确认" name="password_confirmation" type="password" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">用户组</label>
                        <div class="col-lg-10">
                            <select class="form-control m-bot15" name="role_id">
                                <option value="0">请选择</option>
                                @foreach($groups as $key=>$group)
                                    <option value="{{ $key }}">{{ $group }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">状态</label>
                        <div class="col-lg-10 radios has-js">
                            <label class="label_radio r_on" for="radio-01">
                                <input name="status" id="radio-01" value="1" type="radio" checked /> 正常
                            </label>
                            <label class="label_radio" for="radio-02">
                                <input name="status" id="radio-02" value="0" type="radio" /> 禁用
                            </label>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>