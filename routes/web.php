<?php

Route::group(['namespace'=>'Home'],function(){
    Route::get('password/mobile', 'ResetPasswordController@mobile')->name('home.password.mobile');//手机找回密码
    Route::get('password/email',  'ResetPasswordController@email')->name('home.password.email');//邮箱找回密码


    /**--**--**--**--**--**--**--**--**--**网站首页**--**--**--**--**--**--**--**--**--**--**/
    Route::get('', 'IndexController@index')->name('home.index.index');//首页
    //图片上传
    Route::post('upload', 'PictrueController@upload')->name('home.pictrue.upload');
    //头像上传
    Route::post('avatar', 'PictrueController@avatar')->name('home.pictrue.avatar');
    //文件上传
    Route::post('upload', 'FileController@upload')->name('home.file.upload');

    /**--**--**--**--**--**--**--**--**--**网红推荐**--**--**--**--**--**--**--**--**--**--**/
    Route::get('rednet/index',       'RednetController@index')->name('home.rednet.index');
    Route::get('rednet/show/{id}',   'RednetController@show')->name('home.rednet.show')->where('id','\d+');

    /**--**--**--**--**--**--**--**--**--**客户案例**--**--**--**--**--**--**--**--**--**--**/
    Route::get('case/index',         'CaseController@index')->name('home.case.index');

    /**--**--**--**--**--**--**--**--**--**广告主**--**--**--**--**--**--**--**--**--**--**/
    Route::get('ads/index',          'AdvertiserController@index')->name('home.ads.index');

    /**--**--**--**--**--**--**--**--**--**网红入驻**--**--**--**--**--**--**--**--**--**--**/
    Route::get('enter/index',        'RednetEnterController@index')->name('home.enter.index');
    //关于我们
    Route::get('about/index',        'AboutController@index')->name('home.about.index');
    //demo
    Route::get('demo/file',         'DemoController@file')->name('home.demo.file');
    Route::get('demo/picture',      'DemoController@picture')->name('home.demo.picture');
    Route::get('demo/avatar',       'DemoController@avatar')->name('home.demo.avatar');
});