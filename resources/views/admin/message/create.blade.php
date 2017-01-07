<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.message.post') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">选择组</label>
                            <div class="col-lg-10 radios has-js">
                                {!! radio('admin','group',['全部','会员','广告主']) !!}
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
                                <textarea  class="form-control " rows="6" placeholder="内容" name="content"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>