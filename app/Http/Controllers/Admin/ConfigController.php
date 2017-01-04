<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigRequest;
use App\Models\Config;

class ConfigController extends Controller
{

    public function __construct()
    {
        view()->composer(['admin.config.edit'],function($view){
            //配置类型/配置分组
            $view->with('config_type',configs('CONFIG_TYPE_LIST'))
                 ->with('config_group',configs('CONFIG_GROUP_LIST'))
                 ->with('config_module',configs('CONFIG_MODULE_LIST'));
        });
    }

    /**
     * 网站配置
     * @author xingyonghe
     * @date 2017-1-4
     */
    public function index()
    {
        $title = (string)request()->get('title','');
        $name = (string)request()->get('name','');
        $lists = Config::select(['id', 'title', 'name','type','group','module'])
            ->where(function ($query) use($name,$title) {
                if($name){
                    $query->where('name','like','%'.$name.'%');
                }
                if($title){
                    $query->where('title','like','%'.$title.'%');
                }
            })
            ->orderBy('created_at','desc')
            ->paginate(configs('ADMIN_PAGE_LIMIT') ?? 10);

        $this->intToString($lists,[
            'group' => configs('CONFIG_GROUP_LIST'),
            'type'  => configs('CONFIG_TYPE_LIST'),
            'module'=> configs('CONFIG_MODULE_LIST')
        ]);

        $params = [
            'name'  => $name,
            'title' => $title
        ];
        return view('admin.config.index',compact('lists','params'));
    }

    /**
     * 新增
     * @author xingyonghe
     * @date 2017-1-4
     */
    public function create()
    {
        return view('admin.config.edit');
    }

    /**
     * 编辑
     * @author xingyonghe
     * @date 2017-1-4
     * @param int $id
     */
    public function edit(int $id)
    {
        $info = Config::findOrFail($id);
        return view('admin.config.edit',compact('info'));
    }

    /**
     * 配置更新
     * @author xingyonghe
     * @date 2017-1-4
     * @param ConfigRequest $request
     * @return
     */
    public function update(ConfigRequest $request)
    {
        $resualt = Config::updateData($request->all());
        if($resualt){
            return $this->ajaxReturn(isset($resualt['id'])?'配置信息修改成功':'配置信息新增成功',1,route('admin.config.index'));
        }else{
            return $this->ajaxReturn('数据信息操作失败');
        }
    }

    /**
     * 删除
     * @author xingyonghe
     * @date 2017-1-4
     */
    public function destroy(int $id)
    {
        $resualt = Config::destroy($id);
        if($resualt){
            return redirect()->back()->withSuccess('删除信息成功!');
        }else{
            return redirect()->back()->with('error','删除信息失败');
        }
    }

    /**
     * 网站设置
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param int $group_id
     */
    public function setting(int $group_id = 1)
    {
        //取出所有配置分组
        $group = configs('CONFIG_GROUP_LIST');
        //这里只显示基本和系统的配置，其余的放在各自的模型去管理
        $group = array_where($group, function ($value, $key) {
            return $key<3;
        });
        $lists = Config::where('group',$group_id)
            ->orderBy('id','asc')
            ->get(['id','title', 'name','type','group','value','extra','remark']);
        return view('admin.config.setting',compact('lists','group','group_id'));
    }

    /**
     * 更新网站设置
     * @author: xingyonghe
     * @date: 2017-1-4
     * @return mixed
     */
    public function post()
    {
        $data = request()->only('config');
        $config = $data['config'];
        if($config && is_array($config)){
            foreach ($config as $name => $value) {
                $info = Config::where(array('name' => $name))->first();
                $info->update(array('value'=>$value));
            }
        }
        return redirect()->back()->withSuccess('更新网站设置成功!');
    }
}
