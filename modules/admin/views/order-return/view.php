<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OrderReturn */

$this->title = 'Возврат №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Returns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-return-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            [
                'attribute' => 'user_id',
                'value' => $model->user->firstName . ' ' . $model->user->secondName . ' ' . $model->user->lastName,
            ],
            'date_added',
            'date_update',
            'qty',
            [
                'attribute' => 'sum',
                'value' => number_format($model->sum, 2, ',', ' '),
            ],
            [
                'attribute' => 'status',
                'value' =>  $model->status ? '<span class="text-success">Подтвержден</span>' : '<span class="text-danger">Не подтвержден</span>',
                'format' => 'html',
            ],
        ],
    ]) ?>
    <?php $items = $model->orderItemsReturns; ?>
    <?php if (!empty($items)) : ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th>Дата заказа</th>
                    <th>Причина возврата</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($items as $item):?>
                    <tr>
                        <td><a href="<?= \yii\helpers\Url::to(['/product/view', 'id' => $item->product_id])?>"><?= $item['name']?></a></td>
                        <td><?= $item['qty_item']?></td>
                        <td><?= $item['price']?></td>
                        <td><?= number_format($item['sum_item'], 2, ',', ' ')?></td>
                        <td><?= $item['date_added']?></td>
                        <td><?= $item['description']?></td>
                    </tr>
                <?php endforeach?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <h3>Возможно по данному заказу все товары клиент вернул</h3>
    <?php endif; ?>
</div>
