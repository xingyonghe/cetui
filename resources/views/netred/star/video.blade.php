@extends('netred.layouts.base')
@section('style')
    <link href="{{ asset('assets/static/datetimepicker/datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/static/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/static/datetimepicker/jquery.datetimepicker.full.js') }}"></script>
    <script type="text/javascript">
        $(function(){
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
                        $('#avatar').css("background","#ffffff url({{ asset('assets/static/plupload/loading.gif') }}) no-repeat center");
                        $('#avatar').css("background-size","25px 25px");
                        uploader.start();
                    },

                    //当队列中每一个文件上传完成触发
                    FileUploaded: function(up,file,response) {
                        var resault = $.parseJSON(response.response);
                        if(resault.code){
                            updateAlert(resault.error);
                            $('#avatar').html('<img src="{{ asset('assets/member/images/ren.jpg') }}" width="115" height="145">').css('background','');
                        }else{
                            $('#avatar').html('<input type="hidden" name="avatar" value="'+ resault.file.path +'"><img src="'+resault.file.path+'" width="115" height="145">').css('background','');
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

            //广告形式及价格
            $('.adforms').find('input').click(function(){
                var adform = $(this).val();
                var form_adform = $('.form_'+adform);
                if($(this).is(':checked') ){
                    if(form_adform.is(':hidden')){
                        form_adform.show();
                    }
                }else{
                    if(form_adform.is(':visible')){
                        form_adform.hide();
                    }
                }
                form_adform.find('input').val('');
            });

            $('.ajax-post').click(function(){
                var avatar = $('#avatar').find('input').val();
                var stage_name = $('#stage_name').val();
                var sex = $('input[name="sex"]').is(':checked');
                var province = $('#province').val();
                var city = $('#city').val();
                var average_num = $('#average_num').val();
                var platform = $("#platform").val();
                var platform_id = $('#platform_id').val();
                var fans = $('#fans').val();
                var style = $('input[name="style[]"]').is(':checked');
                var catids = $('input[name="catids[]"]').is(':checked');
                var form = $('input[name="form[]"]').is(':checked');
                var moneys = $('#moneys').find("input[name='money[]']:visible");
                var terms = $('#moneys').find("input[name='term[]']:visible");
                if(!avatar){
                    alertTips('请上传头像','avatar');return false;
                }
                if(!stage_name){
                    alertTips('请填写艺名','stage_name');return false;
                }
                if(!sex){
                    alertTips('请选择性别','sex');return false;
                }
                if(!province){
                    alertTips('请选择所在地区省份','province');return false;
                }
                if(!city){
                    alertTips('请选择所在地区城市','city');return false;
                }
                if(!platform){
                    alertTips('请选择所属平台','platform');return false;
                }
                if(!platform_id){
                    alertTips('请填写平台ID','platform_id');return false;
                }
                if(!fans){
                    alertTips('请填写粉丝量级','fans');return false;
                }
                if(!average_num){
                    alertTips('请填写平均在线观看人数','average_num');return false;
                }
                if(!style){
                    alertTips('请选择风格','style');return false;
                }
                if(!catids){
                    alertTips('请选择广告类型','catids');return false;
                }
                if(!form){
                    alertTips('请选择广告形式','form_price');return false;
                }
                var money = true;
                var money_format = true;
                $.each(moneys, function() {
                    if(!$(this).val()){
                        money = false;
                    }
                    if (!/^\d+\.?\d{0,2}$/.test($(this).val())){
                        money_format = false;
                    }
                });
                if(!money){
                    alertTips('请填写广告形式参考价格','form_price');return false;
                }
                if(!money_format){
                    alertTips('广告形式参考价格格式错误','form_price');return false;
                }
                var term_format = true;
                $.each(terms, function() {
                    if(!$(this).val()){
                        term_format = false;
                    }
                });
                if(!term_format){
                    alertTips('请填写广告形式价格有效期','form_price');return false;
                }
                var that = $(this);
                formAjaxPost($('.data-form'),that);
                return false;
            });

            //地区加载
            @if(isset($info))
                select_region("{{$info['province']}}","{{$info['city']}}","{{$info['district']}}");
            @else
                show_region();
            @endif


             $('.datetimepicker').datetimepicker({
                format:"Y-m-d",      //格式化日期
                todayButton:false,    //关闭选择今天按钮
                minDate:true,
                timepicker:false,    //关闭时间选项
            });
        })
    </script>
@endsection
@section('body')
    <div class="inner_c">
        <div class="weizhi">
            当前位置：<a href="{{ route('netred.index.index') }}">首页</a>>
            <a href="{{ route('netred.star.index') }}">资源管理</a>>
            <span>@if(isset($info))修改@else添加@endif短视频账户</span>
        </div>
        <div class="biao2">
            <form role="form" class="data-form" action="{{ route('netred.star.update') }}" metho="post">
                {{ csrf_field() }}
                @if(isset($info))
                    <input  type="hidden" name="id" value="{{ $info->id }}"/>
                @endif
                <div class="addshoukuan">
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>上传头像：</div>
                        <div class="ren fl" id="avatar" style="width: 115px;height: 145px">
                            <input type="hidden" name="avatar" value="{{ isset($info['avatar']) ? $info['avatar'] : '' }}">
                            <img src="{{ isset($info['avatar']) ? asset($info['avatar']) :asset('assets/member/netred/images/ren.jpg') }}" width="115" height="145"/>
                        </div>
                        <span class="annw fl">
                            <input class="btan" type="button" id="upload" value="选择图片">
                        </span>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>艺名：</div>
                        <div class="textkuang fl">
                            <input type="text" name="stage_name"  value="{{ $info['stage_name'] ?? '' }}" id="stage_name">
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi2 fl"><span>*</span>性别：</div>
                        <div class="raw fl">
                            <input type="radio" id="sex" @if(isset($info['sex']) && ($info['sex'] == 1)) checked @endif @if(!isset($info['sex'])) checked @endif name="sex" value="1"><label for="boy">男</label>
                            <input type="radio" name="sex" @if(isset($info['sex']) && ($info['sex'] == 2)) checked @endif value="2"><label for="girl">女</label>
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>所在地：</div>
                        <div class="sele1 fl">
                            <span id="regoin">
                                <select name="province" id="province" class="province"></select>
                                <select name="city" id="city" class="city"></select>
                                <select name="district" id="district" class="district"></select>
                            </span>
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>所属平台：</div>
                        <div class="sele2 fl">
                            <select name="platform" id="platform">
                                <option value="">请选择所属平台</option>
                                @foreach($platforms as $key=>$platform)
                                    <option @if(isset($info['platform']) && ($info['platform'] == $key)) selected @endif value="{{ $key }}">{{ $platform }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>平台ID：</div>
                        <div class="textkuang fl">
                            <input type="text" name="platform_id" id="platform_id" value="{{ $info['platform_id'] ?? '' }}">
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>粉丝量级：</div>
                        <div class="textkuang fl">
                            <input type="text" name="fans" id="fans" value="{{ $info['fans'] ?? '' }}">
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>平均在线观看人数：</div>
                        <div class="textkuang fl">
                            <input type="text" name="average_num" id="average_num" value="{{ $info['average_num'] ?? '' }}">
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>风格（多选）：</div>
                        <div class="dxk">
                            <div class="dxk_c" id="style">
                                <ul>
                                    @foreach($styles as $key=>$style)
                                        <li>
                                            <input type="checkbox" name="style[]" @if(isset($info['style']) && (in_array('style_'.$key,$info['style']))) checked @endif value="style_{{ $key }}">
                                            <label for="ch1">{{ $style }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>类型选择（多选）：</div>
                        <div class="dxk" id="catids">
                            @foreach($categorys as $category)
                                <div class="kind">
                                    <h5 class="fl">{{ $category['name'] }}：</h5>
                                    @if(isset($category['_child']))
                                        <ul>
                                            @foreach($category['_child'] as $key=>$cate)
                                                <li>
                                                    <input type="checkbox" @if(isset($info['catids']) && (in_array('catid_'.$cate['id'],$info['catids']))) checked @endif  name="catids[]" value="catid_{{ $cate['id'] }}">
                                                    <label for="ch17">{{ $cate['name'] }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="qingchu"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl"><span>*</span>广告形式（多选）：</div>
                        <div class="dxk">
                            <div class="dxk_c" id="form_price">
                                <ul class="adforms">
                                    @foreach($adforms as $key=>$adform)
                                        <li>
                                            <input type="checkbox" @if(isset($info['form_price']) && (array_has($info['form_price'],$key))) checked @endif name="form[]" value="{{ $key }}" title="{{ $adform }}">
                                            <label for="ch49">{{ $adform }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div id="moneys">
                                @if(isset($info))
                                    @foreach($adforms as $key=>$adform)
                                        @if(array_has($info['form_price'],$key))
                                            <div class="form_{{ $key }}">
                                                <div class="kuang fl"><span>{{ $adform }}:价格：</span><input name="money[]" value="{{ $info['form_price'][$key]['price'] }}" type="text"> <span>元</span></div>
                                                <div class="kuang fl"><span>有效期: </span><input name="term[]" type="text" value="{{ $info['form_price'][$key]['term'] }}" placeholder="请选择活动截至时间"  class="datetimepicker"/></div>
                                                <div class="qingchu"></div>
                                            </div>
                                        @else
                                            <div class="form_{{ $key }}" style="display: none">
                                                <div class="kuang fl"><span>{{ $adform }}:价格：</span><input name="money[]" value="" type="text"> <span>元</span></div>
                                                <div class="kuang fl"><span>有效期: </span><input type="text" name="term[]" placeholder="请选择活动截至时间"  class="datetimepicker"/></div>
                                                <div class="qingchu"></div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($adforms as $key=>$adform)
                                        <div class="form_{{ $key }}" style="display: none">
                                            <div class="kuang fl"><span>{{ $adform }}:价格：</span><input name="money[]" value="" type="text"> <span>元</span></div>
                                            <div class="kuang fl"><span>有效期: </span><input type="text" name="term[]" placeholder="请选择活动截至时间"  class="datetimepicker"/></div>
                                            <div class="qingchu"></div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="qingchu"></div>
                    <div class="formdl"><h6><a href="#">点击查看各类型广告术语解释</a></h6></div>
                    <div class="formdl">
                        <div class="formzi fl">接单备注：</div>
                        <div class="wenben fl">
                            <textarea name="note"  id="note" cols="91" rows="5">{{ $info['note'] ?? '' }}</textarea>
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl">资源优势：</div>
                        <div class="wenben fl">
                            <textarea name="advantage"  id="advantage"  cols="91" rows="5">{{ $info['advantage'] ?? '' }}</textarea>
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="formdl">
                        <div class="formzi fl">案例介绍：</div>
                        <div class="wenben fl">
                            <textarea name="introduce" id="introduce" cols="91" rows="5">{{ $info['introduce'] ?? '' }}</textarea>
                        </div>
                        <div class="qingchu"></div>
                    </div>
                    <div class="sub">
                        <input type="hidden" name="type" value="2">
                        <input type="submit" class="ajax-post" value="完成提交">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
