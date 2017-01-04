<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'visibility' => 'public',
        ],

        'picture' => [
            'driver'   => 'local',//驱动
            'root'     => public_path('uploads/picture/'),//保存根路径
            'mimes'    => '', //允许上传头像图片的MiMe类型
            'maxsize'  => 4*1024*1024, //上传头像图片的大小限制 (0-不做限制)
            'exts'     => 'jpg,gif,png,jpeg', //允许上传的头像图片后缀
            'subname'  => ['date', 'Y-m-d'], //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'savename' => ['uniqid', ''], //头像图片命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'hash'     => true, //是否生成hash编码
            'table'    => 'picture',//头像图片保存数据表
            'filedata' => 'file',//上传到服务器端接收的名称
            'filename' => '图片',//上传驱动的备注，主要用于提示错误使用，用于区别上传的类型
            'format'     => [['80','80'],['260','328']],
        ],

        'file' => [
            'driver'   => 'local',//驱动
            'root'     => public_path('uploads/file/'),//保存根路径
            'mimes'    => '', //允许上传的文件MiMe类型
            'maxsize'  => 10*1024*1024, //上传的文件大小限制 (0-不做限制)
            'exts'     => 'zip,doc,xls,rar', //允许上传的文件后缀
            'subname'  => ['date', 'Y-m-d'], //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'savename' => ['uniqid', 'md5(microtime(true))'], //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'hash'     => true, //是否生成hash编码
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
        ],

    ],

];
