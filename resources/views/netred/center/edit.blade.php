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
        <div class="biao2ti">
            <form role="form" class="data-form" action="{{ route('netred.center.update') }}" method="post">
                {{ csrf_field() }}
            <table width="100%" border="0" cellspacing="10">
                <tbody>
                <tr>
                    <td></td>
                    <td><div class="denglukky">
                            <ul>
                                <li class="cur"><a href="{{ route('netred.center.index') }}">基本信息</a></li>
                                <li><a href="{{ route('netred.center.password') }}">修改密码</a></li>
                            </ul>
                        </div></td>
                </tr>
                <tr>
                    <td width="20%" align="right"><span class="hong">*</span>手机号：</td>
                    <td align="left">
                        <input class="textkuangnr" disabled value="{{ $user->username }}" type="text"/>@if($user->is_auth)已认证@else未认证@endif
                    </td>
                </tr>
                <tr>
                    <td align="right"><span class="hong">*</span>联系人姓名：</td>
                    <td align="left">
                        <input  name="nickname" id="nickname" value="{{ $user->nickname }}" type="text" class="textkuangnr"/>
                    </td>
                </tr>
                <tr>
                    <td align="right"><span class="hong">*</span>微信：</td>
                    <td align="left">
                        <input  name="weixin"  id="weixin"  value="{{ $user->weixin }}" type="text" class="textkuangnr"/>
                    </td>
                </tr>
                <tr>
                    <td align="right"><span class="hong">*</span>邮箱：</td>
                    <td align="left">
                        <input  name="email" id="email" value="{{ $user->email }}" type="text" class="textkuangnr"/>
                    </td>
                </tr>
                <tr>
                    <td align="right"><span class="hong">*</span>QQ：</td>
                    <td align="left">
                        <input  name="qq" id="qq" value="{{ $user->qq }}" type="text" class="textkuangnr"/>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="left">
                        <input  class="suban ajax-post"  type="submit"  value="修改并保存"/>
                    </td>
                </tr>
                </tbody>
            </table>
            </form>
        </div>
    </div>
@endsection
