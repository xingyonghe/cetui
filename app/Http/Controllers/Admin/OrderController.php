<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{

    public function __construct(){
//        $category = Category::where('model','netred')->orderBy('sort','asc')
//            ->orderBy('id','asc')->get(['id','name','pid'])
//            ->toArray();
//        $categorys = list_to_tree($category);
//        //新增/编辑共享直播平台数据
//        view()->composer(['admin.bespeak.index','admin.bespeak.unlogin'],function($view) use($categorys){
//            $view->with('categorys',$categorys);
//        });
    }

    /**
     * 预约订单
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function index(){
        $order_sn = (string)request()->get('order_sn','');
        $lists = Order::where('type',Order::TYPE_1)
            ->orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>Order::STATUS_TEXT]);
        $params = [
            'order_sn' => $order_sn,
        ];
        return view('admin.order.index',compact('lists','params'));
    }

    /**
     * 活动订单
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function task(){
        $order_sn = (string)request()->get('order_sn','');
        $lists = Order::where('type',Order::TYPE_2)
            ->orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>Order::STATUS_TEXT]);
        $params = [
            'order_sn' => $order_sn,
        ];
        return view('admin.order.index',compact('lists','params'));
    }

    /**
     * 成功
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param int $id
     * @return
     */
    public function agreement(string $id){
        $info = Order::where('order_sn',$id)->where('status',Order::STATUS_4)->first();
        if(empty($info)){
            return redirect()->back()->withErrors('信息不存在');
        }
        $resault = $info->update(['status'=>Order::STATUS_5]);
        if($resault){
            return redirect()->back()->withSuccess('处理成功!');
        }else{
            return redirect()->back()->withErrors('处理失败');
        }
    }

    /**
     * 失败
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param int $id
     * @return
     */
    public function failed(string $id){
        $info = Order::where('order_sn',$id)->where('status',Order::STATUS_4)->first();
        if(empty($info)){
            return redirect()->back()->withErrors('信息不存在');
        }
        $resault = \DB::transaction(function () use($info){
            if(($info->update(['status'=>Order::STATUS_7])) && (User::where('id',$info['buy_user_id'])->increment('balance',$info['money']))){
                $content = '尊敬的用户您好：<br/>';
                $content .= '您的订单："'.$info['order_sn'].'",由于不可抗拒原因导致失败，现已经将订单金额：'.$info['money'].'元退至您的账户余额中，请注意查收';
                Messages::sendMessages('订单退款通知', $content, $info['buy_user_id']);
                return true;
            }
        });
        if($resault){
            return redirect()->back()->withSuccess('处理成功!');
        }else{
            return redirect()->back()->withErrors('处理失败');
        }
    }


















    /**
     * 处理
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param int $id
     * @return mixed
     */
    public function do(int $id){
        $info = UserBespeak::findOrFail($id);
        $resault = $info->update(['status'=>UserBespeak::STATUS_2]);
        if($resault){
            return redirect()->back()->withSuccess('处理成功!');
        }else{
            return redirect()->back()->withErrors('处理失败');
        }
    }

    /**
     * 生产订单
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return
     */
    public function order(int $id){
        $info = UserBespeak::findOrFail($id);
        $view = view('admin.bespeak.order',compact('info'));
        return $this->ajaxReturn($view->render(),0,'','生产订单');
    }

    /**
     * 生产订单提交
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param UserBankRequest $request
     * @return
     */
    public function post(){
        $data = request()->all();
        $info = UserBespeak::findOrFail($data['task_id']);
        $data['created_at'] = \Carbon\Carbon::now();
        $data['order_sn'] = create_order_sn();
        $data['type'] = Order::TYPE_1;
        $data['status'] = Order::STATUS_1;
        $data['buy_user_id'] = $info['user_ads_id'];
        $data['sell_user_id'] = $info['user_id'];
        $data['shop_id'] = $info['netred_id'];
        $resault = Order::updateData($data);
        if($resault){
            $info->update(['status'=>UserBespeak::STATUS_3,'order_sn'=>$resault['order_sn']]);
            return $this->ajaxReturn('订单生成成功',0,url()->previous());
        }else{
            return $this->ajaxReturn('订单生成失败');
        }
    }



    /**
     * 预约网红列表
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function unlogin(){
        $lists = UserBespeak::whereNull('user_ads_id')
            ->orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>UserBespeak::STATUS_TEXT]);
        return view('admin.bespeak.unlogin',compact('lists'));
    }

}
