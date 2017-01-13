<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\User;
use SEO;
use App\Models\MobileSms;
use SMS;
use Mail;

class ResetPasswordController extends Controller
{

    public function __construct()
    {

    }

    public function mobile()
    {

//        Mail::send(function ($email){
//            $email->to('1342234898@qq.com')->subject('Hello World');
//        });
        SEO::setTitle('找回密码-'.configs('WEB_SITE_TITLE'));
        $resend = config('mobilesms.driver.zdtone.resend');
        return view('home.password.mobile',compact('resend'));
    }

    public function post()
    {
        $data = request()->all();

        $rules = [
            'username' => 'required|mobile|exists:user,username',
            'code'     => 'required',
            'password' => 'required|min:6|confirmed',
        ];
        $msgs = [
            'username.required' => '请填写你要注册的手机号码',
            'username.mobile'   => '手机号格式错误',
            'username.exists'   => '手机号未注册',
            'code.required'     => '请填写手机动态验证码',
            'password.required' => '请输入密码',
            'password.min'      => '密码最少6位',
            'password.confirmed'=> '确认密码不一致',
        ];
        //数据验证
        $validator = validator()->make($data, $rules ,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        //验证手机号码是否被验证
        $resault = SMS::verify($data['username'],$data['code'],MobileSms::CATEGORY['reset']);

        if($resault !== true){
            $errorCode = SMS::errorSMS();
            return response()->json(['status'=>-1,'info'=>$errorCode[$resault],'id'=>'username']);
        }

        $info = User::where('username',$data['username'])->first();

        $reault = $info->update(array('password'=>bcrypt($data['password'])));
        if($reault){
            if($info['type'] == 1) $back = route('netred.login.form');
            else $back = route('ads.login.form');
            return $this->ajaxReturn('重新设置密码成功',0,$back);
        }else{
            return $this->ajaxReturn('重新设置失败');
        }
    }

    public function email()
    {
//        Mail::send(['raw'=>'测试邮件发送'],[],function ($message){
//            $message ->to('1342234898@qq.com')->subject('这是一封测试邮件');
//        });
//        Mail::raw('测试邮件发送',function ($message){
//            $message ->to('1342234898@qq.com')->subject('这是一封测试邮件这是一封测试邮件这是一封测试邮件这是一封测试邮件这是一封测试邮件这是一封测试邮件这是一封测试邮件这是一封测试邮件这是一封测试邮件');
//        });
//        Mail::send('emails.test', ['user' => $user], function ($email) use ($user) {
//            $email->to('2794408425@qq.com')->subject('Hello World');
//        });
        if(session('email-code')){
            request()->session()->pull('email-code');
        }
        SEO::setTitle('找回密码-'.configs('WEB_SITE_TITLE'));//195228
        return view('home.password.email');
    }

    public function send(){
        $data = request()->all();
        $rules = [
            'email' => 'required|email|exists:user,email',
        ];
        $msgs = [
            'email.required' => '请填写你要注册的邮箱',
            'email.email'    => '邮箱格式错误',
            'email.exists'   => '邮箱未注册',
        ];
        //数据验证
        $validator = validator()->make($data, $rules ,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $code = $this->getCode();
        $res = Mail::raw('【卓杭广告】您本次验证码为：'.$code.'，如不是本人操作，请忽略',function ($message) use($data){
            $message ->to($data['email'])
                ->subject('找回密码');
        });
        //记录code到session
        session(['email-code' => $code]);
        return $this->ajaxReturn('发送成功',0);
    }

    public function update(){
        $data = request()->all();
        $email_code = session('email-code');
        $rules = [
            'email' => 'required|email|exists:user,email',
            'code'     => 'required',
            'password' => 'required|min:6|confirmed',
        ];
        $msgs = [
            'email.required' => '请填写你要注册的邮箱',
            'email.mobile'   => '邮箱格式错误',
            'email.exists'   => '邮箱未注册',
            'code.required'     => '请填写动态验证码',
            'password.required' => '请输入密码',
            'password.min'      => '密码最少6位',
            'password.confirmed'=> '确认密码不一致',
        ];
        //数据验证
        $validator = validator()->make($data, $rules ,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }

        if($email_code != $data['code']){
            return response()->json(['status'=>-1,'info'=>'动态验证码验证失败','id'=>'email']);
        }

        $info = User::where('email',$data['email'])->first();

        $reault = $info->update(array('password'=>bcrypt($data['password'])));
        if($reault){
            request()->session()->pull('email-code');
            if($info['type'] == 1) $back = route('netred.login.form');
            else $back = route('ads.login.form');
            return $this->ajaxReturn('重新设置密码成功',0,$back);
        }else{
            return $this->ajaxReturn('重新设置失败');
        }
    }




    /**
     * 获取6位数验证码
     * @author: xingyonghe
     * @date: 2016-11-22
     * @return string
     */
    protected function getCode(){
        $char = '0123456789';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $char[mt_rand(0, strlen($char) - 1)];
        }
        return $code;
    }



}
