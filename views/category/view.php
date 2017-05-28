<?php

use yii\helpers\Html;

?>
<div class="container">
    <div class="row">
        <div class="container-fluid">
            <h1 class="title">Популярные товары</h1>
        </div>
    </div>
    <div class="row">
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="span3 product">
                    <div>
                        <figure>
                            <?php if ($product->new !== null) : ?>
                                <span class="new">Новинка</span>
                            <?php endif; ?>
                            <?php if ($product->sale !== null) : ?>
                                <span class="sale">Расспродажа</span>
                            <?php endif; ?>

                            <a href="#"><?php echo Html::img("/web/img/products/" . $product->image, ['alt' => $product->name]); ?></a>
                            <div class="overlay">
                                <a href="http://placehold.it/270x186" class="zoom prettyPhoto"></a>
                                <a href="#" class="link"></a>
                            </div>
                        </figure>
                        <div class="detail">
                            <p>Опт. <span><?php echo number_format($product->price, 2, ',', ' '); ?></span></p>
                            <p>Розн. <span><?php echo number_format($product->wholesale_price, 2, ',', ' '); ?></span></p>
                            <h4><?php echo $product->name; ?></h4>
                            <div class="icon">
                                <a href="#" class="label label-danger"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                                <a href="#" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>

            <h2>Товаров нет</h2>

        <?php endif; ?>
    </div>
</div>