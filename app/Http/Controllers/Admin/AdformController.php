<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserNetredAdform;

class AdformController extends Controller
{
    const NETRED_TYPE = [
        1=> '直播',
        2=> '短视频'
    ];

    public function __construct(){
        view()->composer(['admin.adform.edit','admin.adform.index'],function($view){
            $view->with('category',self::NETRED_TYPE);
        });
    }

    /**
     * 列表
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function index()
    {
        $lists = UserNetredAdform::orderBy('sort', 'asc')
            ->paginate(100);
        return view('admin.adform.index',compact('lists'));
    }

    /**
     * 新增
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function create()
    {
        $view = view('admin.adform.edit');
        return $this->ajaxReturn($view->render(),0,'','新增广告形式');
    }

    /**
     * 修改
     * @author xingyonghe
     * @date 2017-1-4
     * @param int $id
     * @return
     */
    public function edit(int $id)
    {
        $info = UserNetredAdform::find($id);
        $view = view('admin.adform.edit',compact('info'));
        return $this->ajaxReturn($view->render(),0,'','编辑广告形式');
    }

    /**
     * 更新
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param MenuRequest $request
     * @return mixed
     */
    public function update()
    {
        $resault = UserNetredAdform::updateData(request()->all());
        if($resault){
            return $this->ajaxReturn(isset($resault['id'])?'广告形式修改成功':'广告形式新增成功',0,url()->previous());
        }else{
            return $this->ajaxReturn('操作失败，请稍后再试');
        }
    }

    /**
     * 删除
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $resualt = UserNetredAdform::destroy($id);
        if($resualt){
            return redirect()->back()->withSuccess('广告形式信息成功!');
        }else{
            return redirect()->back()->withErrors('删除平台信息失败');
        }
    }

    /**
     * 导航排序
     * @author: xingyonghe
     * @date: 2017-1-4
     * @return
     */
    public function sort()
    {
        $datas = UserNetredAdform::orderBy('sort','asc')->pluck('name','id');
        $view = view('admin.adform.sort',compact('datas'));
        return $this->ajaxReturn($view->render(),0,'','广告形式排序');
    }

    /**
     * 更新排序
     * @author: xingyonghe
     * @date: 2017-1-4
     * @return
     */
    public function order()
    {
        $data = request()->only('ids');
        $ids = explode(',', $data['ids']);
        foreach ($ids as $sort=>$id){
            $adform = UserNetredAdform::find($id);
            $adform->update(['sort'=>$sort+1]);
        }
        return $this->ajaxReturn('广告形式排序成功',0,url()->previous());
    }



}
