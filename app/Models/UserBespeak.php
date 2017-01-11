<?php

namespace App\Models;

class UserBespeak extends CommonModel
{

    const STATUS_1 = 1;//待处理
    const STATUS_2 = 2;//处理中
    const STATUS_3 = 3;//处理成功
    const STATUS_4 = 4;//处理失败

    const STATUS_TEXT = [
        self::STATUS_1 => '<a class="label label-danger label-mini">待处理</a>',
        self::STATUS_2 => '<a class="label label-success label-mini">处理中</a>',
        self::STATUS_3 => '<a class="label label-info label-mini">成功</a>',
        self::STATUS_4 => '<a class="label label-warning label-mini">失败</a>',
    ];

    public $timestamps = false;

    protected $table = 'user_bespeak';

    protected $fillable = ['user_id','user_ads_id','netred_id','money','mobile','order_sn','catids','status','created_at'];

    protected $dates = ['created_at'];

    protected $casts = [
        'catids' => 'array'
    ];



}

