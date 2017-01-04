<?php

namespace App\Models;

class Config extends CommonModel
{

    protected $table = 'config';
    protected $fillable = [
        'title', 'name','type','group','value','extra','remark','module'
    ];

}
