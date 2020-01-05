<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'name' => 'Money&Banking',
    'language' =>'th',
    'timezone' => 'Asia/Bangkok',
    'components' => [
        'searchFilter' => [
            'class' => 'common\components\searchFilter',
        ],
        'MData' => [
            'class' => 'common\components\MData',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'aliases' => [
        '@theme-front'=>'@app',
    ],
];
