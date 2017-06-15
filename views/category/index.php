<?php
    use yii\helpers\Html;
?>
<header>
    <div class="container">
        <div class="row">
            <div class="span9 slider">
                <div class="slider-slides">
                    <?php foreach ($sliders as $slider) : ?>
                        <div class="slides">
                            <img src="/web/img/<?php echo $slider['image']; ?>" alt="">
                            <div class="overlay">
                                <h1><?php echo $slider['name']; ?></h1>
                                <p><?php echo $slider['content']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="#" class="next"></a>
                <a href="#" class="prev"></a>
                <div class="slider-btn"></div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <?php if (!empty($hits)) : ?>
            <div class="container-fluid">
                <h1 class="title">Популярные товары</h1>
            </div>
            <?php foreach ($hits as $hit) : ?>
                <?php $mainImg = $hit->getImage();?>
                <div class="span3 product">
                    <div>
                        <figure>
                            <?php if ($hit->new !== null) : ?>
                                <span class="new">Новинка</span>
                            <?php endif; ?>
                            <?php if ($hit->sale !== null) : ?>
                                <span class="sale">Расспродажа</span>
                            <?php endif; ?>
                            <a href="<?php echo \yii\helpers\Url::to(['product/view', 'id' => $hit->id]); ?>"><?php echo Html::img($mainImg->getUrl('268x270'), ['alt' => $hit->name]); ?></a>
                        </figure>
                        <div class="detail">
                            <p>Опт. <span><?php echo number_format($hit->price, 2, ',', ' '); ?></span></p>
                            <p>Розн. <span><?php echo number_format($hit->wholesale_price, 2, ',', ' '); ?></span></p>
                            <a href="<?php echo \yii\helpers\Url::to(['product/view', 'id' => $hit->id]); ?>"><h4><?php echo $hit->name; ?></h4></a>
                            <div class="icon">
                                <a href="<?php echo \yii\helpers\Url::to(['cart/add', 'id' => $hit->id]); ?>" data-id="<?php echo $hit->id; ?>" class="label label-danger add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                                <a href="<?php echo \yii\helpers\Url::to(['product/view', 'id' => $hit->id]); ?>" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
