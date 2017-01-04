<?php

namespace App\Models;

class UserNetredAdform extends CommonModel
{
    protected $table = 'user_netred_adform';
    protected $fillable = [
        'name', 'explain','category','sort'
    ];

    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = empty($value) ? 0 : $value;
    }



}
