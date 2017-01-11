<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\UserTask;

class TaskController extends Controller
{
    protected $model = 'task';
    public function __construct()
    {

    }

    /**
     * 会员网红
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function index()
    {
        $title = (string)request()->get('title','');
        $lists = UserTask::whereIn('status',[UserTask::STATUS_1,UserTask::STATUS_2,UserTask::STATUS_5,UserTask::STATUS_6])
            ->where(function ($query) use($title) {
                if($title){
                    $query->where('title','like','%'.$title.'%');
                }
            })
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,[
            'status'=> UserTask::STATUS_TEXT,
        ]);
        $params = array(
            'title' => $title,
        );
        return view('admin.task.index',compact('lists','params'));
    }


    /**
     * 等待审核
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function check()
    {
        $title = (string)request()->get('title','');
        $lists = UserTask::whereIn('status',[UserTask::STATUS_3,UserTask::STATUS_4])
            ->where(function ($query) use($title) {
                if($title){
                    $query->where('title','like','%'.$title.'%');
                }
            })
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,[
            'status'=> UserTask::STATUS_TEXT,
        ]);
        $params = array(
            'title' => $title,
        );
        return view('admin.task.check',compact('lists','params'));
    }

    /**
     * 详情
     * @author xingyonghe
     * @date 2016-1-7
     * @param int $id
     * @return
     */
    public function show(int $id){
        $shape_arr = configs('ADS_TASK_TYPE');//活动广告类型
        $info = UserTask::findOrFail($id);
        return view('admin.task.show',compact('info','shape_arr'));
    }

    /**
     * 审核通过
     * @author xingyonghe
     * @date 2016-1-7
     * @param int $id
     * @return
     */
    public function verify(){
        $data = request()->only('ids');
        $resault = UserTask::whereIn('id',(array)$data['ids'])
            ->where('status',UserTask::STATUS_3)
            ->update(['status'=>UserTask::STATUS_1]);
        if($resault){
            return $this->ajaxReturn('审核成功',0,route('admin.task.check'));
        }else{
            return $this->ajaxReturn('操作失败，请稍后再试');
        }
    }

    /**
     * 审核拒绝
     * @author xingyonghe
     * @date 2016-1-7
     * @param int $id
     * @return
     */
    public function refuse(){
        $data = request()->all();
        if(!is_array($data['ids'])){
            $info = UserTask::where('status',UserTask::STATUS_3)->findOrFail($data['ids']);
            if(!empty($data['reason']) || isset($data['reasons'])){
                $resault = \DB::transaction(function () use($info,$data){
                    $res1 = $info->update(['status'=>UserTask::STATUS_D]);
                    $content = '抱歉，你发布的推广活动信息："'.$info['title'].'"审核未通过,具体原因：<br>';
                    if(!empty($data['reason'])){
                        $content .= '* '.$data['reason'].'<br/>';
                    }
                    if(isset($data['reasons'])){
                        foreach($data['reasons'] as $val){
                            $content .= '* '.$val.'<br/>';
                        }
                    }
                    $res2 = Messages::sendMessages('推广活动审核提示',$content,$info['userid']);
                    if($res1 && $res2){
                        return true;
                    }
                    return false;
                });
            }else{
                $res1 = $info->update(['status'=>UserTask::STATUS_D]);
            }
        }else{
            $resault = UserTask::whereIn('id',(array)$data['ids'])
                ->where('status',UserTask::STATUS_3)
                ->update(['status'=>UserTask::STATUS_D]);
        }
        if($resault){
            return $this->ajaxReturn('拒绝操作成功',0,route('admin.task.check'));
        }else{
            return $this->ajaxReturn('操作失败，请稍后再试');
        }
    }


    /**
     * 回收站
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function recycle()
    {
        $title = (string)request()->get('title','');
        $lists = UserTask::where('status',UserTask::STATUS_D)
            ->where(function ($query) use($title) {
                if($title){
                    $query->where('title','like','%'.$title.'%');
                }
            })
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(C('SYSTEM_LIST_LIMIT') ?? 10);
        $this->intToString($lists,[
            'status'=> UserTask::STATUS_TEXT,
        ]);
        $params = array(
            'title' => $title,
        );
        return view('admin.netred.recycle',compact('lists','params'));
    }


}
