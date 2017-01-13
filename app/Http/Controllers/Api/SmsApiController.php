<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MobileSms;
use SMS;

class SmsApiController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | SmsApi Controller
    | @author xingyonghe
    | @date 2016-12-8
    |--------------------------------------------------------------------------
    |
    | 短信API控制器
    |
    */

    /**
     * 发送短信
     * @author: xingyonghe
     * @date: 2016-11-17
     */
    public function sendSMS(){
        $data = request()->only('mobile','category');
        if(!isset($data['category']) || empty($data['category'])){
            $data['category'] = 1;
        }
        //频繁验证
        if(SMS::frequent($data['mobile'],$data['category'])){
            return $this->ajaxReturn('您的操作过快');
        }
        $resault = SMS::send($data['mobile'],$data['category']);
        if($resault === false){
            return $this->ajaxReturn('发送失败');
        }
        return $this->ajaxReturn('发送成功',1);
    }

    /**
     * 短信验证
     * @author: xingyonghe
     * @date: 2016-11-17
     */
    public function verifySMS(){
        $data = request()->only('mobile','code');
        $resault = SMS::verify($data['mobile'],$data['code'],MobileSms::CATEGORY['register']);
        if($resault === true){
            return $this->ajaxReturn('验证成功',1);

        }
        $errorCode = SMS::errorSMS();
        return $this->ajaxReturn($errorCode[$resault]);
    }



























}
