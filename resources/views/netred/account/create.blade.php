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
            <a href="{{ route('netred.account.index') }}">财务中心</a> >
            <a><span>填写收款账户</span></a>
        </div>
        <div class="biao2ti">
            <form role="form" class="data-form" action="{{ route('netred.account.update') }}" method="post">
                {{ csrf_field() }}
                <table width="100%" border="0" cellspacing="10">
                    <tbody>
                    <tr>
                        <td width="20%" align="right"><span class="hong">*</span>账户类型：</td>
                        <td align="left">
                            {!! select('bank_id',$bank,$info['bank_id'] ?? '',['class'=>'textkuangnr']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>账户：</td>
                        <td align="left"><input type="text" name="account" placeholder="请填写账户" id="account" class="textkuangnr" value="{{$info['account'] ?? ''}}"/></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>开户行：</td>
                        <td align="left"><input type="text" name="deposit" id="deposit" placeholder="选择支付宝账户可以不填此项" value="{{$info['deposit'] ?? ''}}" class="textkuangnr"/></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="hong">*</span>开户姓名：</td>
                        <td align="left"><input type="text" name="username" id="username" placeholder="选择支付宝账户可以不填此项" value="{{$info['username'] ?? ''}}" class="textkuangnr"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        @if(isset($info))
                            <input  type="hidden" name="id" value="{{$info['id']}}"/>
                        @endif
                        <td align="left">
                            @if(isset($info))
                                <input type="submit"  value="修改账户" class="suban ajax-post"/>
                            @else
                                <input type="submit"  value="添加账户" class="suban ajax-post"/>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <div class="qingchu"></div>
@endsection
