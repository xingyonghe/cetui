<?php

namespace App\Models;

class UserData extends CommonModel
{
    const STATUS_NORMAL = 1;//正常
    const STATUS_VERIFY = 2;//待审核
    const STATUS_FEILED = 3;//未通过
    const STATUS_TEXT = [
        self::STATUS_NORMAL => '<a class="label label-success label-mini">正常</a>',
        self::STATUS_VERIFY => '<a class="label label-info label-mini">待审核</a>',
        self::STATUS_FEILED => '<a class="label label-warning label-mini">未通过</a>',
    ];
    public $timestamps = false;//模型不需要更新/新增时间
    protected $primaryKey = 'userid';
    protected $table = 'user_data';
    protected $fillable = [
        'userid','truename', 'vcard', 'vcard_face', 'vcard_con','status','created_at'
    ];
    protected $dates = ['created_at'];
    


}
