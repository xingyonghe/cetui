<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\UserBespeak;

class BespeakController extends Controller
{

    public function __construct(){
        $categorys = configs('ADS_TASK_TYPE');
        //新增/编辑共享直播平台数据
        view()->composer(['admin.bespeak.index','admin.bespeak.unlogin'],function($view) use($categorys){
            $view->with('categorys',$categorys);
        });
    }

    /**
     * 预约网红列表
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function index(){
        $lists = UserBespeak::whereNotNull('user_ads_id')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>UserBespeak::STATUS_TEXT]);
        return view('admin.bespeak.index',compact('lists'));
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
     * 预约失败
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param int $id
     * @return
     */
    public function faild(int $id){
        $info = UserBespeak::findOrFail($id);
        $resault = $info->update(['status'=>UserBespeak::STATUS_4]);
        if($resault){
            return redirect()->back()->withSuccess('处理成功!');
        }else{
            return redirect()->back()->withErrors('处理失败');
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
