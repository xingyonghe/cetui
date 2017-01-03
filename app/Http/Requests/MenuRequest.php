<?php

namespace App\Http\Requests;

class MenuRequest extends CommonRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'url'   => 'required',
            'name'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请填写菜单标题',
            'url.required'   => '请填写菜单url地址',
            'name.required'  => '请填写菜单标识',
        ];
    }


}
