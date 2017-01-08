<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
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
            'email'  => 'sometimes|email',
            'qq'  => 'required',
        ];
        $msgs = [
            'nickname.required' => '请填写联系人姓名',
            'email.email' => '邮箱格式错误',
            'qq.required'    => '请填写QQ账号',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
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




}
