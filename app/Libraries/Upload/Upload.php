<?php
/*
|--------------------------------------------------------------------------
| Upload class
| @author xingyonghe
| @date 2016-11-25
|--------------------------------------------------------------------------
|
| 上传类库
|
*/
namespace App\Libraries\Upload;

use Carbon\Carbon;
use Storage;
use DB;
use Image;

class Upload{
    protected $config;//config/filesystems.php 文件系统配置信息
    protected $error = '';//设置返回信息
    // 上传文件信息
    protected $info;
    protected $return  = array('code' => 0, 'success' => '上传成功');

    /**
     * 自动执行一些基础的
     * @author: xingyonghe
     * @date: 2016-12-15
     * @param $config
     */
    protected function uploadInit($config){
        $this->config = $config;
        $this->config['mimes'] = $this->stringToArray($this->config['mimes']);
        $this->config['exts']  = $this->stringToArray($this->config['exts']);
    }

    protected function getError(){
        return $this->error;
    }

    /**
     * 验证
     * @return bool
     */
    protected function check()
    {
        $info = $this->info;
        $type = $this->config['filename'];
        // 检查文件大小
        if (!$this->checkSize($info['size'])) {
            $this->error = '上传'.$type.'大小不符！';
            return false;
        }
        // 检查文件Mime类型
        if (!$this->checkMime($info['type'])) {
            $this->error = '上传'.$type.'MIME类型不允许！';
            return false;
        }
        // 检查文件后缀
        if (!$this->checkExt($info['ext'])) {
            $this->error = '上传'.$type.'后缀不允许';
            return false;
        }
        // 检查图像文件
        if (!$this->checkImg()) {
            $this->error = '非法图像文件！';
            return false;
        }
        return true;
    }

    /**
     * 对图像文件进行严格检测
     * @return bool
     */
    protected function checkImg()
    {
        $extension = strtolower(pathinfo($this->info['tmp_name'], PATHINFO_EXTENSION));
        if (in_array($extension, ['gif', 'jpg', 'jpeg', 'bmp', 'png', 'swf']) && !in_array($this->getImageType($this->info['tmp_name']), [1, 2, 3, 4, 6])) {
            return false;
        }
        return true;
    }

    /**
     * 判断图像类型
     * @param $image
     * @return int
     */
    protected function getImageType($image)
    {
        if (function_exists('exif_imagetype')) {
            return exif_imagetype($image);
        } else {
            $info = getimagesize($image);
            return $info[2];
        }
    }



    public function picture($files,$disks){
        //获取配置
        $config = config('filesystems.disks.'.$disks);
        //获取驱动
        $config['uploader'] = Storage::disk($disks);
        //自动执行一些基础的
        $this->uploadInit($config);
        $picture = $this->uploads($files);
        if($picture){
            foreach($picture as $key => &$value){
                //存在直接返回
                if(isset($value['id']) && is_numeric($value['id'])){
                    continue;
                }
                $path = str_replace(public_path(),'',$value['rootpath']);
                $path = str_replace('\\','/',$path);
                //在模板里的src路径
                $value['path'] = $path . $value['savepath'] . $value['savename'];
                $name = explode('.',$value['path']);
                foreach($this->config['format'] as $format){
                    Image::make('.' . $value['path'])->fit($format[0],$format[1])->save('.' . $name[0].'.'. $format[0].'x'.$format[1] .'.'. $name[1]);
                    $value[$format[0].'x'.$format[1]] = $name[0].'.' . $format[0].'x'.$format[1].'.' . $name[1];
                }
                $insert = [
                    'path' => $value['path'],
                    'url' => C('WEB_SITE_URL'),
                    'md5' => $value['md5'],
                    'sha1' => $value['sha1'],
                    'create_time' => \Carbon\Carbon::now(),
                ];
                $id = DB::table($this->config['table'])->insertGetId($insert);
                if($id){
                    unset($value['rootpath']);
                    unset($value['md5']);
                    unset($value['sha1']);
                    unset($value['savename']);
                    unset($value['savepath']);
                    $value['id'] = $id;
                }else{
                    unset($picture[$key]);
                }
            }
            return ['code'=>0,'file'=>$picture[$this->config['filedata']]];
        }else{
            return ['code'=>-1,'error'=>$this->getError()];
        }
    }

