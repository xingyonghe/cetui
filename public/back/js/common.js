$(function(){
    /**
     * 管理后台公用JS
     */
    //自定义弹出层样式
    layer.config({
        extend:'../../static/layer/skin/admin/style.css'
    });
    //ajax post 提交
    $('body').on('click','.ajax-post',function(){
        var form = $('.form-datas');
        var url = form.get(0).action;
        var query = form.serialize();
        var that = this;
        $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
        $.post(url,query,function(datas){
            if(datas.status==1){
                $(that).removeClass('disabled').prop('disabled',false);
                updateAlert(datas.info + ' 页面即将自动跳转~','alert-success',datas.url);
            }else{
                $(that).removeClass('disabled').prop('disabled',false);
                updateAlert(datas.info);
            }
        });
        return false;
    });

    //更新操作
    $('body').on('click','.ajax-update',function(){
        layer.closeAll();
        var target = $(this).attr('url');
        $.get(target,function(data){
            if(data.status == -1){
                updateAlert(data.error);
            }else{
                layer.open({
                    type    : 1,
                    skin    : 'layer-ext-admin',
                    closeBtn: 1,
                    title   : data.title,
                    area    : ['650px'],
                    btn     : ['确定', '取消'],
                    content : data.info,
                    yes     : function(index){
                        var form = $('.form-datas');
                        var url = form.get(0).action;
                        var query = form.serialize();
                        $.post(url,query,function(datas){
                            if(datas.status==1){
                                updateAlert(datas.info + ' 页面即将自动跳转~','alert-success',datas.url);
                            }else{
                                updateAlert(datas.info);
                            }
                        });
                    }
                });
            }
        },'json');
        return false;
    });

    //删除确认
    $('body').on('click','.ajax-confirm',function(){
        layer.closeAll();
        var target = $(this).attr('url');
        if($(this).hasClass('destroy')){
            confirmDialog('确认要删除该信息吗?',target);
        }
        if($(this).hasClass('forbid')){
            confirmDialog('确认要禁用该信息吗?',target);
        }
        if($(this).hasClass('resume')){
            confirmDialog('确认要启用该信息吗?',target);
        }

        return false;
    });
    
    //排序
    $('.ajax-sort').click(function(){
        layer.closeAll();
        var target = $(this).attr('url');
        var that = this;
        $.get(target).success(function(data){
            if(data.status == 1){
                layer.open({
                    type    : 1,
                    skin    : 'layer-ext-admin',
                    closeBtn: 1,
                    title   : data.title,
                    area    : ['450px'],
                    btn     : ['确定', '取消'],
                    shade   : false,
                    content : data.info,
                    yes     : function(index){
                        var form = $('.form-sort');
                        var url = form.get(0).action;
                        var _token = $('.form-sort').find("input[name='_token']").val();
                        var arr = new Array();
                        $('.sortids').each(function(){
                            arr.push($(this).val());
                        });
                        $('input[name=ids]').val(arr.join(','));
                        var query = {'ids' :  arr.join(','), '_token':_token};
                        $.post(url,query,function(datas){
                            if(datas.status==1){
                                updateAlert(datas.info + ' 页面即将自动跳转~','alert-success',datas.url);
                            }else{
                                updateAlert(datas.info);
                            }
                        });
                    }
                });
            }else{
                updateAlert(data.error);
            }
        });
        return false;
    });


    $('body').on('click','.img-see',function () {
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: ['516'],
            skin: 'layer-ext-admin', //没有背景色
            shadeClose: true,
            content: '<img src="'+$(this).attr('src')+'">',
        });
        return false;
    });

    //ajax get请求
    $('.ajax-get').click(function(){
        var target = $(this).attr('href');
        var that = this;
        $.get(target).success(function(data){
            layer.open({
                type    : 1,
                skin    : 'layer-ext-admin',
                closeBtn: 1,
                title   : '消息提醒',
                area    : ['650px'],
                btn     : ['确定', '取消'],
                shade   : false,
                content : data.info,
            });
        });
        return false;
    });


    /**
     * 信息提示
     * @param text
     * @param c
     */
    window.updateAlert = function (text,c,u) {
        var top_alert = $('#top-alert');
        if(text){
            if ( c ) {
                top_alert.removeClass('alert-block alert-danger').addClass(c);
                top_alert.find('.msg').text('Well Success!');
            }
            top_alert.find('.message').text(text);
            top_alert.show().slideDown(200);
            setTimeout(function(){
                top_alert.hide();
                if(u){
                    location.href = u;
                }
            },1500);
        }
    };


    /**
     * 确认提示弹出层(上下架信息)
     * @author xingyonghe
     * @param msg 提示语
     * @param url 交互跳转地址
     */
    window.confirmDialog = function(msg,url){
        layer.open({
            type    : 1,
            skin    : 'layer-ext-admin',
            closeBtn: 1,
            title   : '消息提醒',
            area    : ['450px'],
            btn     : ['确定', '取消'],
            shade   : false,
            content : msg,
            time    : 20000,
            yes     : function(){
                window.location = url;
            }
        });
    }

    //导航高亮
     window.highlight_subnav = function(url){
         $('.sidebar-menu').find('a[href="'+url+'"]').parents('.sub-menu').find('.dcjq-parent').addClass('active');
         $('.sidebar-menu').find('a[href="'+url+'"]').parent().closest('li').addClass('active');
         $('.sidebar-menu').find('a[href="'+url+'"]').parents('.sub').show();
    }

    //提示界面自动消失
    var alert_msg = $('.alert-msg');
    if(alert_msg.length){
        setTimeout(function(){
            alert_msg.hide();
        },1500);
    }

    //单选按钮效果重写
    $('body').on('click','.label_radio',function(){
        $(this).siblings().removeClass('r_on').find('input').prop('checked',false);
        $(this).addClass('r_on').find('input').prop('checked',true);
    });
})