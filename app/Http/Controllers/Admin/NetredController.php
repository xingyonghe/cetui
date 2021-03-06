<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Messages;
use App\Models\UserNetred;
use App\Models\UserNetredAdform;
use App\Models\UserNetredPosition;

class NetredController extends Controller
{
    protected $model = 'netred';
    public function __construct()
    {
        //资源风格
        $style = configs('NETRED_STYLE');
        //分类
        $category = Category::where('model','netred')->orderBy('sort','asc')
            ->orderBy('id','asc')->get(['id','name','pid'])
            ->toArray();
        $category = list_to_tree($category);
        view()->composer(['admin.netred.show'],function($view) use($style,$category){
            $view->with('styles',$style)->with('categorys',$category);
        });
    }

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
            ->whereNotNull('userid')
            ->where(function ($query) use($stage_name) {
                if($stage_name){
                    $query->where('stage_name','like','%'.$stage_name.'%');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
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
            ->whereNull('userid')
            ->where(function ($query) use($stage_name) {
                if($stage_name){
                    $query->where('stage_name','like','%'.$stage_name.'%');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,[
            'status'=> UserNetred::STATUS_TEXT,
        ]);
        $params = array(
            'stage_name' => $stage_name,
        );
        return view('admin.netred.system',compact('lists','params'));
    }


    /**
     * 等待审核
     * @author xingyonghe
     * @date 2017-1-4
     * @return
     */
    public function check()
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
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        $this->intToString($lists,[
            'status'=> UserNetred::STATUS_TEXT,
        ]);
        $params = array(
            'stage_name' => $stage_name,
        );
        return view('admin.netred.check',compact('lists','params'));
    }

    /**
     * 网红详情
     * @author xingyonghe
     * @date 2016-1-7
     * @param int $id
     * @return
     */
    public function show(int $id){
        $info = UserNetred::findOrFail($id);
        $adforms = UserNetredAdform::where('category',$info['type'])->orderBy('sort','asc')->pluck('name','id');
        return view('admin.netred.show',compact('info','adforms'));
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
        $resault = UserNetred::whereIn('id',(array)$data['ids'])
            ->where('status',UserNetred::STATUS_VERIFY)
            ->update(['status'=>UserNetred::STATUS_NORMAL]);
        if($resault){
            return $this->ajaxReturn('审核成功',0,route('admin.netred.check'));
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
            $info = UserNetred::where('status',UserNetred::STATUS_VERIFY)->findOrFail($data['ids']);
            if(!empty($data['reason']) || isset($data['reasons'])){
                $resault = \DB::transaction(function () use($info,$data){
                    $res1 = $info->update(['status'=>UserNetred::STATUS_FEILED]);
                    $content = '抱歉，你新增的网红信息："'.$info['stage_name'].'"审核未通过,具体原因：<br>';
                    if(!empty($data['reason'])){
                        $content .= '* '.$data['reason'].'<br/>';
                    }
                    if(isset($data['reasons'])){
                        foreach($data['reasons'] as $val){
                            $content .= '* '.$val.'<br/>';
                        }
                    }
                    $res2 = Messages::sendMessages('网红资源审核提示',$content,$info['userid']);
                    if($res1 && $res2){
                        return true;
                    }
                    return false;
                });
            }else{
                $res1 = $info->update(['status'=>UserNetred::STATUS_FEILED]);
            }
        }else{
            $resault = UserNetred::whereIn('id',(array)$data['ids'])
                ->where('status',UserNetred::STATUS_VERIFY)
                ->update(['status'=>UserNetred::STATUS_FEILED]);
        }
        if($resault){
            return $this->ajaxReturn('拒绝操作成功',0,route('admin.netred.check'));
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

    /**
     * 系统网红导入
     * @author xingyonghe
     * @date 2016-1-5
     */
    public function import()
    {
        $view = view('admin.netred.import');
        return $this->ajaxReturn($view->render(),0,'','批量导入网红信息');
    }

    /**
     * 系统网红导入更新
     * @author xingyonghe
     * @date 2016-1-5
     */
    public function post()
    {
        $data = request()->only('info');
        $lists = explode(',',str_replace(array("\r\n","\n","\r"),',',$data['info']));
        if($lists == array('0'=>'')){
            return $this->ajaxReturn('请按格式填写批量导入的至少一条网红信息');
        }
        foreach ($lists as $key => $item) {
            $record = explode('-', $item);
            $category = Category::select('id','name','pid')
                ->where('model',$this->model)
                ->orderBy('sort','asc')
                ->get()->random(3)->toArray();
            $category = array_pluck($category,'id');
            foreach($category as $key=>$val){
                $category[$key] = 'catid_'.$val;
            }
            UserNetred::create([
                'status'      => UserNetred::STATUS_NORMAL,
                'catids'      => $category,
                'platform_id' => $record[1],
                'stage_name'  => $record[0],
                'fans'        => $record[2],
                'average_num' => $record[3],
                'avatar'      => '/uploads/picture/2017-01-05/'.$record[4].'.png',
            ]);
        }
        return $this->ajaxReturn('批量导入成功',1,url()->previous());

    }

    /**
     * 推荐
     * @author xingyonghe
     * @date 2016-1-11
     * @param int $id
     * @return
     */
    public function position(int $id){
        $info = UserNetred::find($id);
        $p_info = UserNetredPosition::where('netred_id',$id)->get(['position'])->toArray();
        if(!empty($p_info)){
            $p_info = array_pluck($p_info,'position');
        }
        $view = view('admin.netred.position',compact('info','p_info'));
        return $this->ajaxReturn($view->render(),0,'','网红推荐');
    }

    /**
     * 更新推荐
     * @author xingyonghe
     * @date 2016-1-11
     * @return
     */
    public function update(){
        $data = request()->all();
        \DB::transaction(function () use($data) {
            UserNetredPosition::where('netred_id',$data['netred_id'])->delete();
            foreach($data['position'] as $item){
                UserNetredPosition::create([
                    'netred_id' => $data['netred_id'],
                    'position' => $item
                ]);
            }
        });
        return $this->ajaxReturn('推荐成功',0,route('admin.netred.index'));
    }

    /**
     * 推荐管理
     * @author xingyonghe
     * @date 2016-1-11
     */
    public function recommend(int $pid=1){
        $lists = UserNetredPosition::where('position',$pid)->get();
        return view('admin.netred.recommend',compact('lists'));
    }


    /**
     * 导航排序
     * @author: xingyonghe
     * @date: 2017-1-4
     * @return
     */
    public function sort(int $pid=1)
    {
        $datas = UserNetredPosition::where('position',$pid)

            ->orderBy('sort','asc')
            ->pluck('name','id');
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
