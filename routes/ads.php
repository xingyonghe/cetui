<?php

/*
|--------------------------------------------------------------------------
| ads route
| @author xingyonghe
| @date 2016-11-22
|--------------------------------------------------------------------------
|
| 广告主会员中心路由
|
*/
Route::group(['namespace'=>'Ads'],function(){
    Route::group(['middleware'=> ['channel']],function(){
        Route::get('login',            'LoginController@showForm')->name('ads.login.form');//网红登录页面
        Route::post('login/post',      'LoginController@login')->name('ads.login.post');//登录
        Route::get('register',         'RegisterController@showForm')->name('ads.register.form'); //网红注册页面
        Route::post('register/post',   'RegisterController@register')->name('ads.register.post');//注册
    });
    Route::group(['middleware'=> ['login_ads']],function(){
        //首页
        Route::get('',               'IndexController@index')->name('ads.index.index');//基本资料
        //个人中心
        Route::get('center/index',     'CenterController@index')->name('ads.center.index');//修改基本资料
        Route::post('center/update',   'CenterController@update')->name('ads.center.update');//更新基本资料
        Route::get('center/password',  'CenterController@password')->name('ads.center.password');//修改密码
        Route::post('center/reset',    'CenterController@reset')->name('ads.center.reset');//更新密码

        //资源管理
        Route::get('netred/index',     'NetredController@index')->name('ads.netred.index');//直播资源列表

        //推广管理
        Route::get('task/index',        'TaskController@index')->name('ads.task.index');//任务列表
        Route::get('task/create',       'TaskController@create')->name('ads.task.create');//任务新增
        Route::get('task/edit/{id}',    'TaskController@edit')->name('ads.task.edit')->where('id','\d+');//任务编辑
        Route::post('task/update',      'TaskController@update')->name('ads.task.update');//任务更新
        Route::get ('task/destroy/{id}','TaskController@destroy')->name('ads.task.destroy')->where('id','\d+');//任务删除

        //订单管理
        Route::get('order/index',        'NetredOrderController@index')->name('ads.order.index');//订单列表


        //派单大厅
        Route::get('dispatch/index',     'DispatchController@index')->name('ads.dispatch.index');//活动列表

        //资源管理
        Route::get('star/index',        'StarController@index')->name('ads.star.index');//网红列表
        Route::get('star/create',       'StarController@create')->name('ads.star.create');//网红新增
        Route::get('star/edit/{id}',    'StarController@edit')->name('ads.star.edit')->where('id','\d+');//网红编辑
        Route::post('star/update',      'StarController@update')->name('ads.star.update');//网红更新
        Route::get ('star/destroy/{id}','StarController@destroy')->name('ads.star.destroy')->where('id','\d+');      //网红删除



        Route::get('index/edit',     'IndexController@edit')->name('ads.index.edit');//修改基本资料
        Route::post('index/update',  'IndexController@update')->name('ads.index.update');//更新基本资料
        Route::get('index/password', 'IndexController@password')->name('ads.index.password');//修改密码
        Route::post('index/reset',   'IndexController@reset')->name('member.ads.reset');//更新密码

        //账户管理
        Route::get('account/index',         'AccountController@index')->name('ads.account.index');//我的账户
        Route::get('account/records',       'AccountController@records')->name('ads.account.records');//收支记录
        Route::get('account/notes',         'AccountController@notes')->name('ads.account.notes');//提现记录
        Route::get('account/recharge',      'AccountController@recharge')->name('ads.account.recharge');//充值界面
        Route::post('account/recharge',     'AccountController@recharge')->name('ads.account.charging');//充值
        Route::get('account/pay/{order_id}','AccountController@pay')->name('ads.account.pay');//充值
        Route::get('account/return',        'AccountController@return')->name('ads.account.return');//充值同步地址
        Route::post('account/notify',       'AccountController@notify')->name('ads.account.notify');//充值异步地址
        Route::get('account/cash',          'AccountController@cash')->name('ads.account.cash');//提现界面
        Route::post('account/post',         'AccountController@post')->name('ads.account.post');//提现

        //图片上传
        Route::post('upload', 'PictrueController@upload')->name('home.pictrue.upload');
        //头像上传
        Route::post('avatar', 'PictrueController@avatar')->name('home.pictrue.avatar');
        //文件上传
        Route::post('upload', 'FileController@upload')->name('home.file.upload');
    });
});


