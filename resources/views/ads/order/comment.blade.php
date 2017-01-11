<div class="dialog">
    <form role="form" action="{{ route('ads.order.send') }}" class="form-datas" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="order_sn"  value="{{ $id }}"/>
        <div style="text-align: left;padding-left:100px">
            请对改网红进行打分：
            <div id="star" style="padding: 10px 20px"></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('#star').raty();
    })
</script>
