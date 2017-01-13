<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCashLog;

class CashController extends Controller
{

    /**
     * 列表
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function index(){
        $lists = UserCashLog::orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>UserCashLog::STATUS_TEXT]);
        return view('admin.cash.index',compact('lists'));
    }

    /**
     * 通过
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return
     */
    public function agreement(string $id){
        $info = UserCashLog::where('order_id',$id)->first();
        $resault = \DB::transaction(function () use($info){
            if(($info->update(['status'=>UserCashLog::STATUS_2])) && (User::where('id',$info['userid'])->decrement('balance', $info['money']))){
                return true;
            }
            return false;
        });
        if($resault){
            return redirect()->back()->withSuccess('操作成功!');
        }else{
            return redirect()->back()->withErrors('操作失败');
        }
    }

    /**
     * 拒绝
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param int $id
     * @return
     */
    public function refuse(string $id){
        $info = UserCashLog::where('order_id',$id)->first();
        $resault = $info->update(['status'=>UserCashLog::STATUS_3]);
        if($resault){
            return redirect()->back()->withSuccess('操作成功!');
        }else{
            return redirect()->back()->withErrors('操作失败');
        }
    }






}
