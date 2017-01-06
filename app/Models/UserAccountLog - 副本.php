<?php

namespace App\Models;

class UserCashLog extends CommonModel
{
    const STATUS_1 = 1;//待处理
    const STATUS_2 = 2;//成功
    const STATUS_3 = 3;//拒绝
    const STATUS_TEXT = [
        self::STATUS_1 => '待处理',
        self::STATUS_2 => '成功',
        self::STATUS_3 => '拒绝',
    ];
    public $timestamps = false;
    protected $table = 'user_cash_log';
    protected $fillable = [
        'userid','order_id','money','account','ip','status','created_at','pay_time'
    ];
    protected $dates = ['created_at','pay_time'];

    /**
     * 生成账户信息记录
     * @author: xingyonghe
     * @date: 2017-7-6
     * @param $money 金额
     * @param $account 账户
     * @param $ip IP地址
     * @param $status 状态
     * @param $mark 备注
     */
    public function createUserCashLog($money,$account,$ip,$status,$mark){
        $data = [
            'userid' => auth()->id(),
            'order_id' => create_order_sn(),
            'money' => $money,
            'account' => $account,
            'ip' => $ip,
            'status' => $status,
            'crteated_at' => \Carbon\Carbon::now(),
        ];
        $resualt = $this->create($data);
        if($resualt === false){
            return false;
        }
        return $data;
    }
}
