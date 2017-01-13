<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Region;
use App\Models\UserBespeak;
use SEO;
use App\Models\UserNetred;
use App\Models\UserNetredAdform;
use App\Models\UserNetredPlatform;

class NetredController extends Controller
{
    protected $navkey = 'netred';//菜单标识
    public function __construct()
    {
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
        //资源风格
        $styles = configs('NETRED_STYLE');
        $styles[0] = '不限';
        ksort($styles);

        //参考报价
        $moneys = configs('NETRED_MONEY');
        //粉丝量级
        $fans = configs('NETRED_FANS');
        //所有省份
        $regions = Region::where('level',0)->where('hot',1)->orderBy('id','asc')->pluck('name','id')->toArray();
        $regions[0] = '不限';
        ksort($regions);

        view()->composer(['ads.netred.index','ads.netred.video'],function($view) use($styles,$regions,$moneys,$fans){
            $view->with('styles',$styles)->with('regions',$regions)->with('moneys',$moneys)->with('fans',$fans);
        });
    }

    /**
     * 直播资源列表
     * @author: xingyonghe
     * @date: 2017-1-8
     * @return mixed
     */
    public function index()
    {
        $platform   = (array)request()->get('platform',0);
        $style      = (array)request()->get('style',0);
        $money      = (int)request()->get('money',0);
        $fan        = (int)request()->get('fan',0);
        $province   = (array)request()->get('region',0);
        $lists = UserNetred::where('status',UserNetred::STATUS_NORMAL)
            ->where('type',1)
            ->whereNotNull('userid')
            ->where(function ($query) use($platform) {
                if(!empty($platform[0])){
                    $query->whereIn('platform_id',$platform);
                }
            })
            ->Where(function ($query) use($style) {
                if(!empty($style[0])){
                    foreach($style as $key=>$value){
                        $query->orWhere('style','like','%style_'.$value.'%');
                    }
                }
            })
            ->where(function ($query) use($money) {
                switch($money){
                    case 1:
                        $query->whereBetween('money', [0, 5000]);
                        break;
                    case 2:
                        $query->whereBetween('money', [5000, 10000]);
                        break;
                    case 3:
                        $query->whereBetween('money', [10000, 30000]);
                        break;
                    case 4:
                        $query->whereBetween('money', [30000, 50000]);
                        break;
                    case 5:
                        $query->whereBetween('money', [50000, 100000]);
                        break;
                    case 6:
                        $query->where('money','>=',100000);
                        break;
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
            ->where(function ($query) use($province) {
                if(!empty($province[0])){
                    $query->whereIn('province',$province);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        //平台
        $platforms = UserNetredPlatform::where('category',1)->orderBy('sort','asc')->pluck('name','id')->toArray();
        $platforms[0] = '不限';
        ksort($platforms);

        //广告形式
        $adforms = UserNetredAdform::where('category',1)->orderBy('sort','asc')->pluck('name','id');
        $params = [
            'platform' => implode(',',$platform),
            'style'    => implode(',',$style),
            'money'    => $money,
            'fan'      => $fan,
            'region' => implode(',',$province),
        ];
        SEO::setTitle('直播资源-广告主中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.netred.index',compact('lists','adforms','platforms','params'));
    }



    /**
     * 短视频资源列表
     * @author: xingyonghe
     * @date: 2017-1-8
     * @return mixed
     */
    public function video()
    {
        $platform   = (array)request()->get('platform',0);
        $style      = (array)request()->get('style',0);
        $money      = (int)request()->get('money',0);
        $fan        = (int)request()->get('fan',0);
        $province   = (array)request()->get('region',0);
        $lists = UserNetred::where('status',UserNetred::STATUS_NORMAL)
            ->where('type',2)
            ->whereNotNull('userid')
            ->where(function ($query) use($platform) {
                if(!empty($platform[0])){
                    $query->whereIn('platform_id',$platform);
                }
            })
            ->Where(function ($query) use($style) {
                if(!empty($style[0])){
                    foreach($style as $key=>$value){
                        $query->orWhere('style','like','%style_'.$value.'%');
                    }
                }
            })
            ->where(function ($query) use($money) {
                switch($money){
                    case 1:
                        $query->whereBetween('money', [0, 5000]);
                        break;
                    case 2:
                        $query->whereBetween('money', [5000, 10000]);
                        break;
                    case 3:
                        $query->whereBetween('money', [10000, 30000]);
                        break;
                    case 4:
                        $query->whereBetween('money', [30000, 50000]);
                        break;
                    case 5:
                        $query->whereBetween('money', [50000, 100000]);
                        break;
                    case 6:
                        $query->where('money','>=',100000);
                        break;
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
            ->where(function ($query) use($province) {
                if(!empty($province[0])){
                    $query->whereIn('province',$province);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        //平台
        $platforms = UserNetredPlatform::where('category',2)->orderBy('sort','asc')->pluck('name','id')->toArray();
        $platforms[0] = '不限';
        ksort($platforms);

        //广告形式
        $adforms = UserNetredAdform::where('category',2)->orderBy('sort','asc')->pluck('name','id');
        $params = [
            'platform' => implode(',',$platform),
            'style'    => implode(',',$style),
            'money'    => $money,
            'fan'      => $fan,
            'region' => implode(',',$province),
        ];
        SEO::setTitle('短视频资源-广告主中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.netred.video',compact('lists','adforms','platforms','params'));
    }

    /**
     * 预约资源
     * @author xingyonghe
     * @date 2016-1-7
     * @param int $id
     */
    public function bespeak(int $id){
        $info = UserNetred::where('status',UserNetred::STATUS_NORMAL)->find($id);
        if(empty($info)){
            $this->ajaxReturn('非法操作');
        }
        $categorys = configs('ADS_TASK_TYPE');
        $view = view('ads.netred.bespeak',compact('id','categorys'));
        return $this->ajaxReturn($view->render(),0,'','立即预约');
    }

    /**
     * 预约网红提交
     * @author xingyonghe
     * @date 2016-1-7
     */
    public function post(){
        $data = request()->all();
        $rules = [
            'catids' => 'required',
            'money'  => 'required|money',
        ];
        $msgs = [
            'catids.required' => '请选择推广需求',
            'money.required'    => '请填写推广预算',
            'money.money' => '推广预算格式错误',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $info = UserNetred::find($data['netred_id']);
        $data['user_id'] = $info['userid'];
        $data['user_ads_id'] = auth()->id();
        $data['mobile'] = auth()->user()->username;
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
