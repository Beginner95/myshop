<?php
    use yii\helpers\Html;
?>
<header>
    <div class="container">
        <div class="row">
            <div class="span9 slider">
                <div class="slider-slides">
                    <div class="slides">
                        <a href="#"><img src="/web/img/iPhone7.jpg" alt=""></a>
                        <div class="overlay">
                            <h1>iPhone 7</h1>
                            <p><span>50%</span> OFF <br/> TRENDY <span>DESIGNS</span> </p>

                        </div>
                    </div>
                    <div class="slides">
                        <a href="#"><img src="/web/img/iPhone6.jpg" alt=""></a>
                        <div class="overlay">
                            <h1>iPhone 6</h1>
                            <p><span>30%</span> OFF <br/> TRENDY <span>DESIGNS</span> </p>
                        </div>
                    </div>
                    <div class="slides">
                        <a href="#"><img src="/web/img/iPhone5.jpg" alt=""></a>
                        <div class="overlay">
                            <h1>iPhone</h1>
                            <p><span>50%</span> OFF <br/> TRENDY <span>DESIGNS</span> </p>
                        </div>
                    </div>
                    <div class="slides">
                        <a href="#"><img src="/web/img/Samsung8.jpg" alt=""></a>
                        <div class="overlay">
                            <h1>SAMSUNG 8</h1>
                            <p><span>30%</span> OFF <br/> TRENDY <span>DESIGNS</span> </p>
                        </div>
                    </div>
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
