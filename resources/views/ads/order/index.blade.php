@extends('ads.layouts.base')
@section('styles')
    <link href="{{ asset('static/datetimepicker/datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{ asset('static/datetimepicker/jquery.datetimepicker.full.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $.datetimepicker.setLocale('ch');
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
        })
    </script>
@endsection
@section('body')
    <div class="container">
        <div class="width_1140">
            <div class="c_box bgColor_f9f9f9">
                <div class="c_box2">
                    <span>订单类型：全部订单</span>
                    <div class="c_box2Right">
                        时间：
                        <input type="text" name="start_time" id="start_time"/>
                        <span> - </span>
                        <input type="text" name="start_time" id="end_time"/>
                        <button class="search"></button>
                    </div>
                    <div class="c_box2Right marRight_20">
                        订单ID：
                        <input type="text" />
                    </div>
                </div>
            </div>
            <p class="c_mark">共计：3 个订单</p>
            <div class="c_box">
                <div class="c_box3">
                    <table cellpadding="0" cellspacing="0">
                        <thead class="bgColor_f9f9f9">
                        <th>订单ID</th>
                        <th>订单日期</th>
                        <th>截止时间</th>
                        <th>活动名称</th>
                        <th>媒体类型</th>
                        <th>媒体名称</th>
                        <th>网红名称</th>
                        <th>广告形式</th>
                        <th>订单金额</th>
                        <th>订单状态</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                001
                                <span class="left_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                            <td>2016.12.13</td>
                            <td>2018.12.13</td>
                            <td>梦幻西游</td>
                            <td>直播</td>
                            <td>斗鱼</td>
                            <td>密子君</td>
                            <td>品牌植入</td>
                            <td>5000元</td>
                            <td class="text-danger">
                                进行中
                                <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                001
                                <span class="left_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                            <td>2016.12.13</td>
                            <td>2018.12.13</td>
                            <td>梦幻西游</td>
                            <td>直播</td>
                            <td>斗鱼</td>
                            <td>密子君</td>
                            <td>品牌植入</td>
                            <td>5000元</td>
                            <td>
                                已完成
                                <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                001
                                <span class="left_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                            <td>2016.12.13</td>
                            <td>2018.12.13</td>
                            <td>梦幻西游</td>
                            <td>直播</td>
                            <td>斗鱼</td>
                            <td>密子君</td>
                            <td>品牌植入</td>
                            <td>5000元</td>
                            <td class="text-danger">
                                进行中
                                <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                001
                                <span class="left_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                            <td>2016.12.13</td>
                            <td>2018.12.13</td>
                            <td>梦幻西游</td>
                            <td>直播</td>
                            <td>斗鱼</td>
                            <td>密子君</td>
                            <td>品牌植入</td>
                            <td>5000元</td>
                            <td>
                                已完成
                                <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                001
                                <span class="left_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                            <td>2016.12.13</td>
                            <td>2018.12.13</td>
                            <td>梦幻西游</td>
                            <td>直播</td>
                            <td>斗鱼</td>
                            <td>密子君</td>
                            <td>品牌植入</td>
                            <td>5000元</td>
                            <td>
                                已完成
                                <span class="right_bgFFF"></span><!-- 只是控制样式，不能删除 -->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
