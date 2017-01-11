@extends('ads.layouts.base')
@section('styles')
    <link href="{{ asset('static/datetimepicker/datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{ asset('static/datetimepicker/jquery.datetimepicker.full.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            //日期插件
            $.datetimepicker.setLocale('ch');
            $('#dead_time').datetimepicker({
                format:"Y-m-d",      //格式化日期
                todayButton:false,    //关闭选择今天按钮
                minDate:true,
                timepicker:false,    //关闭时间选项
            });
            $('#start_time').datetimepicker({
                format:"Y-m-d",      //格式化日期
                todayButton:false,    //关闭选择今天按钮
                minDate:true,
                timepicker:false,    //关闭时间选项
            });
            $('#end_time').datetimepicker({
                format:"Y-m-d",      //格式化日期
                todayButton:false,    //关闭选择今天按钮
                minDate:true,
                timepicker:false,    //关闭时间选项
            });

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
                        $('#logo').find('img').remove();
                        $('#logo').css("background","#ffffff url({{ asset('static/plupload/loading.gif') }}) no-repeat center");
                        $('#logo').css("background-size","25px 25px");
                        uploader.start();
                    },

                    //当队列中每一个文件上传完成触发
                    FileUploaded: function(up,file,response) {
                        var resault = $.parseJSON(response.response);
                        if(resault.code){
                            updateAlert(resault.error, {icon: 5});
                            $('#logo').html('<img src="{{ asset('member/images/ren.jpg') }}" width="115" height="145">').css('background','');
                        }else{
                            $('#logo').html('<input type="hidden" name="logo" value="'+ resault.file.path +'"><img src="'+resault.file.path+'" width="115" height="145">').css('background','');
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
            uploader.init();


            $('.ajax-post').click(function(){
//                var title = $('#title').val();
//                var money = $('#money').val();
//                var logo = $('#logo').find('input').val();
//                var num = $('#num').val();
//                var start_time = $('#start_time').val();
//                var end_time = $('#end_time').val();
//                var dead_time = $('#dead_time').val();
//                var shape = $('#shape').val();
//                var type = $('input[name="type"]').is(':checked');
//                if(!title){
//                    alertTips('请填写活动名称','title');return false;
//                }
//                if(!money){
//                    alertTips('请填写推广预算','money');return false;
//                }
//                if(!isMoney(money)){
//                    alertTips('推广预算格式错误','money');return false;
//                }
//                if(!logo){
//                    alertTips('请上传推广logo','logo');return false;
//                }
//                if(!num){
//                    alertTips('请填写网红数量','num');return false;
//                }
//                if(!isPositiveInteger(num)){
//                    alertTips('网红数量格式错误','num');return false;
//                }
//                if(!start_time){
//                    alertTips('请选择投放开始时间','start_time');return false;
//                }
//                if(!end_time){
//                    alertTips('请选择投放结束时间','end_time');return false;
//                }
//                if(!dead_time){
//                    alertTips('请选择截止时间','dead_time');return false;
//                }
//                if(!shape){
//                    alertTips('请选择广告类型','shape');return false;
//                }
//                if(!type){
//                    alertTips('请选择投放类型','type');return false;
//                }
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
                <a href="{{ route('ads.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('ads.task.index') }}"><span>推广管理</span></a> >
                @if(isset($info))
                <a href="{{ route('ads.task.edit',[$info['id']]) }}"><span class="on">修改推广活动</span></a>
                @else
                <a href="{{ route('ads.task.create') }}"><span class="on">发布推广活动</span></a>
                @endif

            </div>
            <div class="c_box">
                <form role="form" class="data-form" action="{{ route('ads.task.update') }}" method="post">
                    {{ csrf_field() }}
                    @if(isset($info))
                        <input  type="hidden" name="id" value="{{ $info->id }}"/>
                    @endif
                    <div class="c_tggl_box">
                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>活动名称：
                        </div>
                        <div class="c_tggl_right">
                            <input class="width_424" placeholder="请填写活动名称" type="text" name="title"  value="{{ $info['title'] ?? '' }}" id="title" />
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>推广预算：
                        </div>
                        <div class="c_tggl_right">
                            <input class="width_276" placeholder="请填写推广预算" type="text" name="money"  value="{{ $info['money'] ?? '' }}" id="money" />
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>上传产品LOGO：
                        </div>
                        <div class="c_tggl_right">
                            <div class="uploadBox">
                                <span class="uploadImg" id="logo">
                                    <input type="hidden" name="logo" value="{{ isset($info['logo']) ? $info['logo'] : '' }}">
                                    <img src="{{ isset($info['logo']) ? asset($info['logo']) :'/member/ads/img/product_logo.png' }}" width="115" height="145"/>
                                </span>
                            </div>
                            <span class="file_btn">
                                <button id="upload">选择图片</button>
                            </span>
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>需要网红数量：
                        </div>
                        <div class="c_tggl_right">
                            <input class="width_276" placeholder="请填写你需要网红的数量" type="text" name="num"  value="{{ $info['num'] ?? '' }}" id="num" />
                            <p>提示：填写您需要的网红数量</p>
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>投放周期：
                        </div>
                        <div class="c_tggl_right">
                            <input type="text"  placeholder="投放开始时间" name="start_time" id="start_time" value="{{ isset($info) ? $info['start_time']->format('Y-m-d') : '' }}" class="width_114"/>
                            <span> - </span>
                            <input type="text"  placeholder="投放结束时间" name="end_time" id="end_time" value="{{ isset($info) ? $info['end_time']->format('Y-m-d') : '' }}" class="width_114"/>
                            <p>提示：选择广告的投放时间范围</p>
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>截至时间：
                        </div>
                        <div class="c_tggl_right">
                            <input type="text"  placeholder="活动截至时间" name="dead_time" id="dead_time" value="{{ isset($info) ? $info['dead_time']->format('Y-m-d') : '' }}" class="width_114"/>
                            <p>提示：广告活动的截至时间，选择后广告活动将在指定时间内关闭</p>
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>广告类型：
                        </div>
                        <div class="c_tggl_right">
                            <select name="shape" id="shape" class="width_424">
                                <option value="">请选择广告类型</option>
                                @foreach($shape_arr as $key=>$shape)
                                    <option @if(isset($info['shape']) && ($info['shape'] == $key)) selected @endif value="{{ $key }}">{{ $shape }}</option>
                                @endforeach
                            </select>
                            <p>提示：比如您投放的是网店类广告请选择电商</p>
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>网红类型：
                        </div>
                        <div class="c_tggl_right">
                            {!! radio('ads','type',$type_arr,$info['type'] ?? 1) !!}
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            网红要求：
                        </div>
                        <div class="c_tggl_right">
                            <textarea placeholder="如：需要女性网红，需要游戏类直播等信息" name="demand"  id="demand" class="width_650">{{ $info['demand'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            活动要求：
                        </div>
                        <div class="c_tggl_right">
                            <textarea placeholder="如：活动要求增加口碑与知名度，增加游戏，新增用户量等信息" name="notes"  id="notes" class="width_650">{{ $info['notes'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="c_tggl_line">
                        <div class="c_tggl_left"></div>
                        <div class="c_tggl_right">
                            <button class="width_424 ajax-post">完成提交</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection