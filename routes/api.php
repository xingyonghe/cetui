<?php
/**
 * api路由
 * @author xingyonghe
 * @date 2017-1-4
 */
Route::group(['namespace'=>'Api'],function(){
    //手机短信发送
    Route::post('sendsms',    'SmsApiController@sendSMS')->name('api.sendsms');
    //手机短信验证
    Route::post('verifysms',  'SmsApiController@verifySMS')->name('api.verifysms');
    //文件上传
    Route::post('file',       'UploadApiController@file')->name('api.file');
    //图片上传，返回图片ID
    Route::post('picture',    'UploadApiController@picture')->name('api.picture');
    //图片上传，返回图片路径
    Route::post('logo',       'UploadApiController@logo')->name('api.logo');
});
