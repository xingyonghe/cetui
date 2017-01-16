<?php

namespace App\Models;

class UserNetredPosition extends CommonModel
{

    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'user_netred_position';
    protected $fillable = [
        'netred_id','sort', 'position'
    ];



}
