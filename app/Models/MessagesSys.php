<?php

namespace App\Models;

class MessagesSys extends CommonModel
{


    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'messages_sys';
    protected $fillable = [
        'title', 'name', 'content','category','created_at','group'
    ];
    protected $dates = ['created_at'];

    /**
     * 群发消息
     * @author xingyonghe
     * @date 2016-1-7
     * @param string $title
     * @param string $content
     * @param int $category 默认为 Messages::CATEGORY_2
     */
    protected function sendMessages($title='',$content='',$group= 0, $category=2){
        $resault = $this->insert([
            'title'    => $title,
            'content'  => $content,
            'group'    => $group,
            'name'     => create_name(),
            'category' => $category,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        if($resault === false){
            return false;
        }
        return true;
    }


}
