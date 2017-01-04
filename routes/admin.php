<?php

/**
 * 后台路由
 * @author xingyonghe
 * @date 2017-1-3
 */
Route::group(['namespace'=>'Admin'], function () {


    Route::group(['middleware'=>['admin']], function () {
        /*-*-*-*-*-*-*-*-*-*-*首页*-*-*-*-*-*-*-*-*-*-*/
        Route::get('/','IndexController@index')->name('admin.index.index');//首页
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
        Route::post('netred/verify',       'NetredController@verify')->name('admin.netred.verify');//审核通过
        Route::post('netred/refuse',       'NetredController@refuse')->name('admin.netred.refuse');//审核不通过
        Route::get('netred/edit/{id}',     'NetredController@edit')->name('admin.netred.edit');//编辑
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

    });
});
