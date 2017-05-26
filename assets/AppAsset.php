<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'libs/bootstrap/3.3.7/css/bootstrap.min.css',
        'css/main.css',
        'css/prettyPhoto.css',
    ];
    public $js = [
//        'libs/jquery/2.2.4/jquery.min.js',
        'js/jquery.cycle.all.js',
        'js/jquery.magnific-popup.min.js',
        'js/jquery.prettyPhoto.js',
        'web/libs/modernizr/modernizr.js',
        'js/common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
