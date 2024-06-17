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
        "bootstrap-italia/css/bootstrap-italia.min.css",
        "css/fonts.css"
    ];

    public $js = [
        "bootstrap-italia/js/bootstrap-italia.bundle.min.js"
    ];

    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap5\BootstrapAsset',
    ];
}
