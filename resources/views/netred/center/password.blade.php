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
        <div class="biao2kuan">
            <table width="100%" border="0" cellspacing="10">
                <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <div class="main_nav">
                            <ul>
                                <li><a href="{{ route('netred.center.index') }}">基本信息</a></li>
                                <li class="cur"><a href="{{ route('netred.center.password') }}">修改密码</a></li>
                            </ul>
                        </div></td>
                </tr>
                <form role="form" class="data-form" action="{{ route('netred.center.reset') }}" method="post">
                    {{ csrf_field() }}
                <tr>
                    <td>原始密码：</td>
                    <td align="left">
                        <input type="password" class="textkuang"  id="password-old" name="password-old" placeholder="请输入旧密码" value="">
                    </td>
                </tr>
                <tr>
                    <td>新的密码：</td>
                    <td align="left">
                        <input type="password" class="textkuang"  id="password"  name="password" placeholder="请输入新密码" value="">
                    </td>
                </tr>
                <tr>
                    <td>确认新的密码</td>
                    <td align="left">
                        <input id="password-confirm" class="textkuang"   type="password" name="password_confirmation" placeholder="确认新密码" value="">
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="left"><input type="button" id="button" value="提交"  class="sub ajax-post"/></td>
                </tr>
                </form>
                </tbody>
            </table>
        </div>
    </div>
@endsection