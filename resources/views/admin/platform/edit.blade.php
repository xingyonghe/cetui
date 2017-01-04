<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.platform.update') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}
                        @if(isset($info))
                            <input  type="hidden" name="id" value="{{$info['id']}}"/>
                        @endif
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">平台类型</label>
                            <div class="col-lg-10 radios has-js">
                                {!! radio('admin','category',$category,$info['category'] ?? 1) !!}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">平台名称</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                <input class="form-control" placeholder="请填写平台名称" name="name" type="text" value="{{$info['name'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">排序</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-sort-by-order"></i></span>
                                <input  class="form-control" placeholder="用户分组显示的顺序"  type="text" name="sort" value="{{$info['sort'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">平台LOGO</label>
                            <div class="col-lg-10" style="text-align: left">
                                <button type="button"   class="btn btn-default" id="upload"><i class="icon-cloud-upload"></i> Upload</button>
                                <div id="pickfiles" style="position: absolute;left:136px;top:-3px">
                                    @if(isset($info->icon) && $info->icon)
                                        <input type="hidden" name="icon" value="{{ $info->icon }}"><img src="{{ $info->icon }}" width="auto" height="40">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript" src="{{ asset('static/plupload/plupload.full.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        var uploader = new plupload.Uploader({
            browse_button : 'upload', //触发浏览文件按钮标签的唯一id,,在flash、html5、和silverlight中能找到触发事件的ID
            runtimes : 'html5',//上传插件初始化选用那种方式的优先级顺序，如果第一个初始化失败就走第二个，依次类推,flash,silverlight,html4
            url : "{{ route('api.logo') }}",//上传服务器地址
            file_data_name:"file",//设置上传到服务器端的名称。默认名称为'file'
            multi_selection:false,//是否支持选择多个文件，默认为 true
            //额外的参数键值对
            multipart_params:{
                '_token' : "{{ csrf_token() }}",
            },
            //过滤器
            filters : {
                // 上传文件的最大值
                max_file_size : "4M",
                // 上传文件的类型以及类型过滤
                mime_types: [
                    {title : "Image files", extensions : "jpg,gif,png,jpeg"},
                ],
                prevent_duplicates:false //不允许选取重复文件
            },
            init: {
                //用户选择文件时触发
                FilesAdded: function(up, files) {
                    uploader.start();
                },

                //当队列中每一个文件上传完成触发
                FileUploaded: function(up,file,response) {
                    var resault = $.parseJSON(response.response);
                    if(resault.code){
                        updateAlert(resault.error);
                    }else{
                        $('#pickfiles').html('<input type="hidden" name="icon" value="'+ resault.file.path +'"><img src="'+resault.file.path+'" width="auto" height="40">');
                    }
                },

                //上传出错的时候触发
                Error: function(up, err) {
                    //602 不能选择重复文件
                    console.log(err);
                    if(err.code === -602){
                        updateAlert('不能选择重复图片');
                    }
                    if(err.code === -600){
                        updateAlert('最大只能上传4M的图片');
                    }
                    if(err.code === -200){
                        if(err.status == 413){
                            updateAlert('您上传的图片太大');
                        }
                    }

                }
            }
        });
        uploader.init();
    })
</script>
