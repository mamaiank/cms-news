<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'frontend/web/css/jquery.bxslider.css',
        'frontend/web/css/mb-custom.css',
        'frontend/web/css/mb-style.css',
        'frontend/web/css/jquery.fancybox.css',
        'frontend/web/css/ie10-viewport-bug-workaround.css',
        'frontend/web/fonts/fontawesome/font-awesome.css',
        'frontend/web/fonts/SukhumvitSet/fonts-sukhumvitset.css',
        // 'css/bootstrap.min.css',
    ];
    public $js = [
        // 'js/1.12.4/jquery.min.js',
        'frontend/web/js/jquery.bxslider.min.js',
        'frontend/web/js/bootstrap.min.js',
        'frontend/web/js/ie10-viewport-bug-workaround.js',
        'frontend/web/js/jquery-common.utilities.js',
        'frontend/web/js/ie-emulation-modes-warning.js',
        'frontend/web/js/cumtom-js.js',
        'frontend/web/js/jquery.fancybox.min.js',
        


    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
