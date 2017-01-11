<?php

namespace App\Models;

class UserAccountLog extends CommonModel
{

    const TYPE_1 = 1;//收入
    const TYPE_2 = 2;//支出
    const STATUS_0 = 0;//初始值，这里如果是充值，需该状态
    const STATUS_1 = 1;//成功，充值成功合支出成功状态
    const TYPE_TEXT = [
        self::TYPE_1 => '收入',
        self::TYPE_2 => '支出',
    ];
    public $timestamps = false;
    protected $table = 'user_account_log';
    protected $fillable = [
        'userid','order_id','money','type','ip','status','created_at','mark','relation_id'
    ];
    protected $dates = ['created_at'];

    /**
     * 生成账户信息记录
     * @author: xingyonghe
     * @date: 2016-11-23
     * @param $money 金额
     * @param $type 类型
     * @param $ip IP地址
     * @param $status 状态
     * @param $mark 备注
     * @param $relation_id 关联信息ID
     */
    protected function accountLog($money,$type,$ip,$status,$mark,$relation_id=NULL){
        $data = [
            'userid' => auth()->id(),
            'relation_id' => $relation_id,
            'order_id' => create_order_sn(),
            'money' => $money,
            'type' => $type,
            'ip' => $ip,
            'status' => $status,
            'created_at' => \Carbon\Carbon::now(),
            'mark' => $mark
        ];
        $resualt = $this->create($data);
        if($resualt === false){
            return false;
        }
        return $data;
    }
}
