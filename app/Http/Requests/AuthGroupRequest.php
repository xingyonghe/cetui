<?php

namespace App\Http\Requests;

class AuthGroupRequest extends CommonRequest
{


    public function rules(){
        return [
            'title' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required' => '请填写用户组名称',
        ];
    }
}
