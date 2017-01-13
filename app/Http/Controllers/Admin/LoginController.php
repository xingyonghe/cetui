<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct(){
        $this->middleware('admin_login', ['except' => 'logout']);
    }

    /**
     * 登陆界面
     * @author xingyonghe
     * @date 2016-11-16
     */
    public function showLoginForm(){
        return view('admin.auth.login');
    }

    /**
     * 管理员登陆
     * @author: xingyonghe
     * @date: 2016-11-16
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AdminLoginRequest $request){
        //从请求中获取所需的授权凭据。
        $credentials = $request->only('username', 'password');
        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            $admin = $this->guard()->user();
            $user['login_time'] = date('Y-m-d H:i:s');
            $user['login_ip'] = request()->ip();
            $admin->update($user);
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return $this->ajaxReturn('登陆成功',0,route('admin.index.index'));
        }
        $this->incrementLoginAttempts($request);
        return response()->json(['info'=>'账户或密码错误','status'=>-1,'id'=>'username']);
    }


    /**
     * 退出登录
     * @author: xingyonghe
     * @date: 2016-11-16
     * @param Request $request
     * @return mixed
     */
    public function logout(){
        $this->guard()->logout();
//        request()->session()->flush();
        request()->session()->regenerate();
        return redirect(route('admin.login.form'));
    }

    /**
     * 管理员模型
     * @author: xingyonghe
     * @date: 2016-11-16
     * @return mixed
     */
    protected function guard(){
        return Auth::guard('admin');
    }









}
