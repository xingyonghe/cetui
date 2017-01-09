<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 会员中心头部合相关左侧菜单
    | 一级：会员类型；二级：顶部菜单；三级：顶部菜单的左侧菜单
    | @author xingyonghe
    | @date 2016-11-23
    |--------------------------------------------------------------------------
    |
    | 短信配置
    |
    */
    'netred' => [
        'home' => [
            'name' => '首页',
            'url'  => 'netred.index.index',
            'child' => [],
        ],
        'dispatch' => [
            'name' => '派单大厅',
            'url' => 'netred.dispatch.index',
            'child' => [],
        ],
        'order' => [
            'name' => '订单管理',
            'url' => 'netred.order.index',
            'child' => [],
        ],
        'star' => [
            'name' => '资源管理',
            'url' => 'netred.star.index',
            'child' => [],
        ],
        'account' => [
            'name' => '财务中心',
            'url' => 'netred.account.index',
            'child' => [],
        ],
        'center' => [
            'name' => '个人中心',
            'url' => 'netred.center.index',
            'child' => [],
        ],
        'message' => [
            'name' => '消息中心',
            'url' => 'netred.message.index',
            'child' => [],
        ],
    ],
    'ads' => [
        'home' => [
            'name' => '首页',
            'url'  => 'ads.index.index',
            'child' => [],
        ],
        'netred' => [
            'name' => '资源列表',
            'url' => 'ads.netred.index',
            'child' => [],
        ],
        'task' => [
            'name' => '推广管理',
            'url' => 'ads.task.index',
            'child' => [
                [
                    'name' => '我的推广',
                    'url' => 'ads.task.index',
                ],
                [
                    'name' => '发布推广',
                    'url' => 'ads.task.create',
                ]
            ],
        ],
        'order' => [
            'name' => '订单管理',
            'url' => 'ads.order.index',
            'child' => [],
        ],
        'account' => [
            'name' => '财务中心',
            'url' => 'ads.account.index',
            'child' => [],
        ],
        'center' => [
            'name' => '个人中心',
            'url' => 'ads.center.index',
            'child' => [
                [
                    'name' => '基本资料',
                    'url' => 'ads.center.index',
                ],
                [
                    'name' => '修改密码',
                    'url' => 'ads.center.password',
                ],
                [
                'name' => '资料认证',
                'url' => 'ads.netred.index',
            ]
            ],
        ],
        'message' => [
            'name' => '消息中心',
            'url' => 'ads.message.index',
            'child' => [],
        ],
    ],


];
