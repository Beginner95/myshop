<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\client\controllers\OrderClientController;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Возвраты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index row">
    <div class="col-md-3">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'date_added',
                    'value'     => function($data) {
                        return '<a href="/client/return/view?id=' . $data->id . '">Заказ ' . OrderClientController::getDate($data->date_added) . '</a>';
                    },
                    'format' => 'html',
                ],
                'sum',
                [
                    'attribute' => 'status',
                    'value'     => function($data) {
                        return !$data->status ? '<span class="text-danger">В обработке</span>' : '<span class="text-success">Готов</span>';
                    },
                    'format'    => 'html',
                ],
            ],
        ]); ?>
    </div>
    <?php if (!empty($items)) : ?>
    <div class="col-md-9">
        <h1>Детали возврата</h1>
        <br>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Наименование товара</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th>Дата заказа</th>
                    <th>Причина возврата</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) : ?>
                    <tr>
                        <td><?php echo $item->name; ?></td>
                        <td><?php echo $item->qty_item; ?></td>
                        <td><?php echo $item->price; ?></td>
                        <td><?php echo $item->sum_item; ?></td>
                        <td><?php echo $item->date_added; ?></td>
                        <td><?php echo $item->description; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <h1>Все товары по данному заказу возвращены</h1>
    <?php endif; ?>
    </div>
</div>