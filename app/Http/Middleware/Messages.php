<?php

namespace App\Http\Middleware;

use App\Models\MessagesSys;
use Closure;
use App\Models\Messages as UserMessage;

class Messages
{

    public function handle($request, Closure $next)
    {
        if(auth()->guard()->check()){
            //把系统公告单独写给每一个登陆的用户
            $this->writeMessage();
//            查找消息分类下面登陆用户的未读消息条数
//            $messages = $this->getUnreadMessage();
//            view()->share('messages',$messages);
        }
        return $next($request);
    }

    /**
     * 把系统消息单独写给每一个登陆的用户
     * @author xingyonghe
     * @date 2016-11-8
     * @param int $userid 登陆用户ID
     */
    protected function writeMessage()
    {
        //根据用户的最新的一条系统公告消息的时间查找系统公告消息表中大于该时间的所有系统公告消息，然后保存消息
        $items = MessagesSys::where(array(['created_at','>',
            //category = 2为系统公告分类
            UserMessage::where('category',UserMessage::CATEGORY_2)->where('userid',auth()->id())
                ->orderBy('created_at','desc')
                ->value('created_at') ?? '']))
            ->get()
            ->toArray();
        if(!empty($items)){
            foreach($items as $key=>$message){
                //用户type=1为用户2为广告主，$message['group'] 0全部1用户2广告主
                if(auth()->user()->type == 1 && ($message['group'] == 0 || $message['group'] == 1)){
                    UserMessage::sendMessages($message['title'],$message['content'],auth()->id(),$message['created_at'],UserMessage::CATEGORY_2);
                }
                if(auth()->user()->type == 2 && ($message['group'] == 0 || $message['group'] == 2)){
                    UserMessage::sendMessages($message['title'],$message['content'],auth()->id(),$message['created_at'],UserMessage::CATEGORY_2);
                }

            }
        }
    }

//    /**
//     * 查找消息分类下面登陆用户的未读消息条数
//     * @author xingyonghe
//     * @date 2016-11-8
//     * @param int $userid 登陆用户ID
//     */
//    protected function getUnreadMessage(int $userid)
//    {
//        $datas = SysMessage::select(\DB::raw('count(*) as sum,message_catid'))
//            ->where('user_id',$userid)
//            ->where('status',0)
//            ->groupBy('message_catid')
//            ->get()
//            ->toArray();
//        $datas = array_pluck($datas,'sum','message_catid');
//        $catids = SysMessageCategory::getMessageCategory();
//        //把没有分类消息的设置为0
//        $_datas = array();
//        foreach($catids as $key=>$item){
//            if($datas){
//                foreach($datas as $k => $val){
//                    if($key == $k){
//                        $_datas[$item] = ['catid'=>$key,'num'=>$val];
//                        break;
//                    }else{
//                        $_datas[$item] = ['catid'=>$key,'num'=>0];
//                    }
//                }
//            }else{
//                $_datas[$item] = ['catid'=>$key,'num'=>0];
//            }
//
//        }
//        return $_datas;
//    }
}
