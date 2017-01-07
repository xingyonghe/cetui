<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.message.send') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">收件人</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-user"></i></span>
                                <input class="form-control" placeholder="收件人，用户手机账号，多个用-隔开" name="name" type="text">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">标题</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                <input class="form-control" placeholder="标题" name="title" type="text">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">内容</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <textarea  class="form-control " rows="6" name="content"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>