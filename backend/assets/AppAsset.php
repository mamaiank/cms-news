<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/css/site.css',
        'web/css/select2.min.css',
        'web/css/slim.min.css',
    ];
    public $js = [
        '../tinymce/tinymce.min.js',
        'web/js/select2.full.min.js',
        'web/js/slim.kickstart.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
