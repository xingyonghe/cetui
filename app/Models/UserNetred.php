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
        self::STATUS_DELETE => '<a class="label label-danger label-mini">删除</a>',
        self::STATUS_NORMAL => '<a class="label label-success label-mini">正常</a>',
        self::STATUS_VERIFY => '<a class="label label-info label-mini">待审核</a>',
        self::STATUS_FEILED => '<a class="label label-warning label-mini">未通过</a>',
    ];

    protected $table = 'user_netred';
    protected $fillable = [
        'userid','status','avatar','stage_name','sex','province','city','district',
        'area','type','fans','form_id','platform_id','average_num','max_num','style',
        'catids','form','money','term_time','note','advantage','introduce'
    ];
    protected $casts = [
        'style' => 'array','catids' => 'array','style' => 'array','form' => 'array',
    ];
    protected $dates = ['term_time'];


    /**
     * 更新/新增数据
     * @author: xingyonghe
     * @date: 2016-11-10
     * @param $data 表单数据
     * @return bool
     */
    protected function updateData($data)
    {
        $data['average_num'] = empty($data['average_num']) ? 0 : $data['average_num'];
        $data['max_num'] = empty($data['max_num']) ? 0 : $data['max_num'];
        //组装地区area字段
        $area = Region::whereIn('id',[$data['province'],$data['city'],$data['district']])->pluck('name')->toArray();
        $data['area'] = implode(',',$area);

        if(empty($data['id'])){
            //新增
            $data['userid'] = auth()->id();
            $data['status'] = configs('NETRED_VERIFY') ? self::STATUS_VERIFY : self::STATUS_NORMAL;
            $resualt = $this->create($data);
            if($resualt === false){
                return false;
            }
        }else{
            //编辑
            $info = $this->find($data['id']);
            $data['status'] = configs('NETRED_VERIFY') ? self::STATUS_VERIFY : self::STATUS_NORMAL;
            if(empty($info) || $info->update($data)===false){
                return false;
            }
        }
        return $data;
    }

}
