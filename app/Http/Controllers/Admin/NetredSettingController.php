<?php

namespace App\Http\Controllers\Admin\Star;

use App\Http\Controllers\Controller;//公用控制器

class NetredSettingController extends Controller
{
    protected $model = 'star';

    /**
     * 模块配置
     * @author: xingyonghe
     * @date: 2016-12-24
     * @return mixed
     */
    public function index(){
        $model = $this->model;
        $lists = D('SysConfig')
            ->where('group',3)
            ->where('module',$model)
            ->orderBy('sort','asc')
            ->get(['id','title', 'name','sort','type','group','value','extra','remark'])
            ->toArray();
        return view('admin.config.module',compact('lists','model'));
    }


    /**
     * 更新配置
     * @author: xingyonghe
     * @date: 2016-12-24
     * @return
     */
    public function update(){
        $config = request()->config;
        if($config && is_array($config)){
            foreach ($config as $name => $value) {
                $info = D('SysConfig')->where(array('name' => $name))->first();
                $info->update(array('value'=>$value));
            }
        }
        cache()->forget('CONFIG_LIST');//更新配置缓存
        return redirect()->back()->withSuccess('模块配置更新成功!');
    }





}
