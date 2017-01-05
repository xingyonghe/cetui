<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    {!! SEO::generate() !!}
    <script src="{{ asset('assets/home/js/jquery-1.7.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/static/plupload/plupload.full.min.js') }}"></script>
</head>
<body>
<br />
<div style="width: 80px;height: 80px;cursor: pointer;border: 1px solid #cccccc"  id="pickfiles">
    <img src="{{ asset('assets/static/plupload/tu5.jpg') }}" width="80" height="80">
    <input name="avatar" type="hidden" id="avatar">
</div>
<pre id="console"></pre>

<script type="text/javascript">
    $(function() {
        var uploader = new plupload.Uploader({
            browse_button : 'pickfiles', //触发浏览文件按钮标签的唯一id,,在flash、html5、和silverlight中能找到触发事件的ID
            //            container: document.getElementById('containers'), //上传后展现文件列表的容器，[默认是body],不能使用jquery获取
            drop_element:document.getElementById('pickfiles'),//指定了使用拖拽方式来选择上传文件时的拖拽区域，即可以把文件拖拽到这个区域的方式来选择文件。该参数的值可以为一个DOM元素的id,也可是 DOM元素本身，还可以是一个包括多个DOM元素的数组。如果不设置该参数则拖拽上传功能不可用。目前只有html5上传方式才支持拖拽上传。
            runtimes : 'html5',//上传插件初始化选用那种方式的优先级顺序，如果第一个初始化失败就走第二个，依次类推,flash,silverlight,html4
            url : "{{ route('api.picture') }}",//上传服务器地址
            file_data_name:"{{$pconf['filedata']}}",//设置上传到服务器端的名称。默认名称为'file'
            multi_selection:false,//是否支持选择多个文件，默认为 true
            //额外的参数键值对
            multipart_params:{
                '_token' : "{{ csrf_token() }}",
            },
            //修改图片属性 resize: {width: 320, height: 240, quality: 90}
//            resize : {width : 320, height : 240, quality : 90},
//            //flash文件地址
//            flash_swf_url : '/static/plupload/js/Moxie.swf',
//            //silverlight文件地址
//            silverlight_xap_url : '/static/plupload/js/Moxie.xap',
//            chunk_size: '1mb',//当上传文件大于服务器接收端文件大小限制的时候，可以分多次请求发给服务器，如果不需要从设置中移出
//            rename : true,
//            dragdrop: true,
            //过滤器
            filters : {
                // 上传文件的最大值
                {{--max_file_size : "{{$pconf['maxsize']}}"+'kb',--}}
                // 上传文件的类型以及类型过滤
                mime_types: [
                    {title : "Image files", extensions : "{{$pconf['exts']}}"},
                ],
                prevent_duplicates:false //不允许选取重复文件
            },
            init: {
                //init执行完以后要执行的事件触发,即页面加载完成的时候执行，如果想实现自动上传，只需将start方法在FilesAdded（）中实现即可
                //用于绑定事件
//                PostInit: function() {
//                },
                //用户选择文件时触发
                FilesAdded: function(up, files) {
                    $('#pickfiles').find('img').remove();
                    $('#pickfiles').css("background","#ffffff url({{ asset('assets/static/plupload/loading.gif') }}) no-repeat center");
                    $('#pickfiles').css("background-size","25px 25px");
                    uploader.start();
                },

                //当文件正在被上传中触发
//                UploadProgress: function(up, file) {
//                    $("#"+file.id).find('b').html('<span>' + file.percent + '%</span>');
//                },

                //当队列中每一个文件上传完成触发
                FileUploaded: function(up,file,response) {
                    var resault = $.parseJSON(response.response);
                    if(resault.code){
                        $('#console').append("\nError # :"+resault.error);
                        $('#pickfiles').append('<img src="{{ asset('assets/static/plupload/tu5.jpg') }}" width="80" height="80">').css('background','');
                    }else{
                        $('#pickfiles').append('<img src="'+resault.file.path+'" width="80" height="80">').css('background','');
                    }
                },

                //上传出错的时候触发
                Error: function(up, err) {
                    //602 不能选择重复文件
                    console.log(err);
                    if(err.code === -602){
                        $('#console').append("\nError #" + err.code + ": 不能选择重复文件");
                    }
                    if(err.code === -600){
                        $('#console').append("\nError #" + err.code + ": 最大只能上传4M");
                    }
                    if(err.code === -200){
                        if(err.status == 413){
                            $('#console').append("\nError #" + err.status + ": 您上传的大小超过了服务器的限制");
                        }
                    }

                }
            }
        });
        uploader.init();

    });
</script>

</body>
</html>

