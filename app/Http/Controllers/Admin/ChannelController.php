<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelRequest;
use App\Models\Channel;

class ChannelController extends Controller
{

    /**
     * 导航列表
     * @author: xingyonghe
     * @date: 2017-1-4
     * @return mixed
     */
    public function index(){
        $title = (string)request()->get('title','');
        $lists = Channel::where(function ($query) use($title) {
                if($title){
                    $query->where('title','like','%'.$title.'%');
                }
            })
            ->orderBy('sort', 'asc')
            ->get(['id','title', 'remark','url','sort','status','target']);
        $this->intToString($lists,[
            'status'=>[0=>'隐藏',1=>'显示'],
            'target'=>[0=>'否',1=>'是']
        ]);
        $params = array('title'=>$title);
        return view('admin.channel.index',compact('lists','params'));
    }

    /**
     * 导航新增
     * @author: xingyonghe
     * @date: 2017-1-4
     * @return
     */
    public function create(){
        $view = view('admin.channel.edit');
        return $this->ajaxReturn($view->render(),0,'','新增导航');
    }

    /**
     * 导航修改
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param int $id
     * @return
     */
    public function edit(int $id){
        $info = Channel::find($id);
        $view = view('admin.channel.edit',compact('info'));
        return $this->ajaxReturn($view->render(),0,'','修改导航');
    }

    /**
     * 导航更新
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param ChannelRequest $request
     * @return
     */
    public function update(ChannelRequest $request){
        $resault = Channel::updateData($request->all());
        if($resault){
            return $this->ajaxReturn(isset($resault['id'])?'导航信息修改成功':'导航信息新增成功',0,url()->previous());
        }else{
            return $this->ajaxReturn('数据信息操作失败');
        }
    }

    /**
     * 导航删除
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id){
        $resault = Channel::destroy($id);
        if($resault){
            return redirect()->back()->withSuccess('删除信息成功!');
        }else{
            return redirect()->back()->withErrors('删除信息失败');
        }
    }

    /**
     * 导航排序
     * @author: xingyonghe
     * @date: 2017-1-4
     * @return
     */
    public function sort(){
        $datas = Channel::orderBy('sort','asc')->get()->toArray();
        $view = view('admin.channel.sort',compact('datas'));
        return $this->ajaxReturn($view->render(),0,'','导航排序');
    }

    /**
     * 更新排序
     * @author: xingyonghe
     * @date: 2017-1-4
     * @return
     */
    public function order(){
        $data = request()->only('ids');
        $ids = explode(',', $data['ids']);
        foreach ($ids as $sort=>$id){
            $channel = Channel::find($id);
            $channel->update(['sort'=>$sort+1]);
        }
        return $this->ajaxReturn('导航信息排序成功',0,url()->previous());
    }




}
