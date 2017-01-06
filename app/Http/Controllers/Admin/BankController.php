<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserBank;

class BankController extends Controller
{

    /**
     * 列表
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function index(){
        $lists = UserBank::orderBy('sort', 'asc')->get();
        return view('admin.bank.index',compact('lists'));
    }

    /**
     * 新增
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return
     */
    public function create(){
        $view = view('admin.bank.edit');
        return $this->ajaxReturn($view->render(),0,'','新增账户');
    }

    /**
     * 修改
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param int $id
     * @return
     */
    public function edit(int $id){
        $info = UserBank::find($id);
        $view = view('admin.bank.edit',compact('info'));
        return $this->ajaxReturn($view->render(),0,'','修改账户');
    }

    /**
     * 更新
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param UserBankRequest $request
     * @return
     */
    public function update(){
        $resault = UserBank::updateData(request()->all());
        if($resault){
            return $this->ajaxReturn(isset($resault['id'])?'账户信息修改成功':'账户信息新增成功',0,url()->previous());
        }else{
            return $this->ajaxReturn('数据信息操作失败');
        }
    }

    /**
     * 删除
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id){
        $resault = UserBank::destroy($id);
        if($resault){
            return redirect()->back()->withSuccess('删除账户信息成功!');
        }else{
            return redirect()->back()->withErrors('删除账户信息失败');
        }
    }

    /**
     * 排序
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return
     */
    public function sort(){
        $datas = UserBank::orderBy('sort','asc')->get()->toArray();
        $view = view('admin.bank.sort',compact('datas'));
        return $this->ajaxReturn($view->render(),0,'','账户排序');
    }

    /**
     * 更新排序
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return
     */
    public function order(){
        $data = request()->only('ids');
        $ids = explode(',', $data['ids']);
        foreach ($ids as $sort=>$id){
            $channel = UserBank::find($id);
            $channel->update(['sort'=>$sort+1]);
        }
        return $this->ajaxReturn('账户信息排序成功',0,url()->previous());
    }




}
