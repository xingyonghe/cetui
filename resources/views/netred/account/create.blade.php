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
    <div class="container marTB_15">
        <div class="width_1140">
            <div class="c_route">
                当前位置：
                <a href="{{ route('netred.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('netred.account.index') }}"><span>账户中心</span></a> >
                @if(isset($info))
                    <a href="{{ route('netred.account.edit',[$info['id']]) }}"><span class="on">修改账户</span></a>
                @else
                    <a href="{{ route('netred.account.create') }}"><span class="on">添加账户</span></a>
                @endif

            </div>
            <div class="c_box">
                <form role="form" class="data-form" action="{{ route('netred.account.update') }}" method="post">
                    {{ csrf_field() }}
                    @if(isset($info))
                        <input  type="hidden" name="id" value="{{ $info->id }}"/>
                    @endif
                    <div class="c_tggl_box">
                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>账户类型：
                            </div>
                            <div class="c_tggl_right">
                                {!! select('bank_id',$bank,$info['bank_id'] ?? '',['class'=>'width_276']) !!}
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>账户：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="account" placeholder="请填写账户" id="account" class="width_424" value="{{$info['account'] ?? ''}}"/>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>开户行：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="deposit" id="deposit" placeholder="选择支付宝账户可以不填此项" value="{{$info['deposit'] ?? ''}}" class="width_424"/>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left">
                                <span>*</span>开户姓名：
                            </div>
                            <div class="c_tggl_right">
                                <input type="text" name="username" id="username" placeholder="选择支付宝账户可以不填此项" value="{{$info['username'] ?? ''}}" class="width_424"/>
                            </div>
                        </div>

                        <div class="c_tggl_line">
                            <div class="c_tggl_left"></div>
                            <div class="c_tggl_right">
                                @if(isset($info))
                                    <button class="width_424 ajax-post">修改账户</button>
                                @else
                                    <button class="width_424 ajax-post">添加账户</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
