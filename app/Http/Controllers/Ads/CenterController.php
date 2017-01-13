<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\User;
use SEO;

class CenterController extends Controller
{

    protected $navkey = 'center';//菜单标识
    public function __construct(){
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
    }


    /**
     * 修改基本资料
     * @author: xingyonghe
     * @date: 2016-11-25
     * @return mixed
     */
    public function index()
    {
        $user = auth()->user();
        SEO::setTitle('基本资料-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.center.edit',compact('user'));
    }

    /**
     * 更新基本资料
     * @author: xingyonghe
     * @date: 2016-11-23
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $data = request()->all();
        $rules = [
            'nickname' => 'required',
            'email'  => 'required|email',
            'qq'  => 'required',
        ];
        $msgs = [
            'nickname.required' => '请填写联系人姓名',
            'email.required' => '请填写邮箱',
            'email.email' => '邮箱格式错误',
            'qq.required'    => '请填写QQ账号',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        if($data['email'] != auth()->user()->email){
            if(User::where('email',$data['email'])){
                return response()->json(['status'=>-1,'info'=>'邮箱已注册','id'=>'email']);
            }
        }
        $reault = auth()->user()->update($data);
        if($reault){
            return $this->ajaxReturn('基本资料更新成功',0,route('ads.center.index'));
        }else{
            return $this->ajaxReturn('基本资料更新失败');
        }
    }

    /**
     * 修改密码
     * @author: xingyonghe
     * @date: 2016-11-23
     * @return mixed
     */
    public function password()
    {
        SEO::setTitle('密码修改-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.center.password');
    }

    /**
     * 更新密码
     * @author: xingyonghe
     * @date: 2016-12-25
     * @return
     */
    public function reset()
    {
        $data = request()->all();
        if($data['password-old']){
            if((\Hash::check($data['password-old'], auth()->user()->password)) === false){
                return response()->json(['status'=>-1,'info'=>'旧密码输入错误','id'=>'password-old']);
            }
        }
        if($data['password-old'] && ($data['password-old'] == $data['password'])){
            return response()->json(['status'=>-1,'info'=>'新密码和旧密码一致','id'=>'password']);
        }
        $rules = [
            'password-old' => 'required',
            'password'  => 'required|min:6|confirmed',
        ];
        $msgs = [
            'password-old.required' => '请输入旧密码',
            'password.required' => '请输入新密码',
            'password.min'      => '密码最少6位',
            'password.confirmed'=> '确认密码不一致',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $reault = auth()->user()->update(['password'=>bcrypt($data['password'])]);
        if($reault){
            return $this->ajaxReturn('修改密码成功',0,route('ads.center.index'));
        }else{
            return $this->ajaxReturn('修改密码失败');
        }
    }

    /**
     * 修改支付密码
     * @author: xingyonghe
     * @date: 2016-11-23
     * @return mixed
     */
    public function payword()
    {
        SEO::setTitle('密码修改-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.center.payword');
    }

    /**
     * 更新支付密码
     * @author: xingyonghe
     * @date: 2016-12-25
     * @return
     */
    public function post()
    {
        $data = request()->all();

        if(empty(auth()->user()->payword)){
            //设置支付密码
            $rules = [
                'payword'  => 'required|min:6|confirmed',
            ];
            $msgs = [
                'payword.required' => '请输入支付密码',
                'payword.min'      => '支付密码最少6位',
                'payword.confirmed'=> '确认支付密码不一致',
            ];
            $validator = validator()->make($data,$rules,$msgs);
            if ($validator->fails()) {
                return $this->ajaxValidator($validator);
            }
            if((\Hash::check($data['payword'], auth()->user()->password)) === true){
                return response()->json(['status'=>-1,'info'=>'支付密码不能和登陆密码一致','id'=>'payword']);
            }
            $reault = auth()->user()->update(['payword'=>bcrypt($data['payword'])]);
            if($reault){
                return $this->ajaxReturn('设置支付密码成功',0,route('ads.center.index'));
            }else{
                return $this->ajaxReturn('设置支付密码失败');
            }
        }
        //修改支付密码
        if($data['payword-old']){
            if((\Hash::check($data['payword-old'], auth()->user()->payword)) === false){
                return response()->json(['status'=>-1,'info'=>'旧支付密码输入错误','id'=>'payword-old']);
            }
        }
        if($data['payword-old'] && ($data['payword-old'] == $data['payword'])){
            return response()->json(['status'=>-1,'info'=>'新支付密码和旧支付密码一致','id'=>'payword']);
        }
        $rules = [
            'payword-old' => 'required',
            'payword'  => 'required|min:6|confirmed',
        ];
        $msgs = [
            'payword-old.required' => '请输入旧支付',
            'payword.required' => '请输入新支付密码',
            'payword.min'      => '支付密码最少6位',
            'payword.confirmed'=> '确认支付密码不一致',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $reault = auth()->user()->update(['payword'=>bcrypt($data['payword'])]);
        if($reault){
            return $this->ajaxReturn('修改支付密码成功',0,route('ads.center.index'));
        }else{
            return $this->ajaxReturn('修改支付密码失败');
        }
    }





}
