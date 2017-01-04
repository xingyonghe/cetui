@extends('admin.layouts.base')
@section('style')
    <style type="text/css">
        .nav-tabs .active{
            border: 1px solid #e0e0e0;
            border-top: 1px solid #34b4e0;
            border-bottom: none;
        }
        .panel-heading .nav > li > a {
             color: #667fa0;;
        }
    </style>
@stop
@section('script')
    <script type="text/javascript" src="{{ asset('assets/static/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            highlight_subnav("{{ route($model.'.setting.index') }}");
            
            //分组跳转
            $('.nav-tabs li').click(function () {
                window.location = $(this).find('a').attr('href');
            });

            //上传图片
            //店铺头像上传
            var photo = new plupload.Uploader({
                browse_button : 'photo', //触发文件选择对话框的按钮，为那个元素id
                url : "{{ url('picture/upload') }}", //服务器端的上传页面地址
                multipart_params:{
                    '_token' : "{{ csrf_token() }}",
                },
                filters : {
                    max_file_size : '6mb',
                    mime_types: [
                        {title : "Image files", extensions : "jpg,png,jpeg"}
                    ],
                    prevent_duplicates:false //不允许选取重复文件
                },
                init: {
                    //添加
                    FilesAdded: function(up, files) {
                        $('.img').html("");
                        photo.start();
                    },
                    //每个队列上传完成
                    FileUploaded: function(up,file,resault) {
                        var res = $.parseJSON(resault.response);
                        console.log(res);
                        if(!res.status){
                            updateAlert(res.info);
                            uploader.removeFile(file.id);
                        }else{
                            var loading = "{{ asset('/public-static/loading.gif') }}";
                            $('.img').css("background","#d9d9d9 url("+loading+") no-repeat center");
                            $('.img').css("background-size","20px 20px").show();
                            setTimeout(function(){
                                $('.img').html("<img src='"+res.file.path+"' width='120' height='90' class='img-see'>");
                                $('.img').prev('input').val(res.file.id);
                            }, 1100);
                        }
                    },
                    Error : function(up, error) {
                        updateAlert(error.message);
                    },
                },
            });
            //在实例对象上调用init()方法进行初始化
            photo.init();
        })
    </script>
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                模块设置
            </header>
            <section class="panel" style=" margin-top: 15px;margin-left: 14px">

            </section>
            <div class="panel-body">
                <div class=" form">
                    @if($lists)
                        {!! Form::open(['url' => route('article.setting.update'),'class'=>'cmxform form-horizontal tasi-form form-datas']) !!}
                        @foreach($lists as $item)
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">{{ $item['title'] }}</label>
                                <div class="col-lg-10 radios has-js">
                                    @if($item['type'] == 1)
                                        <input class=" form-control" placeholder="{{ $item['remark'] }}" name="config[{{ $item['name'] }}]" type="text" value="{{ $item['value'] }}" />
                                    @elseif($item['type'] == 2)
                                        <input class=" form-control" placeholder="{{ $item['remark'] }}" name="config[{{ $item['name'] }}]" type="text" value="{{ $item['value'] }}" />
                                    @elseif($item['type'] == 3)
                                        <textarea class="form-control " rows="6" placeholder="{{ $item['remark'] }}" type="text" name="config[{{ $item['name'] }}]" />{{ $item['value'] }}</textarea>
                                    @elseif($item['type'] == 4)
                                        {!! Form::adminRadios("config[".$item['name']."]", parse_config_attr($item['extra']), $item['value']) !!}
                                    @elseif($item['type'] == 5)
                                        <span href="{{ url('admin/config/add') }}" class="btn btn-primary" id="photo">
                                        上传图片 <i class="icon-upload-alt"></i>
                                    </span>
                                        <input type="hidden" name="config[{{ $item['name'] }}]" class="input-img" value="{{ $item['value'] }}">
                                        @if($item['value'])
                                            <div style="margin-top: 10px;width: 120px;height: 90px" class="img">
                                                <img src='{{ get_cover($item['value']) }}' width='120' height='90' class='img-see'>
                                            </div>
                                        @else
                                            <div style="margin-top: 10px;display: none;width: 120px;height: 90px" class="img"></div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-danger" type="submit" style="margin:0px 25px">保存</button>
                                <button class="btn btn-default" type="button" onclick="javascript:history.back(-1);return false;">返回</button>
                            </div>
                        </div>
                        {!!Form::close()!!}
                        @else
                        <div class="form-group ">
                            <div class="col-lg-10 radios has-js" style="text-align: center">
                                暂无配置,前去<a href="{{ route('admin.config.index') }}" style="font-size: 16px;color: red">添加</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
@stop