<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use App\Models\AdminAuthGroup;
use App\Models\AdminUser;
use App\Models\SysAdmin;


class CustomController extends Controller
{


    public function __construct()
    {
        view()->composer(['admin.custom.edit','admin.custom.create'],function($view){
            $view->with('admin_type',AdminUser::TYPE_TEXT);
        });

    }

    /**
     * 列表
     * @author xingyonghe
     * @date 2016-11-15
     * @return
     */
    public function index()
    {
        $username = (string)request()->get('username','');
        $nickname = (string)request()->get('nickname','');
        $lists = AdminUser::select(['id', 'username', 'nickname', 'role_id', 'status', 'reg_time', 'login_time','login_ip','type','qq'])
            ->whereIn('status',[AdminUser::STATUS_LOCK,AdminUser::STATUS_NORMAL])
            ->where(function ($query) use($username){
                if($username){
                    $query->where('username','like','%'.$username.'%');
                }
            })
            ->where(function ($query) use($nickname){
                if($nickname){
                    $query->where('nickname','like','%'.$nickname.'%');
                }
            })
            ->orderBy('reg_time', 'desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        $groups = AdminAuthGroup::getGroup()->toArray();
        $groups = array_add($groups,0,'无');
        $groups = array_add($groups,1,'超级管理员');

        $this->intToString($lists,array(
            'status' => AdminUser::STATUS_TEXT,
            'type'   => AdminUser::TYPE_TEXT,
            'role_id'=> $groups
        ));

        $params = array(
            'username' => $username,
            'nickname' => $nickname
        );
        return view('admin.custom.index',compact('lists','params'));
    }

    /**
     * 新增
     * @author xingyonghe
     * @date 2016-11-16
     * @return
     */
    public function create()
    {
        $groups = AdminAuthGroup::getGroup();
        $view = view('admin.custom.create',compact('groups'));
        return $this->ajaxReturn($view->render(),1,'','新增客服账号');
    }

    /**
     * 添加
     * @author xingyonghe
     * @date 2016-11-16
     * @param AdminRequest $request
     * @return
     */
    public function add(AdminUserRequest $request)
    {
        $info = AdminUser::where(array(['username','=',$request->username],['status','>','-1']))->first();
        if(!empty($info)){
            return $this->ajaxReturn('客服账号已存在');
        }
        $resault = AdminUser::updateData($request->all());
        if($resault){
            return $this->ajaxReturn('客服信息添加成功',1,url()->previous());
        }else{
            return $this->ajaxReturn('客服信息添加失败');
        }
    }

    /**
     * 修改
     * @author xingyonghe
     * @date 2016-11-16
     * @param int $id
     * @return
     */
    public function edit(int $id)
    {
        $info = AdminUser::find($id);
        $groups = AdminAuthGroup::getGroup();
        $view = view('admin.custom.edit',compact('info','groups'));
        return $this->ajaxReturn($view->render(),1,'','编辑客服账号');
    }

    /**
     * 更新
     * @author: xingyonghe
     * @date: 2016-11-16
     * @param MenuRequest $request
     * @return mixed
     */
    public function update(){
        $resault = AdminUser::updateData(request()->only(['nickname','role_id','id','status','type','qq']));
        if($resault){
            return $this->ajaxReturn('修改客服信息新增成功',1,url()->previous());
        }else{
            return $this->ajaxReturn('修改客服信息新增失败');
        }
    }

    /**
     * 删除（-1）
     * @author: xingyonghe
     * @date: 2016-11-16
     * @param $id
     * @return mixed
     */
    public function destroy(int $id){
        $info = AdminUser::findOrFail($id);
        $resualt = $info->update(['status'=>-1]);
        if($resualt){
            return redirect()->back()->withSuccess('删除客服信息成功!');
        }else{
            return redirect()->back()->with('error','删除客服信息失败');
        }
    }

    /**
     * 禁用，状态变为0
     * @author: xingyonghe
     * @date: 2016-11-16
     * @param $id
     * @return mixed
     */
    public function forbid(int $id){
        $info = AdminUser::findOrFail($id);
        $resualt = $info->update(['status'=>0]);
        if($resualt){
            return redirect()->back()->withSuccess('禁用客服信息成功!');
        }else{
            return redirect()->back()->with('error','禁用客服信息失败');
        }
    }

    /**
     * 启用，状态变为1
     * @author: xingyonghe
     * @date: 2016-11-16
     * @param $id
     * @return mixed
     */
    public function resume(int $id){
        $info = AdminUser::findOrFail($id);
        $resualt = $info->update(['status'=>1]);
        if($resualt){
            return redirect()->back()->withSuccess('启用客服信息成功!');
        }else{
            return redirect()->back()->with('error','启用客服信息失败');
        }
    }

    /**
     * 重置密码
     * @return mixed
     */
    public function resetpass(){
        return view('admin.custom.resetpass');
    }

    /**
     * 更新密码
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(){
        $data = request()->all();
        $rules = [
            'username' => 'required|exists:admin_user,username',
            'password' => 'required|min:6|confirmed',
        ];
        $messages = [
            'username.required'   => '请填写重置密码的账号',
            'username.exists'     => '账号信息不存在',
            'password.required'   => '请填写新密码',
            'password.min'        => '新密码不能低于6位数',
            'password.confirmed'  => '新密码确认不一致',
        ];
        $validator = validator()->make($data,$rules,$messages);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $resault = AdminUser::resetPassword($data);
        if($resault){
            return $this->ajaxReturn('重置密码成功',0,route('admin.index.index'));
        }else{
            return $this->ajaxReturn('重置密码失败');
        }
    }






}
