@extends('netred.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">

    </script>
@endsection
@section('body')
    <div class="container marTB_15">
        <div class="width_1140">
            <div class="c_route">
                当前位置：
                <a href="{{ route('netred.index.index') }}"><span>首页</span></a> >
                <a href="{{ route('netred.center.index') }}"><span>个人中心</span></a> >
                <a href="{{ route('netred.center.certified') }}"><span class="on">认证资料</span></a>

            </div>
            <div class="c_box">

                <div class="c_tggl_box">
                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>真实姓名：
                        </div>
                        <div class="c_tggl_right">
                            <input class="width_424"  readonly  value="{{ $info['truename'] ?? '' }}" />
                        </div>
                    </div>
                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>身份证号：
                        </div>
                        <div class="c_tggl_right">
                            <input class="width_424" readonly  value="{{ $info['vcard'] ?? '' }}"  />
                        </div>
                    </div>
                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>身份证正面：
                        </div>
                        <div class="c_tggl_right">
                            <div class="uploadBox">
                            <span class="uploadImg" >
                                <img src="{{ $info['vcard_face'] ?? '/member/ads/img/product_logo.png' }}"  width="115" height="145"/>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="c_tggl_line">
                        <div class="c_tggl_left">
                            <span>*</span>身份证反面：
                        </div>
                        <div class="c_tggl_right">
                            <div class="uploadBox">
                            <span class="uploadImg" >
                                <img src="{{ $info['vcard_con'] ?? '/member/ads/img/product_logo.png' }}" width="115" height="145"/>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection