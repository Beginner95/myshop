<?php

use yii\helpers\Html;

?>
<div class="container">
    <div class="row">
        <div class="container-fluid">
            <h1 class="title"><?php echo $category->name; ?></h1>
        </div>
    </div>
    <div class="row">
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <?php $mainImg = $product->getImage(); ?>
                <div class="span3 product">
                    <div>
                        <figure>
                            <?php if ($product->new !== null) : ?>
                                <span class="new">Новинка</span>
                            <?php endif; ?>
                            <?php if ($product->sale !== null) : ?>
                                <span class="sale">Расспродажа</span>
                            <?php endif; ?>

                            <a href="<?php echo \yii\helpers\Url::to(['product/view', 'id' => $product->id]); ?>"><?php echo Html::img($mainImg->getUrl('268x270'), ['alt' => $product->name]); ?></a>
                        </figure>
                        <div class="detail">
                            <p>Розн. <span><?php echo number_format($product->price, 2, ',', ' '); ?></span></p>
                            <p>Опт. <span><?php echo number_format($product->wholesale_price, 2, ',', ' '); ?></span></p>
                            <a href="<?php echo \yii\helpers\Url::to(['product/view', 'id' => $product->id]); ?>"><h4><?php echo $product->name; ?></h4></a>
                            <div class="icon">
                                <a href="<?php echo \yii\helpers\Url::to(['cart/add', 'id' => $product->id])?>" data-id="<?php echo $product->id; ?>" class="label label-danger add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                                <a href="<?php echo \yii\helpers\Url::to(['product/view', 'id' => $product->id]); ?>" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="clearfix"></div>
            <div class="container-fluid"><?php echo \yii\widgets\LinkPager::widget(['pagination' => $pages,]); ?></div>
        <?php else: ?>

            <h2>Товаров нет</h2>

        <?php endif; ?>
    </div>
</div>