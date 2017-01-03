<style type="text/css">
    .sort_center .sort_option{
        width: 200px;  float: left
    }
    .sort_center .sort_option select{
        height: 350px;
    }
    .sort_center .sort_btn{
        float: left;  width: 100px;
    }
    .sort_center .sort_btn .btn{
        margin-bottom:5px
    }
</style>
<div class="sort">
    {!! Form::open(['url' => route('admin.menu.order'),'class'=>'cmxform form-horizontal tasi-form form-sort']) !!}
        <div class="sort_center" >
            <div class="sort_option">
                <select multiple class="form-control select">
                    @foreach($datas as $data)
                        <option class="sortids" title="{{ $data['title'] }}" value="{{ $data['id'] }}">{{ $data['title'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sort_btn">
                <button class="top btn btn-primary" type="button">第 一</button>
                <button class="up btn btn-primary" type="button">上 移</button>
                <button class="down btn btn-primary" type="button">下 移</button>
                <button class="bottom btn btn-primary" type="button">最 后</button>
            </div>
        </div>
        <div class="sort_bottom">
            <input type="hidden" name="ids">
        </div>
    {!!Form::close()!!}
</div>
<script type="text/javascript">
    $(function(){
        sort();
        $(".top").click(function(){
            rest();
            $(".sortids:selected").prependTo(".select");
            sort();
        })
        $(".bottom").click(function(){
            rest();
            $(".sortids:selected").appendTo(".select");
            sort();
        })
        $(".up").click(function(){
            rest();
            $(".sortids:selected").after($(".sortids:selected").prev());
            sort();
        })
        $(".down").click(function(){
            rest();
            $(".sortids:selected").before($(".sortids:selected").next());
            sort();
        })
        function sort(){
            $('.sortids').text(function(){
                return ($(this).index()+1)+'.'+$(this).text();
            });
        }
        //重置所有option文字。
        function rest(){
            $('.sortids').text(function(){
                return $(this).text().split('.')[1]
            });
        }
    })
</script>