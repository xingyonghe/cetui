<?php

namespace App\Models;

class UserAdsTask extends CommonModel{
    /*
    |--------------------------------------------------------------------------
    | UserAdsTask Model
    | @author xingyonghe
    | @date 2016-11-24
    |--------------------------------------------------------------------------
    |
    | 广告主活动模型
    |
    */

    const STATUS_D = -1;//已删除
    const STATUS_1 = 1;//进行中
    const STATUS_2 = 2;//待审核
    const STATUS_3 = 3;//审核未通过
    const STATUS_4 = 4;//已结束
    const STATUS_5 = 5;//已过期
    const STATUS_6 = 6;//未完成
    const STATUS_TEXT = [
        self::STATUS_D => '删除',
        self::STATUS_1 => '正常',
        self::STATUS_2 => '待审核',
        self::STATUS_3 => '审核未通过',
        self::STATUS_4 => '已完成',
        self::STATUS_5 => '已过期',
        self::STATUS_6 => '未完成',
    ];
    protected $table = 'user_ads_task';
    protected $fillable = [
        'userid', 'title', 'logo', 'money', 'num', 'start_time', 'end_time', 'dead_time',
        'shape', 'demand', 'status', 'notes', 'type'
    ];
    protected $dates = ['start_time','end_time','dead_time','created_at','updated_at'];


}
