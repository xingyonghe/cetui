<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
use App\Models\Category;
use SEO;
use App\Models\UserNetred;
use App\Models\UserNetredAdform;
use App\Models\UserNetredPlatform;

class StarController extends Controller{
    protected $navkey = 'star';//菜单标识
    public function __construct()
    {
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
        //资源风格
        $style = configs('NETRED_STYLE');
        //分类
        $category = Category::where('model','star')->orderBy('sort','asc')->orderBy('id','asc')->get(['id','name','pid'])->toArray();
        $category = list_to_tree($category);
        view()->composer(['netred.star.live','netred.star.video'],function($view) use($style,$category){
                $view->with('styles',$style)->with('categorys',$category);
        });
    }

    /**
     * 资源列表
     * @author: xingyonghe
     * @date: 2016-12-23
     *
     */
    public function index()
    {
        $type       = (int)request()->get('type','');
        $status     = (int)request()->get('status','');
        $stage_name = (string)request()->get('stage_name','');

        $lists = UserNetred::where('userid',auth()->id())
            ->where(function ($query) use($type) {
                if($type){
                    $query->where('type',$type);
                }
            })
            ->where(function ($query) use($status) {
                if($status){
                    $query->where('status',$status);
                }
            })
            ->where(function ($query) use($stage_name) {
                if($stage_name){
                    $query->where('stage_name','like','%'.$stage_name.'%');
                }
            })
            ->where('status','>',0)
            ->orderBy('created_at', 'desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>UserNetred::STATUS_TEXT]);
        SEO::setTitle('资源管理-网红中心-'.configs('WEB_SITE_TITLE'));
        $params = [
            'type'       => $type,
            'status'     => $status,
            'stage_name' => $stage_name,
        ];
        return view('netred.star.index',compact('lists','params'));
    }

    /**
     * 添加直播
     * @author: xingyonghe
     * @date: 2016-12-23
     */
    public function live()
    {
        //平台
        $platforms = UserNetredPlatform::where('category',1)->orderBy('sort','asc')->pluck('name','id');
        //广告形式
        $adforms = UserNetredAdform::where('category',1)->orderBy('sort','asc')->pluck('name','id');
        SEO::setTitle('添加直播-网红中心-'.configs('WEB_SITE_TITLE'));
        return view('netred.star.live',compact('platforms','adforms'));
    }

    /**
     * 添加短视频
     * @author: xingyonghe
     * @date: 2016-12-25
     */
    public function video()
    {
        //平台
        $platforms = UserNetredPlatform::where('category',2)->orderBy('sort','asc')->pluck('name','id');
        //广告形式
        $adforms = UserNetredAdform::where('category',2)->orderBy('sort','asc')->pluck('name','id');
        SEO::setTitle('添加短视频-网红中心-'.configs('WEB_SITE_TITLE'));
        return view('netred.star.video',compact('platforms','adforms'));
    }



    /**
     * 资源修改
     * @author: xingyonghe
     * @date: 2016-12-25
     * @return
     */
    public function edit(int $id){
        $templete = [
            1 => 'live',
            2 => 'video',
        ];
        //允许修改的状态条件
        $info = UserNetred::where('userid',auth()->id())
            ->whereIn('status',[UserNetred::STATUS_NORMAL,UserNetred::STATUS_FEILED])
            ->findOrFail($id);
        //平台
        $platforms = UserNetredPlatform::where('category',$info['type'])->orderBy('sort','asc')->pluck('name','id');
        //广告形式
        $adforms = UserNetredAdform::where('category',$info['type'])->orderBy('sort','asc')->pluck('name','id');
        SEO::setTitle('修改资源-网红中心-'.configs('WEB_SITE_TITLE'));

        return view('netred.star.'.$templete[$info['type']],compact('info','platforms','adforms'));
    }

    /**
     * 短视频更新
     * @author: xingyonghe
     * @date: 2016-12-25
     * @return
     */
    public function update(){
        $data = request()->all();
        if((!in_array($data['type'],[1,2])) || request()->method() != 'POST'){
            echo '非法操作';die;
        }
        //后面待完善
        $rules = [
            'avatar'     => 'required',
            'stage_name' => 'required',
            'sex'       => 'required',
            'province'   => 'required',
            'city'    => 'required',
            'platform'   => 'required',
            'platform_id' => 'required',
            'fans' => 'required|integer',
            'average_num' => 'required|integer',
            'max_num' => 'required_if:type,1|integer',
            'style' => 'required',
            'catids' => 'required',
            'form' => 'required',
            'money' => 'required',
        ];
        $msgs = [
            'avatar.required'     => '请上传头像',
            'stage_name.required'   => '请填写用户名',
            'sex.required'       => '请选择资源类别',
            'province.required'   => '请选择直播平台',
            'city.required'    => '请填写直播平台房间号',
            'platform.required'   => '请填写直播平台ID',
            'platform_id.required' => '请填写展现形式及报价',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $resualt = UserNetred::toUpdate($data);
        if($resualt){
            if(!isset($resualt['id'])){
                return response()->json(['info'=>'资源信息添加成功!','status'=>1,'list_url'=>route('netred.star.index'),'pub_url'=>route('netred.star.video')]);
            }else{
                return $this->ajaxReturn('资源信息修改成功!',1,route('netred.star.index'));
            }

        }else{
            return $this->ajaxReturn('资源信息操作失败');
        }
    }

    /**
     * 删除信息
     * @author: xingyonghe
     * @date: 2016-12-25
     * @param int $id
     * @return
     */
    public function destroy(int $id){
        $info = UserNetred::where('userid',auth()->id())
            ->whereIn('status',[UserNetred::STATUS_NORMAL,UserNetred::STATUS_FEILED])
            ->findOrFail($id);
        $resualt = $info->update(array('status'=>UserNetred::STATUS_DELETE));
        if($resualt){
            return $this->ajaxReturn('资源信息删除成功',1,url()->previous());
        }else{
            return $this->ajaxReturn('资源信息删除失败');
        }
    }






}
