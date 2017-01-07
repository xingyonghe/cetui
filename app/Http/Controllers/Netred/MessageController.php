<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use SEO;

class MessageController  extends Controller
{

    protected $navkey = 'message';//菜单标识
    public function __construct(){
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
    }

    /**
     * 列表
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function index()
    {
        $lists = Messages::where('userid',auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        SEO::setTitle('消息中心-网红中心'.configs('WEB_SITE_TITLE'));
        return view('netred.message.index',compact('lists'));
    }

    /**
     * 首页
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param $id
     */
    public function show(int $id)
    {
        $info = Messages::where('userid',auth()->id())->findOrFail($id);
        if($info['status'] == 1){
            $info->update(['status'=>2]);
        }
        SEO::setTitle('消息详情-网红中心'.configs('WEB_SITE_TITLE'));
        return view('netred.message.show',compact('info'));
    }





}
