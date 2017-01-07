<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\MessagesSys;
use App\Models\User;


class MessageController extends Controller
{

    /**
     * 系统消息列表
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function index(){
        $lists = Messages::orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        return view('admin.message.index',compact('lists'));
    }

    /**
     * 新增
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return
     */
    public function add(){
        $view = view('admin.message.add');
        return $this->ajaxReturn($view->render(),0,'','新增账户');
    }

    /**
     * 发送
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param UserBankRequest $request
     * @return
     */
    public function send(){
        $data = request()->all();
        if(empty($data['name'])){
            return $this->ajaxReturn('请填写收件人');
        }
        if(empty($data['title'])){
            return $this->ajaxReturn('请填写标题');
        }
        if(empty($data['content'])){
            return $this->ajaxReturn('请填写内容');
        }
        $name = explode('-',$data['name']);
        foreach($name as $mobile){
            $user  = User::where('username',$mobile)->first();
            if($user){
                Messages::sendMessages($data['title'],$data['content'],$user['id']);
            }
        }
        return $this->ajaxReturn('发送成功',0,url()->previous());
    }


    /**
     * 系统公告列表
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function notice(){
        $lists = MessagesSys::orderBy('created_at', 'desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);
        return view('admin.message.notice',compact('lists'));
    }

    /**
     * 新增
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return
     */
    public function create(){
        $view = view('admin.message.create');
        return $this->ajaxReturn($view->render(),0,'','发送系统公告');
    }

    /**
     * 发送
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param UserBankRequest $request
     * @return
     */
    public function post(){
        $data = request()->all();
        if(empty($data['title'])){
            return $this->ajaxReturn('请填写标题');
        }
        if(empty($data['content'])){
            return $this->ajaxReturn('请填写内容');
        }
        $resault = MessagesSys::sendMessages($data['title'],$data['content'],$data['group']);
        if($resault){
            return $this->ajaxReturn('发送成功',0,url()->previous());
        }else{
            return $this->ajaxReturn('发送失败');
        }
    }





}
