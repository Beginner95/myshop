<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\client\controllers\OrderClientController;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
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
                        return '<a href="/client/order-client/view?id=' . $data->id . '">Заказ ' . OrderClientController::getDate($data->date_added) . '</a>';
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'sum',
                    'value' => function ($data) {
                        return number_format($data->sum, 2, ',',' ');
                    }
                ],
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
        <h1>Детали заказа</h1>
        <br>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Наименование товара</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item) : ?>
                <tr
                    <?php
                        if ($item['status'] == 1) {
                            echo 'style="background: #adebad;"';
                        } else {
                            echo 'style="background: #ff9999;"';
                        }
                    ?>
                >
                    <td><?php echo $item->name; ?></td>
                    <td><?php echo $item->qty_item; ?></td>
                    <td><?php echo number_format($item->price, 2, ',', ' '); ?></td>
                    <td><?php echo number_format($item->sum_item, 2, ',', ' '); ?></td>
                    <td>
                        <?php
                            if ($item->status == 1) {
                                echo 'Есть';
                            } else {
                                echo 'Нет';
                            }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>

    <?php else: ?>
        <h1>Все товары по данному заказу возвращены</h1>
    <?php endif; ?>
    </div>
</div>