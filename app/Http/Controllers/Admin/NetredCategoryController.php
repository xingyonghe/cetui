<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;//公用控制器

class NetredCategoryController extends Controller
{
    protected $model = 'netred';
    public function __construct(){
        view()->composer(['admin.category.edit'],function($view){
            //模块分组
            $view->with('module',parse_config_attr(C('CONFIG_MODULE_LIST')));
        });
    }

    /**
     * 分类列表
     * @author: xingyonghe
     * @date: 2016-12-24
     * @return mixed
     */
    public function index(){
        $model = $this->model;
        $lists = D('Category')->getCategory($model);
        $lists = list_to_tree($lists);
        return view('admin.category.index',compact('lists','model'));
    }


    /**
     * 新增分类
     * @author: xingyonghe
     * @date: 2016-12-24
     * @return
     */
    public function create(){
        $model = $this->model;
        $menus = D('Category')->getMenu($model);
        $view = view('admin.category.edit',compact('model','menus'));
        return $this->ajaxReturn($view->render(),1,'','新增分类');
    }

    /**
     * 编辑分类
     * @author: xingyonghe
     * @date: 2016-12-24
     * @param $id
     * @return
     */
    public function edit(int $id){
        $model = $this->model;
        $info = D('Category')->find($id);
        $menus = D('Category')->getMenu($model);
        $view = view('admin.category.edit',compact('model','menus','info'));
        return $this->ajaxReturn($view->render(),1,'','编辑分类');
    }


    /**
     * 新增/更新分类
     * @author: xingyonghe
     * @date: 2016-12-24
     * @return
     */
    public function update(){
        if(empty(request()->name)){
            return $this->ajaxReturn('请填写分类名称');
        }
        $resualt = D('Category')->updateData(request()->all());
        if($resualt){
            cache()->forget('CATEGORY_LIST.'.$resualt['model']);
            return $this->ajaxReturn(isset($resualt['id'])?'修改分类成功!':'新增分类成功!',1,url()->previous());
        }else{
            return $this->ajaxReturn(D('Category')->getError());
        }
    }

    /**
     * 根据ID彻底删除分类
     * @author: xingyonghe
     * @date: 2016-12-24
     * @param $id
     * @return mixed
     */
    public function destroy(int $id){
        $info = D('Category')->find($id);
        $resualt = $info->destroy($id);
        if($resualt){
            cache()->forget('CATEGORY_LIST.'.$info['model']);
            return redirect()->back()->withSuccess('删除成功!');
        }else{
            return redirect()->back()->with('error','删除失败');
        }
    }





}
