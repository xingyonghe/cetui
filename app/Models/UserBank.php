<?php

namespace App\Models;

class UserBank extends CommonModel
{

    protected $table = 'user_bank';
    protected $fillable = [
        'name', 'logo','sort'
    ];

    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = empty($value) ? 0 : $value;
    }

    /**
     * 获取所有银行
     * @author xingyonghe
     * @date 2016-1-5
     */
    protected function getBank(){
        $data = $this->all()->pluck('name','id');
        return $data;
    }
}
