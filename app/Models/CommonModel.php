<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model{

    /**
     * 更新/新增数据
     * @author: xingyonghe
     * @date: 2016-11-10
     * @param $data 表单数据
     * @return bool
     */
    protected function updateData($data)
    {
        if(empty($data['id'])){
            //新增
            $resualt = $this->create($data);
            if($resualt === false){
                return false;
            }
        }else{
            //编辑
            $info = $this->find($data['id']);
            if(empty($info) || $info->update($data)===false){
                return false;
            }
        }
        return $data;
    }

    
}
