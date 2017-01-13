<?php

namespace App\Http\Requests;

class AdminUserRequest extends CommonRequest
{

    public function rules()
    {
        return [
            'username' => 'required',
            'nickname' => 'required',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'username.required'   => '请填写账号名称',
            'nickname.required'   => '请填写管理员昵称',
            'password.required'   => '请填写账号登陆密码',
            'password.min'        => '账号密码不能低于6位数',
            'password.confirmed'  => '密码确认不一致',
        ];
    }
}
