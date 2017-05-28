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
            <?php //var_dump($hits); ?>
            <?php foreach ($hits as $hit) : ?>
                <div class="span3 product">
                    <div>
                        <figure>
                            <?php if ($hit->new !== null) : ?>
                                <span class="new">Новинка</span>
                            <?php endif; ?>
                            <?php if ($hit->sale !== null) : ?>
                                <span class="sale">Расспродажа</span>
                            <?php endif; ?>

                            <a href="#"><?php echo Html::img("/web/img/products/" . $hit->image, ['alt' => $hit->name]); ?></a>
                            <div class="overlay">
                                <a href="http://placehold.it/270x186" class="zoom prettyPhoto"></a>
                                <a href="#" class="link"></a>
                            </div>
                        </figure>
                        <div class="detail">
                            <p>Опт. <span><?php echo number_format($hit->price, 2, ',', ' '); ?></span></p>
                            <p>Розн. <span><?php echo number_format($hit->wholesale_price, 2, ',', ' '); ?></span></p>
                            <h4><?php echo $hit->name; ?></h4>
                            <div class="icon">
                                <a href="#" class="label label-danger"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                                <a href="#" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>



        <div class="span3 product">
            <div>
                <figure>
                    <span class="sale">Расспродажа</span>
                    <a href="#"><img src="/web/img/2.jpeg" alt=""></a>
                    <div class="overlay">
                        <a href="http://placehold.it/270x186" class="zoom prettyPhoto"></a>
                        <a href="#" class="link"></a>
                    </div>
                </figure>
                <div class="detail">
                    <p>Опт. <span>244.00</span></p>
                    <p>Розн. <span>290.00</span></p>
                    <h4>Camera Samsung</h4>
                    <div class="icon">
                        <a href="#" class="label label-danger"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                        <a href="/product-details.html" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="span3 product">
            <div>
                <figure>
                    <span class="new">Новинка</span>
                    <span class="sale">Расспродажа</span>
                    <a href="#"><img src="/web/img/3.jpg" alt=""></a>
                    <div class="overlay">
                        <a href="http://placehold.it/270x186" class="zoom prettyPhoto"></a>
                        <a href="#" class="link"></a>
                    </div>
                </figure>
                <div class="detail">
                    <p>Опт. <span>244.00</span></p>
                    <p>Розн. <span>290.00</span></p>
                    <h4>Brown Wood Chair</h4>
                    <div class="icon">
                        <a href="#" class="label label-danger"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                        <a href="/product-details.html" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="span3 product">
            <div>
                <figure>
                    <span class="new">Новинка</span>
                    <a href="#"><img src="/web/img/1.jpg" alt=""></a>
                    <div class="overlay">
                        <a href="http://placehold.it/270x186" class="zoom prettyPhoto"></a>
                        <a href="#" class="link"></a>
                    </div>
                </figure>
                <div class="detail">
                    <p>Опт. <span>244.00</span></p>
                    <p>Розн. <span>290.00</span></p>
                    <h4>Камера для iPhone</h4>
                    <div class="icon">
                        <a href="#" class="label label-danger"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                        <a href="/product-details.html" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="span3 product">
            <div>
                <figure>
                    <span class="sale">Расспродажа</span>
                    <a href="#"><img src="/web/img/2.jpeg" alt=""></a>
                    <div class="overlay">
                        <a href="http://placehold.it/270x186" class="zoom prettyPhoto"></a>
                        <a href="#" class="link"></a>
                    </div>
                </figure>
                <div class="detail">
                    <p>Опт. <span>244.00</span></p>
                    <p>Розн. <span>290.00</span></p>
                    <h4>Camera Samsung</h4>
                    <div class="icon">
                        <a href="#" class="label label-danger"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                        <a href="/product-details.html" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="span3 product">
            <div>
                <figure>
                    <a href="#"><img src="/web/img/3.jpg" alt=""></a>
                    <div class="overlay">
                        <a href="http://placehold.it/270x186" class="zoom prettyPhoto"></a>
                        <a href="#" class="link"></a>
                    </div>
                </figure>
                <div class="detail">
                    <p>Опт. <span>244.00</span></p>
                    <p>Розн. <span>290.00</span></p>
                    <h4>Brown Wood Chair</h4>
                    <div class="icon">
                        <a href="#" class="label label-danger"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                        <a href="/product-details.html" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="span3 product">
            <div>
                <figure>
                    <a href="#"><img src="/web/img/1.jpg" alt=""></a>
                    <div class="overlay">
                        <a href="http://placehold.it/270x186" class="zoom prettyPhoto"></a>
                        <a href="#" class="link"></a>
                    </div>
                </figure>
                <div class="detail">
                    <p>Опт. <span>244.00</span></p>
                    <p>Розн. <span>290.00</span></p>
                    <h4>Камера для iPhone</h4>
                    <div class="icon">
                        <a href="#" class="label label-danger"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                        <a href="/product-details.html" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="span3 product">
            <div>
                <figure>
                    <a href="#"><img src="/web/img/5.jpg" alt=""></a>
                    <div class="overlay">
                        <a href="http://placehold.it/270x186" class="zoom prettyPhoto"></a>
                        <a href="#" class="link"></a>
                    </div>
                </figure>
                <div class="detail">
                    <p>Опт. <span>244.00</span></p>
                    <p>Розн. <span>290.00</span></p>
                    <h4>Camera Samsung</h4>
                    <div class="icon">
                        <a href="#" class="label label-danger"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                        <a href="/product-details.html" class="label label-info"><span class="glyphicon glyphicon-info-sign"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
