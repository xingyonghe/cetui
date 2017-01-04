<?php

/**
 * 单选框封装
 * @author: xingyonghe
 * @date: 2017-1-3
 * @param $model 模块名称，默认为后台，针对单选框各个部分的样式不同
 * @param $name 字段名称
 * @param array $list 数据
 * @param null $cheked 选中的值
 * @param array $options 其他参数，如：id,class等
 * @return string
 * @use {!! radio('hide',[0=>'显示',1=>'隐藏'],$info['hide'] ?? 0,[]) !!}
 */
function radio($model='admin', $name, $list=[], $cheked=null, $options = [])
{
    $option = get_options($options);
    $html  = '';
    switch($model){
        case 'admin':
            foreach ($list as $value => $display) {
                if($cheked == $value){
                    $html .= '<label class="label_radio r_on"><input type="radio" name="'.$name.'" value="'.$value.'" checked=checked '.$option.'>'.$display.'</label>';
                }else{
                    $html .= '<label class="label_radio"><input type="radio" name="'.$name.'" value="'.$value.'" '.$option.'>'.$display.'</label>';
                }

            }
            break;
    }
    return $html;
}

/**
 * 下拉框封装
 * @author: xingyonghe
 * @date: 2017-1-4
 * @param $name 字段名称
 * @param array $list 数据
 * @param null $cheked 选中的值
 * @param array $options 其他参数，如：id,class等
 * @return string
 * @use {!! select('hide',[0=>'显示',1=>'隐藏'],$info['hide'] ?? 0,[]) !!}
 */
function select($name, $list=[], $select=null, $options = [])
{
    $option = get_options($options);
    $html  = '<select name="'.$name.'"  '.$option.'>';
    foreach ($list as $value => $display) {
        if($select == $value){
            $html .= '<option value="'.$value.'" selected=selected>'.$display.'</option>';
        }else{
            $html .= '<option value="'.$value.'">'.$display.'</option>';
        }

    }
    $html  .= '</select>';
    return $html;
}

/**
 * 获取标签属性，针对单选，多选，下拉框
 * @author: xingyonghe
 * @date: 2017-1-4
 * @param $options
 * @return string
 */
function get_options($options){
    $html   = [];
    foreach ((array) $options as $key => $value) {
        if (! is_null($value) && ! is_null($key)) {
            $html[] = $key . '="' . e($value) . '"';
        }
    }
    return count($html) > 0 ? ' ' . implode(' ', $html) : '';

}

/**
 * 打印原生sql语句
 * 在你想打印的sql语句之前使用此方法
 * @author xingyonghe
 * @date 2017-1-3
 * @return string 返回SQL语句
 */
function sql_dump()
{
    \DB::listen(function ($query) {
        $bindings = $query->bindings;
        $i = 0;
        $rawSql = preg_replace_callback('/\?/', function ($matches) use ($bindings, &$i) {
            $item = isset($bindings[$i]) ? $bindings[$i] : $matches[0];
            $i++;
            return gettype($item) == 'string' ? "'$item'" : $item;
        }, $query->sql);
        echo $rawSql."\n<br /><br />\n";
    });
}

/**
 * 生产客服QQ url
 * @author xingyonghe
 * @date 2017-1-3
 * @param $custom_id 客服ID
 * @return string
 */
function  get_custom_qq($custom_id)
{
    if(empty($custom_id)){
        return '';
    }
    $info = \App\Models\SysAdmin::find($custom_id);
    if(empty($info) || empty($info['qq'])){
        return '';
    }
    $qq_url = 'tencent://message/?uin='.$info['qq'].'&Site=&Menu=yes';
    return $qq_url;
}

/**
 * 是否是管理员
 * @author: xingyonghe
 * @date: 2017-1-3
 */
function is_administrators()
{
    if(auth()->guard('admin')->id() == 1){
        return true;
    }
    return false;
}

/**
 * 分析枚举类型配置值
 * @author xingyonghe
 * @date 2017-1-3
 * @param $string
 * @return array
 */
function parse_config_attr($string)
{
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}

/**
 * 把返回的数据集转换成Tree
 * @author xingyonghe
 * @date 2017-1-3
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 获取菜单信息
 * @author xingyonghe
 * @date 2017-1-3
 * @param $menu_id
 * @param $name
 * @return mixed
 */
function get_menu($menu_id,$name='title')
{
    $menu = \App\Models\AdminMenu::find($menu_id);
    return empty($menu) ? '': $menu[$name];
}


/**
 * 获取网站配置
 * @author xingyonghe
 * @date 2017-1-4
 * @param $name 配置标识
 * @return mixed
 */
function configs($name)
{
    $configs = \App\Models\Config::all();
    foreach($configs as $key=>&$value){
        if($value['type'] == 3){
            $value['value'] = parse_config_attr($value['value']);
        }
    }
    $configs = array_pluck($configs,'value','name');
    return isset($configs[$name]) ? $configs[$name] : '';
}



