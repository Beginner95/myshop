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
                        <ul>
                            <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span><span class="qty">10</span></a></li>
                            <li>Ваша корзина <br> 0 товаров - 0</li>
                        </ul>
                    </div>

                    <form class="block-serch">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Поиск по товарам">
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>

                    <div class="block-phone">
                        <p>Справочная служба</p>
                        <p class="phone-number">+7 (929) 888 02 05</p>
                    </div>
                    <div class="logo">
                        <a class="navbar-brand" href="<?php echo \yii\helpers\Url::home(); ?>">Logotip</a>
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
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Вход <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Войти в личный кабинет</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Запрос на регистрацию</a></li>
                                </ul>
                            </li>
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
                    <h2>ООО "Ромашка"</h2>
                    <p>Купив один раз у нас товар, вы обязательно придете к нам за покупками еще</p>
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
                        <li>Тел: +1 (999) 999 99 99</li>
                        <li>Email: admin@admin.ru</li>
                        <li>Адрес: Ромашкина 10</li>
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
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>