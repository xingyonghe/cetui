<?php

namespace App\Models;

class Order extends CommonModel
{
    const STATUS_1 = 1;//待支付
    const STATUS_2 = 2;//进行中
    const STATUS_3 = 3;//已完成
    const STATUS_4 = 4;//有问题
    const STATUS_5 = 5;//待评价
    const STATUS_6 = 6;//已评价
    const STATUS_7 = 7;//已失败
    const STATUS_TEXT = [

        self::STATUS_1 => '<a class="label label-danger label-mini">待支付</a>',
        self::STATUS_2 => '<a class="label label-success label-mini">进行中</a>',
        self::STATUS_3 => '<a class="label label-info label-mini">已完成</a>',
        self::STATUS_4 => '<a class="label label-warning label-mini">有问题</a>',
        self::STATUS_5 => '<a class="label label-info label-mini">待评价</a>',
        self::STATUS_6 => '<a class="label label-warning label-mini">已评价</a>',
        self::STATUS_7 => '<a class="label label-danger label-mini">已失败</a>',
    ];

    const TYPE_1 = 1;//预约订单
    const TYPE_2 = 2;//活动订单

    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'order';
    protected $fillable = [
        'buy_user_id','sell_user_id', 'shop_id', 'task_id', 'money','order_sn','images','video_target',
        'type','status','score','created_at','pay_at'
    ];
    protected $dates = ['created_at','pay_at'];
    protected $casts = [
        'images' => 'array'
    ];
}
