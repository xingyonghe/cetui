<?php

namespace App\Http\Requests;

class ChannelRequest extends CommonRequest
{

    public function rules()
    {
        return [
            'title' => 'required',
            'url'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请填写导航标题',
            'url.required'   => '请填写导航url地址',
        ];
    }
}
