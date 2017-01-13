<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminUserLogin
{

    public function handle($request, Closure $next, $guard = 'admin')
    {
        //是否登陆
        if (Auth::guard($guard)->check()) {
            //登录成功
            return redirect(route('admin.index.index'));
        }
        //没有登陆前往登陆界面
        return $next($request);
    }
}
