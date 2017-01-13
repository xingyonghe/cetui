<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use SEO;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * ajax返回信息
     * @author xingyonghe
     * @date 2017-1-3
     * @param $info 提示信息
     * @param $status 状态码 0成功 -1失败
     * @param $url 返回地址
     * @param $title 弹窗标题,只有layer弹窗用到
     * @return
     */
    protected function ajaxReturn($info='', $status=-1, $url='', $title='')
    {
        return response()->json(['status'=>$status, 'info'=>$info, 'url'=>$url, 'title'=>$title]);
    }

    /**
     * select返回的数组进行整数映射转换
     * @author xingyonghe
     * @date 2017-1-3
     * @param max|array $data
     * @param array $map
     * return $data
     */
    protected function intToString(&$data,$map=['status'=>[1=>'正常',-1=>'删除']])
    {
        foreach ($data as $key => &$row){
            foreach ($map as $col=>$pair){
                if(isset($row[$col]) && isset($pair[$row[$col]])){
                    $text = $col.'_text';
                    $row[$text] = $pair[$row[$col]];
                }
            }
        }
        return $data;
    }

    /**
     * ajax字段验证
     * 返回第一条错误信息和错误信息关联字段名称
     * @author xingyonghe
     * @date 2017-1-3
     * @param $validator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function ajaxValidator($validator)
    {
        //错误字段集合，每个字段对应相应html元素ID
        $errorIds = $validator->messages()->keys();
        return response()->json(['status'=>-1,'info'=>$validator->messages()->first(),'id'=>$errorIds[0]]);
    }


    protected function success($msg='',$url='', $time=5){
        SEO::setTitle('消息提示-'.configs('WEB_SITE_TITLE'));
        $message = [
            'msg'  => $msg,
            'url'  => $url,
            'time' => $time,
        ];
        return view('errors.success',compact('message'));
    }

    protected function errors($msg='',$url='', $time=5){
        SEO::setTitle('消息提示-'.configs('WEB_SITE_TITLE'));
        $message = [
            'msg'  => $msg,
            'url'  => $url,
            'time' => $time,
        ];
        return view('errors.errors',compact('message'));
    }



}
