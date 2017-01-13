@extends('netred.layouts.base')
@section('styles')
    <link href="{{ asset('static/datetimepicker/datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('static/js/region.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/datetimepicker/jquery.datetimepicker.full.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){

            //地区加载
            @if(isset($info))
                select_region("{{$info['province']}}","{{$info['city']}}","{{$info['district']}}");
            @else
                show_region();
            @endif

            //日期插件
            $.datetimepicker.setLocale('ch');
            $('.datetimepicker').datetimepicker({
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
                        $('#avatar').find('img').remove();
                        $('#avatar').css("background","#ffffff url({{ asset('static/plupload/loading.gif') }}) no-repeat center");
                        $('#avatar').css("background-size","25px 25px");
                        uploader.start();
                    },

                    //当队列中每一个文件上传完成触发
                    FileUploaded: function(up,file,response) {
                        var resault = $.parseJSON(response.response);
                        if(resault.code){
                            layer.msg(resault.error,{icon: 5});
                            $('#avatar').html('<img src="{{ asset('member/images/ren.jpg') }}" width="115" height="145">').css('background','');
                        }else{
                            $('#avatar').html('<input type="hidden" name="avatar" value="'+ resault.file.path +'"><img src="'+resault.file.path+'" width="115" height="145">').css('background','');
                        }
                    },

                    //上传出错的时候触发
                    Error: function(up, err) {
                        //602 不能选择重复文件
                        console.log(err);
                        if(err.code === -602){
                            layer.msg('不能选择重复图片',{icon: 5});
                        }
                        if(err.code === -600){
                            layer.msg('最大只能上传4M的图片',{icon: 5});
                        }
                        if(err.code === -200){
                            if(err.status == 413){
                                layer.msg('您上传的图片太大',{icon: 5});
                            }
                        }

                    }
                }
            });
            uploader.init();


            $('.ajax-post').click(function(){
                //                var avatar = $('#avatar').find('input').val();
                //                var stage_name = $('#stage_name').val();
                //                var sex = $('input[name="sex"]').is(':checked');
                //                var province = $('#province').val();
                //                var city = $('#city').val();
                //                var average_num = $('#average_num').val();
                //                var platform_id = $("#platform_id").val();
                //                var form_id = $('#form_id').val();
                //                var max_num = $('#max_num').val();
                //                var average_num = $('#average_num').val();
                //                var fans = $('#fans').val();
                //                var style = $('input[name="style[]"]').is(':checked');
                //                var catids = $('input[name="catids[]"]').is(':checked');
                //                var form = $('input[name="form[]"]').is(':checked');
                //                var moneys = $('#moneys').val();
                //                var term_time = $('#term_time').val();
                //                if(!avatar){
                //                    alertTips('请上传头像','avatar');return false;
                //                }
                //                if(!stage_name){
                //                    alertTips('请填写艺名','stage_name');return false;
                //                }
                //                if(!sex){
                //                    alertTips('请选择性别','sex');return false;
                //                }
                //                if(!province){
                //                    alertTips('请选择所在地区省份','province');return false;
                //                }
                //                if(!city){
                //                    alertTips('请选择所在地区城市','city');return false;
                //                }
                //                if(!platform){
                //                    alertTips('请选择所属平台','platform');return false;
                //                }
                //                if(!platform_id){
                //                    alertTips('请填写平台ID','platform_id');return false;
                //                }
                //                if(!fans){
                //                    alertTips('请填写粉丝量级','fans');return false;
                //                }
                //                if(!isPositiveInteger(fans)){
                //                    alertTips('粉丝量级格式错误','fans');return false;
                //                }
                //                if(!average_num){
                //                    alertTips('请填写平均在线观看人数','average_num');return false;
                //                }
                //                if(!isPositiveInteger(average_num)){
                //                    alertTips('平均在线观看人数格式错误','average_num');return false;
                //                }
                //                if(!max_num){
                //                    alertTips('请填写最高观看人数','max_num');return false;
                //                }
                //                if(!isPositiveInteger(max_num)){
                //                    alertTips('最高观看人数格式错误','max_num');return false;
                //                }
                //                if(!style){
                //                    alertTips('请选择风格','style');return false;
                //                }
                //                if(!catids){
                //                    alertTips('请选择广告类型','catids');return false;
                //                }
                //                if(!form){
                //                    alertTips('请选择广告形式','form');return false;
                //                }
                //                if(!money){
                //                    alertTips('请填写参考价格','money');return false;
                //                }
                //                if(!isMoney(money)){
                //                    alertTips('参考价格格式错误','money');return false;
                //                }
                //                if(!term_time){
                //                    alertTips('请填写价格有效期','term_time');return false;
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
                <a href="{{ route('netred.star.index') }}"><span>资源管理</span></a> >
                @if(isset($info))
                    <a href="{{ route('netred.star.edit',[$info['id']]) }}"><span class="on">修改短视频账户</span></a>
                @else
                    <a href="{{ route('netred.star.video') }}"><span class="on">添加短视频账户</span></a>
                @endif

            </div>
            <div class="c_box">
                <form role="form" class="data-form" action="{{ route('netred.star.update') }}" method="post">
                    {{ csrf_field() }}
                    @if(isset($info))
                        <input  type="hidden" name="id" value="{{ $info->id }}"/>
                    @endif
                    <div class="c_tggl_box">
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>上传头像：
                            </div>
                            <div class="c_tggl_right">
                                <div class="uploadBox">
                                    <span class="uploadImg" id="avatar">
                                        <input type="hidden" name="avatar" value="{{ isset($info['avatar']) ? $info['avatar'] : '' }}">
                                        <img src="{{ isset($info['avatar']) ? asset($info['avatar']) :'/member/ads/img/product_logo.png' }}" width="115" height="145"/>
                                    </span>
                                </div>
                                <span class="file_btn">
                                    <button id="upload">选择图片</button>
                                </span>
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>艺名：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="stage_name" placeholder="请填写艺名"  value="{{ $info['stage_name'] ?? '' }}" id="stage_name" class="width_424">
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>姓别：
                            </div>
                            <div class="c_tggl_right">
                                {!! radio('ads','sex',[1=>'男',2=>'女'],$info['sex'] ?? 1) !!}
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>所在地：
                            </div>
                            <div class="c_tggl_right">
                                <span id="regoin">
                                    <select name="province" id="province" class="province wkyang"></select>
                                    <select name="city" id="city" class="city wkyang"></select>
                                    <select name="district" id="district" class="district wkyang"></select>
                                </span>
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>所属平台：
                            </div>
                            <div class="c_tggl_right">
                                {!! select('platform_id',$platforms,$info['platform_id'] ?? '',['id'=>'platform_id']) !!}
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>平台ID：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="form_id" placeholder="请填写平台ID"  id="form_id" value="{{ $info['form_id'] ?? '' }}"  class="width_424">
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>粉丝量级：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="fans" placeholder="请填写粉丝量级"  id="fans" value="{{ $info['fans'] ?? '' }}"  class="width_424">
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                平均在线观看人数：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="average_num" placeholder="请填写平均在线观看人数"  id="average_num" value="{{ $info['average_num'] ?? '' }}"  class="width_424">
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>风格（多选）：
                            </div>
                            <div class="c_tggl_right" id="style">
                                @foreach($styles as $key=>$style)
                                    <lable class="checkbox">
                                        <input type="checkbox" name="style[]" @if(isset($info['style']) && (in_array('style_'.$key,$info['style']))) checked @endif value="style_{{ $key }}" />{{ $style }}
                                    </lable>
                                @endforeach
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>类型选择（多选）：
                            </div>
                            <div class="c_tggl_right" id="catids">
                                @foreach($categorys as $category)
                                    <div>
                                        <lable style="font-size: 14px">{{ $category['name'] }}：</lable>
                                        @if(isset($category['_child']))
                                            @foreach($category['_child'] as $key=>$cate)
                                                <lable class="checkbox">
                                                    <input type="checkbox" @if(isset($info['catids']) && (in_array('catid_'.$cate['id'],$info['catids']))) checked @endif  name="catids[]" value="catid_{{ $cate['id'] }}" />{{ $cate['name'] }}
                                                </lable>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div style="clear: both"></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>广告形式（多选）：
                            </div>
                            <div class="c_tggl_right" id="form">
                                @foreach($adforms as $key=>$adform)
                                    <lable class="checkbox">
                                        <input type="checkbox" @if(isset($info['form']) && (in_array('form_'.$key,$info['form']))) checked @endif name="form[]" value="form_{{ $key }}" title="{{ $adform }}" />{{ $adform }}
                                    </lable>
                                @endforeach
                                <div style="margin-top: 20px;"><a href="javascript:viod(0)" style="color: #1d8fd1;">点击查看各类型广告术语解释</a></div>
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>参考报价：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="money" placeholder="请填写参考报价"  id="money" value="{{ $info['money'] ?? '' }}"  class="width_424">
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>价格有效期：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="term_time" placeholder="请选择价格有效期"  id="term_time" value="{{ isset($info['term_time']) ? $info['term_time']->format('Y-m-d') : '' }}"  class="width_424 datetimepicker">
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                接单备注：
                            </div>
                            <div class="c_tggl_right">
                                <textarea placeholder="如：需要女性网红，需要游戏类直播等信息" name="note"  id="note" class="width_650">{{ $info['note'] ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                资源优惠：
                            </div>
                            <div class="c_tggl_right">
                                <textarea placeholder="如：活动要求增加口碑与知名度，增加游戏，新增用户量等信息" name="advantage"  id="advantage" class="width_650">{{ $info['advantage'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                案例介绍：
                            </div>
                            <div class="c_tggl_right">
                                <textarea placeholder="如：活动要求增加口碑与知名度，增加游戏，新增用户量等信息" name="introduce"  id="introduce" class="width_650">{{ $info['introduce'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="c_tggl_line">
                            <div class="c_tggl_left"></div>
                            <div class="c_tggl_right">
                                <input type="hidden" name="type" value="2">
                                <button class="width_424 ajax-post">完成提交</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
