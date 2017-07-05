<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <p>Дата заказа: <?php echo $model->date_added; ?></p>
    <p>Дата последнего изменения: <?php echo $model->date_update; ?></p>
    <p>Имя клиента: <?php echo $model->secondName; ?></p>
    <p>Телефон: <?php echo $model->phone; ?></p>
    <p>Дополнение к заказу: <?php echo $model->comment; ?></p>
    <?= $form->field($model, 'status')->dropDownList([ '0' => 'Активен', '1' => 'Завершен', ]) ?>

    <?= $form->field($model, 'client_id')->hiddenInput()->label('') ?>
    <h3>Товары в заказе</h3>
    <table class="table table-responsive">
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Сумма</th>
            <th>Наличие</th>
        </tr>
    <?php $i = 1; foreach ($items as $item) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $item->name; ?></td>
            <td><?php echo $item->qty_item; ?></td>
            <td><?php echo number_format($item->price, 2, ',', ' '); ?></td>
            <td><?php echo number_format($item->sum_item, 2, ',', ' '); ?></td>
            <td>
                <?php
                    echo $form->field($item, 'sum_item[' . $item->id . ']')->hiddenInput(['value' => $item->sum_item])->label('');
                    echo $form->field($item, 'availability')
                        ->radioList([
                            '1' => 'Есть',
                            '0' => 'Нет',
                        ], [
                            'id' => 'blog_type',
                            'class' => 'btn-group',
                            'name' => 'availability[' . $item->id . ']',
                            'data-toggle' => 'buttons',
                            'unselect' => $item->availability,
                            'item' => function ($index, $label, $name, $checked, $value) {
                                return '<label class="btn btn-primary' . ($checked ? ' active' : '') . '">' .
                                Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                            },
                        ]);
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td colspan="2">Итого (цена с доставкой)</td>

            <td><?php echo $model->qty; ?></td>
            <td></td>
            <td><?php echo number_format($model->sum, 2, ',', ' '); ?></td>
            <td></td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
