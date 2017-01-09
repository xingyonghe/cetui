<?php

namespace App\Models;

class UserTask extends CommonModel
{

    const STATUS_D = -1;//已删除
    const STATUS_1 = 1;//待支付
    const STATUS_2 = 2;//进行中
    const STATUS_3 = 3;//待审核
    const STATUS_4 = 4;//未通过
    const STATUS_5 = 5;//已过期
    const STATUS_6 = 6;//已结束
    const STATUS_TEXT = [
        self::STATUS_D => '已删除',
        self::STATUS_1 => '待支付',
        self::STATUS_2 => '进行中',
        self::STATUS_3 => '待审核',
        self::STATUS_4 => '未通过',
        self::STATUS_5 => '已过期',
        self::STATUS_6 => '已结束',
    ];
    protected $table = 'user_task';
    protected $fillable = [
        'userid', 'title', 'logo', 'money', 'num', 'start_time', 'end_time', 'dead_time',
        'shape', 'demand', 'status', 'notes', 'type'
    ];
    protected $dates = ['start_time','end_time','dead_time'];


}
