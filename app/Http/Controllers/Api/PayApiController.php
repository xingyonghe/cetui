<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserAccountLog;
use Alipay;
use App\Models\UserTask;

class PayApiController extends Controller
{


    public function pay(string $order_id)
    {
        $info = UserAccountLog::where('order_id',$order_id)->first();
        if(empty($info)){
            echo '数据提交失败';die;
        }
        $data = [
            "notify_url"	   => route('api.task.notify'),
            "return_url"	   => route('api.task.return'),
            "out_trade_no"	   => $order_id,
            "subject"	       => '活动支付',
            "total_fee"	       => $info['money'],
            "body"	           => '',
        ];
        Alipay::alipaySubmit($data);
    }

    public function return()
    {
        $data = request()->all();
        $resault = Alipay::verifyReturn($data);
        if($resault){
//            $out_trade_no = $data['out_trade_no'];
//            $info = D('UserAccount')->where('order_id',$out_trade_no)->first();
            redirect(route('ads.task.index'));
        }else{
            echo "支付失败";
        }
    }

    public function notify()
    {
        $data = request()->all();
        $resault = Alipay::verifyNotify($data);
        if($resault){
            $out_trade_no = $data['out_trade_no'];
            $resualt = \DB::transaction(function () use($data,$out_trade_no){
                $reconds = UserAccountLog::where('status',UserAccountLog::STATUS_0)->where('order_id',$out_trade_no)->first();
                if(empty($reconds)){
                    return false;
                }
                if($reconds->update(['status'=>UserAccountLog::STATUS_1])){
                    $task_info = UserTask::find($reconds['relation_id']);
                    if(empty($task_info)){
                        return false;
                    }
                    $task_info->update(['status'=>UserTask::STATUS_2]);
                }
            });
        }
    }


    /**
     * 订单支付
     * @author xingyonghe
     * @date 2016-1-7
     * @param string $order_id
     */
    public function orderPay(string $order_id)
    {
        $info = Order::where('order_sn',$order_id)->first();
        if(empty($info)){
            echo '数据提交失败';die;
        }
        $data = [
            "notify_url"	   => route('api.order.notify'),
            "return_url"	   => route('api.order.return'),
            "out_trade_no"	   => $order_id,
            "subject"	       => '订单支付',
            "total_fee"	       => $info['money'],
            "body"	           => '',
        ];
        Alipay::alipaySubmit($data);
    }

    public function orderReturn()
    {
        $data = request()->all();
        $resault = Alipay::verifyReturn($data);
        if($resault){
            //            $out_trade_no = $data['out_trade_no'];
            //            $info = D('UserAccount')->where('order_id',$out_trade_no)->first();
            redirect(route('ads.task.index'));
        }else{
            echo "支付失败";
        }
    }

    public function orderNotify()
    {
        $data = request()->all();
        $resault = Alipay::verifyNotify($data);
        if($resault){
            $out_trade_no = $data['out_trade_no'];
            $resualt = \DB::transaction(function () use($data,$out_trade_no){
                $reconds = UserAccountLog::where('status',UserAccountLog::STATUS_0)->where('order_id',$out_trade_no)->first();
                if(empty($reconds)){
                    return false;
                }
                if($reconds->update(['status'=>UserAccountLog::STATUS_1])){
                    $task_info = UserTask::find($reconds['relation_id']);
                    if(empty($task_info)){
                        return false;
                    }
                    $task_info->update(['status'=>UserTask::STATUS_2]);
                }
            });
        }
    }



    public function rechargePay(string $order_id)
    {
        $info = UserAccountLog::where('order_id',$order_id)->first();
        if(empty($info)){
            echo '数据提交失败';die;
        }
        $data = [
            "notify_url"	   => route('api.recharge.notify'),
            "return_url"	   => route('api.recharge.return'),
            "out_trade_no"	   => $order_id,
            "subject"	       => '充值',
            "total_fee"	       => $info['money'],
            "body"	           => '',
        ];
        Alipay::alipaySubmit($data);
    }

    public function rechargeReturn()
    {
        $data = request()->all();
        $resault = Alipay::verifyReturn($data);
        if($resault){
            //            $out_trade_no = $data['out_trade_no'];
            //            $info = D('UserAccount')->where('order_id',$out_trade_no)->first();
            redirect(route('ads.task.index'));
        }else{
            echo "支付失败";
        }
    }

    public function rechargeNotify()
    {
        $data = request()->all();
        $resault = Alipay::verifyNotify($data);
        if($resault){
            $out_trade_no = $data['out_trade_no'];
            $resualt = \DB::transaction(function () use($data,$out_trade_no){
                $reconds = UserAccountLog::where('status',UserAccountLog::STATUS_0)->where('order_id',$out_trade_no)->first();
                if(empty($reconds)){
                    return false;
                }
                if($reconds->update(['status'=>UserAccountLog::STATUS_1])){
                    $task_info = UserTask::find($reconds['relation_id']);
                    if(empty($task_info)){
                        return false;
                    }
                    $task_info->update(['status'=>UserTask::STATUS_2]);
                }
            });
        }
    }



























}
