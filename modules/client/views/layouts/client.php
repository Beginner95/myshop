<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\ltAppAsset;

AppAsset::register($this);
ltAppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>Кабинет клиента: <?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="<?php echo \yii\helpers\Url::to(['default/'])?>">Главная<span class="sr-only">(current)</span></a></li>
                                <li><a href="">Сообщения</a></li>


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">История<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="">Заказы</a></li>
                                        <li><a href="">Возвраты</a></li>
                                        <li><a href="">Оплата</a></li>
                                    </ul>
                                </li>

                                <li><a href="">Оформить возврат</a></li>
                                <li><a href="">Внести оплату</a></li>
                                <li><a href="">Сменить пароль</a></li>
                                <li><a href="">Скачать прайс</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="auth_spec"><?php //echo $user[0]['firstname'] . ' ' . $user[0]['secondname'] . ' ' . $user[0]['lastname']; ?> </li>
                                <li><a href="">Выход</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

    <div class="container-fluid">
        <?php echo $content; ?>
    </div>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>