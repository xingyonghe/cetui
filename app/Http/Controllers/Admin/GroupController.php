<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthGroupRequest;
use App\Models\AdminAuthGroup;
use App\Models\AdminAuthRule;
use App\Models\AdminMenu;

class GroupController extends Controller
{

    /**
     * 部门列表
     * @author: xingyonghe
     * @date: 2017-1-13
     * @return mixed
     */
    public function index()
    {
        $lists = AdminAuthGroup::select(['id', 'title', 'description', 'status'])
            ->orderBy('id', 'asc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);

        $this->intToString($lists,array(
            'status' => AdminAuthGroup::STATUS_TEXT
        ));

        return view('admin.group.index',compact('lists'));
    }

    /**
     * 新增
     * @author: xingyonghe
     * @date: 2017-1-13
     * @return
     */
    public function create()
    {
        $view = view('admin.group.edit');
        return $this->ajaxReturn($view->render(),1,'','新增部门');
    }

    /**
     * 编辑
     * @author: xingyonghe
     * @date: 2017-1-13
     * @param int $id
     * @return
     */
    public function edit(int $id)
    {
        $info = AdminAuthGroup::where('id','>',1)->find($id);
        $view = view('admin.group.edit',compact('info'));
        return $this->ajaxReturn($view->render(),1,'','编辑部门');
    }

    /**
     * 更新
     * @author: xingyonghe
     * @date: 2017-1-13
     * @param AuthGroupRequest $request
     * @return
     */
    public function update(AuthGroupRequest $request)
    {
        $resault = AdminAuthGroup::updateData($request->all());
        if($resault){
            return $this->ajaxReturn(isset($resault['id'])?'部门信息修改成功':'部门信息新增成功',0,url()->previous());
        }else{
            return $this->ajaxReturn('操作失败');
        }
    }

    /**
     * 删除
     * @author: xingyonghe
     * @date: 2017-1-13
     * @param $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $resault = AdminAuthGroup::where('id','>',1)->where('id',$id)->delete();
        if($resault){
            cache()->forget('GROUP_LIST');
            return redirect()->back()->withSuccess('删除部门信息成功!');
        }else{
            return redirect()->back()->withErrors('删除部门信息失败');
        }
    }

    /**
     * 授权
     * @author: xingyonghe
     * @date: 2017-1-13
     * @param $id 用户组ID
     * @return mixed
     */
    public function access(int $id)
    {
        //把菜单节点更新到权限节点表中
        AdminAuthRule::updateRules();
        //所有菜单
        $nodeList   = AdminMenu::returnNodes();

        //url节点
        $childRules = AdminAuthRule::getRules(AdminAuthRule::RULE_URL);
        $childRules = array_pluck($childRules,'id','name');

        //主菜单节点
        $mainRules = AdminAuthRule::getRules(AdminAuthRule::RULE_MAIN);
        $mainRules = array_pluck($mainRules,'id','name');
//        dump($childRules);dump($mainRules);dd($nodeList);
        //已设置的组权限
        $data = AdminAuthGroup::select('rules')->findOrFail($id)->toArray();
        $thisRules = json_encode($data['rules']);

        $groupId = $id;
        return view('admin.group.access',compact('nodeList','mainRules','childRules','groupId','thisRules'));
    }

    /**
     * 更新权限组
     * @author: xingyonghe
     * @date: 2017-1-13
     * @param Request $request
     * @return
     */
    public function write()
    {
        $rules = request()->rules;
        $id    = request()->id;
        $info = AdminAuthGroup::findOrFail($id);
        $resault = $info->update(array('rules'=>$rules));
        if($resault){
            return redirect(route('admin.group.index'))->withSuccess('更新用户组权限成功!');
        }else{
            return redirect()->back()->with('error','更新用户组权限失败');
        }
    }




}
