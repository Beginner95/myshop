<?php
    use yii\helpers\Html;
?>
<div class="container">
    
    <div class="row">
        <div class="product-details">
            <div>
                <figure>
                    <?php echo Html::img("/web/img/products/" . $product->image, ['alt' => $product->name]); ?>
                </figure>
                <div class="product-detail">
                    <h4><?php echo $product->name; ?></h4>
                    <p><strong>Розн: </strong><?php echo number_format($product->price, 2, ',', ' '); ?></p>
                    <p><strong>Опт: </strong><?php echo number_format($product->wholesale_price, 2, ',', ' '); ?></p>

                    <div class="icon">
                        <input type="number" value="1" class="form-control" id="qty">
                        <a href="<?php echo \yii\helpers\Url::to(['cart/add', 'id' => $product->id])?>" data-id="<?php echo $product->id; ?>" class="btn btn-danger add-to-cart">Добавить в корзину</a>
                    </div>
                    <div class="info">
                        <p>
                            <strong>Категория: </strong>
                            <?php echo $product->category->name; ?>
                        </p>
                        <p>
                            <strong>Модель: </strong>
                            <?php echo $product->model; ?>
                        </p>
                        <p>
                            <strong>Новинка: </strong>
                            <?php echo $product->new ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>'; ?>
                        </p>
                        <p>
                            <strong>Хит: </strong>
                            <?php echo $product->hit ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>'; ?>
                        </p>
                        <p>
                            <strong>Распродажа: </strong>
                            <?php echo $product->sale ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>'; ?>
                        </p>
                        <p><strong>Описание:</strong> <?php echo $product->content; ?></p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
