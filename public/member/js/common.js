$(function(){
    /**
     * 前台公用JS
     */
    //自定义弹出层样式
    layer.config({
        extend:'../../static/layer/skin/member/style.css'
    });

    //多选
    // $('body').on('click','.span-checkbox',function(){
    //     var i = $(this).find('i');
    //     var input = $(this).find('input');
    //     if( i.hasClass("checked_on") ){
    //         input.prop('checked',false);
    //         i.removeClass("checked_on");
    //     }else{
    //         input.prop('checked',true);
    //         i.addClass("checked_on");
    //     }
    // });




    //立即预约
    $('body').on('click','.ajax-bespeak',function(){
        layer.closeAll();
        var target = $(this).attr('url');
        $.get(target,function(data){
            if(data.status > -1){
                layer.open({
                    type    : 1,
                    skin    : 'layer-ext-member',
                    closeBtn: 1,
                    title   : data.title,
                    area    : ['650px','450px'],
                    btn     : ['确定', '取消'],
                    content : data.info,
                    yes     : function(index){
                        var form = $('.form-datas');
                        var url = form.get(0).action;
                        var query = form.serialize();
                        $.post(url,query,function(datas){
                            if(datas.status == -1){
                                layer.msg(datas.info, {icon: 5});
                            }else{
                                layer.closeAll();
                                layer.open({
                                    type    : 1,
                                    skin    : 'layer-ext-member',
                                    title   : '消息提醒',
                                    area    : ['600px'],
                                    closeBtn: 1,
                                    btn     : ['确定', '取消'],
                                    shade   : false,
                                    content : datas.info,
                                    time    : 3000,
                                });
                            }
                        });
                    }
                });
            }
        },'json');
        return false;
    });


    //上传凭证
    $('body').on('click','.ajax-upload',function(){
        layer.closeAll();
        var target = $(this).attr('url');
        $.get(target,function(data){
            if(data.status > -1){
                layer.open({
                    type    : 1,
                    skin    : 'layer-ext-member',
                    closeBtn: 1,
                    title   : data.title,
                    area    : ['650px'],
                    btn     : ['提交', '取消'],
                    content : data.info,
                    yes     : function(index){
                        var form = $('.form-datas');
                        var url = form.get(0).action;
                        var query = form.serialize();
                        $.post(url,query,function(datas){
                            if(datas.status == -1){
                                layer.msg(datas.info, {icon: 5});
                            }else{
                                layer.closeAll();
                                layer.open({
                                    type    : 1,
                                    skin    : 'layer-ext-member',
                                    title   : '消息提醒',
                                    area    : ['600px'],
                                    closeBtn: 1,
                                    btn     : ['确定', '取消'],
                                    shade   : false,
                                    content : datas.info,
                                    time    : 3000,
                                    yes     :function(){
                                        window.location = datas.url;
                                    },
                                    end     :function(){
                                        window.location = datas.url;
                                    }
                                });
                            }
                        });
                    }
                });
            }
        },'json');
        return false;
    });


    /**
     * 表单提交（管理或者继续发布）
     * @param formObj form表单的class或者id
     * @param that 绑定提交事情的对象，一般为submit按钮对象
     */
    window.formAjaxPost = function(formObj,that){
        var target,query;
        target = formObj.get(0).action;
        query = formObj.serialize();
        // that.addClass('disabled').attr('autocomplete','off').prop('disabled',true);
        $.post(target,query,function(data){
            if (data.status == -1){
                alertTips(data.info,data.id);
                // that.removeClass('disabled').prop('disabled',false);

            }else{
                // that.removeClass('disabled').prop('disabled',false);
                if(data.url){

                    layer.open({
                        type    : 1,
                        skin    : 'layer-ext-member',
                        title   : '消息提醒',
                        area    : ['600px'],
                        closeBtn: 1,
                        btn     : ['确定', '取消'],
                        shade   : false,
                        content : data.info,
                        time    : 5000,
                        yes  : function (index) {
                            window.location = data.url;
                        },
                        end  : function (index) {
                            window.location = data.url;
                        }
                    });
                }else{
                    //两种选择
                    layer.open({
                        type    : 1,
                        skin    : 'layer-ext-member',
                        title   : '消息提醒',
                        area    : ['600px'],
                        closeBtn: 1,
                        btn     : ['资源管理', '继续发布'],
                        shade   : false,
                        content : data.info,
                        yes     : function (index) {
                            window.location = data.list_url;
                        },
                        end  : function (index) {
                            window.location = data.pub_url;
                        }
                    });
                }
            }
        },'json');
    }
    
    

    //删除确认
    $('body').on('click','.ajax-confirm',function(){
        layer.closeAll();
        var target = $(this).attr('url') || $(this).attr('href');
        if($(this).hasClass('destroy')){
            confirmDialog('确认要删除该信息吗?',target);
        }
        if($(this).hasClass('forbid')){
            confirmDialog('确认要禁用该信息吗?',target);
        }
        if($(this).hasClass('resume')){
            confirmDialog('确认要启用该信息吗?',target);
        }
        if($(this).hasClass('bespeak')){
            confirmDialog('确认要预约该网红吗?',target);
        }


        return false;
    });




    /**
     * 确认提示弹出层(上下架信息)
     * @author xingyonghe
     * @param msg 提示语
     * @param url 交互跳转地址
     */
    window.confirmDialog = function(msg,url){
        layer.open({
            type    : 1,
            skin    : 'layer-ext-member',
            closeBtn: 1,
            title   : '消息提醒',
            area    : ['450px'],
            btn     : ['确定', '取消'],
            shade   : false,
            content : msg,
            time    : 20000,
            yes     : function(index){
                layer.closeAll();
                $.get(url).success(function(data){
                    if (data.status == -1){
                        layer.open({
                            type    : 1,
                            skin    : 'layer-ext-member',
                            closeBtn: 1,
                            title   : '消息提醒',
                            area    : ['600px'],
                            btn     : ['确定', '取消'],
                            content : data.info,
                            time    : 3000,
                        });
                    }else{
                        layer.open({
                            type    : 1,
                            skin    : 'layer-ext-member',
                            closeBtn: 1,
                            title   : '消息提醒',
                            area    : ['600px'],
                            btn     : ['确定', '取消'],
                            content : data.info,
                            time    : 3000,
                            yes     : function (index) {
                                window.location = data.url;
                            },
                            end     : function (index) {
                                window.location = data.url;
                            }
                        });
                    }
                });
            }
        });
    }

    /**
     * tips层提示错误
     * @author xingyonghe
     * @date 2016-11-23
     * @param msg 错误信息
     * @param id tips吸附元素选择器
     * @param scroll 是否执行滚动,默认滚动
     * @param color tips颜色
     */
    window.alertTips = function(msg,obj){
        var Obj = $('#'+obj);//提示html对象
        //页面自动滚动到提示错误的对象的偏移量的top处
        $('body,html').animate({scrollTop: Obj.offset().top},500,'swing');

        layer.tips(msg, Obj , {
            tips: [3, '#F77B6F'] //配置颜色
        });
    }

    //导航高亮
    window.highlight_subnav = function(url){
        $('.date-wrap').find('a[href="'+url+'"]').parent('span').addClass('active');
    }


})