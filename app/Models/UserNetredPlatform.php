<?php

namespace App\Models;

class UserNetredPlatform extends CommonModel
{
    protected $table = 'user_netred_platform';
    protected $fillable = [
        'name', 'icon','category','sort'
    ];

    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = empty($value) ? 0 : $value;
    }



}
