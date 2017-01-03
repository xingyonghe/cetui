<?php

/**
 * 单选框封装
 * @author: xingyonghe
 * @date: 2017-1-3
 * @param $name 字段名称
 * @param array $list 数据
 * @param null $cheked 选中的值
 * @param array $options 其他参数，如：id,class等
 * @return string
 * @use {!! radio('hide',[0=>'显示',1=>'隐藏'],$info['hide'] ?? 0,[]) !!}
 */
function radio($name, $list=[], $cheked=null, $options = []){
    $html   = [];
    foreach ((array) $options as $key => $value) {
        if (! is_null($value) && ! is_null($key)) {
            $html[] = $key . '="' . e($value) . '"';
        }
    }
    $option = count($html) > 0 ? ' ' . implode(' ', $html) : '';
    $radio  = '';
    foreach ($list as $value => $display) {
        if($cheked == $value){
            $radio .= '<label class="label_radio r_on"><input type="radio" name="'.$name.'" value="'.$value.'" checked=checked '.$option.'>'.$display.'</label>';
        }else{
            $radio .= '<label class="label_radio"><input type="radio" name="'.$name.'" value="'.$value.'" '.$option.'>'.$display.'</label>';
        }

    }
    return $radio;
}