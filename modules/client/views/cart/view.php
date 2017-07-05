<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>

<div class="container">
    <?php if (!empty($session['cart'])) : ?>
        <div class="row">
            <div class="container-fluid">
                <h1 class="title">Оформление заказа</h1>
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
        <?php $form = ActiveForm::begin(); ?>
        <?php echo $form->field($order, 'comment')->textInput(['placeholder' => 'Наименование товара кторого вы не нашли в прайсе']); ?>
        <hr>
        <h1 class="title">Данные клиента</h1>

            <?php echo $form->field($order, 'firstName')->textInput(['value'=> $fio['firstName']]); ?>
            <?php echo $form->field($order, 'secondName')->textInput(['value'=> $fio['secondName']]); ?>
            <?php echo $form->field($order, 'lastName')->textInput(['value'=> $fio['lastName']]); ?>
            <?php echo $form->field($order, 'email')->textInput(['value'=> $fio['email']]); ?>
            <?php echo $form->field($order, 'phone')->textInput(['value'=> $fio['phone']]); ?>
            <?php echo $form->field($order, 'address')->textInput(['value'=> $fio['address']]); ?>
            <?php
                $items = \app\modules\client\controllers\MyHelper::cmap($delivery, 'id', ['name', 'cost'], ' Стоимость ');
                echo $form->field($order, 'delivery_id')->dropDownList($items);
            ?>

            <?php echo Html::submitButton('Заказать', ['class' => 'btn btn-success']); ?>
        <?php ActiveForm::end(); ?>
        <br>
        <br>
        <br>
    <?php else: ?>
        <div class="container-fluid">
            <h1 class="title">Ваш заказ принят, ожидайте!</h1>
        </div>
    <?php endif; ?>
</div>