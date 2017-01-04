<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminMenu;
use App\Http\Requests\MenuRequest;

/**
 * 系统菜单控制器
 * Class MenuController
 * @package App\Http\Controllers\Admin
 */
class MenuController extends Controller
{

    public function __construct(){
        view()->composer(['admin.menu.edit'],function($view){
            $view->with('menus',AdminMenu::getMenus())
            ->with('awesome',json_encode(array_chunk(config('awesome'), 5)));
        });
    }

    /**
     * 菜单列表
     * @author xingyonghe
     * @date 2017-1-3
     * @return
     */
    public function index()
    {
        $pid = (int)request()->get('pid',0);
        $lists = AdminMenu::where('pid',$pid)
            ->orderBy('sort','asc')
            ->get(['id', 'title', 'pid', 'sort', 'url', 'hide', 'group','name'])
            ->toArray();
        foreach($lists as $key=>&$val){
            if($val['pid']){
                $val['up_title'] = get_menu($val['pid']);
            } else{
                $val['up_title'] = '无';
            }
        }
        $this->intToString($lists,['hide'=>[1=>'隐藏',0=>'显示']]);
        return view('admin.menu.index',compact('lists','pid'));
    }

    /**
     * 菜单新增
     * @author xingyonghe
     * @date 2017-1-3
     * @param int $pid 上级菜单ID
     * @return
     */
    public function create(int $pid=0)
    {
        $view = view('admin.menu.edit',compact('pid'));
        return $this->ajaxReturn($view->render(),0,'','新增菜单');
    }

    /**
     * 菜单修改
     * @author xingyonghe
     * @date 2017-1-3
     * @param int $id
     * @return
     */
    public function edit(int $id)
    {
        $info = AdminMenu::find($id);
        $pid = $info['pid'];
        $view = view('admin.menu.edit',compact('info','pid'));
        return $this->ajaxReturn($view->render(),0,'','修改菜单');
    }

    /**
     * 菜单更新
     * @author xingyonghe
     * @date 2017-1-3
     * @param MenuRequest $request
     * @return
     */
    public function update(MenuRequest $request){
        $resualt = AdminMenu::updateData($request->all());
        if($resualt){
            return $this->ajaxReturn(isset($resualt['id'])?'菜单信息修改成功':'菜单信息新增成功',0,url()->previous());
        }else{
            return $this->ajaxReturn('数据信息操作失败');
        }
    }

    /**
     * 菜单删除
     * @author xingyonghe
     * @date 2016-7-3
     * @return
     */
    public function destroy(int $id){
        $resualt = AdminMenu::destroy($id);
        if($resualt){
            return redirect()->back()->withSuccess('删除信息成功!');
        }else{
            return redirect()->back()->withErrors('删除信息失败');
        }
    }


    /**
     * 菜单排序
     * @author: xingyonghe
     * @date: 2016-7-4
     * @param int $pid
     * @return
     */
    public function sort(int $pid=0){
        $datas = AdminMenu::where('pid',$pid)->orderBy('sort','asc')->get()->toArray();
        $view = view('admin.menu.sort',compact('datas'));
        return $this->ajaxReturn($view->render(),0,'','菜单排序');
    }

    /**
     * 更新排序
     * @author: xingyonghe
     * @date: 2016-7-4
     * @return mixed
     */
    public function order(){
        $data = request()->only('ids');
        $ids = explode(',', $data['ids']);
        foreach ($ids as $sort=>$id){
            $info = AdminMenu::find($id);
            $resualt = $info->update(array('sort'=>$sort+1));
        }
        return $this->ajaxReturn('菜单排序更新成功',0,url()->previous());
    }




}
