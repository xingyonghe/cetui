<?php

namespace App\Models;

class Category extends CommonModel
{
    protected $table = 'category';
    protected $fillable = [
        'name','sort', 'pid', 'model',
    ];
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
    protected $formatTree;

    /**
     * 获取所有分类
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param array $map
     * @return mixed
     */
    protected function getCategory(string $model)
    {
//        $lists = cache()->get('CATEGORY_LIST.'.$model);
//        if(empty($lists)){
//
//            cache()->forever('CATEGORY_LIST.'.$model,$lists);
//        }
        $lists = $this->select('id','name','pid')->where('model',$model)->orderBy('sort','asc')->get()->toArray();
        return $lists;
    }

    /**
     * 分类更新下拉菜单
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param $model
     * @return array|mixed
     */
    protected function getMenu(string $model)
    {
        $lists = $this->getCategory($model);
        $menus = $this->toFormatTree($lists,'name');
        $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级分类')), $menus);
        return $menus;
    }

    /**
     * 信息发布下拉菜单
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param $model
     * @return array|mixed
     */
    protected function getTree($model)
    {
        $lists = $this->getCategory($model);
        $menus = $this->toFormatTree($lists,'name');
        $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'请选择')), $menus);
        return $menus;
    }

    /**
     * 获取分类名称
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param $model 模块名称
     * @param $catid 分类ID
     */
    protected function getCateName($model,$catid)
    {
        $lists = $this->getCategory($model);
        $cate = array_where($lists,function($value,$key) use($catid){
            return $value['id'] == $catid;
        });
        return array_get($cate, '0.name');
    }
























}
