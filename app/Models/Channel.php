<?php

namespace App\Models;

class Channel extends CommonModel
{

    protected $table = 'channel';
    protected $fillable = [
        'title', 'remark','url','sort','status','target'
    ];



}
