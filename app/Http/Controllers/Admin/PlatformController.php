<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserNetredPlatform;

class PlatformController extends Controller
{

    const NETRED_TYPE = [
        1=> '直播',
        2=> '短视频'
    ];

    public function __construct(){
        view()->composer(['admin.platform.edit','admin.platform.index'],function($view){
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
        $lists = UserNetredPlatform::orderBy('sort', 'asc')
            ->paginate(100);
        return view('admin.platform.index',compact('lists'));
    }

    /**
     * 新增
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function create()
    {
        $view = view('admin.platform.edit');
        return $this->ajaxReturn($view->render(),0,'','新增平台信息');
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
        $info = UserNetredPlatform::find($id);
        $view = view('admin.platform.edit',compact('info'));
        return $this->ajaxReturn($view->render(),0,'','编辑平台信息');
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
        $resault = UserNetredPlatform::updateData(request()->all());
        if($resault){
            return $this->ajaxReturn(isset($resault['id'])?'平台信息修改成功':'平台信息新增成功',0,url()->previous());
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
        $resualt = UserNetredPlatform::destroy($id);
        if($resualt){
            return redirect()->back()->withSuccess('删除平台信息成功!');
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
        $datas = UserNetredPlatform::orderBy('sort','asc')->pluck('name','id');
        $view = view('admin.platform.sort',compact('datas'));
        return $this->ajaxReturn($view->render(),0,'','平台排序');
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
            $platform = UserNetredPlatform::find($id);
            $platform->update(['sort'=>$sort+1]);
        }
        return $this->ajaxReturn('平台信息排序成功',0,url()->previous());
    }



}
