<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\CommonController;
use App\Models\MobileSms;
use SMS;
use App\Models\User;
use SEO;

class RegisterController extends CommonController{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    | @author xingyonghe
    | @date 2016-11-17
    |--------------------------------------------------------------------------
    |
    | 用户注册控制器
    |
    */
    public function __construct(){
        $this->middleware('guest');
    }

    /**
     * 网红注册界面
     * @author xingyonghe
     * @date 2015-12-9
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRednetForm(){
        SEO::setTitle(C('WEB_SITE_TITLE').'-网红注册');
        $resend = config('mobilesms.driver.zdtone.resend');
        return view('home.auth.register_rednet',compact('resend'));
    }

    /**
     * 广告主注册界面
     * @author xingyonghe
     * @date 2015-12-9
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdsForm(){
        SEO::setTitle(C('WEB_SITE_TITLE').'-广告主注册');
        $resend = config('mobilesms.driver.zdtone.resend');
        return view('home.auth.register_ads',compact('resend'));
    }


    /**
     * 用户注册
     * @author: xingyonghe
     * @date: 2016-11-17
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(){
        $data = request()->all();
        if(empty($data['type']) || !in_array($data['type'],[1,2])){
            return $this->ajaxReturn('非法操作');
        }
        //验证手机号码是否被验证
        $resault = SMS::verify($data['username'],$data['code'],MobileSms::CATEGORY['register']);

        if($resault !== true){
            $errorCode = SMS::errorSMS();
            return response()->json(['status'=>0,'info'=>$errorCode[$resault],'id'=>'username']);
        }

        $rules = [
            'username' => 'required|mobile|unique:user',
            'code'     => 'required',
            'captcha'  => 'required|captcha',
            'email'    => 'required|email|unique:user',
            'nickname' => 'required',
            'password' => 'required|min:6|confirmed',
            'protocol' => 'accepted'
        ];
        $msgs = [
            'username.required' => '请填写你要注册的手机号码',
            'username.mobile'   => '手机号格式错误',
            'username.unique'   => '手机号已经注册',
            'code.required'     => '请填写手机动态验证码',
            'captcha.required'  => '请填写验证码',
            'captcha.captcha'   => '验证码错误',
            'email.required'    => '请填写邮箱账号',
            'email.email'       => '邮箱账号格式错误',
            'email.unique'      => '邮箱账号已经存在',
            'nickname.required' => '请填写公司或者个人名称',
            'password.required' => '请输入密码',
            'password.min'      => '密码最少6位',
            'password.confirmed'=> '确认密码不一致',
            'protocol.accepted' => '您还没有阅读并同意条款《策推中国用户协议》',
        ];
        //数据验证
        $validator = validator()->make($data, $rules ,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }

        $resault = User::register(request());
        if($resault === false){
            return $this->ajaxReturn('注册失败');
        }else{
            if($data['type']==1) $back = route('home.login.rednet');
            else $back = route('home.login.ads');
            return $this->ajaxReturn('恭喜您，注册成功',1,$back);
        }

    }




}
