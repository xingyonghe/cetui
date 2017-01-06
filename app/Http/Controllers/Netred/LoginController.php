<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use SEO;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * 网红登陆界面
     * @author xingyonghe
     * @date 2015-12-9
     * @return
     */
    public function showForm(){
        SEO::setTitle('网红登陆-'.configs('WEB_SITE_TITLE'));
        return view('netred.auth.login');
    }


    /**
     * 网红登陆
     * @author: xingyonghe
     * @date: 2016-12-21
     * @return
     */
    public function login(){
        $data = request()->only('username', 'password');
        //字段验证
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $msgs = [
            'username.required' => '请填写用户名',
            'password.required' => '请填写密码',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $data['type'] = User::USER_TYPE_NETRED;

        if ($this->guard()->attempt($data, request()->has('remember'))) {
            //记录登陆时间和登陆IP
            $user = $this->guard()->user();
            $login['login_time'] = \Carbon\Carbon::now();
            $login['login_ip'] = request()->ip();
            User::where('id',$user['id'])->update($login);
            request()->session()->regenerate();
            $this->clearLoginAttempts(request());
            return $this->ajaxReturn('',0,route('netred.index.index'));
        }
        return response()->json(['status'=>-1,'info'=>'账户不存在或密码输入错误','id'=>'username']);
    }


    /**
     * 退出登录
     * @param Request $request
     * @return mixed
     */
    public function logout(){
        $this->guard()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect(route('home.index.index'));
    }

    /**
     * 调用模型
     */
    protected function guard(){
        return Auth::guard();
    }

}