    public function logo($files,$disks){
        //获取配置
        $config = config('filesystems.disks.'.$disks);
        //获取驱动
        $config['uploader'] = Storage::disk($disks);
        //自动执行一些基础的
        $this->uploadInit($config);
        $logo = $this->uploads($files);
        if($logo){
            foreach($logo as $key => &$value){
                //存在直接返回
                if(isset($value['id']) && is_numeric($value['id'])){
                    continue;
                }
                $path = str_replace(public_path(),'',$value['rootpath']);
                $path = str_replace('\\','/',$path);
                //在模板里的src路径
                $value['path'] = $path . $value['savepath'] . $value['savename'];
                $name = explode('.',$value['path']);
                $insert = [
                    'path' => $value['path'],
                    'url' => '',
                    'md5' => $value['md5'],
                    'sha1' => $value['sha1'],
                    'create_time' => \Carbon\Carbon::now(),
                ];
                $id = DB::table($this->config['table'])->insertGetId($insert);
                if($id){
                    unset($value['rootpath']);
                    unset($value['md5']);
                    unset($value['sha1']);
                    unset($value['savename']);
                    unset($value['savepath']);
                    $value['id'] = $id;
                }else{
                    unset($logo[$key]);
                }
            }
            return ['code'=>0,'file'=>$logo[$this->config['filedata']]];
        }else{
            return ['code'=>-1,'error'=>$this->getError()];
        }
    }

    /**
     * 上传文件
     * @param 文件信息数组 $files ，通常是 $_FILES数组
     */
    protected function uploads($files)
    {
        if(!isset($files[$this->config['filedata']])){
            $this->error = '上传信息不存在';
            return false;
        }
        //检测根目录
        if(!$this->checkRootPath()){
            $this->error = '上传根目录不存在！请尝试手动创建:'.$this->config['root'];
            return false;
        }
        $this->info['rootpath'] = $this->config['root'];
        foreach ($files as $key => $file) {
            $this->info['name'] = $file->getClientOriginalName();// 文件原名
            $this->info['ext'] = $file->getClientOriginalExtension();     // 扩展名
            $this->info['size'] = $file->getClientSize();//文件大小
            $this->info['type'] = $file->getClientMimeType();//文件大小
            $this->info['tmp_name'] = $file->getPathname();//临时文件名

            //判断文件是否上传成功
            if (!$file->isValid()) {
                $this->error = $file->getErrorMessage();
                return false;
            }

            // 验证上传
            if (!$this->check()) {
                return false;
            }

            // 获取文件hash
            if($this->config['hash']){
                $this->info['md5']  = $this->hash($this->info['tmp_name'],'md5');
                $this->info['sha1']  = $this->hash($this->info['tmp_name'],'sha1');
            }
            // 检测文件是否存在
            $map = array('md5' => $this->info['md5'],'sha1'=>$this->info['sha1']);
            $file_info = DB::table($this->config['table'])->where($map)->first();
            if($file_info){
                //判断路径存不存在，如存在则返回
                if ( file_exists('.'.$file_info->path)) {
                    $data[$key] = (array)$file_info;
                    continue;
                }else {
                    //如果不存在，删除垃圾数据
                    DB::table($this->config['table'])->where(array('id'=>$file_info->id))->delete();
                }
            }
            // 检测并创建子目录
            $subpath = $this->getSubPath($this->info['name']);
            if(false === $subpath){
                continue;
            } else {
                $this->info['savepath'] = $subpath;
            }

            // 生成保存文件名
            $savename = $this->getSaveName();
            if(false == $savename){
                continue;
            } else {
                $this->info['savename'] = $savename;
            }
            $filename = $this->info['savepath'] . $this->info['savename'];
            $this->info['error'] = $this->error;
            // 保存文件 并记录保存成功的文件
            if ($this->config['uploader']->put($filename,file_get_contents($this->info['tmp_name']))) {
                unset($this->info['error'], $this->info['tmp_name']);
                $data[$key] = $this->info;
            } else {
                return false;
            }
        }
        return $data;
    }


