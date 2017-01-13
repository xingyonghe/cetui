<?php

Route::group(['namespace'=>'Home','middleware'=> ['channel']],function(){
    Route::get('password/mobile', 'ResetPasswordController@mobile')->name('home.password.mobile');//手机找回密码
    Route::post('password/post',  'ResetPasswordController@post')->name('home.password.post');//手机找回密码
    Route::get('password/email',  'ResetPasswordController@email')->name('home.password.email');//邮箱找回密码
    Route::post('password/send',  'ResetPasswordController@send')->name('home.password.send');//发送邮件
    Route::post('password/update','ResetPasswordController@update')->name('home.password.update');//邮件更新密码


    /**--**--**--**--**--**--**--**--**--**网站首页**--**--**--**--**--**--**--**--**--**--**/
    Route::get('', 'IndexController@index')->name('home.index.index');//首页

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