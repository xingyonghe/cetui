<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Category;
use SEO;
use App\Models\UserNetred;
use App\Models\UserNetredAdform;
use App\Models\UserNetredPlatform;

class NetredController extends Controller
{
    protected $navkey = 'netred';//菜单标识
    public function __construct()
    {
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
        //资源风格
        $styles = configs('NETRED_STYLE');
        //分类
//        $category = Category::where('model','star')->orderBy('sort','asc')->orderBy('id','asc')->get(['id','name','pid'])->toArray();
//        $category = list_to_tree($category);
        view()->composer(['ads.netred.index'],function($view) use($styles){
            $view->with('styles',$styles);
        });
    }

    /**
     * 资源列表
     * @author: xingyonghe
     * @date: 2017-1-8
     * @return mixed
     */
    public function index()
    {
        $type       = (int)request()->get('type','');
        $status     = (int)request()->get('status','');
        $stage_name = (string)request()->get('stage_name','');
        $lists = UserNetred::where('status',UserNetred::STATUS_NORMAL)
            ->whereNotNull('userid')
            ->where(function ($query) use($type) {
                if($type){
                    $query->where('type',$type);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        //平台
        $platforms = UserNetredPlatform::orderBy('sort','asc')->pluck('name','id');
        //广告形式
        $adforms = UserNetredAdform::orderBy('sort','asc')->pluck('name','id');
        SEO::setTitle('资源列表-广告主中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.netred.index',compact('lists','adforms'));
    }




}
