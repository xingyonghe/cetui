<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserData;

class UserController extends Controller
{

    /**
     * 认证资料
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function certified(){
        $lists = UserData::orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>UserData::STATUS_TEXT]);
        return view('admin.user.certified',compact('lists'));
    }

    /**
     * 审核通过
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return
     */
    public function agreement(int $id){
        $info = UserData::where('userid',$id)->first();
        $resault = $info->update(['status'=>UserData::STATUS_NORMAL]);
        if($resault){
            return redirect()->back()->withSuccess('审核通过!');
        }else{
            return redirect()->back()->withErrors('操作失败');
        }
    }

    /**
     * 审核不通过
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param int $id
     * @return
     */
    public function refuse(int $id){
        $info = UserData::where('userid',$id)->first();
        $resault = $info->update(['status'=>UserData::STATUS_FEILED]);
        if($resault){
            return redirect()->back()->withSuccess('审核不通过!');
        }else{
            return redirect()->back()->withErrors('操作失败');
        }
    }






}
