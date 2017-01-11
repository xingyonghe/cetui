<div class="dialog">
    <form role="form" class="form-datas" action="{{ route('netred.order.post') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="order_sn"  value="{{ $id }}"/>
        <div class="c_tggl_box">
            <div class="c_tggl_line">
                <div class="c_tggl_left">
                    <span>*</span>凭证资料：
                </div>
                <div class="c_tggl_right" style="text-align: left;padding-left: 45px">
                    <span id="voucher">上传凭证</span>
                    <div style="clear: both"></div>
                    <div class="images">
                        <div class="uploadImg">
                            <input type="hidden" name="images[]" >
                            <img src="/member/netred/img/default_jt.png" width="110" height="110">
                        </div>
                        <div class="uploadImg">
                            <input type="hidden" name="images[]" >
                            <img src="/member/netred/img/default_jt.png" width="110" height="110">
                        </div>
                        <div class="uploadImg">
                            <input type="hidden" name="images[]" >
                            <img src="/member/netred/img/default_jt.png" width="110" height="110">
                        </div>
                        <div class="uploadImg">
                            <input type="hidden" name="images[]" >
                            <img src="/member/netred/img/default_jt.png" width="110" height="110">
                        </div>
                    </div>
                </div>
            </div>

            <div class="c_tggl_line">
                <div class="c_tggl_left">
                    视频链接：
                </div>
                <div class="c_tggl_right">
                    <input type="text" name="video_target" placeholder="请填写您的视频链接" value="" class="width_424"/>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{ asset('static/plupload/plupload.full.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        var uploader = new plupload.Uploader({
            browse_button : 'voucher', //触发浏览文件按钮标签的唯一id,,在flash、html5、和silverlight中能找到触发事件的ID
            runtimes : 'html5',//上传插件初始化选用那种方式的优先级顺序，如果第一个初始化失败就走第二个，依次类推,flash,silverlight,html4
            url : "{{ route('api.logo') }}",//上传服务器地址
            file_data_name:"file",//设置上传到服务器端的名称。默认名称为'file'
            multi_selection:true,//是否支持选择多个文件，默认为 true
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
                    var length = files.length;
                    var _length = 0;
                    $('.images .uploadImg').each(function(){
                        var input = $(this).find('input');
                        if(input.val()){
                            _length ++;
                        }
                    });
                    if((files.length > 4) || ((files.length+_length) > 4)){
                        layer.msg('您最多只能上传4张凭证资料', {icon: 5});return false;
                    }
                    uploader.start();
                },

                //当队列中每一个文件上传完成触发
                FileUploaded: function(up,file,response) {
                    var resault = $.parseJSON(response.response);
                    if(resault.code){
                        layer.msg(resault.error);
                    }else{
                        var cont = 0;
                        $('.images .uploadImg').each(function(){
                            if(cont > 0){
                                return false;
                            }
                            var input = $(this).find('input');
                            var img = $(this).find('img');
                            if(!input.val()){
                                input.val(resault.file.path);
                                img.attr('src',resault.file.path);
                                cont ++;
                            }
                        });
                    }
                },

                //上传出错的时候触发
                Error: function(up, err) {
                    //602 不能选择重复文件
                    console.log(err);
                    if(err.code === -602){
                        layer.msg('不能选择重复图片', {icon: 5});
                    }
                    if(err.code === -600){
                        layer.msg('最大只能上传4M的图片', {icon: 5});
                    }
                    if(err.code === -200){
                        if(err.status == 413){
                            layer.msg('您上传的图片太大', {icon: 5});
                        }
                    }

                }
            }
        });
        uploader.init();
    })
</script>
