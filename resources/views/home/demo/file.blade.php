<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    {!! SEO::generate() !!}
    <script src="{{ asset('assets/home/js/jquery-1.7.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/static/plupload/plupload.full.min.js') }}"></script>
</head>
<body>
<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<br />
<div style="border: 1px solid #ff0000;width: 80px;height: 80px;cursor: pointer"  id="pickfiles">
</div>
<pre id="console"></pre>
<script type="text/javascript">
    $(function() {
        var uploader = new plupload.Uploader({
            browse_button : 'pickfiles', //触发浏览文件按钮标签的唯一id,,在flash、html5、和silverlight中能找到触发事件的ID
//            container: document.getElementById('containers'), //上传后展现文件列表的容器，[默认是body],不能使用jquery获取
            runtimes : 'html5,flash,silverlight,html4',//上传插件初始化选用那种方式的优先级顺序，如果第一个初始化失败就走第二个，依次类推
            url : "{{ route('api.picture') }}",//上传服务器地址
            file_data_name:'file',//设置上传到服务器端的名称。默认名称为'file'
            //额外的参数键值对
            multipart_params:{
                '_token' : "{{ csrf_token() }}",
            },
            //修改图片属性 resize: {width: 320, height: 240, quality: 90}
            //            resize : {width : 320, height : 240, quality : 90},
            //flash文件地址
            flash_swf_url : '/static/plupload/js/Moxie.swf',
            //silverlight文件地址
            silverlight_xap_url : '/static/plupload/js/Moxie.xap',
            //            chunk_size: '1mb',//当上传文件大于服务器接收端文件大小限制的时候，可以分多次请求发给服务器，如果不需要从设置中移出
            //            rename : true,
            //            dragdrop: true,
            //过滤器
            filters : {
                // 上传文件的最大值
                max_file_size : '1mb',
                // 上传文件的类型以及类型过滤
                mime_types: [
                    {title : "Image files", extensions : "jpg,gif,png,jpeg"},
//                    {title : "Zip files", extensions : "zip"}
                ],
                prevent_duplicates:true //不允许选取重复文件
            },
            init: {
                //init执行完以后要执行的事件触发,即页面加载完成的时候执行，如果想实现自动上传，只需将start方法在FilesAdded（）中实现即可
                PostInit: function() {
                    $('#uploadfiles').on('click',function(){
                        uploader.start();
                        return false;
                    })
                },
                //用户选择文件时触发
                FilesAdded: function(up, files) {
                    var html = ''
                    plupload.each(files, function(file) {
                        html += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                    });
                    $('#filelist').append(html);
                },
                //当文件正在被上传中触发
                UploadProgress: function(up, file) {
                    $("#"+file.id).find('b').html('<span>' + file.percent + '%</span>');
                },
                //                //上传出错的时候触发
                Error: function(up, err) {
                    //602 不能选择重复文件
                    console.log(err.code);
                    if(err.code === -602){
                        $('#console').append("\nError #" + err.code + ": 不能选择重复文件");
                    }
                    if(err.code === -600){
                        $('#console').append("\nError #" + err.code + ": 最大只能上传1M");
                    }

                }
            }
        });
        uploader.init();

    });
</script>

</body>
</html>

