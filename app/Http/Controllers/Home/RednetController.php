<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserNetred;
use SEO;

class RednetController extends Controller
{
    protected $channel_id = 2;//设置导航选中标志
    public function __construct()
    {
        view()->share('channel_id',$this->channel_id);
    }

    public function index()
    {
        SEO::setTitle(configs('WEB_SITE_TITLE'));

        $stage_name = (string)request()->get('stage_name','');
        $lists = UserNetred::where('status',UserNetred::STATUS_NORMAL)
            ->whereNull('userid')
            ->where(function ($query) use($stage_name) {
                if($stage_name){
                    $query->where('stage_name','like','%'.$stage_name.'%');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        $params = array(
            'stage_name' => $stage_name,
        );

        //查找所有分类
        $category = Category::where('model','netred')->orderBy('sort','asc')
            ->orderBy('id','asc')
            ->get(['id','name','pid'])->toArray();
        $category = list_to_tree($category);

        return view('home.rednet.index',compact('category','lists'));
    }



























}
