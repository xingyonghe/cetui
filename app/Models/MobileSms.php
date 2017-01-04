<?php

namespace App\Models;

class MobileSms extends CommonModel{
    /*
    |--------------------------------------------------------------------------
    | MobileSms Model
    | @author xingyonghe
    | @date 2016-11-17
    |--------------------------------------------------------------------------
    |
    | 短信模型
    |
    */
    const STATUS = [
        'success' => 1,//已验证状态
        'created'  => 0,//未验证状态
    ];
    const CATEGORY = [
        'register' =>  1,//注册使用
    ];
    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'mobile_sms';
    protected $fillable = [
        'mobile','status','content','created_at','code','category'
    ];
    protected $dates = ['created_at'];

    








}
