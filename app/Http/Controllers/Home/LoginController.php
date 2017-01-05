<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use SEO;
use App\Models\User;

class LoginController extends Controller{
    use AuthenticatesUsers;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    | @author xingyonghe
    | @date 2016-11-17
    |--------------------------------------------------------------------------
    |
    | 用户登陆控制器
    |
    */

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRednetForm(){
        SEO::setTitle(C('WEB_SITE_TITLE').'-网红登陆');
        return view('home.auth.login_rednet');
    }

    /**
     * 广告主登陆界面
     * @author xingyonghe
     * @date 2015-12-9
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdsForm(){
        SEO::setTitle(C('WEB_SITE_TITLE').'-广告主登陆');
        return view('home.auth.login_ads');
    }


    public function login(){
        $data = request()->except('_token');
        if(empty($data['type']) || !in_array($data['type'],[1,2])){
            return $this->ajaxReturn('非法操作');
        }
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

        //从请求中获取所需的授权凭据。
        $credentials = request()->only('username', 'password', 'type');
        if ($this->guard()->attempt($credentials, request()->has('remember')) ||
            $this->guard()->attempt(['email'=>$credentials['username'],'password'=>$credentials['password'],'type'=>$credentials['type']], request()->has('remember'))) {
            //记录登陆时间和登陆IP
            $user = $this->guard()->user();
            $login['login_time'] = \Carbon\Carbon::now();
            $login['login_ip'] = request()->ip();
            User::where('id',$user['id'])->update($login);
            request()->session()->regenerate();
            $this->clearLoginAttempts(request());
            return $this->ajaxReturn('',1,route('home.index.index'));
        }
        return response()->json(array('status'=>0,'info'=>'账户不存在或密码输入错误','id'=>'username'));
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