    /**
     * 获取文件的哈希散列值
     * @author: xingyonghe
     * @date: 2016-12-15
     * @param string $filename 文件名
     * @param string $type hash方式
     * @return string
     */
    protected function hash($filename = '',$type = 'sha1')
    {
        return hash_file($type, $filename);;
    }



    /**
     * 检查上传根目录是否存在
     * @return bool
     */
    protected function checkRootPath()
    {
        if(!(is_dir($this->config['root']) && is_writable($this->config['root']))){
            return false;
        }
        return true;
    }

    /**
     * 检查文件大小是否合法
     * @param integer $size 数据
     */
    protected function checkSize($size) {
        return !($size > $this->config['maxsize']) || (0 == $this->config['maxsize']);
    }

    /**
     * 检查上传的文件MIME类型是否合法
     * @param string $mime 数据
     */
    protected function checkMime($mime) {
        return empty($this->config['mimes']) ? true : in_array(strtolower($mime), $this->config['mimes']);
    }

    /**
     * 检查上传的文件后缀是否合法
     * @param string $ext 后缀
     */
    protected function checkExt($ext) {
        return empty($this->config['exts']) ? true : in_array(strtolower($ext), $this->config['exts']);
    }

    /**
     * 根据上传文件命名规则取得保存文件名
     * @return string  文件名称
     */
    protected function getSaveName() {
        $rule = $this->config['savename'];
        if (empty($rule)) { //保持文件名不变
            //解决pathinfo中文文件名BUG
            $filename = substr(pathinfo("_{$this->info['name']}", PATHINFO_FILENAME), 1);
            $savename = $filename;
        } else {
            $savename = $this->getName($rule, $this->info['name']);
            if(empty($savename)){
                $this->error = '文件命名规则错误！';
                return false;
            }
        }
        return $savename . '.' . $this->info['ext'];
    }

    /**
     * 根据指定的规则获取文件或目录名称
     * @param  array  $rule     规则
     * @param  string $filename 原文件名
     * @return string           文件或目录名称
     */
    protected function getName($rule, $filename){
        $name = '';
        if(is_array($rule)){ //数组规则
            $func     = $rule[0];
            $param    = (array)$rule[1];
            foreach ($param as &$value) {
                $value = str_replace('__FILE__', $filename, $value);
            }
            $name = call_user_func_array($func, $param);
        } elseif (is_string($rule)){ //字符串规则
            if(function_exists($rule)){
                $name = call_user_func($rule);
            } else {
                $name = $rule;
            }
        }
        return $name;
    }

    /**
     * 获取子目录的名称
     * @param array $file  上传的文件信息
     */
    protected function getSubPath($filename)
    {
        $subpath = '';
        $rule    = $this->config['subname'];
        if (!empty($rule)) {
            $subpath = $this->getName($rule, $filename) . '/';
            if(!empty($subpath) && !$this->mkdir($this->config['root'] . $subpath)){
                return false;
            }
        }
        return $subpath;
    }

    /**
     * 创建目录
     * @param  string $savepath 要创建的穆里
     * @return boolean          创建状态，true-成功，false-失败
     */
    protected function mkdir($savepath){
        if(is_dir($savepath)){
            return true;
        }
        if(mkdir($savepath, 0777, true)){
            return true;
        } else {
            $this->error = '目录'.$savepath.' 创建失败！';
            return false;
        }
    }

    /**
     * 把字符串转化成数组,每个成员小写
     * @author: xingyonghe
     * @date: 2016-11-25
     * @param $data
     */
    protected function stringToArray($data){
        if(empty($data)){
            return $data;
        }
        if(is_string($data)) {
            $data = explode(',', $data);
        }
        return array_map('strtolower', $data);
    }




}