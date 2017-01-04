<?php

namespace App\Models;

use Storage;

class Picture extends CommonModel
{

    protected $table = 'picture';
    public $timestamps = false;
    protected $fillable = [
        'url', 'path'
    ];
    protected $hidden = [
        'md5', 'sha1', 'create_time'
    ];

}
