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
            'child' => [
                [
                    'name' => '预约订单',
                    'url' => 'netred.order.index',
                ],
                [
                    'name' => '活动订单',
                    'url' => 'netred.order.index',
                ]
            ],
        ],
        'star' => [
            'name' => '资源管理',
            'url' => 'netred.star.index',
            'child' => [
                [
                    'name' => '添加直播资源',
                    'url' => 'netred.star.live',
                ],
                [
                    'name' => '添加短视频资源',
                    'url' => 'netred.star.video',
                ]
            ],
        ],
        'account' => [
            'name' => '财务中心',
            'url' => 'netred.account.index',
            'child' => [
                [
                    'name' => '账户中心',
                    'url' => 'netred.account.index',
                ],
                [
                    'name' => '账户管理',
                    'url' => 'netred.account.account',
                ]
            ],
        ],
        'center' => [
            'name' => '个人中心',
            'url' => 'netred.center.index',
            'child' => [
                [
                    'name' => '基本资料',
                    'url' => 'netred.center.index',
                ],
                [
                    'name' => '修改密码',
                    'url' => 'netred.center.password',
                ],
                [
                    'name' => '支付密码',
                    'url' => 'netred.center.payword',
                ],
                [
                    'name' => '认证资料',
                    'url' => 'netred.center.certified',
                ]
            ],
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
            'child' => [
                [
                    'name' => '直播资源列表',
                    'url' => 'ads.netred.index',
                ],
                [
                    'name' => '短视频资源列表',
                    'url' => 'ads.netred.video',
                ],
            ],
        ],
        'task' => [
            'name' => '推广管理',
            'url' => 'ads.task.index',
            'child' => [
                [
                    'name' => '我的推广活动',
                    'url' => 'ads.task.index',
                ],
                [
                    'name' => '发布推广活动',
                    'url' => 'ads.task.create',
                ]
            ],
        ],
        'order' => [
            'name' => '订单管理',
            'url' => 'ads.order.index',
            'child' => [
                [
                    'name' => '我的预约',
                    'url' => 'ads.order.bespeak',
                ],
                [
                    'name' => '预约订单',
                    'url' => 'ads.order.index',
                ],
                [
                    'name' => '活动订单',
                    'url' => 'ads.order.index',
                ]
            ],
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
                    'name' => '支付密码',
                    'url' => 'ads.center.payword',
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
