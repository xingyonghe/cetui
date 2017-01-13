<div class="dialog">
    <form role="form" class="form-datas" action="{{ route('ads.netred.post') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="netred_id" value="{{ $id }}" class="width_424"/>
        <div class="c_tggl_box">
            <div class="c_tggl_line">
                <div class="c_tggl_left">
                    <span>*</span>推广需求：
                </div>
                <div class="c_tggl_right" id="catids" style="text-align: left;padding-left: 35px">
                    @foreach($categorys as $key=>$category)
                        <span style="margin-right: 5px">
                            <input type="checkbox" style="" name="catids[]" value="catid_{{ $key }}">{{ $category}}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="c_tggl_line">
                <div class="c_tggl_left">
                    <span>*</span>推广预算：
                </div>
                <div class="c_tggl_right">
                    <input type="text" name="money" id="money" placeholder="请填写您的推广预算" value="" class="width_424"/>
                </div>
            </div>
        </div>
    </form>
</div>
