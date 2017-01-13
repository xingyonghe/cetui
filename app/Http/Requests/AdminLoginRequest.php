<?php

namespace App\Http\Requests;


class AdminLoginRequest extends CommonRequest
{


    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '请填写管理员账号',
            'password.required' => '请填写登陆密码',
        ];
    }
}
