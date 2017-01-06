<?php

namespace App\Models;

class UserAccount extends CommonModel{

    protected $table = 'user_account';
    protected $fillable = [
        'userid','bank_id','account','deposit','username'
    ];


    protected function getUserAccount($userid = 0){
        if(empty($userid)){
            $userid = auth()->id();
        }
        $data = $this->where('userid',$userid)->get();
        return $data;
    }

}
