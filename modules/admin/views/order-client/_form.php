<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ '0' => 'Активен', '1' => 'Завершен', ]) ?>

    <?= $form->field($model, 'secondName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <h3>Товары в заказе</h3>
    <table class="table table-responsive">
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Сумма</th>
            <th>Стутаус</th>
        </tr>
    <?php $i = 1; foreach ($items as $item) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $item->name; ?></td>
            <td><?php echo $item->qty_item; ?></td>
            <td><?php echo number_format($item->price, 2, ',', ' '); ?></td>
            <td><?php echo number_format($item->sum_item, 2, ',', ' '); ?></td>
            <td><?php echo $form->field($item, 'status[' . $item->id . ']')->dropDownList([ '1' => 'Есть', '0' => 'Нет', ]) ?></td>
        </tr>
    <?php endforeach; ?>
    </table>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
