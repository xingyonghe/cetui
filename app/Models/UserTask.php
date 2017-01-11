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
        self::STATUS_D => '<a class="label label-danger label-mini">已删除</a>',
        self::STATUS_1 => '<a class="label label-danger label-mini">待支付</a>',
        self::STATUS_2 => '<a class="label label-success label-mini">进行中</a>',
        self::STATUS_3 => '<a class="label label-info label-mini">待审核</a>',
        self::STATUS_4 => '<a class="label label-warning label-mini">未通过</a>',
        self::STATUS_5 => '<a class="label label-info label-mini">已过期</a>',
        self::STATUS_6 => '<a class="label label-warning label-mini">已结束</a>',
    ];
    protected $table = 'user_task';
    protected $fillable = [
        'userid', 'title', 'logo', 'money', 'num', 'start_time', 'end_time', 'dead_time',
        'shape', 'demand', 'status', 'notes', 'type'
    ];
    protected $dates = ['start_time','end_time','dead_time'];

//
//    protected function updateData($data)
//    {
//
//        if(empty($data['id'])){
//            //新增
//            $res = $this->create($data);
//            if($res === false){
//                return false;
//            }
//            $resualt = \DB::transaction(function () use($data){
//
//                $mark = '推广活动支付，支付金额：'.$data['money'];
//                $log = UserAccountLog::accountLog($data['money'],
//                    UserAccountLog::TYPE_1,
//                    $data['ip'],
//                    UserAccountLog::STATUS_0,
//                    $mark,
//                    $relation_id = $res->id);
//                if($log === false){
//                    return false;
//                }
//                return $log;
//            });

//        }else{
//            //编辑
//            $info = $this->find($data['id']);
//            //编辑
//            $info = $this->find($data['id']);
//            if(empty($info) || $info->update($data)===false){
//                return false;
//            }
//            $resualt = \DB::transaction(function () use($info,$data){
//                $res = $info->update($data);
//                if($res === false){
//                    return false;
//                }
//                //查看活动支付记录是否存在，存在修改使用这条记录，不存在，生产一条新的纪录
//                $log = UserAccountLog::where('userid',auth()->id())->where('relation_id',$data['id'])->first();
//                $mark = '推广活动支付，支付金额：'.$data['money'];
//                if($log){
//                    $task_account_log = $log->update(['mark'=>$mark,'money'=>$data['money']]);
//                    if($task_account_log === false){
//                        return false;
//                    }
//                }else{
//                    $log = UserAccountLog::accountLog($data['money'],
//                        UserAccountLog::TYPE_1,
//                        $data['ip'],
//                        UserAccountLog::STATUS_0,
//                        $mark,
//                        $relation_id = $info['id']);
//                    if($log === false){
//                        return false;
//                    }
//                }
//                return $log;
//            });


//        }
//        return $data;
//    }

}
