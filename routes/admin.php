<?php

/**
 * 后台路由
 * @author xingyonghe
 * @date 2017-1-3
 */
Route::group(['namespace'=>'Admin'], function () {
    /*-*-*-*-*-*-*-*-*-*-*首页*-*-*-*-*-*-*-*-*-*-*/
    Route::get('/','IndexController@index')->name('admin.index.index');//首页
    /*-*-*-*-*-*-*-*-*-*-*系统菜单*-*-*-*-*-*-*-*-*-*-*/
    Route::get('menu/index',         'MenuController@index')->name('admin.menu.index');//列表页
    Route::get('menu/create/{pid}',  'MenuController@create')->name('admin.menu.create');//新增
    Route::get('menu/eidt/{id}',     'MenuController@eidt')->name('admin.menu.eidt');//编辑
    Route::post('menu/update',       'MenuController@update')->name('admin.menu.update');//更新
    Route::get('menu/destroy/{id}',  'MenuController@destroy')->name('admin.menu.destroy');//删除
    //菜单列表
});
