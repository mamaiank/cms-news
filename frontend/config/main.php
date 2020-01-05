<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
// use \yii\web\Request;
// $baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' =>'th',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@app/themes/mnb/views',
                ],
            ],
        ],
        'request' => [
            // 'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
           'class' => 'yii\web\UrlManager',
           // Disable index.php
           'showScriptName' => false,
           // Disable r= routes
           'enablePrettyUrl' => true,
           'rules' => array(
                    '<id:\d+>/<category:\d+>/<title:[ก-๙A-Za-z0-9-_.]+>' => 'news/detail',
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
           ),
        ],
    ],
    'params' => $params,
];
