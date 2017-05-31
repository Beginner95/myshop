<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <div class="row">
        <div class="container-fluid">
            <h1 class="title">Оформление заказа</h1>
        </div>
    </div>

    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')) : ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($session['cart'])) : ?>
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
                        <td><?php echo \yii\helpers\Html::img("/web/img/products/{$item['img']}", ['alt' => $item['name'], 'height' => 50]); ?></td>
                        <td><a href="<?php echo Url::to(['product/view', 'id' => $id])?>"><?php echo $item['name']; ?></a></td>
                        <td style="text-align: center;"><?php echo $item['qty']; ?></td>
                        <td style="text-align: center;"><?php echo number_format($item['price'], 2, ',', ' '); ?></td>
                        <td style="text-align: center;"><?php echo number_format($item['qty'] * $item['price'], 2, ',', ' '); ?></td>
                        <td style="text-align: center;"><span data-id="<?php echo $id; ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5">Итого: </td>
                    <td style="text-align: center;"><?php echo $session['cart.qty']; ?></td>
                </tr>
                <tr>
                    <td colspan="5">На сумму: </td>
                    <td style="text-align: center;"><?php echo number_format($session['cart.sum'], 2, ',', ' '); ?></td>
                </tr>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
        <hr>
        <?php $form = ActiveForm::begin(); ?>
            <?php echo $form->field($order, 'name'); ?>
            <?php echo $form->field($order, 'email'); ?>
            <?php echo $form->field($order, 'phone'); ?>
            <?php echo $form->field($order, 'address'); ?>
            <?php echo Html::submitButton('Заказать', ['class' => 'btn btn-success']); ?>
        <?php ActiveForm::end(); ?>
        <hr>
    <?php else: ?>
        <h3>Корзина пуста</h3>
    <?php endif; ?>
</div>