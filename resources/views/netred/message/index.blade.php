@extends('netred.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('.ajax-post').click(function(){
                var that = $(this);
                formAjaxPost($('.data-form'),that);
                return false;
            });
        })
    </script>
@endsection
@section('body')
    <div class="inner_c">
        <div class="weizhi">当前位置：
            <a href="{{ route('netred.index.index') }}">首页</a> >
            <a>信息中心</a></div>
        <div class="biao">
            <table width="100%" border="0" cellspacing="0">
                <tbody>
                <tr class="biaotou">
                    <td>类型</td>
                    <td>信息标题</td>
                    <td>时间</td>
                </tr>
                <tr>
                    <td  class="biaorongmo">公告</td>
                    <td  class="biaorongmo"><a href="{{ route('netred.message.show',[1]) }}">服务器今晚更新维护，网站暂时无法访问</a></td>
                    <td class="biaorongmo">2016.11.30</td>
                </tr>
                <tr>
                    <td class="biaorong">站内信</td>
                    <td class="biaorong"><a href="{{ route('netred.message.show',[1]) }}">您的投标已经被采纳，请查看订单</a></td>
                    <td class="biaorong">2016.11.30</td>
                </tr>
                <tr>
                    <td class="biaorong">公告</td>
                    <td class="biaorong"><a href="{{ route('netred.message.show',[1]) }}">服务器今晚更新</a></td>
                    <td class="biaorong">2016.11.30</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
