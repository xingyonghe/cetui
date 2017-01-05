<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use SEO;

class IndexController extends Controller
{

    protected $channel_id = 1;//设置导航选中标志

    public function __construct()
    {
        view()->share('channel_id',$this->channel_id);
    }

    public function index()
    {
        SEO::setTitle(configs('WEB_SITE_TITLE'));
        $category = Category::where('model','netred')->orderBy('sort','asc')
            ->orderBy('id','asc')
            ->get(['id','name','pid'])->toArray();
        $category = list_to_tree($category);
        return view('home.index.index',compact('category'));
    }



























}
