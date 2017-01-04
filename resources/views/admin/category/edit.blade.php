<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class=" form">
                    {!! Form::open(['url' => route('article.category.update'),'class'=>'cmxform form-horizontal tasi-form form-datas']) !!}
                    <input class="form-control "  type="hidden" name="id" value="{{ $info['id'] ?? '' }}"/>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">名称</label>
                        <div class="col-lg-10">
                            <input class=" form-control" placeholder="分类标题名称" name="name" type="text" value="{{ $info['name'] ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">排序</label>
                        <div class="col-lg-10">
                            <input class="form-control " placeholder="分类显示的顺序"  type="text" name="sort" value="{{ $info['sort'] ?? 0 }}"/>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">模块分组</label>
                        <div class="col-lg-10">
                            <input class="form-control " type="hidden" name="model" value="{{ $info['model'] ?? $model }}" readonly/>
                            <span class="control-label col-lg-2" style="padding-left: 0px">{{ $module[$model] }}</span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">上级菜单</label>
                        <div class="col-lg-10">
                            <select class="form-control m-bot15" name="pid">
                            @foreach($menus as $menu)
                                <option value="{{ $menu['id'] }}" @if(isset($info['pid']) && $info['pid']==$menu['id']) selected @endif>{{ $menu['title_show'] }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </section>
    </div>
</div>