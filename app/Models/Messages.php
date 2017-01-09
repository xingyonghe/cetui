<?php

namespace App\Models;

class Messages extends CommonModel
{

    const CATEGORY_1 = 1;//系统消息
    const CATEGORY_2 = 2;//系统公告
    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'messages';
    protected $fillable = [
        'userid','title', 'content', 'status','category','created_at'
    ];
    protected $dates = ['created_at'];

    /**
     * 发送站内信
     * @author xingyonghe
     * @date 2016-1-7
     * @param string $title
     * @param string $content
     * @param int $userid
     * @param int $category
     */
    protected function sendMessages($title='', $content='', $userid, $time = '', $category=1){
        if(empty($time)){
            $time =  \Carbon\Carbon::now();
        }
        $resault = $this->create([
            'title'    => $title,
            'content'  => $content,
            'userid'   => $userid,
            'category' => $category,
            'created_at' => $time
        ]);
        if($resault === false){
            return false;
        }
        return true;
    }


}
