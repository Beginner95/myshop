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
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <div class="container">
        <div class="row">
            <div class="container-fluid">
                <nav class="top">
                    <div class="cart">
                        <?php if (empty(Yii::$app->session['cart'])) : ?>
                        <ul>
                            <li style="padding-left: 35px">
                                <a href="#" onclick="return getCart()">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                </a>
                            </li>
                            <li style="margin-top: 8px;">Корзина пуста!</li>
                        </ul>

                        <?php else: ?>
                        <ul>
                            <li>
                                <a href="#" onclick="return getCart()">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    <span class="qty count-qty"><?php echo Yii::$app->session['cart.qty']; ?></span>
                                </a>
                            </li>
                            <li>
                                Ваша корзина <br>
                                <?php echo Yii::$app->session['cart.qty']; ?>
                                товаров -
                                <?php echo number_format(Yii::$app->session['cart.sum'], 2, ',', ' '); ?>р.
                            </li>
                        </ul>
                        <?php endif; ?>
                    </div>

                    <form method="get" action="<?php echo \yii\helpers\Url::to(['search/search']); ?>" class="block-serch">
                        <div class="form-group">
                            <input type="text" name="q" class="form-control" placeholder="Поиск по товарам">
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>

                    <div class="block-phone">
                        <p>Справочная служба</p>
                        <p class="phone-number"><?php echo \app\components\SettingsWidget::widget(['position' => 'phone']); ?></p>
                    </div>
                    <div class="logo">
                        <a class="navbar-brand" href="<?php echo \yii\helpers\Url::home(); ?>">
                            <img src="<?php echo \app\components\SettingsWidget::widget(['position' => 'logotip']); ?>" alt="logo">
                        </a>
                    </div>
                    <div class="clear"></div>
                </nav>
            </div>
        </div>
    </div>
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
                            <?php echo \app\components\MenuWidget::widget(['tpl' => 'menu']) ?>
                            <li><a href="#">Условия работы</a></li>
                            <li><a href="#">Контакты</a></li>
                        </ul>

                            <ul class="nav navbar-nav navbar-right">
                            <?php if (!Yii::$app->user->isGuest) : ?>
                                <?php if (!empty(Yii::$app->user->identity['id']) && Yii::$app->user->identity['id'] == 1 ) { ?>
                                    <li>
                                        <a href="<?php echo \yii\helpers\Url::to(['/admin/']); ?>">
                                            Админская часть
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo \yii\helpers\Url::to(['/client/default']); ?>">
                                            Кабинет клиента
                                        </a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="<?php echo \yii\helpers\Url::to(['/site/logout']); ?>">
                                        <?php echo Yii::$app->user->identity['username']; ?> (Выход)
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Вход <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo \yii\helpers\Url::to(['/client/default']); ?>">Войти в личный кабинет</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?php echo \yii\helpers\Url::to(['site/registration']); ?>">Запрос на регистрацию</a></li>
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

<?php echo $content; ?>



<div class="container">
    <footer>
        <div class="row"></div>
        <div class="row">
            <div class="container-fluid">
                <div class="col-md-4">
                    <h2><?php echo \app\components\SettingsWidget::widget(['position' => 'name_company']); ?></h2>
                    <p><?php echo \app\components\SettingsWidget::widget(['position' => 'slogan']); ?></p>
                </div>
                <div class="col-md-4">
                    <h2>Навигация</h2>
                    <nav class="menu-bottom">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">PC</a></li>
                            <li><a href="#">iPhone</a></li>
                            <li><a href="#">Samsung</a></li>
                            <li><a href="#">Sony</a></li>
                            <li><a href="#">Lume</a></li>
                            <li><a href="#">Прочие телефоны</a></li>
                            <li><a href="#">Аксессуары</a></li>
                            <li><a href="#">Рации</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-4">
                    <h2>Контакты</h2>
                    <ul class="contacts">
                        <li>Тел: <?php echo \app\components\SettingsWidget::widget(['position' => 'phone']); ?></li>
                        <li>Email: <?php echo \app\components\SettingsWidget::widget(['position' => 'email']); ?></li>
                        <li>Адрес: <?php echo \app\components\SettingsWidget::widget(['position' => 'address']); ?></li>
                        <br>
                        <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir"></div>
                    </ul>
                    <script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
                    <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="copy">
                <p>&copy 2017</p>
            </div>

        </div>
    </footer>
    <?php
        \yii\bootstrap\Modal::begin([
            'header' => '<h2>Корзина</h2>',
            'id' => 'cart',
            'size' => 'modal-lg',
            'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button> 
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