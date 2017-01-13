<?php

namespace App\Models;

class UserCashLog extends CommonModel
{

    const STATUS_1 = 1;//待处理
    const STATUS_2 = 2;//已处理
    const STATUS_3 = 3;//拒绝
    const STATUS_TEXT = [
        self::STATUS_1 => '<a class="label label-danger label-mini">待处理</a>',
        self::STATUS_2 => '<a class="label label-info label-mini">已处理</a>',
        self::STATUS_3 => '<a class="label label-danger label-mini">拒绝</a>',
    ];
    public $timestamps = false;
    protected $table = 'user_cash_log';
    protected $fillable = [
        'userid','order_id','account','money','ip','status','created_at','pay_time','account_type'
    ];
    protected $dates = ['created_at'];


    /**
     * 生成提现信息记录
     * @author: xingyonghe
     * @date: 2016-11-23
     */
    protected function cashLog($log){
        $data = [
            'userid' => auth()->id(),
            'order_id' => create_order_sn(),
            'money' => $log['money'],
            'ip' => $log['ip'],
            'status' => self::STATUS_1,
            'created_at' => \Carbon\Carbon::now(),
            'account' => $log['account'],
            'account_type' => $log['account_type']
        ];
        $resualt = $this->create($data);
        if($resualt === false){
            return false;
        }
        return $data;
    }
}
