<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserNetred;

class NetredController extends Controller
{

    /**
     * 会员网红
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function index()
    {
        $stage_name = (string)request()->get('stage_name','');
        $lists = UserNetred::where('status',UserNetred::STATUS_NORMAL)
            ->where(function ($query) use($stage_name) {
                if($stage_name){
                    $query->where('stage_name','like','%'.$stage_name.'%');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $this->intToString($lists,[
            'status'=> UserNetred::STATUS_TEXT,
        ]);
        $params = array(
            'stage_name' => $stage_name,
        );
        return view('admin.netred.index',compact('lists','params'));
    }


    /**
     * 系统网红
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function system()
    {
        $stage_name = (string)request()->get('stage_name','');
        $lists = UserNetred::where('status',UserNetred::STATUS_NORMAL)
            ->where(function ($query) use($stage_name) {
                if($stage_name){
                    $query->where('stage_name','like','%'.$stage_name.'%');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $this->intToString($lists,[
            'status'=> UserNetred::STATUS_TEXT,
        ]);
        $params = array(
            'stage_name' => $stage_name,
        );
        return view('admin.netred.system',compact('lists','params'));
    }

    /**
     * 新增
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function create()
    {
        $view = view('admin.netred.edit');
        return $this->ajaxReturn($view->render(),1,'','新增平台信息');
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
        $info = UserPlatform::find($id);
        $view = view('admin.netred.edit',compact('info'));
        return $this->ajaxReturn($view->render(),1,'','编辑平台信息');
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
        $resault = UserPlatform::toUpdate(request()->all());
        if($resault){
            return $this->ajaxReturn(isset($resault['id'])?'平台信息修改成功':'平台信息新增成功',1,url()->previous());
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
        $resualt = UserPlatform::destroy($id);
        if($resualt){
            return redirect()->back()->withSuccess('删除平台信息成功!');
        }else{
            return redirect()->back()->with('error','删除平台信息失败');
        }
    }

    /**
 * 等待审核
 * @author xingyonghe
 * @date 2017-1-4
 * @return
 */
    public function verify()
    {
        $stage_name = (string)request()->get('stage_name','');
        $lists = UserNetred::whereIn('status',[UserNetred::STATUS_VERIFY,UserNetred::STATUS_FEILED])
            ->where(function ($query) use($stage_name) {
                if($stage_name){
                    $query->where('stage_name','like','%'.$stage_name.'%');
                }
            })
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(C('SYSTEM_LIST_LIMIT') ?? 10);
        $this->intToString($lists,[
            'status'=> UserNetred::STATUS_TEXT,
        ]);
        $params = array(
            'stage_name' => $stage_name,
        );
        return view('admin.netred.verify',compact('lists','params'));
    }

    /**
     * 回收站
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function recycle()
    {
        $stage_name = (string)request()->get('stage_name','');
        $lists = UserNetred::where('status',UserNetred::STATUS_DELETE)
            ->where(function ($query) use($stage_name) {
                if($stage_name){
                    $query->where('stage_name','like','%'.$stage_name.'%');
                }
            })
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(C('SYSTEM_LIST_LIMIT') ?? 10);
        $this->intToString($lists,[
            'status'=> UserNetred::STATUS_TEXT,
        ]);
        $params = array(
            'stage_name' => $stage_name,
        );
        return view('admin.netred.recycle',compact('lists','params'));
    }

    public function category(){
        $model = $this->model;
        $lists =Category::getCategory($model);
        $lists = list_to_tree($lists);
        return view('admin.category.index',compact('lists','model'));
    }



}
