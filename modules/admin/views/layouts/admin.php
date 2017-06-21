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
        <title>Админка: <?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </head>
    <body>
    <?php $this->beginBody() ?>
    <header>

        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
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
                                <li><a href="<?php echo \yii\helpers\Url::to(['/admin']); ?>">Главная</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Сайт <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo \yii\helpers\Url::to(['slider/index']); ?>">Слайдер</a></li>
                                        <li><a href="<?php echo \yii\helpers\Url::to(['category/create']); ?>">Условия работы</a></li>
                                        <li><a href="<?php echo \yii\helpers\Url::to(['category/create']); ?>">Контакты</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Категории <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo \yii\helpers\Url::to(['category/index']); ?>">Список категории</a></li>
                                        <li><a href="<?php echo \yii\helpers\Url::to(['category/create']); ?>">Добавить категорию</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Товары <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo \yii\helpers\Url::to(['product/index']); ?>">Список товаров</a></li>
                                        <li><a href="<?php echo \yii\helpers\Url::to(['product/create']); ?>">Добавить товар</a></li>
                                        <li><a href="<?php echo \yii\helpers\Url::to(['import/upload']); ?>">Ипорт товаров</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo \yii\helpers\Url::to(['user/index']); ?>">Списко клиентов</a></li>
                                <li><a href="<?php echo \yii\helpers\Url::to(['order/index/']); ?>">Заказы</a></li>
                                <li><a href="<?php echo \yii\helpers\Url::to(['order-return/']); ?>">Возвраты</a></li>
                                <li><a href="<?php echo \yii\helpers\Url::to(['transaction/index']) ; ?>">Платежы</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <li><a href="<?php echo \yii\helpers\Url::to(['/site/logout']); ?>"><?php echo Yii::$app->user->identity['username']; ?> (Выход)</a></li>
                                <?php else: ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Вход <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Войти в личный кабинет</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#">Запрос на регистрацию</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>

                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </header>
<?php if (Yii::$app->user->identity->id == 1) : ?>
    <div class="container">
        <?php echo $content; ?>
    </div>
<?php else: ?>
    <div class="container">
        <div class="row">
        <div class="alert alert-warning" role="alert">Вам сюда нельзя <a href="<?php echo \yii\helpers\Url::to(['/']); ?>">Вернуться на главную</a> </div>
        </div>
    </div>
<?php endif; ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>