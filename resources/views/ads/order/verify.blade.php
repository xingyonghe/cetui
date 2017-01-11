<div class="dialog">
    <form role="form" class="form-datas" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="order_sn"  value="{{ $info['order_sn'] }}"/>
        <div class="c_tggl_box">
            <div class="c_tggl_line">
                <div class="c_tggl_left">
                    凭证资料：
                </div>
                <div class="c_tggl_right" style="text-align: left;padding-left: 45px">
                    <div class="images">
                        @foreach($info['images'] as $img)
                            <div class="uploadImg">
                                <img src="{{ $img ?? '/member/netred/img/default_jt.png' }}" width="110" height="110">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="c_tggl_line">
                <div class="c_tggl_left">
                    视频链接：
                </div>
                <div class="c_tggl_right" style="text-align: left;padding-left:45px;line-height:50px">
                    <a target="_blank" href="{{ $info['video_target'] }}">{{ $info['video_target'] }}</a>
                </div>
            </div>
        </div>
    </form>
</div>
