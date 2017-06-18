<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

    <div class="row">
        <div class="col-md-6">
            <div class="row-two-left">
                <p>Ваш баланс:
                    <?php
                        if (!empty($balance[0]->amount)) {
                            echo number_format($balance[0]->amount, 2, ',', ' ');
                        } else {
                            echo '00,00';
                        }
                    ?>
                </p>
            </div>
            <div class="row-two-right">
                <p><?php echo date('d.m.Y'); ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row-two">
                <div class="row-two-left">
                    <p>Введите нужный для поиска товар</p>
                </div>
                <div class="row-two-right">
                    <p>1 у.е. = 1.95</p>
                </div>
            </div>
        </div>

    </div>

    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="msg-left">
                <p>Ваша отсрочка - 14 дней;  Ваш кредит - 300 у.е.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="msg-right">
                <p>При заказе и наличии товара на сумму от 100 у.е - доставка EMS БЕСПЛАТНА!!!</p>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <div id="cart-client">
                <?php if (!empty($session['cart'])) : ?>
                    <div class="row">
                        <div class="container-fluid">
                            <span class="title">Корзина</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Фото</th>
                                <th>Наименование</th>
                                <th style="text-align: center;">Кол-во</th>
                                <th style="text-align: center;">Цена</th>
                                <th style="text-align: center;">Сумма</th>
                                <th style="text-align: center;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($session['cart'] as $id => $item) : ?>
                                <tr>
                                    <td><?php echo \yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]); ?></td>
                                    <td><a href="<?php echo Url::to(['product/view', 'id' => $id])?>"><?php echo $item['name']; ?></a></td>
                                    <td style="text-align: center;"><?php echo $item['qty']; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($item['price'] * ((100 - Yii::$app->user->identity->discount) / 100), 2, ',', ' '); ?></td>
                                    <td style="text-align: center;"><?php echo number_format($item['qty'] * $item['price'] * ((100 - Yii::$app->user->identity->discount) / 100), 2, ',', ' '); ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?php echo \yii\helpers\Url::to(['/cart/del-item', 'id' => $id])?>" data-id="<?php echo $id; ?>" class="del-item">
                                            <span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5">Итого: </td>
                                <td style="text-align: center;"><?php echo $session['cart.qty']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="5">На сумму: </td>
                                <td style="text-align: center;"><?php echo number_format($session['cart.sum'] * ((100 - Yii::$app->user->identity->discount) / 100), 2, ',', ' '); ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="clear"></div>
                    </div>
                    <a href="<?php echo \yii\helpers\Url::to(['cart/view']); ?>" class="btn btn-success">Оформить заказ</a>
                <?php else: ?>
                    <div class="container-fluid">
                        <span class="title">У вас нет заказанных товаров</span>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    <div class="col-md-6">
        <div class="block-search">
            <form method="get" action="<?php echo \yii\helpers\Url::to(['default/search']); ?>">
                <div class="form-group">
                    <input type="text" name="q" class="form-control search" placeholder="Поиск по товарам">
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </div>
            </form>
        </div>
        <?php if (!empty($_GET['q'])) : ?>
        <div class="row">
            <div class="container-fluid">
                <span class="title">Поиск по запросу: <?php echo Html::encode($q); ?></span>
            </div>
        </div>
        <div class="row">

            <div class="container-fluid">
            <?php if (!empty($products)) : ?>

                <table class="table table-bordered my-table">
                    <tr>
                        <th>#</th>
                        <th>Кол-во</th>
                        <th>Картинка</th>
                        <th>Наименование товара</th>
                        <th>Цена</th>
                    </tr>
                    <?php foreach ($products as $product) : ?>
                        <?php if ($product->status == 1) : ?>
                        <?php $mainImg = $product->getImage(); ?>
                        <tr>
                            <td>
                                <a href="<?php echo \yii\helpers\Url::to(['cart/add', 'id' => $product->id])?>" data-id="<?php echo $product->id; ?>" class="add-to-cart">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                </a>
                            </td>
                            <td>
                                <input type="number" value="1" class="form-control" id="qty">
                            </td>
                            <td>
                                <a href="<?php echo $mainImg->getUrl(); ?>" class="img-big">
                                    <?php echo Html::img($mainImg->getUrl('30x50'), ['alt' => $product->name]); ?>
                                </a>
                            </td>
                            <td><?php echo $product->name; ?></td>
                            <td><?php echo number_format($product->price * ((100 - Yii::$app->user->identity->discount) / 100), 2, ',', ' '); ?></td>
                        </tr>
                            <?php endif; ?>
                    <?php endforeach; ?>
                </table>
                <div class="container-fluid"><?php echo \yii\widgets\LinkPager::widget(['pagination' => $pages,]); ?></div>
            <?php else: ?>
                <div class="container"><h3>Ничего не найдено...</h3></div>
            <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    </div>
