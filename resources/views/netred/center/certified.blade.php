@extends('netred.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('static/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            var upload_vcard_face = new plupload.Uploader({
                browse_button : 'upload_vcard_face', //触发浏览文件按钮标签的唯一id,,在flash、html5、和silverlight中能找到触发事件的ID
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
                        $('#vcard_face').find('img').remove();
                        $('#vcard_face').css("background","#ffffff url({{ asset('static/plupload/loading.gif') }}) no-repeat center");
                        $('#vcard_face').css("background-size","25px 25px");
                        upload_vcard_face.start();
                    },

                    //当队列中每一个文件上传完成触发
                    FileUploaded: function(up,file,response) {
                        var resault = $.parseJSON(response.response);
                        if(resault.code){
                            updateAlert(resault.error, {icon: 5});
                            $('#vcard_face').html('<img src="{{ asset('member/ads/img/product_logo.png') }}" width="115" height="145">').css('background','');
                        }else{
                            $('#vcard_face').html('<input type="hidden" name="vcard_face" value="'+ resault.file.path +'"><img src="'+resault.file.path+'" width="115" height="145">').css('background','');
                        }
                    },

                    //上传出错的时候触发
                    Error: function(up, err) {
                        //602 不能选择重复文件
                        if(err.code === -602){
                            updateAlert('不能选择重复图片', {icon: 5});
                        }
                        if(err.code === -600){
                            updateAlert('最大只能上传4M的图片', {icon: 5});
                        }
                        if(err.code === -200){
                            if(err.status == 413){
                                updateAlert('您上传的图片太大', {icon: 5});
                            }
                        }

                    }
                }
            });
            upload_vcard_face.init();

            var upload_vcard_con = new plupload.Uploader({
                browse_button : 'upload_vcard_con', //触发浏览文件按钮标签的唯一id,,在flash、html5、和silverlight中能找到触发事件的ID
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
                        $('#vcard_con').find('img').remove();
                        $('#vcard_con').css("background","#ffffff url({{ asset('static/plupload/loading.gif') }}) no-repeat center");
                        $('#vcard_con').css("background-size","25px 25px");
                        upload_vcard_con.start();
                    },

                    //当队列中每一个文件上传完成触发
                    FileUploaded: function(up,file,response) {
                        var resault = $.parseJSON(response.response);
                        if(resault.code){
                            updateAlert(resault.error, {icon: 5});
                            $('#vcard_con').html('<img src="{{ asset('member/ads/img/product_logo.png') }}" width="115" height="145">').css('background','');
                        }else{
                            $('#vcard_con').html('<input type="hidden" name="vcard_con" value="'+ resault.file.path +'"><img src="'+resault.file.path+'" width="115" height="145">').css('background','');
                        }
                    },

                    //上传出错的时候触发
                    Error: function(up, err) {
                        //602 不能选择重复文件
                        console.log(err);
                        if(err.code === -602){
                            updateAlert('不能选择重复图片', {icon: 5});
                        }
                        if(err.code === -600){
                            updateAlert('最大只能上传4M的图片', {icon: 5});
                        }
                        if(err.code === -200){
                            if(err.status == 413){
                                updateAlert('您上传的图片太大', {icon: 5});
                            }
                        }

                    }
                }
            });
            upload_vcard_con.init();

            $('.ajax-post').click(function(){
                var that = $(this);
                formAjaxPost($('.data-form'),that);
                return false;
            });


        })
    </script>
@endsection
@section('body')
    <div class="container marTB_15">
        <div class="width_1140">
            <div class="c_route">
                当前位置：
                <a href="{{ route('netred.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('netred.center.index') }}"><span>个人中心</span></a> >
                <a href="{{ route('netred.center.certified') }}"><span class="on">认证资料</span></a>
            </div>
            <div class="c_box">
                <form role="form" class="data-form" action="{{ route('netred.center.send') }}" method="post">
                    {{ csrf_field() }}
                    <div class="c_tggl_box">
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>真实姓名：
                            </div>
                            <div class="c_tggl_right">
                                <input class="width_424" placeholder="请填写您的真实姓名" type="text" name="truename"  value="{{ $info['truename'] ?? '' }}" id="truename" />
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>身份证号：
                            </div>
                            <div class="c_tggl_right">
                                <input class="width_424" placeholder="请填写身份证号号码" type="text" name="vcard"  value="{{ $info['vcard'] ?? '' }}" id="vcard" />
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>身份证正面：
                            </div>
                            <div class="c_tggl_right">
                                <div class="uploadBox">
                                <span class="uploadImg" id="vcard_face">
                                    <input type="hidden" name="vcard_face" value="{{ $info['vcard_face'] ?? '' }}">
                                    <img src="{{ $info['vcard_face'] ?? '/member/ads/img/product_logo.png' }}"  width="115" height="145"/>
                                </span>
                                </div>
                                <span class="file_btn">
                                <button id="upload_vcard_face">选择图片</button>
                            </span>
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>身份证反面：
                            </div>
                            <div class="c_tggl_right">
                                <div class="uploadBox">
                                <span class="uploadImg" id="vcard_con">
                                    <input type="hidden" name="vcard_con" value="{{ $info['vcard_con'] ?? '' }}">
                                    <img src="{{ $info['vcard_con'] ?? '/member/ads/img/product_logo.png' }}" width="115" height="145"/>
                                </span>
                                </div>
                                <span class="file_btn">
                                <button id="upload_vcard_con">选择图片</button>
                            </span>
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left"></div>
                            <div class="c_tggl_right">
                                @if(isset($info))
                                    <button class="width_424 ajax-post">重新提交</button>
                                @else
                                    <button class="width_424 ajax-post">完成提交</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection