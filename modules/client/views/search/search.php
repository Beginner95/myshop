<?php
    use yii\helpers\Html;
?>



    <div class="col-md-6"></div>
    <div class="row">
        <div class="container-fluid">
            <h1 class="title">Поиск по запросу: <?php echo Html::encode($q); ?></h1>
        </div>
    </div>
    <div class="row">
        <?php if (!empty($products)) : ?>
        <table class="table table-bordered my-table">
            <tr>
                <th>#</th>
                <th>Картинка</th>
                <th>Наименование товара</th>
                <th>Цена</th>
            </tr>
            <?php foreach ($products as $product) : ?>
                <?php $mainImg = $product->getImage(); ?>
            <tr>
                <td><a href="<?php echo \yii\helpers\Url::to(['cart/add', 'id' => $product->id])?>" data-id="<?php echo $product->id; ?>" class="label label-danger add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span></a></td>
                <td><?php echo Html::img($mainImg->getUrl('68x70'), ['alt' => $product->name]); ?></td>
                <td><?php echo $product->name; ?></td>
                <td><?php echo number_format($product->price, 2, ',', ' '); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
            <div class="container-fluid"><?php echo \yii\widgets\LinkPager::widget(['pagination' => $pages,]); ?></div>
        <?php else: ?>
            <div class="container"><h3>Ничего не найдено...</h3></div>
        <?php endif; ?>
    </div>