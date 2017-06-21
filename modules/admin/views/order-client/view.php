<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->secondName;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
    <h1>Просмотр заказа №<?= $model->id ?></h1>
    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date_added',
            'date_update',
            'qty',
            [
                'attribute' => 'sum',
                'value' => number_format($model->sum, 2, ',', ' '),
            ],
            [
                'attribute' => 'status',
                'value' => !$model->status ? '<span class="text-danger">Активен</span>' : '<span class="text-success">Завершен</span>',
                'format' => 'html',
            ],
            'secondName',
            'email:email',
            'phone',
            'address',
            [
                'attribute' => 'delivery_id',
                'value'     => $model->delivery->name,
            ],
            'comment',
        ],
    ]) ?>

    <?php $items = $model->orderItems; ?>
    <?php if (!empty($items)) : ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($items as $item):?>
                <tr>
                    <td><a href="<?= \yii\helpers\Url::to(['/product/view', 'id' => $item->product_id])?>"><?= $item['name']?></a></td>
                    <td><?= $item['qty_item']?></td>
                    <td><?= number_format($item['price'], 2, ',', ' ') ?></td>
                    <td><?= number_format($item['sum_item'], 2, ',', ' ') ?></td>
                </tr>
            <?php endforeach?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <h3>Возможно по данному заказу все товары клиент вернул</h3>
    <?php endif; ?>
</div>
