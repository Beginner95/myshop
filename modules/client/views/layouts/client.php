<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\ClientAppAsset;
use app\assets\ltAppAsset;

ClientAppAsset::register($this);
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
        <!--Navigation-->
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
                                <li class="active"><a href="<?php echo \yii\helpers\Url::to(['default/index'])?>">Главная<span class="sr-only">(current)</span></a></li>
                                <li><a href="">Сообщения</a></li>


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">История<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo \yii\helpers\Url::to(['order-client/']); ?>">Заказы</a></li>
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
                                <li class="auth_spec"><?php echo Yii::$app->user->identity->firstName . ' ' . Yii::$app->user->identity->secondName . ' ' . Yii::$app->user->identity->lastName; ?></li>
                                <li><a href="<?php echo \yii\helpers\Url::to(['/site/logout']); ?>">Выход</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <?php echo $content; ?>

        <?php
        \yii\bootstrap\Modal::begin([
            'header' => '<h2>Корзина</h2>',
            'id' => 'cart',
            'size' => 'modal-lg',
            'footer' => '<button type="button" class="btn btn-default" onClick="window.location.reload()">Продолжить покупки</button> 
                         <a href="' . \yii\helpers\Url::to(['cart/view']) . '" class="btn btn-success">Оформить заказ</a> 
                         <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>'
        ]);

        \yii\bootstrap\Modal::end();
        ?>
    </div>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>