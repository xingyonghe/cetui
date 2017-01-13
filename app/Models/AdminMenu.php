<?php

namespace App\Models;

/**
 * 系统菜单模型
 * Class AdminMenu
 * @package App\Models
 */
class AdminMenu extends CommonModel
{


    protected $table    = 'admin_menu';
    public $timestamps  = false;
    protected $fillable = [
        'title', 'pid', 'sort', 'url', 'hide', 'group','icon','name'
    ];
    protected $formatTree = [];//用于树型数组完成递归格式的全局变量

    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = empty($value) ? 0 : $value;
    }


    /**
     * 获取所有菜单
     * @author xingyonghe
     * @date 2017-1-3
     * @return mixed
     */
    protected function getMenus(){
        $menus = $this->returnMenus();
        $menus = $this->toFormatTree($menus);
        $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
        return $menus;
    }

    /**
     * 将格式数组转换为树
     * @author: xingyonghe
     * @date: 2016-11-10
     * @param $list
     * @param string $title
     * @param string $pk
     * @param string $pid
     * @param int $root
     * @return mixed
     */
    protected function toFormatTree($list,$title = 'title',$pk='id',$pid = 'pid',$root = 0){
        $list = list_to_tree($list,$pk,$pid,'_child',$root);
        $this->_toFormatTree($list,0,$title);
        return $this->formatTree;
    }

    /**
     * 将格式数组转换为树
     * @author: xingyonghe
     * @date: 2016-11-10
     * @param array $list
     * @param integer $level 进行递归时传递用的参数
     */

    protected function _toFormatTree($list,$level=0,$title = 'title') {
        foreach($list as $key=>$val){
            $tmp_str=str_repeat("&nbsp;",$level*2);
            $tmp_str.="∟";
            $val['level'] = $level;
            $val['title_show'] =$level==0?$val[$title]."&nbsp;":$tmp_str.$val[$title]."&nbsp;";
            if(!array_key_exists('_child',$val)){
                array_push($this->formatTree,$val);
            }else{
                $tmp_ary = $val['_child'];
                unset($val['_child']);
                array_push($this->formatTree,$val);
                $this->_toFormatTree($tmp_ary,$level+1,$title); //进行下一层递归
            }
        }
        return;
    }

    /**
     * 获取所有菜单并存入缓存
     * @author xingyonghe
     * @date 2017-1-3
     * @return mixed
     */
    protected function returnMenus(){
        $menus = $this->orderBy('sort', 'asc')->get()->toArray();
        return $menus;
    }

    /**
     * 返回后台节点数据
     * @param boolean $tree 是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     */
    protected function returnNodes($tree = true){
        static $tree_nodes = array();
        if ( $tree && !empty($tree_nodes[(int)$tree]) ) {
            return $tree_nodes[$tree];
        }
        if((int)$tree){
            $list = $this->returnMenus();
            $nodes = list_to_tree($list,$pk='id',$pid='pid',$child='operator',$root=0);
            foreach ($nodes as $key => $value) {
                if(!empty($value['operator'])){
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        }else{
            $nodes = $this->returnMenus();
        }
        $tree_nodes[(int)$tree]   = $nodes;
        return $nodes;
    }








}
