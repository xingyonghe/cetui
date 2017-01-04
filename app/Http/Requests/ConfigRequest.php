<?php

namespace App\Http\Requests;


class ConfigRequest extends CommonRequest
{

    public function rules()
    {
        $id = $this->get('id');
        return [
            'title' => 'required',
            'name' => 'required|unique:config,name,'.$id,
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请填写配置标题',
            'name.required'   => '请填写配置标识',
            'name.unique'   => '配置标识已经存在',
        ];
    }
}
