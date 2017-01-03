$(function(){
    /**
     * js 验证
     * @author xingyoghe
     * @date 2016-12-25
     */

    //是否为正整数
    window.isPositiveInteger = function (value){
        var reg = /^[1-9]+$/ ;
        return reg.test(value);
    }

    //是否为正确格式的金额
    window.isMoney = function (value){
        var reg = /^\d+\.?\d{0,2}$/ ;
        return reg.test(value);
    }

    //是否为正确格式的手机号码
    window.isMobile = function (value){
        var reg = /^1[34578]{1}\d{9}$/ ;
        return reg.test(value);
    }



})