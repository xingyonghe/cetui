<?php

namespace App\Http\Middleware;

use App\Models\AdminAuthRule;
use Closure;

class AdminUserAuth
{


    public function handle($request, Closure $next, $guard = 'admin'){
        //是否登陆
        if (!auth()->guard($guard)->check()) {
            return redirect(route('admin.login.form'));
        }
        //判断是否是超级管理员
        //非超级管理员是否有权限
        if(is_administrators() || $this->checkRules()){
            return $next($request);
        }
        if($request->ajax()){
            return response()->json(array('error'=>'抱歉，您的权限不足','status'=>-1));
        }else{
            return redirect()->back()->withErrors('抱歉，您的权限不足');
        }
    }


    /**
     * 用户角色权限检查
     * @author: xingyonghe
     * @date: 2016-11-17
     * @return bool
     */
    protected function checkRules(){
        $user = auth()->guard('admin')->user();
        if(empty($user->role_id)){
            return false;
        }
        $roles = AdminAuthRule::getUserRules($user->role_id);
        //获取当前URL菜单
        $current = request()->route()->getName();
        if(in_array($current,$roles)){
            return true;
        }
        return false;
    }
}
