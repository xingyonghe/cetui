<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    <form method="post" action="{{ route('admin.menu.update') }}" class="cmxform form-horizontal form-datas">
                        {{ csrf_field() }}

                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">标题</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-pencil"></i></span>
                                <input class="form-control" placeholder="用于后台显示的配置标题" name="title" type="text" value="{{$info['title'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">排序</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-sort-by-order"></i></span>
                                <input  class="form-control" placeholder="用户分组显示的顺序"  type="text" name="sort" value="{{$info['sort'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">链接</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-link"></i></span>
                                <input  class="form-control" placeholder="后台菜单别名" type="text" name="url" value="{{$info['url'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">上级菜单</label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" name="pid">
                                    {{--@foreach($menus as $menu)--}}
                                        {{--<option value="{{ $menu['id'] }}" @if($pid==$menu['id']) selected @endif>{{$menu['title_show']}}</option>--}}
                                    {{--@endforeach--}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">是否隐藏</label>
                            <div class="col-lg-10 radios has-js">
                                {!! radio('hide',[0=>'显示',1=>'隐藏'],$info['hide'] ?? 0) !!}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">样式图标</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <div id="awesome" style="display: none"></div>
                                <span class="input-group-addon" id="icon-tag"><i class="icon-tag"></i></span>
                                <input  class="form-control" id="icon" placeholder="请选择菜单修饰图标" type="text" name="icon" value="{{ $info['icon'] ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-2">分组</label>
                            <div class="input-group m-bot15 col-lg-10">
                                <span class="input-group-addon"><i class="icon-bookmark"></i></span>
                                <input  class="form-control" placeholder="用于左侧分组的二级菜单" type="text" name="group" value="{{$info['group'] ?? ''}}">
                            </div>
                        </div>
                        <input  type="hidden" name="id" value="{{$info['id'] ?? ''}}"/>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
$(function(){
    var awesomes = $.parseJSON('{!! $awesome !!}');
    var code = '<table>';
    for(i =0;i<awesomes.length;i++){
        code += '<tr>';
        for(j =0;j<awesomes[i].length;j++){
            code += '<td style="padding: 5px"><span class="btn btn-white btn-xs awesome"><a class="'+awesomes[i][j]+'" role="button"></a></span></td>';
        }
        code += '</tr>';
    }
    code += '</table>';
    $('#awesome').html(code);
    $('#icon').focus(function(){
        $('#awesome').show();
    });

    $('body').on('click','.awesome',function(){
        var icon = $(this).find('a').attr('class');
        $('#icon').val(icon);
        $('#icon-tag').find('i').remove();
        $('#icon-tag').html('<i class="'+icon+'"></i>');
        $('#awesome').hide();
    })

})
</script>