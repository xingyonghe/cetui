<?php

namespace App\Models;

/**
 * 系统菜单模型
 * Class AdminMenu
 * @package App\Models
 */
class AdminMenu extends CommonModel{


    protected $table    = 'admin_menu';
    public $timestamps  = false;
    protected $fillable = [
        'title', 'pid', 'sort', 'url', 'hide', 'group','icon'
    ];
    

//    /**
//     * 获取所有菜单
//     * @author xingyonghe
//     * @date 2016-11-10
//     * @return mixed
//     */
//    public function getMenus(){
//        $menus = $this->returnMenus();
//        $menus = $this->toFormatTree($menus);
//        $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
//        return $menus;
//    }
//
//    /**
//     * 获取所有菜单并存入缓存
//     * @author xingyonghe
//     * @date 2016-11-10
//     * @return mixed
//     */
//    public function returnMenus(){
//        $menus = cache()->get('MENUS_LIST');
//        if(empty($menus)){
//            $menus = $this->orderBy('sort', 'asc')->get()->toArray();
//            cache()->forever('MENUS_LIST',$menus);//永久保存
//        }
//        return $menus;
//    }
//
//    /**
//     * 返回后台节点数据
//     * @param boolean $tree 是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
//     * @retrun array
//     */
//    public function returnNodes($tree = true){
//        static $tree_nodes = array();
//        if ( $tree && !empty($tree_nodes[(int)$tree]) ) {
//            return $tree_nodes[$tree];
//        }
//        if((int)$tree){
//            $list = $this->returnMenus();
//            $nodes = list_to_tree($list,$pk='id',$pid='pid',$child='operator',$root=0);
//            foreach ($nodes as $key => $value) {
//                if(!empty($value['operator'])){
//                    $nodes[$key]['child'] = $value['operator'];
//                    unset($nodes[$key]['operator']);
//                }
//            }
//        }else{
//            $nodes = $this->returnMenus();
//        }
//        $tree_nodes[(int)$tree]   = $nodes;
//        return $nodes;
//    }








}
