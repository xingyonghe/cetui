<?php

/**
 * 后台路由
 * @author xingyonghe
 * @date 2017-1-3
 */
Route::group(['namespace'=>'Admin'], function () {

    /*-*-*-*-*-*-*-*-*-*-*用户登陆*-*-*-*-*-*-*-*-*-*-*/
    Route::get('/', 'LoginController@showLoginForm')->name('admin.login.form');//登录页面
    Route::post('post', 'LoginController@login')->name('admin.login.post'); //登录提交
    Route::get('logout', 'LoginController@logout')->name('admin.login.logout');//退出登录

    Route::group(['middleware'=>['admin']], function () {
        /*-*-*-*-*-*-*-*-*-*-*首页*-*-*-*-*-*-*-*-*-*-*/
        Route::get('index/index','IndexController@index')->name('admin.index.index');//首页

        /*-*-*-*-*-*-*-*-*-*-*客服*-*-*-*-*-*-*-*-*-*-*/
        //客服
        Route::get ('custom/index',         'CustomController@index')->name('admin.custom.index'); //管理员列表
        Route::get ('custom/create',        'CustomController@create')->name('admin.custom.create');//新增
        Route::post('custom/add',           'CustomController@add')->name('admin.custom.add');//添加管理员
        Route::get ('custom/edit/{id}',     'CustomController@edit')->name('admin.custom.edit')->where('id','\d+'); //修改
        Route::post('custom/update',        'CustomController@update')->name('admin.custom.update');//修改管理员
        Route::get ('custom/forbid/{id}',   'CustomController@forbid')->name('admin.custom.forbid')->where('id','\d+'); //禁用
        Route::get ('custom/resume/{id}',   'CustomController@resume')->name('admin.custom.resume')->where('id','\d+');//启用
        Route::get ('custom/destroy/{id}',  'CustomController@destroy')->name('admin.custom.destroy')->where('id','\d+');//删除
        Route::get ('custom/resetpass',     'CustomController@resetpass')->name('admin.custom.resetpass');//重置密码
        Route::post('custom/change',        'CustomController@change')->name('admin.custom.change');//更新密码

        //部门
        Route::get ('group/index',         'GroupController@index')->name('admin.group.index');//用户组列表
        Route::get ('group/create',        'GroupController@create')->name('admin.group.create');//新增用户组
        Route::get ('group/edit/{id}',     'GroupController@edit')->name('admin.group.edit')->where('id','\d+');//修改用户组
        Route::post('group/update',        'GroupController@update')->name('admin.group.update');   //更新用户组
        Route::get ('group/destroy/{id}',  'GroupController@destroy')->name('admin.group.destroy')->where('id','\d+');   //删除用户组
        Route::get ('group/access/{id}',   'GroupController@access')->name('admin.group.access')->where('id','\d+'); //用户组授权
        Route::post('group/write',         'GroupController@write')->name('admin.group.write');//用户组授权写入

        /*-*-*-*-*-*-*-*-*-*-*系统*-*-*-*-*-*-*-*-*-*-*/
        //菜单管理
        Route::get('menu/index',         'MenuController@index')->name('admin.menu.index');//列表页
        Route::get('menu/create/{pid}',  'MenuController@create')->name('admin.menu.create');//新增
        Route::get('menu/edit/{id}',     'MenuController@edit')->name('admin.menu.edit');//编辑
        Route::post('menu/update',       'MenuController@update')->name('admin.menu.update');//更新
        Route::get('menu/destroy/{id}',  'MenuController@destroy')->name('admin.menu.destroy');//删除
        Route::get('menu/sort/{pid}',    'MenuController@sort')->name('admin.menu.sort');//排序
        Route::post('menu/order',        'MenuController@order')->name('admin.menu.order');//更新排序

        //配置管理
        Route::get ('config/index',           'ConfigController@index')->name('admin.config.index');//配置列表
        Route::get ('config/create',          'ConfigController@create')->name('admin.config.create'); //新增配置
        Route::get ('config/edit/{id}',       'ConfigController@edit')->name('admin.config.edit')->where('id','\d+'); //修改配置
        Route::post('config/update',          'ConfigController@update')->name('admin.config.update');   //更新配置
        Route::get ('config/destroy/{id}',    'ConfigController@destroy')->name('admin.config.destroy')->where('id','\d+');//删除配置
        Route::get ('config/setting/{group?}','ConfigController@setting')->name('admin.config.setting')->where('group','\d+'); //网站设置
        Route::post('config/post',            'ConfigController@post')->name('admin.config.post'); //更新设置

        //导航管理
        Route::get ('channel/index',       'ChannelController@index')->name('admin.channel.index');        //列表
        Route::get ('channel/create',      'ChannelController@create')->name('admin.channel.create');          //新增
        Route::get ('channel/edit/{id}',   'ChannelController@edit')->name('admin.channel.edit')->where('id','\d+');         //修改
        Route::post('channel/update',      'ChannelController@update')->name('admin.channel.update');       //更新
        Route::get ('channel/destroy/{id}','ChannelController@destroy')->name('admin.channel.destroy')->where('id','\d+');      //删除
        Route::get ('channel/sort',        'ChannelController@sort')->name('admin.channel.sort');         //排序
        Route::post('channel/order',       'ChannelController@order')->name('admin.channel.order');     //更新排序

        /*-*-*-*-*-*-*-*-*-*-*网红*-*-*-*-*-*-*-*-*-*-*/
        //网红管理
        Route::get('netred/index',         'NetredController@index')->name('admin.netred.index');//会员网红
        Route::get('netred/system',        'NetredController@system')->name('admin.netred.system');//系统网红
        Route::get('netred/check',         'NetredController@check')->name('admin.netred.check');//会员网红等待审核
        Route::get('netred/recycle',       'NetredController@recycle')->name('admin.netred.recycle');//会员网红已删除
        Route::get('netred/create',        'NetredController@create')->name('admin.netred.create');//新增
        Route::get('netred/import',        'NetredController@import')->name('admin.netred.import');//导入
        Route::post('netred/post',         'NetredController@post')->name('admin.netred.post');//导入更新
        Route::post('netred/verify',       'NetredController@verify')->name('admin.netred.verify');//审核通过
        Route::post('netred/refuse',       'NetredController@refuse')->name('admin.netred.refuse');//审核不通过
        Route::get('netred/edit/{id}',     'NetredController@edit')->name('admin.netred.edit');//编辑
        Route::get('netred/show/{id}',     'NetredController@show')->name('admin.netred.show');//详情
        Route::post('netred/update',       'NetredController@update')->name('admin.netred.update');//更新
        Route::get('netred/destroy/{id}',  'NetredController@destroy')->name('admin.netred.destroy');//删除

        //平台管理
        Route::get ('platform/index',         'PlatformController@index')->name('admin.platform.index');//平台列表
        Route::get ('platform/create',        'PlatformController@create')->name('admin.platform.create');//新增平台
        Route::get ('platform/edit/{id}',     'PlatformController@edit')->name('admin.platform.edit')->where('id','\d+');//修改平台
        Route::post('platform/update',        'PlatformController@update')->name('admin.platform.update');//更新平台
        Route::get ('platform/destroy/{id}',  'PlatformController@destroy')->name('admin.platform.destroy')->where('id','\d+');//删除平台
        Route::get ('platform/sort',          'PlatformController@sort')->name('admin.platform.sort');//排序
        Route::post('platform/order',         'PlatformController@order')->name('admin.platform.order');//更新排序
        //广告形式
        Route::get ('adform/index',         'AdformController@index')->name('admin.adform.index');//广告形式列表
        Route::get ('adform/create',        'AdformController@create')->name('admin.adform.create');//新增广告形式
        Route::get ('adform/edit/{id}',     'AdformController@edit')->name('admin.adform.edit')->where('id','\d+');//修改广告形式
        Route::post('adform/update',        'AdformController@update')->name('admin.adform.update');//更新广告形式
        Route::get ('adform/destroy/{id}',  'AdformController@destroy')->name('admin.adform.destroy')->where('id','\d+');//删除广告形式
        Route::get ('adform/sort',          'AdformController@sort')->name('admin.adform.sort');//排序
        Route::post('adform/order',         'AdformController@order')->name('admin.adform.order');//更新排序

        /*-*-*-*-*-*-*-*-*-*-*用户*-*-*-*-*-*-*-*-*-*-*/
        //用户
        Route::get ('bank/index',       'BankController@index')->name('admin.bank.index');//列表
        Route::get ('bank/create',      'BankController@create')->name('admin.bank.create');//新增
        Route::get ('bank/edit/{id}',   'BankController@edit')->name('admin.bank.edit')->where('id','\d+');//修改
        Route::post('bank/update',      'BankController@update')->name('admin.bank.update');       //更新
        Route::get ('bank/destroy/{id}','BankController@destroy')->name('admin.bank.destroy')->where('id','\d+');//删除
        Route::get ('bank/sort',        'BankController@sort')->name('admin.bank.sort');//排序
        Route::post('bank/order',       'BankController@order')->name('admin.bank.order');//更新排序

        //资料认证
        Route::get('user/certified',          'UserController@certified')->name('admin.certified.index');//资料列表
        Route::get('user/agreement/{id}',     'UserController@agreement')->name('admin.certified.agreement');//通过
        Route::get('user/refuse/{id}',        'UserController@refuse')->name('admin.certified.refuse');//拒绝

        //提现记录
        Route::get('cash/index',              'CashController@index')->name('admin.cash.index');//提现记录
        Route::get('cash/agreement/{id}',     'CashController@agreement')->name('admin.cash.agreement');//通过
        Route::get('cash/refuse/{id}',        'CashController@refuse')->name('admin.cash.refuse');//拒绝

        //站内信
        Route::get ('message/index',       'MessageController@index')->name('admin.message.index');//系统消息
        Route::get ('message/add',         'MessageController@add')->name('admin.message.add');//新增
        Route::post ('message/send',       'MessageController@send')->name('admin.message.send');//发送

        Route::get ('message/notice',      'MessageController@notice')->name('admin.message.notice');//系统公告
        Route::get ('message/create',      'MessageController@create')->name('admin.message.create');//新增
        Route::post ('message/post',       'MessageController@post')->name('admin.message.post');//发送

        /*-*-*-*-*-*-*-*-*-*-*推广活动*-*-*-*-*-*-*-*-*-*-*/
        //活动
        Route::get('task/index',         'TaskController@index')->name('admin.task.index');//列表
        Route::get('task/check',         'TaskController@check')->name('admin.task.check');//待审核
        Route::get('task/recycle',       'TaskController@recycle')->name('admin.task.recycle');//已删除
        Route::post('task/verify',       'TaskController@verify')->name('admin.task.verify');//审核通过
        Route::post('task/refuse',       'TaskController@refuse')->name('admin.task.refuse');//审核不通过
        Route::get('task/show/{id}',     'TaskController@show')->name('admin.task.show');//详情

        /*-*-*-*-*-*-*-*-*-*-*订单*-*-*-*-*-*-*-*-*-*-*/
        //订单管理
        Route::get('order/index',           'OrderController@index')->name('admin.order.index');//预约订单
        Route::get('order/task',            'OrderController@task')->name('admin.order.task');//活动订单
        Route::get('order/show/{id}',       'OrderController@show')->name('admin.order.show');//订单详情
        Route::get('order/agreement/{id}',  'OrderController@agreement')->name('admin.order.agreement');//通过订单
        Route::get('order/failed/{id}',     'OrderController@failed')->name('admin.order.failed');//失败订单

        //预约管理
        Route::get('bespeak/index',         'BespeakController@index')->name('admin.bespeak.index');//预约网红
        Route::get('bespeak/unlogin',       'BespeakController@unlogin')->name('admin.bespeak.unlogin');//意向预约
        Route::get('bespeak/do/{id}',       'BespeakController@do')->name('admin.bespeak.do');//处理预约
        Route::get('bespeak/order/{id}',    'BespeakController@order')->name('admin.bespeak.order');//形成订单
        Route::post('bespeak/post',         'BespeakController@post')->name('admin.bespeak.post');//订单生成提交
        Route::get('bespeak/faild/{id}',    'BespeakController@faild')->name('admin.bespeak.faild');//预约失败
    });
});
