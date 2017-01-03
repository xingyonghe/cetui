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
    public function create(int $pid)
    {
        $view = view('admin.menu.edit',compact('pid'));
        return $this->ajaxReturn($view->render(),1,'','新增菜单');
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
        $info = D('SysMenu')->find($id);
        $pid = $info['pid'];
        $view = view('admin.menu.edit',compact('info','pid'));
        return $this->ajaxReturn($view->render(),1,'','修改菜单');
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
     * @date 2016-11-16
     */
    public function destroy(int $id){
        $resualt = D('SysMenu')->destroy($id);
        if($resualt){
            cache()->forget('MENUS_LIST');//更新菜单缓存
            session()->forget('ADMIN_MENU_LIST');//更新菜单session
            return redirect()->back()->withSuccess('删除信息成功!');
        }else{
            return redirect()->back()->with('error','删除信息失败');
        }
    }

    /**
     * 批量菜单新增
     * @author xingyonghe
     * @date 2016-11-16
     */
    public function batch(int $pid=0){
        $menus = D('SysMenu')->returnMenus();
        $menus = array_pluck($menus,'title','id');
        if($menus){
            if($pid){
                $up_title = $menus[$pid];
            } else{
                $up_title = '顶级菜单';
            }
        }
        $view = view('admin.menu.batch',compact('pid','up_title'));
        return $this->ajaxReturn($view->render(),1,'','批量新增菜单');
    }

    /**
     * 批量菜单更新
     * @author xingyonghe
     * @date 2016-11-16
     */
    public function submit(){
        $tree = request()->menus;
        $lists = explode(',',str_replace(array("\r\n","\n","\r"),',',$tree));
        if($lists == array('0'=>'')){
            return $this->ajaxReturn('请按格式填写批量导入的至少一条菜单信息');
        }
        foreach ($lists as $key => $item) {
            $record = explode('|', $item);
            D('SysMenu')->create(array(
                'title'=> $record[0],
                'url'  => $record[2],
                'pid'  => request()->pid,
                'sort' => $record[1],
                'hide' => $record[3],
                'icon' => $record[4] ?? '',
                'group'=> $record[5] ?? '',
            ));
        }
        cache()->forget('MENUS_LIST');//更新菜单缓存
        session()->forget('ADMIN_MENU_LIST');//更新菜单session
        return $this->ajaxReturn('菜单批量新增成功',1,url()->previous());
    }

    /**
     * 菜单排序
     * @author: xingyonghe
     * @date: 2016-11-18
     * @param int $pid
     * @return \Illuminate\Http\JsonResponse
     */
    public function sort(int $pid=0){
        $datas = D('SysMenu')->where('pid',$pid)->orderBy('sort','asc')->get()->toArray();
        $view = view('admin.menu.sort',compact('datas'));
        return $this->ajaxReturn($view->render(),1,'','菜单排序');
    }

    /**
     * 更新排序
     * @author: xingyonghe
     * @date: 2016-11-18
     * @return mixed
     */
    public function order(){
        $ids = request()->ids;
        $ids = explode(',', $ids);
        foreach ($ids as $sort=>$id){
            $info = D('SysMenu')->find($id);
            $resualt = $info->update(array('sort'=>$sort+1));
        }
        cache()->forget('MENUS_LIST');//更新菜单缓存
        session()->forget('ADMIN_MENU_LIST');//更新菜单session
        return $this->ajaxReturn('菜单排序更新成功',1,url()->previous());
    }




}
