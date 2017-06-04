<?php

namespace app\assets;

use yii\web\AssetBundle;

class ClientAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/wholesaler.css',
        'css/magnific-popup.css',
    ];
    public $js = [
        'js/jquery.cycle.all.js',
        'js/jquery.magnific-popup.min.js',
        'web/libs/modernizr/modernizr.js',
        'js/client.js',
        'js/wholesaler.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
