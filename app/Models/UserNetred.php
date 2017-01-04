<?php

namespace App\Models;

use App\Models\Region;

class UserNetred extends CommonModel{
    /*
    |--------------------------------------------------------------------------
    | UserAccount Model
    | @author xingyonghe
    | @date 2016-12-23
    |--------------------------------------------------------------------------
    |
    | 网红资源模型
    |
    */
    const STATUS_DELETE = -1;//删除
    const STATUS_NORMAL = 1;//正常
    const STATUS_VERIFY = 2;//待审核
    const STATUS_FEILED = 3;//未通过
    const STATUS_TEXT = [
        self::STATUS_DELETE => '<span class="label label-danger label-mini">删除</span>',
        self::STATUS_NORMAL => '<span class="label label-success label-mini">正常</span>',
        self::STATUS_VERIFY => '<span class="label label-info label-mini">待审核</span>',
        self::STATUS_FEILED => '<span class="label label-warning label-mini">未通过</span>',
    ];

    protected $table = 'user_netred';
    protected $fillable = [
        'userid','status','avatar','stage_name','sex','province','city','district',
        'area','type','fans','platform','platform_id','average_num','max_num','style',
        'catids','form_price','min_money','max_money','note','advantage','introduce'
    ];
    protected $casts = [
        'style' => 'array','catids' => 'array','style' => 'array','form_price' => 'array',
    ];


    /**
     * 更新/新增数据
     * @author: xingyonghe
     * @date: 2016-11-10
     * @param $data 表单数据
     * @return bool
     */
    protected function toUpdate($data)
    {
        //过滤空值得广告形式参考价格和价格有效期
        $data['money'] = array_where($data['money'], function ($value,$key) {
            if(!empty($value))return $value;
        });
        $data['term'] = array_where($data['term'], function ($value,$key) {
            if(!empty($value))return $value;
        });
        //设置最高价格与最低价格
        $money = array_sort($data['money'],function ($value){
            return $value;
        });
        $data['min_money'] = head($money);
        $data['max_money'] = last($money);
        //组装广告形式和相应价格及有效期到form_price字段
        $money_term = [];
        foreach($data['money'] as $key=>$item){
            $money_term[$key] = ['price'=>$item,'term'=>$data['term'][$key]];
        }
        $data['form_price'] = array_combine($data['form'],$money_term);
        unset($data['form']);unset($data['money']);unset($data['term']);
        //组装地区area字段
        $area = Region::whereIn('id',[$data['province'],$data['city'],$data['district']])->pluck('name')->toArray();
        $data['area'] = implode(',',$area);
        if(empty($data['id'])){
            //新增
            $data['userid'] = auth()->id();
            $data['status'] = C('USER_MEDIA_VERIFY') ? self::STATUS_VERIFY : self::STATUS_NORMAL;
            $resualt = $this->create($data);
            if($resualt === false){
                return false;
            }
        }else{
            //编辑
            $info = $this->find($data['id']);
            if($info['status'] == self::STATUS_FEILED){
                $info['status'] == self::STATUS_VERIFY;
            }
            if(empty($info) || $info->update($data)===false){
                return false;
            }
        }
        return $data;
    }

}
