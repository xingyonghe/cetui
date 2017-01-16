<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserBespeak;
use App\Models\UserNetred;
use App\Models\UserNetredPlatform;
use SEO;

class RednetController extends Controller
{
    protected $channel_id = 2;//设置导航选中标志
    public function __construct()
    {
        view()->share('channel_id',$this->channel_id);
    }

    public function index()
    {
        SEO::setTitle(configs('WEB_SITE_TITLE'));
        $platform   = (int)request()->get('platform',0);
        $catid      = (int)request()->get('catid',0);
        $fan        = (int)request()->get('fan',0);

        $lists = UserNetred::where('status',UserNetred::STATUS_NORMAL)
            ->whereNull('userid')
            ->where(function ($query) use($platform) {
                if($platform){
                    $query->where('platform_id',$platform);
                }
            })
            ->Where(function ($query) use($catid) {
                if($catid){
                    $query->Where('catids','like','%catid_'.$catid.'%');
                }
            })
            ->where(function ($query) use($fan) {
                switch($fan){
                    case 1:
                        $query->whereBetween('fans', [0, 5000]);
                        break;
                    case 2:
                        $query->whereBetween('fans', [5000, 10000]);
                        break;
                    case 3:
                        $query->whereBetween('fans', [10000, 30000]);
                        break;
                    case 4:
                        $query->whereBetween('fans', [30000, 50000]);
                        break;
                    case 5:
                        $query->whereBetween('fans', [50000, 100000]);
                        break;
                    case 6:
                        $query->where('fans','>=',100000);
                        break;
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        //粉丝量级
        $fans = configs('NETRED_FANS');
        //查找所有分类
        $category = Category::where('model','netred')->orderBy('sort','asc')
            ->orderBy('id','asc')
            ->get(['id','name','pid'])->toArray();
        $category = list_to_tree($category);
        //平台
        $platforms = UserNetredPlatform::orderBy('sort','asc')->pluck('name','id')->toArray();
        $platforms[0] = '不限';
        ksort($platforms);
        $params = [
            'platform' => $platform,
            'catid'    => $catid,
            'fan'      => $fan,
        ];
        $bespeak = json_encode(configs('ADS_TASK_TYPE'));
        return view('home.rednet.index',compact('category','lists','fans','params','platforms','bespeak'));
    }


    /**
     * 预约网红提交
     * @author xingyonghe
     * @date 2016-1-7
     */
    public function bespeak(){
        $data = request()->all();
        if(auth()->check()){
            $data['mobile'] = auth()->user()->username;
            $rules = [
                'catids' => 'required',
                'money'  => 'required|money',
            ];
            $msgs = [
                'catids.required' => '请选择推广需求',
                'money.required'    => '请填写推广预算',
                'money.money' => '推广预算格式错误',
            ];
        }else{
            $rules = [
                'mobile' => 'required|mobile',
            ];
            $msgs = [
                'mobile.required' => '请输入正确的手机号码',
                'mobile.mobile'   => '请输入正确的手机号码',
            ];
        }
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $info = UserNetred::find($data['netred_id']);
        $data['user_id'] = $info['userid'];
        if(!isset($data['money']) || empty($data['money'])){
            $data['money'] = 0;
        }
        $data['created_at'] = \Carbon\Carbon::now();
        $data['status'] = UserBespeak::STATUS_1;
        $resault = UserBespeak::updateData($data);
        if($resault){
            return $this->ajaxReturn('预约成功，请耐心等待客服处理，您也可以主动联系专属客服!',0);
        }else{
            return $this->ajaxReturn('预约失败，请稍后再试，如有疑问，请联系客服');
        }
    }
























}
