<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.netred.post') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        <div class="form-group" >
                            <div class="col-lg-10" style="text-align: left;font-size: 14px;margin-bottom: 10px">
                                上级菜单
                            </div>
                            <div class="col-lg-10" style="width: 98%;margin-bottom: 10px">
                                <textarea class="form-control" rows="10" placeholder="请按规则填写网红信息" name="info" />
                                </textarea>
                            </div>
                            <div class="col-lg-10" style="text-align: left;font-size: 14px;color:#797979">
                                批量规则:<br/>
                                网红艺名-平台ID-粉丝数-播放次数-头像编号<br/>
                                网红艺名-平台ID-粉丝数-播放次数-头像编号<br/><br/>
                                规则说明:<br/>
                                一行一条网红信息，新的信息必须另起一行
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>