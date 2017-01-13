<?php

namespace App\Http\Middleware;

use App\Models\AdminAuthRule;
use App\Models\AdminMenu;
use Closure;
class AdminMenus
{
    public function handle($request, Closure $next)
    {
        view()->share('menus',$this->getMenu());//share()，分享数据给所有视图，参数一代表键，参数二代表值
        return $next($request);
    }

    /**
     * 返回后台用户权限菜单，存入session
     * @return array
     */
    public function getMenu()
    {
        session()->forget('ADMIN_MENU_LIST');//更新菜单session
        //获取当前URL菜单
        $current = request()->route()->getName();
        $urlCurrent = explode('.',$current);
        $menus = session()->get('ADMIN_MENU_LIST.'.$urlCurrent[1]);//加上控制器的名称用来区分菜单的子菜单
        if(empty($menus)){
            //获取用户角色ID
            $userGroupId = auth()->guard('admin')->user()->role_id;
            //获取用户角色的所有权限
            $access = AdminAuthRule::getUserRules($userGroupId);

            //获取所有菜单
            $menus = [];
            $sysmenus = AdminMenu::returnMenus();
            $menus['main'] = array_where($sysmenus, function ($value, $key){
                return ($value['pid'] == 0) && ($value['hide'] == 0);
            });

            //检查权限。保留用户有权限的菜单
            foreach($menus['main'] as $key=>$item){
                if(is_administrators()){
                    break;
                }
                if(!in_array($item['name'],$access)){
                    unset($menus['main'][$key]);
                    continue;//继续循环
                }
            }

            //查找当前的链接的PID信息
            $parent = AdminMenu::select('pid')->where('pid','>',0)->where('name',$current)->first();
            if($parent['pid']){
                //从缓存中读取pid菜单详细
                $nav = array_where($sysmenus, function ($value, $key) use($parent){
                    return $value['id'] == $parent['pid'];
                });
                //返回pid菜单的ID
                $nav = head($nav);
                if($nav['pid']){
                    $nav = array_where($sysmenus, function ($value, $key) use($nav){
                        return $value['id'] == $nav['pid'];
                    });
                    $nav = head($nav);
                }
            }else{
                //当不存在父级的时候，代表访问的是首页
                $nav = array_where($menus['main'], function ($value, $key) use($parent){
                    return $value['id'] == 1;
                });
                $nav = head($nav);
            }

            foreach($menus['main'] as $key=>$item){
                if($nav['id'] == $item['id']){
                    $menus['main'][$key]['current'] = 'active';
                    //生成child 树
                    $groups = array_where($sysmenus, function ($value, $key) use($item){
                        return ($value['pid'] == $item['id']) &&  ($value['group'] != '');
                    });
                    foreach ($groups as $g) {
                        $menuList = array_where($sysmenus, function ($value, $key) use($item,$g){
                            return ($value['pid'] == $item['id']) &&  ($value['group'] == $g['group']) &&  ($value['hide'] == 0);
                        });

                        foreach($menuList as $k=>$list){
                            if(is_administrators()){
                                break;
                            }
                            if(!in_array($list['name'],$access)){
                                unset($menuList[$k]);
                                continue;//继续循环
                            }
                            if($list['name'] == $current){
                                $menuList[$k]['current'] = 'active';
                            }else{
                                $menuList[$k]['current'] = '';
                            }
                        }
                        $menus['child'][$g['group']] = $menuList;
                    }
                }else{
                    $menus['main'][$key]['current'] = '';
                }
            }
            session()->put('ADMIN_MENU_LIST.'.$urlCurrent[1],$menus);
        }
        return $menus;
    }
}
