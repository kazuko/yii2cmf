<?php

$params = array_merge(
    require(__DIR__.'/../../common/config/params.php'),
    require(__DIR__.'/params.php')
);

return [
    'id' => 'backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrfBackend'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'rbac\components\DbManager',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => 'backend\components\Formatter',
            'nullDisplay' => '',
            'booleanFormat' => ['<i class="fa fa-times text-danger"></i>', '<i class="fa fa-check text-success"></i>'],
        ],
        'themeManager' => [
            'class' => 'common\components\ThemeManager',
        ],
    ],
    'modules' => [
        'rbac' => [
            'class' => 'rbac\Module',
        ],
        'backup' => [
            'class' => 'backup\Module',
        ],
    ],
    'aliases' => [
        '@rbac' => '@backend/modules/rbac',
        '@backup' => '@backend/modules/backup',
    ],
    'as access' => [
        'class' => 'rbac\components\AccessControl',
        'allowActions' => [
            'user/default/logout'
        ],
    ],
    'as adminLog' => 'backend\\behaviors\\AdminLogBehavior',
    'params' => $params,
];
