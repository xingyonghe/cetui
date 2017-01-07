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
                            updateAlert(resault.error);
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

            //地区加载
            @if(isset($info))
                select_region("{{$info['province']}}","{{$info['city']}}","{{$info['district']}}");
            @else
                show_region();
            @endif

            //加载日期
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
        <div class="biao2ti">
            <form role="form" class="data-form" action="{{ route('netred.star.update') }}" method="post">
                {{ csrf_field() }}
                @if(isset($info))
                    <input  type="hidden" name="id" value="{{ $info->id }}"/>
                @endif
                <table width="100%" border="0" cellspacing="10">
                    <tbody>
                    <tr>
                        <td width="20%" align="right"><span class="hong">*</span>上传头像：</td>
                        <td width="100" align="left" id="avatar">
                            <input type="hidden" name="avatar" value="{{ isset($info['avatar']) ? $info['avatar'] : '' }}">
                            <img src="{{ isset($info['avatar']) ? asset($info['avatar']) : '/member/netred/images/ren.jpg' }}" width="115" height="145"/>
                        </td>
                        <td align="left">
                            <input class="btancc" type="button" id="upload" value="选择图片">
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>艺名：</td>
                        <td colspan="2" align="left">
                            <input type="text" name="stage_name"  value="{{ $info['stage_name'] ?? '' }}" id="stage_name" class="textkuangnr">
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>姓别：</td>
                        <td colspan="2" align="left">
                            <input type="radio" id="sex" @if(isset($info['sex']) && ($info['sex'] == 1)) checked @endif @if(!isset($info['sex'])) checked @endif name="sex" value="1">
                            <label for="radio">男</label>
                            <input type="radio" name="sex" @if(isset($info['sex']) && ($info['sex'] == 2)) checked @endif value="2">
                            <label for="radio">女</label>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>所在地：</td>
                        <td colspan="2" align="left">
                        <span id="regoin">
                            <select name="province" id="province" class="province wkyang"></select>
                            <select name="city" id="city" class="city wkyang"></select>
                            <select name="district" id="district" class="district wkyang"></select>
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>所属平台：</td>
                        <td colspan="2" align="left">
                            <select name="platform_id" id="platform_id" class="dakuan">
                                <option value="">请选择所属平台</option>
                                @foreach($platforms as $key=>$platform)
                                    <option @if(isset($info['platform_id']) && ($info['platform_id'] == $key)) selected @endif value="{{ $key }}">{{ $platform }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>平台ID：</td>
                        <td colspan="2" align="left">
                            <input type="text" name="form_id" id="form_id" value="{{ $info['form_id'] ?? '' }}"  class="textkuangnr">
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>粉丝量级：</td>
                        <td colspan="2" align="left">
                            <input type="text" name="fans" id="fans" value="{{ $info['fans'] ?? '' }}"  class="textkuangnr">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">最高观看人数：</td>
                        <td colspan="2" align="left">
                            <input type="text" name="max_num" id="max_num" value="{{ $info['max_num'] ?? '' }}"  class="textkuangnr">
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>风格（多选）：</td>
                        <td colspan="2" align="left"><div class="daxk" id="style">
                                @foreach($styles as $key=>$style)
                                    <input type="checkbox" name="style[]" @if(isset($info['style']) && (in_array('style_'.$key,$info['style']))) checked @endif value="style_{{ $key }}" />
                                    <label for="ch19">{{ $style }}</label>
                                @endforeach
                            </div></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>类型选择（多选）：</td>
                        <td colspan="2" align="left">
                            <div class="daxk" id="catids">
                                @foreach($categorys as $category)
                                    <div class="baikk">
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr>
                                                <td width="50" align="left" valign="top">{{ $category['name'] }}：</td>
                                                <td>
                                                    @if(isset($category['_child']))
                                                        @foreach($category['_child'] as $key=>$cate)
                                                            <input type="checkbox" @if(isset($info['catids']) && (in_array('catid_'.$cate['id'],$info['catids']))) checked @endif  name="catids[]" value="catid_{{ $cate['id'] }}" />
                                                            <label for="checkbox17">{{ $cate['name'] }}</label>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>广告形式（多选）：</td>
                        <td colspan="2" align="left">
                            <div class="daxk" id="form">
                                @foreach($adforms as $key=>$adform)
                                    <input type="checkbox" @if(isset($info['form']) && (in_array('form_'.$key,$info['form']))) checked @endif name="form[]" value="form_{{ $key }}" title="{{ $adform }}" />
                                    <label for="checkbox48">{{ $adform }}</label>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">&nbsp;</td>
                        <td colspan="2" align="left" class="duowen"><a href="javascript:viod(0)">点击查看各类型广告术语解释</a></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>参考报价：</td>
                        <td colspan="2" align="left">
                            <input type="text" name="money" id="money" value="{{ $info['money'] ?? '' }}"  class="textkuangnr">
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>价格有效期：</td>
                        <td colspan="2" align="left">
                            <input type="text" name="term_time" id="term_time" value="{{ isset($info['term_time']) ? $info['term_time']->format('Y-m-d') : '' }}"  class="textkuangnr datetimepicker">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">接单备注：</td>
                        <td colspan="2" align="left">
                            <textarea name="note" id="note" cols="45" rows="5" class="wenbenkys">{{ $info['note'] ?? '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">资源优惠：</td>
                        <td colspan="2" align="left">
                            <textarea name="advantage" id="advantage" cols="45" rows="5" class="wenbenkys">{{ $info['advantage'] ?? '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">案例介绍：</td>
                        <td colspan="2" align="left">
                            <textarea name="introduce" id="introduce" cols="45" rows="5" class="wenbenkys">{{ $info['introduce'] ?? '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2">
                            <input type="hidden" name="type" value="2">
                            <input type="submit" class="ajax-post suban" value="完成提交">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <div class="qingchu"></div>
@endsection
