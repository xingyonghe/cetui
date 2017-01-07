<?php

namespace App\Models;

class Region extends CommonModel
{

    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'region';
    protected $fillable = [
        'code','name', 'parent_id', 'first_letter', 'level'
    ];
    


}
