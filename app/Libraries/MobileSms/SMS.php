<?php
/*
|--------------------------------------------------------------------------
| SMS class
| @author xingyonghe
| @date 2016-11-22
|--------------------------------------------------------------------------
|
| 短信类库
|
*/
namespace App\Libraries\MobileSms;

use App\Models\MobileSms;

class SMS{
    protected $config = [];//短信配置

    public function __construct(){
        $this->config = config('mobilesms.driver.zdtone');
    }

    /**
     * 获取6位数验证码
     * @author: xingyonghe
     * @date: 2016-11-22
     * @return string
     */
    protected function getCode(){
        $char = '0123456789';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $char[mt_rand(0, strlen($char) - 1)];
        }
        return $code;
    }

    /**
     * 获取短信发送内容
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param int $category
     * @param string $code
     * @return string
     */
    protected function getMsg(int $category,string $code = ''){
        $msg = '';
        switch($category){
            case '1'://注册
                $msg = '【卓杭广告】您本次验证码为：'.$code.'，如不是本人操作，请忽略';
                break;
        }
        return $msg;
    }

    /**
     * 发送短信
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param $mobile 手机号
     * @param $category 见MobileSms 模型 const CATEGORY
     * @return bool
     */
    public function send(string $mobile,int $category){
        $code = $this->getCode();
        $msg  = $this->getMsg($category,$code);
        $datas = [
            'loginname' => $this->config['username'],
            'password'  => $this->config['password'],
            'msg'       => $msg,
            'tele'      => $mobile,
        ];
        $resault = $this->call($datas,$this->config['host']);
        $resault = preg_split('/[,;\r\n]+/', trim($resault, ",;\r\n"));
        foreach($resault as $key=>$string){
            if(strstr($string,'ERROR')){
                $errors = explode(':', $string);
                $error = [];
                $errorCode = $this->errorSMS();
                $error[$errors[0]] = $errorCode[$errors[1]];
                return false;
            }
        }
        MobileSms::create(
            array(
                'mobile'     => $mobile,
                'status'     => MobileSms::STATUS['created'],
                'content'    => $msg,
                'created_at' => \Carbon\Carbon::now(),
                'code'       => $code,
                'category'   => $category
            )
        );
        return true;
    }

    /**
     * curl 实现post数据提交
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param $datas 数据信息
     * @param $host sms
     * @return mixed
     */
    protected function call($datas,$host){
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $host);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $datas);
        //执行命令
        $resault = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        return $resault;
    }

    /**
     * 短信错误代码
     * @author: xingyonghe
     * @date: 2016-11-22
     * @return array
     */
    public function errorSMS(){
        return [
            //接口返回
            '0100' => '无短信内容',
            '0101' => '无发送号码',
            '0102' => '账户或密码错误',
            '0103' => '余额不足',
            '0105' => '发送失败',
            //自定义验证状态码
            '0200' => '验证失败',
            '0201' => '验证已失效',
            '0202' => '您的操作过快',
            '0203' => '验证输入错误',
        ];
    }

    /**
     * 验证码验证操作过于频繁
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param $mobile 手机号
     * @param $category 见MobileSms 模型 const CATEGORY
     * @return bool true 代表操作频繁
     */
    public function frequent(string $mobile,int $category){
        //查找该号码最近的一条发送信息
        $info = MobileSms::where('mobile',$mobile)
            ->where('category',$category)
            ->orderBy('created_at','desc')
            ->first();
        //操作过快
        $resend = $this->config['resend'];//重发间隔时间
        $now = \Carbon\Carbon::now()->timestamp;
        if($info && ($now - $info->created_at->timestamp < $resend)){
            return true;
        }
        return false;
    }

    /**
     * 手机短信验证
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param $mobile 手机号码
     * @param $code 手机验证码
     * @param $category 见MobileSms 模型 const CATEGORY
     * @return bool
     */
    public function verify(string $mobile,string $code,int $category){
        if(empty($code) || empty($mobile)){
            return '0200';
        }

        //是否已验证
        $_info = MobileSms::where('mobile',$mobile)
            ->where('category',$category)
            ->where('code',$code)
            ->where('status',MobileSms::STATUS['success'])
            ->first();

        $overtime = $this->config['overtime'];
        $now = \Carbon\Carbon::now()->timestamp;
        if($_info){
            //已过期
            if($now - $_info->created_at->timestamp > $overtime){
                return '0201';
            }
            return true;
        }else{
            //查找该号码最近的一条发送信息
            $info = MobileSms::where('mobile',$mobile)
                ->where('category',$category)
                ->orderBy('created_at','desc')
                ->first();
            if(empty($info)){
                return '0200';
            }
            //已过期
            if($now - $info->created_at->timestamp > $overtime){
                return '0201';
            }
            //失败
            if($info->code != $code){
                return '0203';
            }
            //频繁
            if($info->status == MobileSms::STATUS['success']){
                return '0202';
            }
            $info->update(array('status'=>MobileSms::STATUS['success']));
            return true;
        }

    }

}