<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
use App\Models\UserData;
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
        return view('netred.center.edit',compact('user'));
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
            return $this->ajaxReturn('基本资料更新成功',0,route('netred.center.index'));
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
        return view('netred.center.password');
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
                return response()->json(array('status'=>-1,'info'=>'旧密码输入错误','id'=>'password-old'));
            }
        }
        if($data['password-old'] && ($data['password-old'] == $data['password'])){
            return response()->json(array('status'=>-1,'info'=>'新密码和旧密码一致','id'=>'password'));
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
        $reault = auth()->user()->update(array('password'=>bcrypt($data['password'])));
        if($reault){
            return $this->ajaxReturn('修改密码成功',0,route('netred.center.index'));
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
        return view('netred.center.payword');
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

    /**
     * 认证资料
     * @author xingyonghe
     * @date 2016-1-11
     * @return
     */
    public function certified(){
        SEO::setTitle('认证资料-会员中心-'.configs('WEB_SITE_TITLE'));
        $info = UserData::where('userid',auth()->id())->first();
        if(empty($info)){
            return view('netred.center.certified');
        }
        if($info['status'] == UserData::STATUS_VERIFY){
            echo '请耐心等待审核，您也可以主动联系专属客服跟进该活动';die;
        }
        if($info['status'] == UserData::STATUS_FEILED){
            return view('netred.center.certified',compact('info'));
        }
        if($info['status'] == UserData::STATUS_NORMAL){
            return view('netred.center.show',compact('info'));
        }
    }

    /**
     * 提交认证资料
     * @author xingyonghe
     * @date 2016-1-11
     * @return
     */
    public function send(){
        $data = request()->all();
        $rules = [
            'truename'   => 'required',
            'vcard'      => 'required',
            'vcard_face' => 'required',
            'vcard_con'  => 'required',
        ];
        $msgs = [
            'truename.required'      => '请填写真实姓名',
            'vcard.required'      => '请填写身份证号码',
            'vcard_face.required'       => '请上传身份证正面',
            'vcard_con.required' => '请上传身份证反面',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $info = UserData::where('userid',auth()->id())->first();
        $data['status'] = UserData::STATUS_VERIFY;
        if(empty($info)){
            $data['userid']     = auth()->id();
            $data['created_at'] = \Carbon\Carbon::now();
            $resualt = UserData::create($data);
        }else{
            $resualt = $info->update($data);
        }
        if($resualt === false){
            return $this->ajaxReturn('操作失败，请联系客服');
        }
        return $this->ajaxReturn('提交成功，请耐心等待审核，您也可以主动联系专属客服跟进该活动',0,route('netred.center.index'));
    }


}
