<?php

/*
|--------------------------------------------------------------------------
| netred route
| @author xingyonghe
| @date 2016-11-22
|--------------------------------------------------------------------------
|
| 网红会员中心路由
|
*/
Route::group(['namespace'=>'Netred'],function(){
    Route::group(['middleware'=> ['channel']],function(){
        Route::get('login',          'LoginController@showForm')->name('netred.login.form');//网红登录页面
        Route::post('login/post',    'LoginController@login')->name('netred.login.post');//登录
        Route::get('logout',         'LoginController@logout')->name('netred.login.logout');//退出登录
        Route::get('register',       'RegisterController@showForm')->name('netred.register.form'); //网红注册页面
        Route::post('register/post', 'RegisterController@register')->name('netred.register.post');//注册
    });
    Route::group(['middleware'=> ['login_netred','messages']],function(){
        //首页
        Route::get('',               'IndexController@index')->name('netred.index.index');//网红中心首页
        //个人中心
        Route::get('center/index',       'CenterController@index')->name('netred.center.index');//修改基本资料
        Route::post('center/update',     'CenterController@update')->name('netred.center.update');//更新基本资料
        Route::get('center/password',    'CenterController@password')->name('netred.center.password');//修改密码
        Route::post('center/reset',      'CenterController@reset')->name('netred.center.reset');//更新密码
        Route::get('center/payword',     'CenterController@payword')->name('netred.center.payword');//修改支付密码
        Route::post('center/post',       'CenterController@post')->name('netred.center.post');//更新支付密码
        Route::get('center/certified',   'CenterController@certified')->name('netred.center.certified');//认证资料
        Route::post('center/send',       'CenterController@send')->name('netred.center.send');//提交认证资料

        //订单管理
        Route::get('order/index',        'OrderController@index')->name('netred.order.index');//订单列表
        Route::get('order/upload/{id}',  'OrderController@upload')->name('netred.order.upload');//上传凭证
        Route::post('order/post',        'OrderController@post')->name('netred.order.post');//上传凭证提交

        //派单大厅
        Route::get('dispatch/index',     'DispatchController@index')->name('netred.dispatch.index');//活动列表

        //资源管理->where('type', '(1|2)')
        Route::get('star/index',        'StarController@index')->name('netred.star.index');//资源列表
        Route::get('star/live',         'StarController@live')->name('netred.star.live');//直播资源新增
        Route::get('star/video',        'StarController@video')->name('netred.star.video');//短视频资源新增
        Route::post('star/update',      'StarController@update')->name('netred.star.update');//资源更新
        Route::get ('star/edit/{id}',   'StarController@edit')->name('netred.star.edit')->where('id','\d+');//短视频资源修改
        Route::get('star/destroy/{id}', 'StarController@destroy')->name('netred.star.destroy')->where('id','\d+');//短视频资源删除



        //账户管理
        Route::get('account/index',         'AccountController@index')->name('netred.account.index');//我的账户
        Route::get('account/records',       'AccountController@records')->name('netred.account.records');//收支记录
        Route::get('account/notes',         'AccountController@notes')->name('netred.account.notes');//提现记录
        Route::get('account/recharge',      'AccountController@recharge')->name('netred.account.recharge');//充值界面
        Route::post('account/recharge',     'AccountController@recharge')->name('netred.account.charging');//充值
        Route::get('account/pay/{order_id}','AccountController@pay')->name('netred.account.pay');//充值
        Route::get('account/return',        'AccountController@return')->name('netred.account.return');//充值同步地址
        Route::post('account/notify',       'AccountController@notify')->name('netred.account.notify');//充值异步地址

        Route::get('account/account',      'AccountController@account')->name('netred.account.account');//账户管理
        Route::get('account/create',       'AccountController@create')->name('netred.account.create');//添加账户
        Route::post('account/update',      'AccountController@update')->name('netred.account.update');//添加提现
        Route::get('account/edit/{id}',    'AccountController@edit')->name('netred.account.edit');//修改账户
        Route::get('account/destroy/{id}', 'AccountController@destroy')->name('netred.account.destroy');//删除账户

        Route::get('account/cash',         'AccountController@cash')->name('netred.account.cash');//提现界面
        Route::post('account/post',        'AccountController@post')->name('netred.account.post');//提现


        //消息中心
        Route::get('message/index',        'MessageController@index')->name('netred.message.index');//消息列表
        Route::get('message/show/{id}',    'MessageController@show')->name('netred.message.show');//消息列表
    });
});

